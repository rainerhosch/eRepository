<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : RoleUser.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 25/05/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class RoleUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        $this->load->model('manajemen/M_role', 'role');
        $this->load->model('manajemen/M_menu', 'menu');
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Manajemen';
        $data['subpage'] = 'Role User';
        $data['content'] = 'content/manajemen/v_role_access';
        $this->load->view('template', $data);
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            if (count($data_post) <= 0) {
                $field = '*';
                $data = $this->role->getData($field, null)->result_array();
                foreach ($data as $key => $value) {
                    $field = 'm_menu.*';
                    $where = [
                        'user_access_menu.role_id' => $value['role_id']
                    ];
                    $tbl_join = [
                        0 => [
                            'table' => 'user_access_menu',
                            'on' => 'm_menu.id_menu = user_access_menu.id_menu',
                            'type' => ''
                        ]
                    ];
                    $data[$key]['role_access_menu'] = $this->menu->getData($field, $where, $tbl_join)->result_array();
                }
            } else {
                $field = '*';
                $where = [
                    'role_id' => $data_post['role_id']
                ];
                $data = $this->role->getData($field, $where)->row_array();
                $field2 = 'm_menu.*';
                $where2 = [
                    'user_access_menu.role_id' =>  $data_post['role_id']
                ];
                $tbl_join = [
                    0 => [
                        'table' => 'user_access_menu',
                        'on' => 'm_menu.id_menu = user_access_menu.id_menu',
                        'type' => ''
                    ]
                ];
                $dataMenuAccess = $this->menu->getData($field2, $where2, $tbl_join)->result_array();
                if (count($dataMenuAccess) > 0) {
                    foreach ($dataMenuAccess as $i => $dma) {
                        $id[] = $dma['id_menu'];
                    }
                    $where = 'id_menu NOT IN (' . implode(",", $id) . ')';
                } else {
                    $where = null;
                }
                $data['menu_can_use'] = $this->menu->getData(null, $where)->result_array();
            }
            $res = [
                'code' => 200,
                'status' => true,
                'message' => 'Success',
                'data' => $data
            ];
        } else {
            $res = [
                'code' => 403,
                'status' => false,
                'message' => 'Access Denied',
                'data' => null
            ];
        }
        echo json_encode($res);
    }

    public function simpan_role_baru()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $data_insert = [
                'role_type' => $data_post['role_type'],
                'description' => $data_post['desc']
            ];
            $insert = $this->role->addData('user_role', $data_insert);
            if ($insert) {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'msg' => 'Data berhasil ditambahkan.',
                    'data' => $data_post
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal insert data role.',
                    'data' => null
                ];
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


    public function simpan_menu_access()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $data_input = [
                'role_id'       => $data_post['id_role'],
                'id_menu'       => $data_post['select_menu_access'],
                'create_by'     => $this->session->userdata('user_id'),
                'create_date'   => date('Y-m-d')
            ];
            $insert = $this->role->addData('user_access_menu', $data_input);
            if ($data_input) {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'msg' => 'Berhasil menambahkan menu akses baru.',
                    'data' => $insert
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal menambahkan data.',
                    'data' => null
                ];
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

    public function delete_menu_access()
    {
        if ($this->input->is_ajax_request()) {
            $input_post = $this->input->post();
            $where = [
                'id_menu' => $input_post['id_menu'],
                'role_id' => $input_post['id_role']
            ];
            $delete = $this->role->delete_data('user_access_menu', $where);
            if ($delete) {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'msg' => 'Data berhasil dihapus.',
                    'data' => $input_post['id_menu']
                ];
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal saat menghapus data.',
                    'data' => null
                ];
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

    public function deleteData()
    {
        if ($this->input->is_ajax_request()) {
            $input_post = $this->input->post();
            $delete_role = $this->role->delete_data('user_role', ['role_id' => $input_post['id']]);
            if ($delete_role) {
                $delete = $this->role->delete_data('user_access_menu', ['role_id' => $input_post['id']]);
                if ($delete) {
                    $data = [
                        'code' => 200,
                        'status' => true,
                        'msg' => 'Data berhasil dihapus.',
                        'data' => $input_post['id']
                    ];
                } else {
                    $data = [
                        'code' => 500,
                        'status' => false,
                        'msg' => 'Gagal delete data menu user access.',
                        'data' => null
                    ];
                }
            } else {
                $data = [
                    'code' => 500,
                    'status' => false,
                    'msg' => 'Gagal delete data role user.',
                    'data' => null
                ];
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
}
