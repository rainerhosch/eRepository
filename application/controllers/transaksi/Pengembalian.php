<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Pengembalian.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 11/06/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('transaksi/M_pengembalian', 'pengembalian');
        $this->load->model('transaksi/M_peminjaman', 'peminjaman');
        $this->load->model('manajemen/M_buku', 'buku');
        $this->load->model('manajemen/M_user', 'user');
        $this->load->model('manajemen/M_denda', 'denda');
    }
    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Transaksi';
        $data['subpage'] = 'Pengembalian';
        $data['content'] = 'content/transaksi/v_pengembalian';
        $this->load->view('template', $data);
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $date_now = date('Y-m-d');
            $post_limit = $this->input->post('limit');
            $post_offset = $this->input->post('offset');
            $key_cari = $this->input->post('keyword');
            $filter_date = $this->input->post('filter_mounth');
            $post_page = $this->input->post('page');
            $url_pagination = $this->input->post('url_pagination');

            if ($key_cari != null || $filter_date != null) {
                if (!empty($filter_date)) {
                    if ($filter_date === 'date') {
                        $where = "tr_pengembalian.tanggal_pengembalian='" . $date_now . "'";
                    } else {
                        $where = "SUBSTR(tr_pengembalian.tanggal_pengembalian, 1,7)='" . substr($date_now, 0, 7) . "'";
                    }
                } else {
                    $where = "uda.nama LIKE '%" . $key_cari . "%' OR ag.username LIKE '%" . $key_cari . "%'";
                }
            } else {
                $where = null;
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
                // 'field' => 'tr_pengembalian.*, uda.nama AS nama_anggota, udp.nama AS nama_petugas',
                'field' => 'tr_pengembalian.*, uda.nama AS nama_anggota, udp.nama AS nama_petugas, tr_peminjaman.id_buku AS id_buku',
                'limit' => $limit,
                'offset' => $offset,
                'where' => $where,
                'join_tbl' => [
                    0 => [
                        'table' => 'tr_peminjaman',
                        'on' => 'tr_pengembalian.id_peminjaman=tr_peminjaman.id_peminjaman',
                        'join_type' => ''
                    ],
                    1 => [
                        'table' => 'user as ag',
                        'on' => 'ag.user_id=tr_pengembalian.id_anggota',
                        'join_type' => ''
                    ],
                    2 => [
                        'table' => 'user_detail as uda',
                        'on' => 'uda.user_detail_id=ag.user_detail_id',
                        'join_type' => ''
                    ],
                    3 => [
                        'table' => 'user as ptg',
                        'on' => 'ptg.user_id=tr_pengembalian.id_petugas',
                        'join_type' => ''
                    ],
                    4 => [
                        'table' => 'user_detail as udp',
                        'on' => 'udp.user_detail_id=ptg.user_detail_id',
                        'join_type' => ''
                    ]
                ]
            ];
            $data['pengembalian'] = $this->pengembalian->getData($condition)->result_array();
            // var_dump($this->db->last_query());
            // die;
            foreach ($data['pengembalian'] as $key => $value) {

                $data['pengembalian'][$key]['data_denda'] = $this->denda->getData(['id_pengembalian' => $value['id_pengembalian']], 'tr_denda')->result_array();

                $id_buku = explode(',', $value['id_buku']);
                $jml_buku_dipinjam = count($id_buku);
                foreach ($id_buku as $i => $item_buku) {
                    $data['pengembalian'][$key]['buku_dipinjam'][$i] = $this->buku->getBukuById(['id_buku' => $item_buku])->row_array();
                }
            }
            $data['total_data'] = $this->pengembalian->getCount();
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

    public function insertPengembalian()
    {
        $post = $this->input->post();
        // var_dump($post);
        // die;
        $data = [];
        $data_denda = [];

        $data_insert = [
            'tanggal_pengembalian' => $post['input_tgl_pengembalian'],
            'id_peminjaman' => $post['input_id_peminjaman'],
            'id_anggota' => $post['input_iduser_pengembalian'],
            'id_petugas' => $this->session->userdata('user_id')
        ];
        $insert = $this->peminjaman->insertData($data_insert, 'tr_pengembalian');
        if ($insert) {
            $id_pengembalian = $insert;
            $update = $this->peminjaman->updateData(['status_pengembalian' => 1], ['id_peminjaman' => $post['input_id_peminjaman']], 'tr_peminjaman');
            if ($post['input_jumlah_buku_hilang'] > 0) {
                $jenis_denda = $this->denda->getData(['jenis_denda' => 'hilang'])->row_array();
                $data_denda[] = [
                    'jenis_denda' => $jenis_denda['id_biaya_denda'],
                    'id_buku' => implode(",", $post['input_buku_hilang']),
                    'jml_denda' => count($post['input_buku_hilang']) * $jenis_denda['jml_denda'],
                    'id_pengembalian' => $id_pengembalian,
                ];
            }

            if ($post['input_denda_telat'] > 0) {
                $jenis_denda = $this->denda->getData(['jenis_denda' => 'telat'])->row_array();
                $data_denda[] = [
                    'jenis_denda' => $jenis_denda['id_biaya_denda'],
                    'id_buku' => implode(",", $post['input_buku_dikembalikan']),
                    'jml_denda' => count($post['input_buku_dikembalikan']) * $jenis_denda['jml_denda'],
                    'id_pengembalian' => $id_pengembalian,
                ];
            }
            foreach ($data_denda as $key => $value) {
                $this->peminjaman->insertData($value, 'tr_denda');
            }


            $this->session->set_flashdata('success', 'Data berhasil di input!');
            redirect('transaksi/peminjaman');
        } else {
            // error
            $this->session->set_flashdata('error', 'Gagal input data!');
            redirect('transaksi/peminjaman');
        }
    }
}
