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
        $this->load->model('manajemen/M_peminjaman', 'peminjaman');
        $this->load->model('manajemen/M_buku', 'buku');
        $this->load->model('manajemen/M_user', 'user');
        $this->load->model('manajemen/M_denda', 'denda');
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $post_limit = $this->input->post('limit');
            $post_offset = $this->input->post('offset');
            $key_cari = $this->input->post('keyword');
            $post_page = $this->input->post('page');
            $url_pagination = $this->input->post('url_pagination');

            if ($key_cari != null) {
                $where = "uda.nama LIKE '%" . $key_cari . "%' OR m_buku.judul_buku LIKE '%" . $key_cari . "%' OR ag.username LIKE '%" . $key_cari . "%'";
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
                'field' => 'tr_peminjaman.*, m_buku.judul_buku, uda.nama AS nama_anggota, udp.nama AS nama_petugas',
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
                    4 => [
                        'table' => 'm_buku',
                        'on' => 'm_buku.id_buku = tr_peminjaman.id_buku',
                        'join_type' => ''
                    ]
                ]
            ];
            $data['peminjaman'] = $this->peminjaman->getData($condition)->result_array();
            foreach ($data['peminjaman'] as $key => $value) {
                $tgl_now = strtotime(date('Y-m-d'));
                $tgl_pengembalian = strtotime($value['tanggal_kembali']);
                $datediff = $tgl_now - $tgl_pengembalian;
                $denda = $this->denda->getData()->row_array();
                if ($tgl_now > $tgl_pengembalian) {
                    $data['peminjaman'][$key]['denda_status'] = 1;
                    $data['peminjaman'][$key]['jml_hari_denda'] =  round($datediff / (60 * 60 * 24));
                    $data['peminjaman'][$key]['total_biaya_denda'] =  $denda['jml_denda'] * $data['peminjaman'][$key]['jml_hari_denda'];
                } else {
                    $data['peminjaman'][$key]['denda_status'] = 0;
                    $data['peminjaman'][$key]['jml_hari_denda'] = 0;
                    $data['peminjaman'][$key]['total_biaya_denda'] =  $denda['jml_denda'] * $data['peminjaman'][$key]['jml_hari_denda'];
                }
            }
            $data['total_data'] = $this->peminjaman->getCount();
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

    public function addPeminjaman()
    {
        $post = $this->input->post();
        $data_insert = [
            'tanggal_pinjam' => $post['input_tgl_peminjaman'],
            'tanggal_kembali' => $post['input_tgl_pengembalian'],
            'id_buku' => $post['input_idbuku'],
            'id_anggota' => $post['input_iduser'],
            'id_petugas' => $this->session->userdata('user_id'),
            'status_pengembalian' => 0,
        ];
        $insert = $this->peminjaman->insertData($data_insert);
        if ($insert) {
            $this->session->set_flashdata('success', 'Data berhasil di input!');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Gagal input data!');
            redirect('dashboard');
        }
    }
}
