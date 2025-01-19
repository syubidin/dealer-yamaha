<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'Masuk';
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login', $data);
		} else {
			$this->_login();
		}
		
	}
	private function _login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$user = $this->db->get_where('users', ['user_name'=>$username])->row_array();
		if($user){
			if($user['is_active'] == 1){
				if($user['is_block'] == 0){
					if(password_verify($password, $user['user_password'])){
						$data = [
							'telp' => $user['user_telp'],
							'username' => $user['user_name'],
							'access' => $user['user_type']
						];
						$this->session->set_userdata($data);
						// redirect('dashboard');
						$this->Auth_m->updateLogin($user['idusers']);
						if($user['user_type']!= 'customer'){
							redirect('dashboard');
						}else{
							if ($cart = $this->cart->contents())
							{
								foreach ($cart as $item)
									{
										$data = array(
											'product_id' => $item['id'],
											'user_id' => $user['idusers'],
											'qty' => $item['qty'],
											'harga' => $item['price'],			
											'satuan' => $item['satuan'],			
											'berat' => $item['weight'],
											'create_at'=>get_dateTime(),
											'create_by'=>$user['idusers']			
										);
										$this->db->insert('cart',$data);
									}
							}
							$this->cart->destroy();
							redirect('user');
						}
					}else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Password anda salah.</div>');
						redirect('auth');
					}
				}else{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Akun anda diblok.</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Akun anda sudah tidak aktif.</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Username tidak terdaftar.</div>');
			redirect('auth');
		}
	}
	public function register(){
		$data['title'] = 'Buat Akun';
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
		$this->form_validation->set_rules('telp', 'No. Telp', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[20]|is_unique[users.user_name]');
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|max_length[25]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[3]|max_length[25]|matches[password1]');

		if ($this->form_validation->run() == TRUE) {
			// Konfigurasi upload file
			$config['upload_path']   = './uploads/users/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']      = 2048; // Maksimal 2MB
			$config['file_name']     = uniqid('user_'); // Nama file unik

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('user_gambar')) {
				// Jika upload berhasil
				$upload_data = $this->upload->data();
				$user_gambar = $upload_data['file_name']; // Nama file yang disimpan
			} else {
				// Jika upload gagal, gunakan default gambar
				$user_gambar = 'default.png';
			}

			// Ambil data dari form input
			$user_data = [
				'user_name'     => $this->input->post('username', TRUE),
				'user_password' => $this->input->post('password1', TRUE),
				'user_fullname' => $this->input->post('fullname', TRUE),
				'user_telp'     => $this->input->post('telp', TRUE),
				'user_gambar'   => $user_gambar
			];

			// Panggil fungsi register pada model Auth_m
			$this->Auth_m->register($user_data);

			// Set pesan sukses dan redirect
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Create account successfully.</div>');
			redirect('auth');
		} else {
			// Jika validasi gagal, tampilkan form register
			$this->load->view('register', $data);
		}
	}


	public function logout()
	{
		// $user = user()['username'];
		// $this->LogActivity_m->logKeluar($user);
		$this->session->sess_destroy();
		redirect('welcome','refresh');
	}


}

/* End of file Auth.php */