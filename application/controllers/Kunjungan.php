<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Kunjungan.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 05/07/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Kunjungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_kunjungan', 'kunjungan');
        $this->load->model('manajemen/M_user', 'user');
    }

    public function insertData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $cek_user = $this->user->getData('*', ['username' => $data_post['nisn']])->row_array();
            if ($cek_user != null) {
                $data_insert = [
                    'id_user' => $cek_user['user_id'],
                    'tgl_kunjungan' => date('Y-m-d'),
                    'time_kunjungan' => date("H:i:s")
                ];
                $insert_pengunjung = $this->kunjungan->insert_data($data_insert);
                if ($insert_pengunjung) {
                    $res = [
                        'code' => 200,
                        'status' => true,
                        'message' => 'Data kunjungan telah tersimpan',
                        'data' => $data_insert,
                    ];
                } else {
                    $res = [
                        'code' => 500,
                        'status' => false,
                        'message' => 'Gagal insert.',
                        'data' => null
                    ];
                }
            } else {
                $res = [
                    'code' => 404,
                    'status' => false,
                    'message' => 'Data tidak ditemukan.',
                    'data' => null
                ];
            }
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

    public function getDataPerBulan()
    {
        if ($this->input->is_ajax_request()) {
            $date_now = date('Y-m-d');
            $pecah_date = explode('-', $date_now);
            $thn = $pecah_date[0];
            $bln = $pecah_date[1];
            $tgl = $pecah_date[2];
            $bln_lalu = $bln - 1;
            $FormatTanggal = new FormatTanggal;
            $nm_bln = $FormatTanggal->konversiBulan($bln);
            $data['bulan_ini'] = $nm_bln . ' ' . $thn;
            $data['tgl_bulan_ini'] = $tgl . ' ' . $nm_bln . ' ' . $thn;


            $where = "SUBSTR(data_kunjungan.tgl_kunjungan, 1,7)='" . substr($date_now, 0, 7) . "'";
            $data['kunjungan_bulan_ini'] = $this->kunjungan->getCount($where);
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
                        $where = "data_kunjungan.tgl_kunjungan='" . $date_now . "'";
                    } else {
                        $where = "SUBSTR(data_kunjungan.tgl_kunjungan, 1,7)='" . substr($date_now, 0, 7) . "'";
                    }
                } else {
                    $where = "user_detail.nama LIKE '%" . $key_cari . "%' OR user.username LIKE '%" . $key_cari . "%'";
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
                'field' => 'data_kunjungan.*, user.username as nisn, user_detail.nama, user_detail.tlp, user_detail.alamat',
                'limit' => $limit,
                'offset' => $offset,
                'where' => $where,
                'join_tbl' => [
                    0 => [
                        'table' => 'user',
                        'on' => 'data_kunjungan.id_user=user.user_id',
                        'join_type' => ''
                    ],
                    1 => [
                        'table' => 'user_detail',
                        'on' => 'user_detail.user_detail_id=user.user_detail_id',
                        'join_type' => ''
                    ]
                ]
            ];
            $data['kunjungan'] = $this->kunjungan->getData($condition)->result_array();
            $data['total_data'] = $this->kunjungan->getCount();
            $total_page = ($data['total_data'] / $limit);
            $convert_data = intval(preg_replace('/[^\d.]/', '', $total_page));
            $data['total_page'] =  $convert_data;
            $data['current_page'] =  $offset;
            $data['limit_per_page'] =  $post_limit;
            $data["uri_segment"] = $where;


            // config pagination
            $config['base_url'] = base_url('kunjungan/getData');
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
}
