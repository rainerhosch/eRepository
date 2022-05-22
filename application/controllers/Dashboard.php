<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Dashboard.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 21/05/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if ($this->session->has_userdata('username') == null) {
        //     $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> <h4><i class='icon fa fa-warning'></i> Alert!</h4> Harus Login Terlebih Dahulu</div>");
        //     redirect(base_url());
        // }
    }
    public function index()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Dashboard';
        $data['content'] = 'content/v_dashboard';
        $this->load->view('template', $data);
        // $this->load->view('app');
    }
    
    public function home()
    {
        $data['title'] = 'E-Library';
        $data['page'] = 'Dashboard';
        $data['subpage'] = 'Home';
        $data['content'] = 'content/v_dashboard';
        $this->load->view('template', $data);
    }
}
