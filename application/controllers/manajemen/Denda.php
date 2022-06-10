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
}
