<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_m');
    	$this->load->helper('encryption_helper'); // Pastikan nama helper sesuai dengan yang ada di application/helpers/
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
	private function _login() {
		$this->load->helper('encryption_helper'); // Load helper
		$username = $this->input->post('username');
		$password = $this->input->post('password');
	
		$user = $this->db->get_where('users', ['user_name' => $username])->row_array();
	
		if ($user) {
			if ($user['is_active'] == 1) {
				if ($user['is_block'] == 0) {
					// Dekripsi password dari database dan bandingkan
					if (decrypt_password($user['user_password']) === $password) {
						$data = [
							'telp' => $user['user_telp'],
							'username' => $user['user_name'],
							'access' => $user['user_type']
						];
						$this->session->set_userdata($data);
						
						$this->Auth_m->updateLogin($user['idusers']);
	
						if ($user['user_type'] != 'customer') {
							redirect('dashboard');
						} else {
							if ($cart = $this->cart->contents()) {
								foreach ($cart as $item) {
									$data = [
										'product_id' => $item['id'],
										'user_id' => $user['idusers'],
										'qty' => $item['qty'],
										'harga' => $item['price'],            
										'satuan' => $item['satuan'],            
										'berat' => $item['weight'],
										'create_at' => get_dateTime(),
										'create_by' => $user['idusers']            
									];
									$this->db->insert('cart', $data);
								}
							}
							$this->cart->destroy();
							redirect('user');
						}
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Password anda salah.</div>');
						redirect('auth');
					}
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Akun anda diblok.</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-ban"></i> Akun anda sudah tidak aktif.</div>');
				redirect('auth');
			}
		} else {
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
            // Simpan username ke session
            $this->session->set_userdata('reset_username', $username);

            // Ambil password terenkripsi dari database
            $encrypted_password = $user['user_password'];

            // Dekripsi password (pastikan fungsi decrypt_password tersedia)
            $decrypt_password = decrypt_password($encrypted_password);

			$this->session->set_flashdata('msg', '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Password saat ini Anda: <strong>' . htmlspecialchars($decrypt_password) . '</strong></div>');

            // Kirim data ke view
            $data['username'] = $username;
            $data['decrypt_password'] = $decrypt_password;

            $this->load->view('password_old', $data);
        } else {
            // Username tidak ditemukan
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Username tidak terdaftar.</div>');
            redirect('auth/forgot_password');
        }
    }
}

public function reset_password()
{
    $data['title'] = 'Reset Password';
    
    // Ambil username dari session
    $username = $this->session->userdata('reset_username');

    if (!$username) {
        // Jika session tidak ada, redirect kembali ke forgot_password
        $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Silakan masukkan username terlebih dahulu.</div>');
        redirect('auth/forgot_password');
        return;
    }

    $this->form_validation->set_rules('password1', 'Password Baru', 'trim|required|min_length[3]|max_length[25]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Konfirmasi Password Baru', 'trim|required|min_length[3]|max_length[25]|matches[password1]');

    if ($this->form_validation->run() == FALSE) {
        $data['username'] = $username; // Kirim username ke view agar bisa dipakai
        $this->load->view('lost_password', $data);
    } else {
        $password = encrypt_password($this->input->post('password1'));
        
        $user = $this->db->get_where('users', ['user_name' => $username])->row_array();

        if ($user) {
            // Update password
            $this->db->where('idusers', $user['idusers']);
            $this->db->update('users', ['user_password' => $password]);
            
            // Hapus session reset_username setelah password diubah
            $this->session->unset_userdata('reset_username');

            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">Password berhasil direset. Silakan login dengan password baru Anda.</div>');
            redirect('auth');
        } else {
            // Username tidak ditemukan
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">Terjadi kesalahan. Silakan coba lagi.</div>');
            redirect('auth/reset_password');
        }
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