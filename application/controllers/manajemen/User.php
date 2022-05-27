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
        login_check();
        $this->load->model('manajemen/M_user', 'user');
        $this->load->model('manajemen/M_menu', 'menu');
        $this->load->model('manajemen/M_submenu', 'submenu');
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Manajemen';
        $data['subpage'] = 'User';
        $data['content'] = 'content/manajemen/v_user';
        $this->load->view('template', $data);
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            if (count($data_post) <= 0) {
                $field = 'user.user_id, user_detail.*, user_role.role_type, user_role.role_id';
                $data = $this->user->getData($field)->result_array();
            } else {
                $where = [
                    'user_id' => $data_post['id']
                ];
                $data = $this->user->getData(null, $where)->row_array();
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


    public function hapus_user()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('user_id');
            $user_detail_id = $this->input->post('user_detail_id');
            $table = $this->input->post('table');
            $field = $table . '_id';
            $where = [
                '' . $field . '' => $id
            ];
            $delete_tbl_user = $this->user->delete_data($table, $where);
            // $delete_tbl_user = true;
            if (!$delete_tbl_user) {
                $data = [
                    'code' => 300,
                    'status' => false,
                    'msg' => 'Gagal hapus user.',
                    'data' => null
                ];
            } else {
                $table = 'user_detail';
                $field = $table . '_id';
                $where = [
                    '' . $field . '' => $user_detail_id
                ];
                $delete_user_detail = $this->user->delete_data($table, $where);
                // $delete_user_detail = true;
                if (!$delete_user_detail) {
                    $data = [
                        'code' => 300,
                        'status' => false,
                        'msg' => 'Gagal hapus user detail.',
                        'data' => null
                    ];
                } else {
                    $data = [
                        'code' => 200,
                        'status' => true,
                        'msg' => 'Berhasil delete data.',
                        'data' => $where
                    ];
                }
            }
        } else {
            $data = [
                'code' => 500,
                'status' => false,
                'msg' => 'Invalid request.',
                'data' => null
            ];
        }
        echo json_encode($data);
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
