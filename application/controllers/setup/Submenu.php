<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Submenu.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 21/06/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Submenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        $this->load->model('manajemen/M_submenu', 'submenu');
        $this->load->model('manajemen/M_menu', 'menu');
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Setup';
        $data['subpage'] = 'Submenu';
        $data['content'] = 'content/setup/v_submenu';
        $this->load->view('template', $data);
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            // $data_post = $this->input->post('id_menu') ? $id_menu = $this->input->post('id_menu') : $id_menu = null;
            $submenu = $this->submenu->getData()->result_array();
            foreach ($submenu as $key => $value) {
                $data_menu = $this->menu->getData(['nama_menu'], ['id_menu' => $value['id_menu']])->row_array();
                $submenu[$key]['menu_parent'] = $data_menu['nama_menu'];
            }
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $submenu
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
            $data_update = [
                'is_active' => $data_post['status']
            ];
            $param = [
                'id_submenu' => $data_post['id']
            ];
            $update = $this->submenu->updateData($data_update, $param);
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
                    'data' => $update
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
