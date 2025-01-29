<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_m');
		$this->load->model('Wilayah_m');
		
	}
	

	public function index()
	{	
		$idorder = $this->db->get_where('pesanan',['user_id'=>user()['idusers']])->row();
		// var_dump($idorder->idorder);die;
		if($idorder){
		$data['totalorder']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers']])->result());
		$data['totalproses']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers'],'status'=>'proses'])->result());
		$data['totalpengiriman']=count($this->db->get_where('pesanan',['user_id'=>user()['idusers'],'status'=>'pengiriman'])->result());
		$data['totalbeli']=count($this->User_m->totalBeli(user()['idusers']));
		}else{
			$data['totalorder']=0;
			$data['totalproses']=0;
			$data['totalpengiriman']=0;
			$data['totalbeli']=0;
		}// var_dump($data['barangbeli']);die;
		$data['provinsi'] = $this->Wilayah_m->provinsi();
		$data['profil']=$this->User_m->getProfile(user()['idusers']);
		$data['content'] = 'themes/'.theme_active().'/user_profil';
		$this->load->view('themes/'.theme_active().'/index',$data);
	}
	public function alluser()
	{
		$data['title'] = 'All Users';
		$data['users'] = $data['allusers'] = true;
		$data['alluser'] = $this->db->get('users')->result_array();
		$data['content'] = 'backend/alluser';
		$this->load->view('backend/index', $data);
	}
	public function user_profile()
	{
		$data['title'] = 'Update Profile';
		$data['user_profile'] = true;
		$data['update_user'] = $this->db->get_where('users',['idusers'=>user()['idusers']])->row();
		$data['content'] = 'backend/profil';
		$this->load->view('backend/index', $data);
	}
	public function change_password()
	{
		$data['title'] = 'Change Password';
		$data['change_password'] = true;
		$data['update_user'] = $this->db->get_where('users',['idusers'=>user()['idusers']])->row();
		$data['content'] = 'backend/change_password';
		$this->load->view('backend/index', $data);
	}
	public function editpassword(){
		// $this->User_m->register();
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[25]|matches[retype_password]');
		$this->form_validation->set_rules('retype_password', 'Confirm password', 'trim|required|min_length[3]|max_length[25]|matches[password]');
		if ($this->form_validation->run() == TRUE) {
			$data = [
				'user_password' => password_hash(htmlspecialchars($this->input->post('password', true)), PASSWORD_DEFAULT),
				'update_at'=>get_dateTime(),
				'update_by'=>$this->input->post('idusers', true)
			];
			$this->db->where('idusers', $this->input->post('idusers', true));
			$this->db->update('users', $data);
			$this->toastr->success('Your Password Updated');
		} else {
			$this->toastr->error('Password and Retype Password Not Matchs');
		}
		redirect('user/change_password');
	}
	public function editprofil()
	{
		$data = [
			'user_fullname'=>$this->input->post('user_fullname', true),
			'user_telp'=>$this->input->post('user_telp', true),
			'user_url'=>$this->input->post('user_url', true),
			'user_bio'=>$this->input->post('user_bio', true),
			'update_at'=>get_dateTime(),
			'update_by'=>$this->input->post('idusers', true)
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
		$this->toastr->success('Your Profile Updated');
		redirect('user/user_profile');
	}
	public function usergroup()
	{
		$data['title'] = 'All Group';
		$data['users'] = $data['usersgroup'] = true;
		$data['usergroup'] = $this->db->get('user_group')->result_array();
		$data['content'] = 'backend/usergroup';
		$this->load->view('backend/index', $data);
	}
	public function useraccess()
	{
		$data['title'] = 'All Access';
		$data['users'] = $data['usersaccess'] = true;
		$data['alluser'] = $this->db->get('users')->result_array();
		$data['content'] = 'backend/alluser';
		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data = [
			'users_id'=>$this->input->post('users_id', true),
			'fullname'=>$this->input->post('nama', true),
			'telp'=>$this->input->post('telp', true),
			'prov'=>$this->input->post('prov', true),
			'kab'=>$this->input->post('kab', true),
			'kec'=>$this->input->post('kec', true),
			'kodepos'=>$this->input->post('kodepos', true),
			'address'=>$this->input->post('address', true),
			'create_at'=>get_dateTime(),
			'create_by'=>user()['idusers']
		];
		$this->db->insert('user_profile', $data);
		redirect('user');
	}
	public function edit()
	{
		$data = [
			'fullname'=>$this->input->post('nama', true),
			'telp'=>$this->input->post('telp', true),
			'prov'=>$this->input->post('prov', true),
			'kab'=>$this->input->post('kab', true),
			'kec'=>$this->input->post('kec', true),
			'kodepos'=>$this->input->post('kodepos', true),
			'address'=>$this->input->post('address', true),
			'update_at'=>get_dateTime(),
			'update_by'=>$this->input->post('iduser_profile', true)
		];
		$this->db->where('iduser_profile', $this->input->post('iduser_profile', true));
		$this->db->update('user_profile', $data);
		redirect('user');
	}
	public function addTestimoni()
	{
		$data = [
			'user_id' => user()['idusers'],
			'name' => $this->input->post('nama', true),
			'telp' => $this->input->post('telp', true),
			'user_gambar' => $this->input->post('user_gambar', true),
			'job' => $this->input->post('job', true),
			'message' => $this->input->post('message', true),
			'create_at' => get_dateTime(),
			'create_by' => user()['idusers']
		];
		$this->db->insert('testimonial', $data);
		$this->toastr->success('Testimoni telah ditambahkan');
		redirect('public/testimoni');
	}
	public function addContact()
	{
		// Set aturan validasi form
		$this->form_validation->set_rules('nama_contact', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('no_contact', 'No. Telp', 'required|numeric');
		$this->form_validation->set_rules('pesan', 'Pesan', 'required');

		// Validasi form
		if ($this->form_validation->run() == FALSE) {
			// Simpan input ke flashdata jika validasi gagal
			$this->session->set_flashdata('old_data', $this->input->post());
			$this->session->set_flashdata('error', validation_errors('<p class="text-danger">', '</p>'));
			redirect('public/contact');
		} else {
			// Ambil data form dan simpan ke dalam array
			$data = [
				'idusers' => user()['idusers'],
				'nama_contact' => $this->input->post('nama_contact', true),
				'no_contact' => $this->input->post('no_contact', true),
				'pesan' => $this->input->post('pesan', true),
			];

			// Insert data ke tabel contact_us
			$this->db->insert('contact_us', $data);

			// Set flash data untuk sukses
			$this->session->set_flashdata('message_status', 'sent');
			$this->toastr->success('Pesan Anda telah terkirim!');
			
			// Redirect ke halaman yang sama
			redirect('public/contact');
		}
	}
	public function addKonfirmasi()
	{
		$config['upload_path'] = './uploads/bukti/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1024;
		$config['file_name'] = 'bukti-bayar-' . time();

		$this->load->library('upload', $config);

		if (! $this->upload->do_upload('bukti')) {
			$this->upload->display_errors();
		} else {
			$img = $this->upload->data();
			$image = $img['file_name'];

			$data = [
				'order_id' => $this->input->post('order_id', true),
				'user_id' => user()['idusers'],
				'file' => $image,
				'total' => $this->input->post('total', true),
				'status' => 'pending',
				'keterangan' => $this->input->post('keterangan', true),
				'create_at' => get_dateTime(),
				'create_by' => user()['idusers']
			];

			$this->db->insert('pembayaran', $data);
			$this->toastr->success('Konfirmasi pembayaran telah ditambahkan');
		}
		redirect('public/konfirmasi');
	}
	public function editTestimoni()
	{
		$data = [
			'name'=>$this->input->post('nama', true),
			'telp'=>$this->input->post('telp', true),
			'user_gambar' => $this->input->post('user_gambar', true),
			'job'=>$this->input->post('job', true),
			'message'=>$this->input->post('message', true),
			'status'=>'No',
			'update_at'=>get_dateTime(),
			'update_by'=>user()['idusers']
		];
		$this->db->where('user_id', $this->input->post('user_id', true));
		$this->db->update('testimonial', $data);
		redirect('public/testimoni');
	}
	public function addNewUser() {
		// Handle image upload
		$config['upload_path'] = './uploads/users/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048; // 2MB
		$config['encrypt_name'] = TRUE; // Encrypt the name of the uploaded file
		$this->load->library('upload', $config);
	
		if ($this->upload->do_upload('user_gambar')) {
			$upload_data = $this->upload->data();
			$user_image = $upload_data['file_name'];
		} else {
			$user_image = NULL; // If no image uploaded, set to NULL
		}
	
		// Prepare data for insertion
		$data = [
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_password' => password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_telp' => htmlspecialchars($this->input->post('user_telp', true)),
			'user_type' => htmlspecialchars($this->input->post('user_type', true)), // Store user type
			'is_active' => 1,
			'is_block' => 0,
			'create_at' => get_dateTime(),
			'create_by' => user()['idusers'],
			'user_gambar' => $user_image // Store the image file name
		];
	
		// Insert data into the database
		$this->db->insert('users', $data);
		$this->toastr->success('Created Successfully');
		redirect('user/alluser');
	}
	

	public function updateUser() {
		// Get current user ID
		$user_id = $this->input->post('idusers', true);
	
		// Default user_image is NULL
		$user_image = NULL;
	
		// Check if new image is uploaded
		if (!empty($_FILES['user_gambar']['name'])) {
			// Config upload path and restrictions
			$config['upload_path'] = './uploads/users/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048; // 2MB
			$config['encrypt_name'] = TRUE; // Encrypt the name of the uploaded file
			$this->load->library('upload', $config);
	
			if ($this->upload->do_upload('user_gambar')) {
				$upload_data = $this->upload->data();
				$user_image = $upload_data['file_name']; // Store new image name
			} else {
				// If upload fails, keep the error message for debugging
				log_message('error', 'Upload error: ' . $this->upload->display_errors());
			}
		}
	
		// If image is not uploaded, try to keep the old image
		if (!$user_image) {
			// Query to get the current image from the database if no new image uploaded
			$user = $this->db->get_where('users', ['idusers' => $user_id])->row();
			if ($user) {
				$user_image = $user->user_gambar; // Retain old image if no new image
			}
		}
	
		// Update data
		$data = [
			'user_fullname' => htmlspecialchars($this->input->post('user_fullname', true)),
			'user_telp' => htmlspecialchars($this->input->post('user_telp', true)),
			'user_name' => htmlspecialchars($this->input->post('user_name', true)),
			'user_type' => htmlspecialchars($this->input->post('user_type', true)), // Update user_type
			'update_at' => get_dateTime(),
			'update_by' => user()['idusers']
		];
	
		// Add image if exists
		if ($user_image) {
			$data['user_gambar'] = $user_image;
		}
	
		$this->db->where('idusers', $user_id);
		$this->db->update('users', $data);
		$this->toastr->success('Updated Successfully');
		redirect('user/alluser');
	}	
	public function changepassword()
	{
		$data = [
			"user_password"=>password_hash(htmlspecialchars($this->input->post('user_password', true)), PASSWORD_DEFAULT),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idusers', $this->input->post('idusers', true));
		$this->db->update('users', $data);
		$this->toastr->success('Change Password Successfully');
		redirect('user/alluser');
	}
	public function proses_order()
	{
		// Input data order
		$data_order = [
			'code' => 'ODR-' . get_dateTime(),
			'datetime' => get_dateTime(),
			'user_id' => user()['idusers'],
			'subtotal' => $this->input->post('subtotal', true),
			'total_weight' => $this->input->post('weight', true),
			'order_ongkir' => $this->input->post('delivery', true),
			'total_harga' => $this->input->post('carttotal', true),
			'order_prov' => $this->input->post('prov', true),
			'order_kab' => $this->input->post('kab', true),
			'order_kec' => $this->input->post('kec', true),
			'order_kodepos' => $this->input->post('kodepos', true),
			'order_address' => $this->input->post('address', true),
			'order_kurir' => $this->input->post('kurir', true),
			'order_layanan' => $this->input->post('layanan', true),
			'status_bayar' => 'belum lunas',
			'status' => 'pembayaran pending',
			'create_at' => get_dateTime(),
			'create_by' => user()['idusers']
		];

		$id_order = $this->User_m->tambah_order($data_order);

		// Input data pembayaran
		$data_bayar = [
			'order_id' => $id_order,
			'user_id' => user()['idusers'],
			'file' => '',
			'total' => 0,
			'status' => 'pending',
			'keterangan' => '',
			'create_at' => get_dateTime(),
			'create_by' => user()['idusers']
		];

		$id_bayar = $this->User_m->tambah_bayar($data_bayar);

		// Input data detail order
		if ($cart = cartlist(user()['idusers'])) {
			foreach ($cart as $item) {
				$data_detail = [
					'product_id' => $item['product_id'],
					'order_id' => $id_order,
					'qty' => $item['qty'],
					'harga' => $item['harga'],
					'satuan' => $item['satuan'],
					'berat' => $item['berat'],
					'create_at' => get_dateTime(),
					'create_by' => user()['idusers']
				];

				$this->User_m->tambah_detail_order($data_detail);

				$this->db->where('idcart', $item['idcart']);
				$this->db->delete('cart');
			}
		}

		redirect(base_url('public/konfirmasi'), 'refresh');
	}


	public function add_to_cart_totals() {
		$user_id = $this->session->userdata('user_id');
		$idorder = $this->input->post('order_id'); // Get the order ID from the form submission
	
		// Validate the inputs
		$subtotal = $this->input->post('subtotal');
		$delivery_fee = $this->input->post('delivery_fee');
		$interest_rate = $this->input->post('interest_rate');
		$installment_duration = $this->input->post('installment_duration');
		$down_payment = $this->input->post('down_payment');
	
		if (!is_numeric($subtotal) || !is_numeric($delivery_fee) || !is_numeric($interest_rate) || !is_numeric($down_payment) || !is_numeric($installment_duration)) {
			$this->session->set_flashdata('error', 'Invalid input values.');
			redirect('cart');
		}
	
		$interest_amount = ($subtotal * $interest_rate) / 100;
		$grand_total = $subtotal + $interest_amount + $delivery_fee;
		$remaining_installments = ($grand_total - $down_payment) / $installment_duration;
	
		// Prepare data for saving to the database
		$data = [
			'order_id' => $idorder,
			'user_id' => $user_id,
			'subtotal' => $subtotal,
			'delivery_fee' => $delivery_fee,
			'interest_rate' => $interest_rate,
			'interest_amount' => $interest_amount,
			'grand_total' => $grand_total,
			'down_payment' => $down_payment,
			'remaining_installments' => $remaining_installments,
			'installment_duration' => $installment_duration,
			'created_at' => time(),
			'created_by' => $user_id,
		];
	
		// Insert data into the 'pesanan' table
		$this->db->insert('pesanan', $data);
	
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Cart totals have been successfully saved.');
		} else {
			$this->session->set_flashdata('error', 'Failed to save cart totals.');
		}
	
		// Prepare cart totals data to pass to the view
		$cart_totals = [
			'total' => $subtotal,
			'bunga' => $interest_amount,
			'ongkir' => $delivery_fee,
			'sisa_cicilan' => $remaining_installments,
		];
	
		// Pass both 'cart_totals' and 'order_id' to the view
		$this->load->view('themes/motor/cart', [
			'cart_totals' => $cart_totals,
			'order_id' => $idorder // Pass the order_id here
		]);
	}
	
	
	// public function proses_orde()
	// {
	// 	//-------------------------Input data order------------------------------
	// 	$data_order = array('code' => 'ODR-'.get_dateTime(),
	// 						'datetime' => get_dateTime(),
	// 						'user_id' => user()['idusers'],
	// 						'total_harga' => $this->cart->total(),
	// 						'status_bayar' => 'belum lunas',
	// 						'status' => 'pembayaran pending',
	// 						'create_at'=>get_dateTime(),
	// 						'create_by'=>user()['idusers']
	// 					);
	// 						// var_dump($data_order);die;
	// 	$id_order = $this->User_m->tambah_order($data_order);
	// 	//-------------------------Input data pembayaran------------------------------
	// 	$data_bayar = array('order_id' => $id_order,
	// 						'user_id' => user()['idusers'],
	// 						'file' => '',
	// 						'total' => 0,
	// 						'status' => 'pending',
	// 						'keterangan' => '',
	// 						'create_at'=>get_dateTime(),
	// 						'create_by'=>user()['idusers']
	// 					);
	// 						// var_dump($data_order);die;
	// 	$id_bayar = $this->User_m->tambah_bayar($data_bayar);
	// 	//-------------------------Input data detail order-----------------------		
	// 	if ($cart = $this->cart->contents())
	// 		{
	// 			foreach ($cart as $item)
	// 				{
	// 					$data_detail = array(
	// 						'product_id' => $item['id'],
	// 						'order_id' =>$id_order,
	// 						'qty' => $item['qty'],
	// 						'harga' => $item['price'],			
	// 						'satuan' => $item['satuan'],			
	// 						'berat' => $item['berat'],
	// 						'create_at'=>get_dateTime(),
	// 						'create_by'=>user()['idusers']			
	// 					);
	// 					$proses = $this->User_m->tambah_detail_order($data_detail);
	// 				}
	// 		}
	// 	//-------------------------Hapus shopping cart--------------------------		
	// 	$this->cart->destroy();
		
	// 	redirect(base_url('user'),'refresh');
		
	// }
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('users',['idusers'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* View Alamat By Id
	* @return Array
	*/
	public function viewAlamat()
	{
		$id = $this->input->post('id', true);
		$this->db->select('user_profile.*,kabupaten.nama as nama_kab');
		$this->db->join('kabupaten', 'kabupaten.id_kab = user_profile.kab', 'left');
		// $this->db->join('provinsi', 'provinsi.id_prov = user_profile.prov', 'left');
		$data = $this->db->get_where('user_profile',['users_id'=>$id])->row();
		// $data = $this->db->get_where('user_profile',['users_id'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* Blocked By ID
	* @return Boolean
	*/
	public function block()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->User_m->blocked($id[$i]);
			}
		}
	}
	/**
	* Unblocked By ID
	* @return Boolean
	*/
	public function unblock()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->User_m->unblocked($id[$i]);
			}
		}
	}
}

/* End of file User.php */