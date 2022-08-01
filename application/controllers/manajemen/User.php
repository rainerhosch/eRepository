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

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use \PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        $this->load->model('manajemen/M_user', 'user');
        $this->load->model('manajemen/M_menu', 'menu');
        $this->load->model('manajemen/M_submenu', 'submenu');
        $this->load->model('transaksi/M_peminjaman', 'peminjaman');
        $this->load->model('transaksi/M_pengembalian', 'pengembalian');
        $this->load->model('M_kunjungan', 'kunjungan');
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

    public function updateStatusAktif()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $user_id = $data_post['id'];
            $data_update_user = [
                'is_active' => $data_post['status']
            ];
            $update = $this->user->update_data('user', $user_id, $data_update_user);
            $data['update'] = $update;
            if ($update) {
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
                $field = 'user.user_id, user.username, user.is_active, user_detail.*, user_role.role_type, user_role.role_id';
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
            // get data user
            $where2 = [
                'user.user_id' => $id
            ];
            $field2 = 'user.user_id, user.username, user.password, user.qrcode_img, user_detail.*, user_role.role_type, user_role.role_id';
            $data_user = $this->user->getData($field2, $where2)->row_array();

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
                    $wherex = [
                        'id_anggota' => $data_user['user_id']
                    ];
                    $delete_peminjaman = $this->peminjaman->deleteData($wherex);
                    $delete_pengembalian = $this->pengembalian->deleteData($wherex);
                    $delete_data_kunjungan = $this->kunjungan->delete_data(['id_user' => $data_user['user_id']]);
                    $dir = FCPATH . 'assets/img/qrcode/';
                    $file_path = $dir . $data_user['qrcode_img'];
                    unlink($file_path);
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

    public function importFromExcel()
    {
        // if ($this->input->is_ajax_request()) {
        $dir = FCPATH . 'assets/file/tmp/';
        // JIKA DIREKTORI TAHUN TIDAK ADA
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $file_ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
        // $new_name = $timestamp . '.' . $file_ext;

        $file_name = $_FILES['files']['name'];
        // var_dump($file_name);
        // die;

        $config['file_name']        = $file_name;
        $config['upload_path']      =  $dir . "/";
        $config['allowed_types']        = 'xls|xlsx';
        $config['max_size'] = 50000; // max_size in kb
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        if (!empty($_FILES['files']['name'])) {

            $_FILES['file']['name'] = $file_name;
            $_FILES['file']['type'] = $_FILES['files']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['files']['error'];
            $_FILES['file']['size'] = $_FILES['files']['size'];

            //Load upload library
            $this->load->library('upload', $config);
            // File upload
            if ($this->upload->do_upload('file')) {
                // Get data about the file
                $uploadData = $this->upload->data();
                $data_file_upload = $uploadData;
                $file_name = $data_file_upload['file_name'];
                if ('csv' == $file_ext) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ('xls' == $file_ext) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreadsheet = $reader->load($data_file_upload['full_path']);
                $sheet = $spreadsheet->getSheet(0);
                $sheetData = $sheet->toArray(false, true, true, true);

                // echo '<pre>';
                // print_r($datav);
                // echo '</pre>';
                // exit();

                $datasku = array();
                $dataV = array();

                foreach ($sheetData as $i => $name) {

                    foreach ($name as $u => $names) {
                        $datasku[] = $name;
                        if ($i > 5 && $i < 393) {
                            $datav[$i] = [
                                'h2' => $name['C'],
                                'j1' => $name['D'],
                                'j2' => $name['E'],
                                'kode' => $name['F'],
                                'mk' => $name['G'],
                                'sks' => $name['H'],
                                'dosen' => $name['I'],
                                'ruang' => $name['J'],
                                'kelas' => $name['K'],
                                'prodi' => $name['L'],
                            ];
                        }
                    }
                }
            }
        }
        // $res = [
        //     'code' => 200,
        //     'status' => true,
        //     'message' => 'Success',
        //     'data' => $dir
        // ];
        // } else {
        //     $res = [
        //         'code' => 500,
        //         'status' => false,
        //         'message' => 'Access Denied',
        //         'data' => null
        //     ];
        // }

        // echo json_encode($res);
    }
}
