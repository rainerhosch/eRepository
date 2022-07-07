<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Peminjaman.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 09/06/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('transaksi/M_peminjaman', 'peminjaman');
        $this->load->model('manajemen/M_buku', 'buku');
        $this->load->model('manajemen/M_user', 'user');
        $this->load->model('manajemen/M_denda', 'denda');
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Transaksi';
        $data['subpage'] = 'Peminjaman';
        $data['content'] = 'content/transaksi/v_peminjaman';
        $this->load->view('template', $data);
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $date_now = date('Y-m-d');
            $post_limit = $this->input->post('limit');
            $post_offset = $this->input->post('offset');
            $key_cari = $this->input->post('keyword');
            $post_page = $this->input->post('page');
            $filter_date = $this->input->post('filter_mounth');
            $url_pagination = $this->input->post('url_pagination');

            if ($key_cari != null || $filter_date != null) {
                if (!empty($filter_date)) {
                    if ($filter_date === 'date') {
                        $where = "tr_peminjaman.tanggal_pinjam='" . $date_now . "'";
                    } else {
                        $where = "SUBSTR(tr_peminjaman.tanggal_pinjam, 1,7)='" . substr($date_now, 0, 7) . "'";
                    }
                } else {
                    $where = "uda.nama LIKE '%" . $key_cari . "%' OR ag.username LIKE '%" . $key_cari . "%'";
                    // $where = "uda.nama LIKE '%" . $key_cari . "%' OR m_buku.judul_buku LIKE '%" . $key_cari . "%' OR ag.username LIKE '%" . $key_cari . "%'";
                }
            } else {
                $where = "tr_peminjaman.status_pengembalian = '0'";
            }
            if ($post_offset != null) {
                $offset = $post_offset;
            } else {
                $offset = 0;
            }
            if ($post_limit != 0) {
                $limit = $post_limit;
            } else {
                $limit = 10;
            }
            if ($offset != 0) {
                $offset = ($offset - 1) * $limit;
            }

            $this->load->library('pagination');

            $condition = [
                'field' => 'tr_peminjaman.*, uda.nama AS nama_anggota, udp.nama AS nama_petugas',
                'limit' => $limit,
                'offset' => $offset,
                'where' => $where,
                'join_tbl' => [
                    0 => [
                        'table' => 'user as ag',
                        'on' => 'ag.user_id=tr_peminjaman.id_anggota',
                        'join_type' => ''
                    ],
                    1 => [
                        'table' => 'user_detail as uda',
                        'on' => 'uda.user_detail_id=ag.user_detail_id',
                        'join_type' => ''
                    ],
                    2 => [
                        'table' => 'user ptg',
                        'on' => 'ptg.user_id=tr_peminjaman.id_petugas',
                        'join_type' => ''
                    ],
                    3 => [
                        'table' => 'user_detail as udp',
                        'on' => 'udp.user_detail_id=ptg.user_detail_id',
                        'join_type' => ''
                    ],
                    // 4 => [
                    //     'table' => 'm_buku',
                    //     'on' => 'm_buku.id_buku = tr_peminjaman.id_buku',
                    //     'join_type' => ''
                    // ]
                ]
            ];
            $data['peminjaman'] = $this->peminjaman->getData($condition)->result_array();
            foreach ($data['peminjaman'] as $key => $value) {

                $id_buku = explode(',', $value['id_buku']);
                $jml_buku_dipinjam = count($id_buku);
                foreach ($id_buku as $i => $item_buku) {
                    $data['peminjaman'][$key]['buku_dipinjam'][$i] = $this->buku->getBukuById(['id_buku' => $item_buku])->row_array();
                }

                $tgl_now = strtotime(date('Y-m-d'));
                $tgl_pengembalian = strtotime($value['tanggal_kembali']);
                $datediff = $tgl_now - $tgl_pengembalian;
                $denda = $this->denda->getDataMasterDenda(['nama_denda' => 'telat'])->row_array();
                if ($tgl_now > $tgl_pengembalian) {
                    $data['peminjaman'][$key]['denda_status'] = 1;
                    $data['peminjaman'][$key]['jml_hari_denda'] =  round($datediff / (60 * 60 * 24));
                    $data['peminjaman'][$key]['denda_telat'] =  ($denda['jml_denda'] * $data['peminjaman'][$key]['jml_hari_denda']) * $jml_buku_dipinjam;
                } else {
                    $data['peminjaman'][$key]['denda_status'] = 0;
                    $data['peminjaman'][$key]['jml_hari_denda'] = 0;
                    $data['peminjaman'][$key]['denda_telat'] =  ($denda['jml_denda'] * $data['peminjaman'][$key]['jml_hari_denda']) * $jml_buku_dipinjam;
                }
            }
            $where_total = [
                'tr_peminjaman.status_pengembalian' => '0'
            ];
            $data['total_data'] = $this->peminjaman->getCount($where_total);
            $total_page = ($data['total_data'] / $limit);
            $convert_data = intval(preg_replace('/[^\d.]/', '', $total_page));
            $data['total_page'] =  $convert_data;
            $data['current_page'] =  $offset;
            $data['limit_per_page'] =  $post_limit;
            $data["uri_segment"] = $where;


            // config pagination
            $config['base_url'] = base_url('manajemen/buku/getData');
            $config['total_rows'] = $data['total_data'];
            $config['per_page'] = $limit;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;
            $config['first_link'] = FALSE;
            $config['last_link'] = FALSE;

            // ============ config css pagination ======================
            $config['full_tag_open'] = "<nav aria-label='Page navigation example'><ul class='pagination pagination-sm float-end'>";
            $config['full_tag_close'] = '</ul></nav>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link"  href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['prev_tag_open'] = '<li class="page-item prev">';
            $config['prev_tag_close'] = '</li>';


            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';
            $config['next_tag_open'] = '<li class="page-item next">';
            $config['next_tag_close'] = '</li>';
            // ============ End config css pagination ======================

            $this->pagination->initialize($config);
            $data['pagination_link'] = $this->pagination->create_links();


            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data,
            ];
        } else {
            $res = [
                'code' => 403,
                'status' => false,
                'message' => 'Forbidden',
                'data' => null
            ];
        }

        echo json_encode($res);
    }

    public function getDataPeminjamanOneUser()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $where = "ag.username ='" . $data_post['username'] . "'";
            $condition = [
                'field' => 'tr_peminjaman.*, uda.nama AS nama_anggota, udp.nama AS nama_petugas',
                'limit' => 9999999999,
                'offset' => 0,
                'where' => $where,
                'join_tbl' => [
                    0 => [
                        'table' => 'user as ag',
                        'on' => 'ag.user_id=tr_peminjaman.id_anggota',
                        'join_type' => ''
                    ],
                    1 => [
                        'table' => 'user_detail as uda',
                        'on' => 'uda.user_detail_id=ag.user_detail_id',
                        'join_type' => ''
                    ],
                    2 => [
                        'table' => 'user ptg',
                        'on' => 'ptg.user_id=tr_peminjaman.id_petugas',
                        'join_type' => ''
                    ],
                    3 => [
                        'table' => 'user_detail as udp',
                        'on' => 'udp.user_detail_id=ptg.user_detail_id',
                        'join_type' => ''
                    ],
                ]
            ];
            $data['peminjaman'] = $this->peminjaman->getData($condition)->result_array();
            foreach ($data['peminjaman'] as $key => $value) {

                $id_buku = explode(',', $value['id_buku']);
                $jml_buku_dipinjam = count($id_buku);
                foreach ($id_buku as $i => $item_buku) {
                    $data['peminjaman'][$key]['buku_dipinjam'][$i] = $this->buku->getBukuById(['id_buku' => $item_buku])->row_array();
                }

                $tgl_now = strtotime(date('Y-m-d'));
                $tgl_pengembalian = strtotime($value['tanggal_kembali']);
                $datediff = $tgl_now - $tgl_pengembalian;
                $denda = $this->denda->getDataMasterDenda(['nama_denda' => 'telat'])->row_array();
                if ($tgl_now > $tgl_pengembalian) {
                    $data['peminjaman'][$key]['denda_status'] = 1;
                    $data['peminjaman'][$key]['jml_hari_denda'] =  round($datediff / (60 * 60 * 24));
                    $data['peminjaman'][$key]['denda_telat'] =  ($denda['jml_denda'] * $data['peminjaman'][$key]['jml_hari_denda']) * $jml_buku_dipinjam;
                } else {
                    $data['peminjaman'][$key]['denda_status'] = 0;
                    $data['peminjaman'][$key]['jml_hari_denda'] = 0;
                    $data['peminjaman'][$key]['denda_telat'] =  ($denda['jml_denda'] * $data['peminjaman'][$key]['jml_hari_denda']) * $jml_buku_dipinjam;
                }
            }
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data,
            ];
        } else {
            $res = [
                'code' => 403,
                'status' => false,
                'message' => 'Forbidden',
                'data' => null
            ];
        }

        echo json_encode($res);
    }

    public function getDataById()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $where = ['id_peminjaman' => $id];
            $field = [
                'tr_peminjaman.*',
                'uda.nama AS nama_anggota',
                'ag.username AS nisn'
            ];
            $tbl_join = [
                0 => [
                    'table' => 'user as ag',
                    'on' => 'ag.user_id=tr_peminjaman.id_anggota',
                    'join_type' => ''
                ],
                1 => [
                    'table' => 'user_detail as uda',
                    'on' => 'uda.user_detail_id=ag.user_detail_id',
                    'join_type' => ''
                ],
            ];
            $data = $this->peminjaman->getDataById($where, $field, $tbl_join)->row_array();
            $id_buku = explode(',', $data['id_buku']);
            $jml_buku_dipinjam = count($id_buku);
            foreach ($id_buku as $i => $item_buku) {
                $data['buku_dipinjam'][$i] = $this->buku->getBukuById(['id_buku' => $item_buku])->row_array();
            }

            $tgl_now = strtotime(date('Y-m-d'));
            $tgl_pengembalian = strtotime($data['tanggal_kembali']);
            $datediff = $tgl_now - $tgl_pengembalian;

            // denda telat
            $dendaTelat = $this->denda->getDataMasterDenda(['nama_denda' => 'telat'])->row_array();
            $data['biaya_denda_telat'] = (int)$dendaTelat['jml_denda'];
            if ($tgl_now > $tgl_pengembalian) {
                $data['denda_status'] = 1;
                $data['jml_hari_denda'] =  round($datediff / (60 * 60 * 24));
                // $data['denda_telat'] =  ($dendaTelat['jml_denda'] * $data['jml_hari_denda']) * $jml_buku_dipinjam;
            } else {
                $data['denda_status'] = 0;
                $data['jml_hari_denda'] = 0;
                // $data['denda_telat'] =  ($dendaTelat['jml_denda'] * $data['jml_hari_denda']) * $jml_buku_dipinjam;
            }

            // denda hilang
            $denda_hilang = $this->denda->getDataMasterDenda(['nama_denda' => 'hilang'])->row_array();
            $data['biaya_denda_hilang'] = (int)$denda_hilang['jml_denda'];

            // $tgl_now = strtotime(date('Y-m-d'));
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data,
                // 'query' => $this->last->query(),
            ];
        } else {
            $res = [
                'code' => 403,
                'status' => false,
                'message' => 'Forbidden',
                'data' => null
            ];
        }
        echo json_encode($res);
    }

    public function insertPeminjaman()
    {
        $post = $this->input->post();
        foreach ($post as $key => $value) {
            $waktu_peminjaman = explode(' - ', $post['input_tgl_peminjaman']);

            // cek id buku
            $postIdBuku = explode(PHP_EOL, $post['input_idbuku']);
            foreach ($postIdBuku as $key => $value) {
                if ($value != '') {
                    $post['id_buku'][$key] = $value;
                }
            }
            $id_buku = implode(",", $post['id_buku']);

            foreach ($waktu_peminjaman as $key => $val) {
                $waktu_peminjaman[$key] = date('Y-m-d', strtotime($val));
            }
        }
        $post['input_tgl_peminjaman'] = $waktu_peminjaman[0];
        $post['input_tgl_pengembalian'] = $waktu_peminjaman[1];
        // var_dump($id_buku);
        // die;
        $data_insert = [
            'tanggal_pinjam' => $waktu_peminjaman[0],
            'tanggal_kembali' => $waktu_peminjaman[1],
            'id_buku' => $id_buku,
            'id_anggota' => $post['input_iduser'],
            'id_petugas' => $this->session->userdata('user_id'),
            'status_pengembalian' => 0,
        ];
        // var_dump($data_insert);
        // die;
        $insert = $this->peminjaman->insertData($data_insert);
        if ($insert) {
            $this->session->set_flashdata('success', 'Data berhasil di input!');
            redirect('transaksi/peminjaman');
        } else {
            $this->session->set_flashdata('error', 'Gagal input data!');
            redirect('transaksi/peminjaman');
        }
    }


    // public function insertPengembalian()
    // {
    //     $post = $this->input->post();
    //     $id_peminjaman = $post['id_peminjaman'];
    //     // $table_insert = 'tr_pengembalian';
    //     $data_insert = [
    //         'tanggal_pengembalian' => $post['tgl_pengembalian'],
    //         // 'denda' => $post['denda'],
    //         'id_buku' => $post['id_buku'],
    //         'id_anggota' => $post['id_anggota'],
    //         'id_petugas' => $this->session->userdata('user_id')
    //     ];
    //     $insert = $this->peminjaman->insertData($data_insert, 'tr_pengembalian');
    //     if ($insert) {
    //         $update = $this->peminjaman->updateData(['status_pengembalian' => 1], ['id_peminjaman' => $id_peminjaman], 'tr_peminjaman');
    //         $res = [
    //             'code' => 200,
    //             'status' => true,
    //             'message' => 'Berhasil tersimapan',
    //             'data' => $update,
    //         ];
    //     } else {
    //         $res = [
    //             'code' => 500,
    //             'status' => false,
    //             'message' => 'Internal Server Error',
    //             'data' => null
    //         ];
    //     }
    //     echo json_encode($res);
    // }
}
