<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_m');
		
	}
	

	public function index()
	{
		$data['title'] = 'All Transaction';
		$data['transaction'] = true;
		$data['alltransaction'] = $this->User_m->allTransaction();
		$data['content'] = 'backend/transaction';
		$this->load->view('backend/index', $data);
	}
	public function detail($id)
	{
		$data['title'] = 'Detail Transaction';
		$data['detail'] = $this->User_m->detailTransaksi($id);
		$data['content'] = 'backend/detail';
		$this->load->view('backend/index', $data);
		
	}
	public function ongkir()
	{
		// $data['title'] = 'Detail Transaction';
		// $data['detail'] = $this->User_m->detailTransaksi($id);
		$data['content'] = 'backend/ongkir';
		$this->load->view('backend/index', $data);
		
	}
	public function payment()
	{
		$data['title'] = 'All Payment';
		$data['payment'] = true;
		$data['allpayment'] = $this->User_m->allPayment();
		// var_dump($data['allpayment']);die;
		$data['content'] = 'backend/payment';
		$this->load->view('backend/index', $data);
	}
	public function editStatusBayar()
	{
		$idbayar = $this->input->post('idbayar');
		$orderid = $this->input->post('orderid');
		$status = $this->input->post('status');
		$jenis_pembayaran = $this->input->post('jenis_pembayaran');
		$uang_muka = $this->input->post('uang_muka');
		$durasi_cicilan = $this->input->post('durasi_cicilan');

		// Update data pembayaran
		$data = [
			'status' => $status,
			'jenis_pembayaran' => $jenis_pembayaran,
			'uang_muka' => $jenis_pembayaran == 'credit' ? $uang_muka : NULL,
			'durasi_cicilan' => $jenis_pembayaran == 'credit' ? $durasi_cicilan : NULL,
			'status_cicilan' => $jenis_pembayaran == 'credit' ? 'pending' : 'lunas',
		];

		$this->Pembayaran_m->updatePaymentStatus($idbayar, $data);

		// Redirect or success message
		redirect('transaction/payment');
	}

	public function editStatus()
	{
		$data = [
			"status"=>$this->input->post('status', true),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idorder', $this->input->post('idorder', true));
		$this->db->update('pesanan', $data);
		redirect('transaction');
	}
	public function editResi()
	{
		$data = [
			"no_resi"=>$this->input->post('no_resi', true),
			"update_at"=>get_dateTime(),
			"update_by"=>user()['idusers']
		];
		$this->db->where('idorder', $this->input->post('idorder', true));
		$this->db->update('pesanan', $data);
		redirect('transaction');
	}
	/**
	* View By Id
	* @return Array
	*/
	public function view()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('pesanan',['idorder'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* View Pembayaran By Id
	* @return Array
	*/
	public function viewPembayaran()
	{
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('pembayaran',['idpembayaran'=>$id])->row();
		echo json_encode($data);
	}
	/**
	* Delete By ID
	* @return Boolean
	*/
	public function delete()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->Category_m->delete($id[$i]);
			}
		}else{
			$id = $this->input->post('idx');
			for ($i=0; $i < count($id); $i++) { 
				$this->Category_m->delete_permanen($id[$i]);
			}
		}
	}
	/**
	* Restore By ID
	* @return Boolean
	*/
	public function restore()
	{
		if($this->input->post('id')){
			$id = $this->input->post('id');
			for ($i=0; $i < count($id); $i++) { 
				$this->Posts_m->restore($id[$i]);
			}
		}
	}
}

/* End of file Transaction.php */