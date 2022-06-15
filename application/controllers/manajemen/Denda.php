<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Denda.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 09/06/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Denda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        $this->load->model('manajemen/M_denda', 'denda');
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Manajemen';
        $data['subpage'] = 'Denda';
        $data['content'] = 'content/manajemen/v_denda';
        $this->load->view('template', $data);
    }

    public function getData()
    {
        if ($this->input->post('ajax')) {
            $data = $this->denda->getData()->result_array();
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data,
            ];
            echo json_encode($res);
        } else {
            redirect('manajemen/denda');
        }
    }

    public function getDataForPagination()
    {
        if ($this->input->is_ajax_request()) {
            $post_limit = $this->input->post('limit');
            $post_offset = $this->input->post('offset');
            $key_cari = $this->input->post('keyword');
            $post_page = $this->input->post('page');
            $url_pagination = $this->input->post('url_pagination');

            if ($key_cari != null) {
                $where = "nama_denda LIKE '%" . $key_cari . "%'";
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
                'field' => '*',
                'limit' => $limit,
                'offset' => $offset,
                'where' => $where,
            ];
            $data['data_denda'] = $this->denda->getDataMasterDenda($condition)->result_array();
            $data['total_data'] = $this->denda->getCount($where);
            $total_page = ($data['total_data'] / $limit);
            $convert_data = intval(preg_replace('/[^\d.]/', '', $total_page));
            $data['total_page'] =  $convert_data;
            $data['current_page'] =  $offset;
            $data['limit_per_page'] =  $post_limit;
            $data["uri_segment"] = $where;


            // config pagination
            $config['base_url'] = base_url('manajemen/denda/getDataForPagination');
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

    public function insertMasterDataDenda()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $data_insert = [
                'nama_denda' => $data_post['input_nama_denda'],
                'jml_denda' => $data_post['input_jml_denda'],
                'desc_denda' => $data_post['input_desc_denda'],
                'update_by' => $this->session->userdata('user_id'),
                'update_date' => date('Y-m-d')
            ];

            $insert = $this->denda->insertData($data_insert);
            if ($insert) {
                $res = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'Success Insert Data',
                    'data' => $data_insert,
                    'alert' => [
                        'icon' => 'success',
                        'title' => 'Success',
                    ]
                ];
            } else {
                $res = [
                    'code' => 500,
                    'status' => false,
                    'message' => 'Internal Server Error',
                    'data' => null,
                    'alert' => [
                        'icon' => 'error',
                        'title' => 'Oops...',
                    ]
                ];
            }
        } else {
            $res = [
                'code' => 403,
                'status' => false,
                'message' => 'Forbidden',
                'data' => null,
                'alert' => [
                    'icon' => 'error',
                    'title' => 'Oops...',
                ]
            ];
        }
        echo json_encode($res);
    }

    public function updateMasterDataDenda()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $id_denda = $data_post['edit_id_denda'];
            $data_update = [
                'nama_denda' => $data_post['edit_nama_denda'],
                'jml_denda' => $data_post['edit_jml_denda'],
                'desc_denda' => $data_post['edit_desc_denda'],
                'update_by' => $this->session->userdata('user_id'),
                'update_date' => date('Y-m-d')
            ];
            $update = $this->denda->updateData(['id_denda' => $id_denda], $data_update);
            // $update = true;
            if ($update) {
                $res = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'Success Update Data',
                    'data' => $data_update,
                    'alert' => [
                        'icon' => 'success',
                        'title' => 'Success',
                    ]
                ];
            } else {
                $res = [
                    'code' => 500,
                    'status' => false,
                    'message' => 'Internal Server Error',
                    'data' => $this->db->last_query(),
                    'alert' => [
                        'icon' => 'error',
                        'title' => 'Oops...',
                    ]
                ];
            }
        } else {
            $res = [
                'code' => 403,
                'status' => false,
                'message' => 'Forbidden',
                'data' => null,
                'alert' => [
                    'icon' => 'error',
                    'title' => 'Oops...',
                ]
            ];
        }
        echo json_encode($res);
    }

    public function deleteMasterDataDenda()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $id_denda = $data_post['id_denda'];
            $delete = $this->denda->deleteData(['id_denda' => $id_denda]);
            if ($delete) {
                $res = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'Success Delete Data',
                    'data' => $data_post,
                    'alert' => [
                        'icon' => 'success',
                        'title' => 'Success',
                    ]
                ];
            } else {
                $res = [
                    'code' => 500,
                    'status' => false,
                    'message' => 'Internal Server Error',
                    'data' => $this->db->last_query(),
                    'alert' => [
                        'icon' => 'error',
                        'title' => 'Oops...',
                    ]
                ];
            }
        } else {
            $res = [
                'code' => 403,
                'status' => false,
                'message' => 'Forbidden',
                'data' => null,
                'alert' => [
                    'icon' => 'error',
                    'title' => 'Oops...',
                ]
            ];
        }
        echo json_encode($res);
    }
}
