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
		$data['user_terdaftar'] = $this->admin->get_all('tbl_user');
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/home', $data);
	}
}
