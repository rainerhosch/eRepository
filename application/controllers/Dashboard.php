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
        if ($this->session->userdata('role') <= 2) {
            redirect('dashboard/admin');
        } else {
            redirect('dashboard/anggota');
        }
    }

    public function admin()
    {
        if ($this->session->userdata('role') <= 2) {
            $data['title'] = 'E-Library';
            $data['page'] = 'Dashboard Admin';
            $data['content'] = 'content/v_dashboard';
            $this->load->view('template', $data);
        } else {
            redirect('dashboard/anggota');
        }
    }
    public function anggota()
    {
        if ($this->session->userdata('role') > 2) {
            $data['title'] = 'E-Library';
            $data['page'] = 'Dashboard Anggota';
            $data['content'] = 'content/v_dashboard_anggota';
            $this->load->view('template', $data);
        } else {
            redirect('dashboard/admin');
        }
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
