<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function register($user_data)
	{
		$this->load->helper('encryption_helper');
		$data = [
            'user_name' => htmlspecialchars($user_data['user_name']),
            'user_password' => encrypt_password($user_data['user_password']), // Simpan password terenkripsi
            'user_fullname' => htmlspecialchars($user_data['user_fullname']),
            'user_telp' => htmlspecialchars($user_data['user_telp']),
            'user_gambar' => htmlspecialchars($user_data['user_gambar']),
            'user_type' => 'customer',
            'is_active' => 1,
            'is_block' => 0,
            'create_at' => date('Y-m-d H:i:s'),
            'create_by' => 1
        ];
		$this->db->insert('users', $data);
		
	}

    public function get_user_by_username($username) {
        return $this->db->where('user_name', $username)->get('users')->row();
    }

	public function updateLogin($id)
	{
		$data = [
			'last_loggin' => get_dateTime(),
			'ip_address' => get_ip_address()
		];
		$this->db->where('idusers', $id);
		$this->db->update('users', $data);
		
	}
	
	
}

/* End of file Auth_m.php */