<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : User.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 21/05/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('manajemen/M_user', 'user');
        $this->load->model('manajemen/M_menu', 'menu');
        $this->load->model('manajemen/M_submenu', 'submenu');
    }

    public function get_user_acces_menu()
    {

        if ($this->input->is_ajax_request()) {
            $role_user = $this->session->userdata('role');
            $where = [
                'm_menu.is_active' => 1,
                'user_access_menu.role_id' => $role_user
            ];
            $data = $this->user->get_user_acces_menu($where)->result_array();
            foreach ($data as $i => $val) {
                $where = [
                    'id_menu' => $val['id_menu'],
                    'is_active' => 1
                ];
                $submenu = $this->submenu->getData($where)->result_array();
                $data[$i]['submenu'] = $submenu;
                //     }
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
}
