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
        login_check();
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
