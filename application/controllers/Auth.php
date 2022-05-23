<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : Auth.php
 *  File Type             : Controller
 *  File Package          : CI_Controller
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 23/05/2022
 *  Quots of the code     : 'Hanya seorang yang hobi berbicara dengan komputer.'
 */
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('manajemen/M_user', 'user');
	}

	public function index()
	{
		if ($this->session->userdata('user_id')) {
			redirect('dashboard');
		} else {
			redirect('auth/login');
		}
	}

	public function login()
	{
		// code here...
		$data['title'] = 'E-Library';
		$data['page'] = 'Auth';
		$data['subpage'] = 'Login';
		$data['content'] = 'content/v_login';
		$this->load->view('template', $data);
	}

	public function process_login()
	{
		if ($this->input->is_ajax_request()) {
			$email_or_username = $this->input->post('email_or_username');
			$password = $this->input->post('password');
			$field = 'user.user_id,user.username, user.password, user.is_active, user.role_id as role, user_detail.*';
			$contition = "user.username='" . $email_or_username . "' OR user_detail.email='" . $email_or_username . "'";
			$data_user = $this->user->getData($field, $contition)->row_array();
			if ($data_user) {
				if (md5($password) == $data_user['password']) {
					if ($data_user['is_active'] == 1) {
						$data_session = [
							'user_id' => $data_user['user_id'],
							'username' => $data_user['username'],
							'email' => $data_user['email'],
							'fullname' => $data_user['nama'],
							'role' => $data_user['role'],
							'is_login' => true
						];
						$this->session->set_userdata($data_session);
						$response = [
							'code' => 200,
							'status' => 'success',
							'message' => 'Success',
							'data' => 'Data sesion berhasil di set'
						];
					} else {
						$response = [
							'code' => 404,
							'status' => 'error',
							'message' => 'Akun belum aktif, silahkan hubungi admin',
							'data' => ''
						];
					}
				} else {
					$response = [
						'code' => 403,
						'status' => 'error',
						'message' => 'Password salah',
						'data' => ''
					];
				}
			} else {
				$response = [
					'code' => 404,
					'status' => 'error',
					'message' => 'Data pengguna tidak ditemukan',
					'data' => $data_user
				];
			};
		} else {
			$response = [
				'code' => 403,
				'status' => 'error',
				'msh' => 'Invalid request',
				'data' => null
			];
		}
		echo json_encode($response);
	}


	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Berhasil Logout!</div>');
		redirect('Auth');
	}
}
