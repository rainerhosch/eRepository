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
        // $this->load->library('phpqrcode/qrlib');
        include APPPATH . 'libraries\phpqrcode\qrlib.php';
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Manajemen';
        $data['subpage'] = 'User';
        $data['content'] = 'content/manajemen/v_user';
        $this->load->view('template', $data);
    }

    public function generateQRCode()
    {
        $dir = FCPATH . 'assets/img/qrcode/';
        // JIKA DIREKTORI TAHUN TIDAK ADA
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $field = 'user.user_id, user.username';
        $data_user = $this->user->getData($field)->result_array();
        foreach ($data_user as $i => $val) {
            $file_name = $val['username']  . date("Ymd") . rand() . ".png";
            $file_path = $dir . $file_name;
            $update_user = $this->user->update_data('user', $val['user_id'], ['qrcode_img' => $file_name]);
            if ($update_user) {
                QRcode::png($file_name, $file_path, QR_ECLEVEL_L, 10);
            }
        }
    }

    public function updateData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $password = '';
            if (isset($data_post['password_baru'])) {
                $password = md5($data_post['password_baru']);
            } else {
                $password = $data_post['password_lama'];
            }
            $user_id = $data_post['user_id'];
            $user_detail_id = $data_post['user_detail_id'];
            $data_update_detail = [
                'nama'          => $data_post['nama_user'],
                'email'         => $data_post['email_user'],
                'tlp'           => $data_post['tlp_user'],
                'alamat'        => $data_post['alamat_user'],
                'img'           => 'default.jpg'
            ];
            $update = $this->user->update_data('user_detail', $user_detail_id, $data_update_detail);
            $data['update'] = $update;
            // $data['query'] = $this->db->last_query();
            if ($update) {
                $data_update_user = [
                    'password' => $password
                ];
                $this->user->update_data('user', $user_id, $data_update_user);
                $res = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'Success',
                    'data' => $data,

                ];
            } else {
                $res = [
                    'code' => 500,
                    'status' => true,
                    'message' => 'Gagal update.',
                    'data' => $data,

                ];
            }
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

    public function getDataById()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $where = [
                'user.user_id' => $data_post['id']
            ];
            $field = 'user.user_id, user.username, user.password, user_detail.*, user_role.role_type, user_role.role_id';
            $data = $this->user->getData($field, $where)->row_array();
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data,

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


    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            if (count($data_post) <= 0) {
                $field = 'user.user_id, user.username, user_detail.*, user_role.role_type, user_role.role_id';
                $data = $this->user->getData($field)->result_array();
            } else {
                if (isset($data_post['filter']) && isset($data_post['search'])) {
                    $search =  $data_post['search'];
                    $field = 'user.user_id, user.username, user_detail.*, user_role.role_type, user_role.role_id';
                    $where = [
                        'user.role_id' => $data_post['filter'],
                        'user.username' => $search
                    ];
                    $data = $this->user->getData($field, $where, null)->result_array();
                } else {
                    $where = [
                        'user_id' => $data_post['id']
                    ];
                    $data = $this->user->getData(null, $where)->row_array();
                }
            }
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data,
                'post' => empty($data['search'])

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

    public function getDataForAutoComplete()
    {
        if ($this->input->is_ajax_request()) {
            $response = [];
            $data_post = $this->input->post();
            if (count($data_post) <= 0) {
                $field = 'user.user_id, user.username, user_detail.*, user_role.role_type, user_role.role_id';
                $data = $this->user->getData($field)->result_array();
            } else {
                if (isset($data_post['filter']) && isset($data_post['search'])) {
                    $search =  $data_post['search'];
                    $field = 'user.user_id, user.username, user_detail.*, user_role.role_type, user_role.role_id';
                    $where = [
                        'user.role_id' => $data_post['filter']
                    ];
                    $data = $this->user->getData($field, $where, $search)->result_array();
                    foreach ($data as $key => $value) {
                        $response[$key] = [
                            'label' => $value['nama'],
                            'value' => $value['username'],
                            'id' => $value['user_id']
                        ];
                    }
                } else {
                    $where = [
                        'user_id' => $data_post['id']
                    ];
                    $data = $this->user->getData(null, $where)->row_array();
                }
            }
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data,
                'data_autocomplete' => $response

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
