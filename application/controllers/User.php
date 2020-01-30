<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

	public function data_user()
	{
		$this->cek_login();
        $data['user_terdaftar'] = $this->admin->get_all('tbl_user');
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/user/data_user', $data);
	}
	public function set_terima()
	{
		$this->cek_login();
		$id = $this->input->post('id', TRUE);
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			$this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required');
			if ($this->form_validation->run() == TRUE){
				$data = array(
					'status_aktif' => '0',
					'level' => $this->input->post('level', TRUE),
					'berakhir_pada' => $this->input->post('tgl_akhir', TRUE),
				);
				$this->admin->update('tbl_user', $data, ['id' => $id]);
				$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
				redirect('user/data_user');
			} else {
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('user/data_user');
			}	
		}
	}
	public function status()
	{
		$this->cek_login();
		$id = $this->uri->segment(3);
		$data = array(
			'status_aktif' => 1,
		);
		$this->admin->update('tbl_user', $data, array('id'=> $id));
		$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
	
		redirect('user/data_user');
	}
    public function hapus_user()
    {
        $this->cek_login();
        $id = $this->uri->segment(3);
        $get = $this->admin->get_where('tbl_user', array('id' => $id));
        foreach($get->result() As $key){
            $status = $key->status_aktif;
        }
        if( $status == 1 ){
            $this->admin->delete('tbl_user', array('id' => $id));
            $this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
			redirect('user/data_user');
        } else {
			$this->session->set_flashdata('danger', '<i class="icon fa fa-warning"></i>  Maaf.. User Masih Aktif <strong>Silahkan Blokir Terlebih Dahulu</strong>');
			redirect('user/data_user');
        }
	}
}
