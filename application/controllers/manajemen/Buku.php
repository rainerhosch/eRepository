<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Buku.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 28/05/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        login_check();
        $this->load->model('manajemen/M_buku', 'buku');
        $this->load->model('transaksi/M_peminjaman', 'peminjaman');
    }

    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Manajemen';
        $data['subpage'] = 'Buku';
        $data['content'] = 'content/manajemen/v_buku';
        $this->load->view('template', $data);
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
                $where = "m_buku.judul_buku LIKE '%" . $key_cari . "%' OR m_buku.penulis_buku LIKE '%" . $key_cari . "%' OR m_buku.penerbit_buku LIKE '%" . $key_cari . "%'";
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
                'field' => 'm_buku.*, m_kategori_buku.nama_kategori',
                'limit' => $limit,
                'offset' => $offset,
                'where' => $where,
                'join_tbl' => [
                    0 => [
                        'table' => 'm_kategori_buku',
                        'on' => 'm_buku.id_kategori = m_kategori_buku.id_kategori',
                        'join_type' => ''
                    ]
                ]
            ];
            $data_buku = $this->buku->getData($condition)->result_array();
            $data['buku'] = $data_buku;
            foreach ($data_buku as $i => $val) {
                $filter = [
                    'field' => 'id_buku',
                    'data' => $val['id_buku'],
                    'option' => 'both'
                ];
                $data['buku'][$i]['jml_dipinjam'] = $this->peminjaman->getDataById(null, null, null, $filter)->num_rows();
            }

            // $data['total_data'] = $this->buku->getData($condition)->num_rows();
            $data['total_data'] = $this->buku->getCount();
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

    public function getDataForAutoComplete()
    {
        if ($this->input->is_ajax_request()) {
            $data = [];
            $key_cari = $this->input->post('search');
            if ($key_cari != null) {
                $where = "m_buku.judul_buku LIKE '%" . $key_cari . "%' OR m_buku.penulis_buku LIKE '%" . $key_cari . "%' OR m_buku.penerbit_buku LIKE '%" . $key_cari . "%'";
            } else {
                $where = null;
            }
            $condition = [
                'field' => 'm_buku.*, m_kategori_buku.nama_kategori',
                'where' => $where,
                'join_tbl' => [
                    0 => [
                        'table' => 'm_kategori_buku',
                        'on' => 'm_buku.id_kategori = m_kategori_buku.id_kategori',
                        'join_type' => ''
                    ]
                ]
            ];
            $dataBuku = $this->buku->getData($condition)->result_array();
            foreach ($dataBuku as $key => $value) {
                $data[] = [
                    'id' => $value['id_buku'],
                    'value' => $value['judul_buku']
                ];
            }

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

    public function getMaxId()
    {
        $data = $this->buku->getMaxId()->row_array();
        $res = [
            'code' => 200,
            'status' => true,
            'message' => 'Success',
            'data' => $data['id_buku'] + 1,
        ];
        echo json_encode($res);
    }

    public function getBukuById()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $where = ['id_buku' => $id];
            $data = $this->buku->getBukuById($where)->row_array();
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


    public function addBuku()
    {
        $data_post = $this->input->post();
        $data = $this->buku->getMaxId()->row_array();
        $lastid = $data['id_buku'];
        $id_buku = $lastid + 1;
        $date = date('Y-m-d H:i:s');
        $timestamp = strtotime($date);

        // config folder
        $dir = FCPATH . 'assets/img/coverbuku';
        // JIKA DIREKTORI TIDAK ADA
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $_FILES['files']['name'];
        $file_ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
        $new_name = $timestamp . '.' . $file_ext;

        $config['file_name']        = $new_name;
        $config['upload_path']      =  $dir . "/";
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size'] = 5000; // max_size in kb
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        if (!empty($_FILES['files']['name'])) {

            $_FILES['file']['name'] = $new_name;
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
                $filename = $uploadData;
                $cover = $filename['file_name'];
            }
        } else {
            $cover = 'ebookdefault.jpg';
        }

        $data = [
            'judul_buku' => $data_post['input_judul'],
            'penulis_buku' => $data_post['input_penulis'],
            'penerbit_buku' => $data_post['input_penerbit'],
            'tahun_penerbit' => $data_post['input_tahun_terbit'],
            'jumlah' => $data_post['input_jumlah'],
            'kode_buku' => $data_post['input_kode_buku'],
            'kode_penulis' => strtoupper(substr($data_post['input_penulis'], 0, 3)),
            'kode_judul' => $data_post['input_kode_judul'],
            'id_kategori' => $data_post['input_kategori'],
            'img' => $cover,
        ];
        $table = 'm_buku';
        $res = $this->buku->insert_data($table, $data);
        if ($res) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan data!');
            redirect('manajemen/buku');
        } else {
            $this->session->set_flashdata('error', 'gagal menambah data!');
            redirect('manajemen/buku');
        }
    }

    public function updateData()
    {
        $data = [];
        $delete_file = false;
        $data_post = $this->input->post();
        $id = $data_post['edit_id_buku'];
        $where = ['id_buku' => $id];
        $resBuku = $this->buku->getBukuById($where)->row_array();

        $date = date('Y-m-d H:i:s');
        $timestamp = strtotime($date);
        $dir = FCPATH . 'assets/img/coverbuku';
        $file_old = $dir . "/" . $resBuku['img'];

        // var_dump($resBuku);
        $_FILES['files']['name'];
        $file_ext = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
        $new_file = $timestamp . '.' . $file_ext;
        $config['file_name']        = $new_file;
        $config['upload_path']      =  $dir . "/";
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size'] = 500000; // max_size in kb
        if (!empty($_FILES['files']['name'])) {
            $_FILES['file']['name'] = $resBuku['img'];
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
                $filename = $uploadData;
                $cover = $filename['file_name'];
                $data = [
                    'judul_buku' => $data_post['edit_judul'],
                    'penulis_buku' => $data_post['edit_penulis'],
                    'penerbit_buku' => $data_post['edit_penerbit'],
                    'tahun_penerbit' => $data_post['edit_tahun_terbit'],
                    'jumlah' => $data_post['edit_jumlah'],
                    'kode_buku' => $data_post['edit_kode_buku'],
                    'kode_penulis' => strtoupper(substr($data_post['edit_penulis'], 0, 3)),
                    'kode_judul' => $data_post['edit_kode_judul'],
                    'id_kategori' => $data_post['edit_kategori'],
                    'img' => $cover,
                ];
            }
        } else {
            $data = [
                'judul_buku' => $data_post['edit_judul'],
                'penulis_buku' => $data_post['edit_penulis'],
                'penerbit_buku' => $data_post['edit_penerbit'],
                'tahun_penerbit' => $data_post['edit_tahun_terbit'],
                'jumlah' => $data_post['edit_jumlah'],
                'kode_buku' => $data_post['edit_kode_buku'],
                'kode_penulis' => strtoupper(substr($data_post['edit_penulis'], 0, 3)),
                'kode_judul' => $data_post['edit_kode_judul'],
                'id_kategori' => $data_post['edit_kategori']
            ];
        }
        // $table = 'm_buku';
        $res = $this->buku->updateData($data, $where);
        if ($res) {
            if (file_exists($file_old)) {
                unlink($file_old);
            }
            $this->session->set_flashdata('success', 'Berhasil update data!');
            redirect('manajemen/buku');
        } else {
            $this->session->set_flashdata('error', 'Gagal update data!');
            redirect('manajemen/buku');
        }
    }

    public function deleteData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            if ($data_post['cover'] != 'ebookdefault.jpg') {
                $dir = FCPATH . 'assets/img/coverbuku/';
                $file = $dir . $data_post['cover'];
                $delete_file = unlink($file);
            } else {
                $delete_file = true;
            }
            if ($delete_file) {
                $where = ['id_buku' => $data_post['id']];
                $res = $this->buku->deleteData($where);
                if ($res) {
                    $res = [
                        'code' => 200,
                        'status' => true,
                        'message' => 'Success',
                        'data' => $data_post
                    ];
                } else {
                    $res = [
                        'code' => 500,
                        'status' => false,
                        'message' => 'Internal Server Error',
                        'data' => null
                    ];
                }
            } else {
                $res = [
                    'code' => 500,
                    'status' => false,
                    'message' => 'Error delete image',
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

    public function getKategori()
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->buku->getDataKategori()->result_array();
            if ($data) {
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
                    'message' => 'Internal Server Error!',
                    'data' => 1
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

    public function addKategori()
    {
        $data_post = $this->input->post();
        $data = [
            'nama_kategori' => $data_post['input_nama_kategori'],
        ];
        $table = 'm_kategori_buku';
        $res = $this->buku->insert_data($table, $data);
        if ($res) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan data!');
            redirect('manajemen/buku');
        } else {
            $this->session->set_flashdata('error', 'gagal menambah data!');
            redirect('manajemen/buku');
        }
    }

    public function deleteKategori()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post();
            $where = ['id_kategori' => $data_post['id']];
            $delete = $this->buku->deleteKategori($where);
            if ($delete) {
                $res = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'Success',
                    'data' => null
                ];
            } else {
                $res = [
                    'code' => 500,
                    'status' => false,
                    'message' => 'Internal Server Error',
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
}
