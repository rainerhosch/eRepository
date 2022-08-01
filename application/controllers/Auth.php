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
		include APPPATH . 'libraries\phpqrcode\qrlib.php';
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

	public function register()
	{
		// code here...
		$data['title'] = 'E-Library';
		$data['page'] = 'Auth';
		$data['subpage'] = 'Register';
		$data['content'] = 'content/v_registration';
		$this->load->view('template', $data);
	}

	public function process_login()
	{
		if ($this->input->is_ajax_request()) {
			$email_or_username = $this->input->post('email_or_username');
			$password = $this->input->post('password');
			$field = 'user.user_id,user.username, user.password, user.is_active, user.role_id as role, user.qrcode_img, user_detail.*';
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
							'tlp' => $data_user['tlp'],
							'alamat' => $data_user['alamat'],
							'role' => $data_user['role'],
							'qrcode_img' => $data_user['qrcode_img'],
							'is_login' => true
						];
						$this->session->set_userdata($data_session);
						$response = [
							'code' => 200,
							'status' => 'success',
							'message' => 'Success',
							'data' => $data_session
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


	public function process_registration()
	{
		if ($this->input->is_ajax_request()) {
			$curent_time = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
			$date = $curent_time->format('Y-m-d');
			$post_regist = $this->input->post();


			// cek tlp
			$data_tlp = '62' . substr($post_regist['tlp_user'], 1, 11);
			// data insert user detail
			$tbl = 'user_detail';
			$data_detail_user = [
				'nama'      	=> $post_regist['nama_user'],
				'email'     	=> $post_regist['email_user'],
				'tlp'       	=> $data_tlp,
				'alamat'    	=> $post_regist['alamat_user'],
				'img'       	=> 'default.jpg'
			];

			$id_detail_user = $this->user->insert_data($tbl, $data_detail_user);
			if (!$id_detail_user) {
				// error
				$data = [
					'code' => 500,
					'status' => false,
					'msh' => 'Gagal insert data user detail.',
					'data' => null
				];
			} else {
				$dir = FCPATH . 'assets/img/qrcode/';
				// JIKA DIREKTORI TAHUN TIDAK ADA
				if (!is_dir($dir)) {
					mkdir($dir, 0777, true);
				}
				$qrcode_filename = $post_regist['username']  . date("Ymd") . rand() . ".png";
				$file_path = $dir . $qrcode_filename;
				$tbl = 'user';
				$data_user_regist = [
					'username'          => $post_regist['username'],
					'password'          => md5($post_regist['password']),
					'role_id'           => $post_regist['role_user'],
					'user_detail_id'    => $id_detail_user,
					'is_active'         => 0,
					'create_date'       => strtotime($date),
					'qrcode_img'		=> $qrcode_filename
				];
				$insert_user = $this->user->insert_data($tbl, $data_user_regist);
				if (!$insert_user) {
					$data = [
						'code' => 500,
						'status' => false,
						'msh' => 'Gagal insert data user.',
						'data' => null
					];
				} else {
					QRcode::png($qrcode_filename, $file_path, QR_ECLEVEL_L, 10);
					$data = [
						'code' => 200,
						'status' => true,
						'msg' => 'Data registarsi berhasil di simpan.',
						'data' => $post_regist['nama_user'],
					];
				}
			}
		} else {
			$data = [
				'code' => 500,
				'status' => false,
				'msh' => 'Invalid request',
				'data' => null
			];
		}
		echo json_encode($data);
	}


	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Berhasil Logout!</div>');
		redirect('Auth');
	}
}
