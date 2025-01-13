<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Auth_m');
		
	}
	

	public function index(){
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
		$this->form_validation->set_rules('password2', 'Confirm password', 'trim|required|min_length[3]|max_length[25]|matches[password1]');
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './uploads/users/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = settings('general','upload_max_filesize'); // Contoh pengaturan ukuran
			$config['file_name'] = 'user-' . time(); // Menentukan nama file gambar
			$this->load->library('upload', $config);
	
			// Mengunggah gambar
			if ($this->upload->do_upload('user_gambar')) {
				$image_data = $this->upload->data(); // Data gambar
				$image_path = $image_data['file_name']; // Mendapatkan nama file gambar
			} else {
				$image_path = 'default.jpg'; // Default gambar jika upload gagal
			}

			 // Simpan data ke database melalui model
			 $user_data = [
				'user_name' => $this->input->post('username', true),
				'user_password' => $this->input->post('password1', true),
				'user_fullname' => $this->input->post('fullname', true),
				'user_telp' => $this->input->post('telp', true),
				'user_gambar' => $image_path // Pastikan gambar diteruskan
			];
			// Simpan data ke database melalui model
			$this->Auth_m->register($user_data);
	
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Create account successfuly.</div>');
			redirect('auth');
		} else {
			$this->load->view('register', $data);
		}
	}
	
	public function forgot_password()
{
    $data['title'] = 'Lupa Password';
    $this->form_validation->set_rules('username', 'Username', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('forgot_password', $data);
    } else {
        $username = $this->input->post('username');
        $user = $this->db->get_where('users', ['user_name' => $username])->row_array();

        if ($user) {
            // Generate kode pemulihan
            $kode_pemulihan = rand(100000, 999999); // Kode 6 digit
            $this->db->where('idusers', $user['idusers']);
            $this->db->update('users', ['user_forgot_password_key' => $kode_pemulihan]);

            // Set pesan berhasil di halaman login
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your recovery code will be: <strong>' . $kode_pemulihan . '</strong>. Masukkan kode ini untuk reset password.</div>');
            redirect('auth/reset_password');
        } else {
            // Username tidak ditemukan
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Username tidak terdaftar.</div>');
            redirect('auth/forgot_password');
        }
    }
}

	public function reset_password()
	{
		$data['title'] = 'Reset Password';
		$this->form_validation->set_rules('user_forgot_password_key', 'Kode Pemulihan', 'trim|required');
		$this->form_validation->set_rules('password1', 'Password Baru', 'trim|required|min_length[3]|max_length[25]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Konfirmasi Password Baru', 'trim|required|min_length[3]|max_length[25]|matches[password1]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('lost_password', $data);
		} else {
			$user_forgot_password_key = $this->input->post('user_forgot_password_key');
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

			$user = $this->db->get_where('users', ['user_forgot_password_key' => $user_forgot_password_key])->row_array();

			if ($user) {
				// Update password
				$this->db->where('idusers', $user['idusers']);
				$this->db->update('users', ['user_password' => $password, 'user_forgot_password_key' => null]);

				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password berhasil direset. Silakan login dengan password baru Anda.</div>');
				redirect('auth');
			} else {
				// Kode pemulihan salah
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Invalid recovery code.</div>');
				redirect('auth/reset_password');
			}
		}
	}

	public function logout(){
		// $user = user()['username'];
		// $this->LogActivity_m->logKeluar($user);
		$this->session->sess_destroy();
		redirect('welcome','refresh');
	}


}