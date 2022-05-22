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
        $this->load->model('manajemen/M_submenu', 'submenu');
    }

    public function getData()
    {
        if ($this->input->is_ajax_request()) {
            $data_post = $this->input->post('id_menu') ? $id_menu = $this->input->post('id_menu') : $id_menu = null;
            $data = $this->submenu->getData(['id_menu'=>$data_post])->result_array();
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
