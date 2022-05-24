<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Menu.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 21/05/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        $this->load->model('manajemen/M_menu', 'menu');
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Setup';
        $data['subpage'] = 'Menu';
        $data['content'] = 'content/setup/v_menu';
        $this->load->view('template', $data);
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            if (count($data_post) <= 0) {
                $data = $this->menu->getData()->result_array();
            } else {
                $where = [
                    'id_menu' => $data_post['id']
                ];
                $data = $this->menu->getData(null, $where)->row_array();
            }
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data
            ];
        } else {
            $res = [
                'code' => 500,
                'status' => false,
                'message' => 'Access Denied',
                'data' => null
            ];
        }
        echo json_encode($res);
    }

    public function updateData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            if (isset($data_post['status']) == null) {
                $data_update = [
                    'nama_menu' => $data_post['editNamaMenu'],
                    'link_menu' => $data_post['editUrlMenu'],
                    'type' => $data_post['editTipeMenu'],
                    'icon' => $data_post['editIconMenu'],
                ];
                $param = [
                    'id_menu' => $data_post['editIdMenu']
                ];
            } else {
                $data_update = [
                    'is_active' => $data_post['status']
                ];
                $param = [
                    'id_menu' => $data_post['id']
                ];
            }
            $update = $this->menu->updateData($data_update, $param);
            if (!$update) {
                $res = [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Internal Server Error',
                    'data' => null
                ];
            } else {
                $res = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Berhasil Update Data',
                    'data' => $data_post
                ];
            }
        } else {
            $res = [
                'code' => 403,
                'status' => 'error',
                'message' => 'Access Denied',
                'data' => null
            ];
        }
        echo json_encode($res);
    }

    public function addData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $dataInsert = [
                'nama_menu' => $data_post['inputNamaMenu'],
                'link_menu' => $data_post['inputUrlMenu'],
                'type' => $data_post['inputTipeMenu'],
                'icon' => $data_post['inputIconMenu'],
                // default value
                'is_active' => '1',
                'editable' => 'YES',
                'create_by' => $this->session->userdata('user_id'),
                'create_date' => date('Y-m-d')
            ];
            $insert = $this->menu->insertData($dataInsert);
            if ($insert) {
                $res = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Berhasil Menambahkan Menu' . $data_post['inputNamaMenu'],
                    'data' => $dataInsert
                ];
            } else {
                $res = [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Internal Server Error',
                    'data' => $insert
                ];
            }
        } else {
            $res = [
                'code' => 403,
                'status' => 'error',
                'message' => 'Access Denied',
                'data' => null
            ];
        }
        echo json_encode($res);
    }


    public function deleteData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $param = [
                'id_menu' => $data_post['id']
            ];
            $delete = $this->menu->deleteData($param);
            if ($delete) {
                $res = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Berhasil Menghapus Menu',
                    'data' => $delete
                ];
            } else {
                $res = [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Internal Server Error',
                    'data' => $delete
                ];
            }
        } else {
            $res = [
                'code' => 403,
                'status' => 'error',
                'message' => 'Access Denied',
                'data' => null
            ];
        }
        echo json_encode($res);
    }
}
