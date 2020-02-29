<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
	public function user_prabayar()
    {
		$this->cek_login();
		$tgl_mulai = date('Y-m-01');
        $tgl_akhir = date('Y-m-31');
		if ($this->input->post('submit', TRUE) == 'Submit'){
			$this->form_validation->set_rules('tgl_akhir', 'Sampai Tanggal', 'required', array('required' => 'Gunakan Rentang Waktu'));

			if ($this->form_validation->run() == TRUE){
				$tgl_mulai = $this->input->post('tgl_mulai', TRUE);
				$tgl_akhir = $this->input->post('tgl_akhir', TRUE);
            } else {
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Gunakan rentang waktu');
				redirect('stock/masuk');
			}
        } else {
            $tgl_mulai = date('Y-m-01');
            $tgl_akhir = date('Y-m-31');
        }
        $mulai = $tgl_mulai;
        $akhir = $tgl_akhir;
		$data['tgl_mulai'] = $mulai;
		$data['tgl_akhir'] = $akhir;
		$where_in = ['Super User', 'User'];
		$where = ['aksi' => 'Aktivasi User', 'tanggal >=' => $mulai, 'tanggal <=' => $akhir];
		$data['data'] = $this->m_laporan->getUserPrabayar($where_in, $where);
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/laporan/user_prabayar',$data);
    }
	public function user_free()
    {
		$this->cek_login();
		$tgl_mulai = date('Y-m-01');
        $tgl_akhir = date('Y-m-31');
		if ($this->input->post('submit', TRUE) == 'Submit'){
			$this->form_validation->set_rules('tgl_akhir', 'Sampai Tanggal', 'required', array('required' => 'Gunakan Rentang Waktu'));

			if ($this->form_validation->run() == TRUE){
				$tgl_mulai = $this->input->post('tgl_mulai', TRUE);
				$tgl_akhir = $this->input->post('tgl_akhir', TRUE);
            } else {
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Gunakan rentang waktu');
				redirect('stock/masuk');
			}
        } else {
            $tgl_mulai = date('Y-m-01');
            $tgl_akhir = date('Y-m-31');
        }
        $mulai = $tgl_mulai;
        $akhir = $tgl_akhir;
		$data['tgl_mulai'] = $mulai;
		$data['tgl_akhir'] = $akhir;
		$where_in = ['Free', 'Trial'];
		$where = ['aksi' => 'Aktivasi User', 'tanggal >=' => $mulai, 'tanggal <=' => $akhir];
		$data['data'] = $this->m_laporan->getUserFree($where_in, $where);
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/laporan/user_free',$data);
    }
}