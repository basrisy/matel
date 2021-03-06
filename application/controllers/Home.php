<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

    function cek_login()
	{
		$id = $this->session->userdata('id');
		$log = $this->session->userdata('isLogin');
		$admin = $this->admin->get_where('tbl_administrator',['id'=> $id]);
		foreach($admin->result() As $key){
			$isLogin = $key->isLogin;
		}
		if (!$id || $log != $isLogin)
		{
			$this->session->sess_destroy();
			redirect('login');
		}
    }

	public function index()
	{
		$this->cek_login();
		$data['kendaraan'] 	= $this->admin->count('tbl_kendaraan');
		$data['user_prabayar'] 	= $this->admin->count_LogUser(['Aktivasi User','Update Tipe Akun'],['Super User', 'User'],"YEAR(tanggal)=YEAR(CURDATE()) AND MONTH(tanggal)=MONTH(CURDATE())");
		$data['user_prabayar'] 	= 0;
		$data['user_free'] 	= $this->admin->count_LogUser(['Aktivasi User','Update Tipe Akun'], ['Free'], "YEAR(tanggal)=YEAR(CURDATE()) AND MONTH(tanggal)=MONTH(CURDATE())");
		$data['jml_user'] 	= $this->admin->count_User(['0','2']);

		$data['data'] = $this->admin->User_Where_in(['0', '2']);
		// $data['data'] = $this->m_user->getAll();
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/home', $data);
	}
	function json(){
        $this->load->library('datatables');
        $this->datatables->select('*');
        $this->datatables->from('tbl_user');
        return print_r($this->datatables->generate());
	}
	function get_user_json() { //data data produk by JSON object
		header('Content-Type: application/json');
		echo $this->m_user->get_all_user();
	}
	
}
