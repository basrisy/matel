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
        $data['data'] = $this->admin->get_where('tbl_user',array('status_aktif' => 0));
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/user/data_user', $data);
	}
	public function user_baru()
	{
		$this->cek_login();
        $data['data'] = $this->admin->get_where('tbl_user',array('status_aktif' => 1));
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/user/user_baru', $data);
	}
	public function user_blokir()
	{
		$this->cek_login();
        $data['data'] = $this->admin->get_where('tbl_user',array('status_aktif' => 2));
		$data['kota'] = $this->admin->get_all('tbl_kabupaten');
		$data['level'] = $this->admin->get_all('tbl_level');
		$this->template->admin('admin/user/user_blokir', $data);
	}

	public function set_terima()
	{
		$this->cek_login();
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$level_lama = $this->input->post('level_lama', TRUE);
		$level = $this->input->post('level', TRUE);
		$tgl_akhir = $this->input->post('tgl_akhir', TRUE);
		$get_level  = $this->admin->get_where('tbl_level', ['id' => $level]);
		$lev = $get_level->row();
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			$this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required');
			if ($this->form_validation->run() == TRUE){
				$data = array(
					'status_aktif' => '0',
					'level' => $level,
					'berakhir_pada' => $tgl_akhir,
				);
				$this->admin->update('tbl_user', $data, ['id' => $id]);
				if($this->db->affected_rows() > 0)
				{
					activity_log("Aktivasi User", $nama, $level_lama, $lev->tipe, $tgl_akhir);
					
					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
					redirect('user/user_baru');
				}
			} else {
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('user/user_baru');
			}	
		}
	}
	public function perbarui()
	{
		$this->cek_login();
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$level_lama = $this->input->post('level_lama', TRUE);
		$level = $this->input->post('level', TRUE);
		$tgl_akhir = $this->input->post('tgl_akhir', TRUE);
		$get_level  = $this->admin->get_where('tbl_level', ['id' => $level]);
		$lev = $get_level->row();
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			$this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required');
			if ($this->form_validation->run() == TRUE){
				$data = array(
					'level' => $level,
					'berakhir_pada' => $tgl_akhir,
				);
				$this->admin->update('tbl_user', $data, ['id' => $id]);
				if($this->db->affected_rows() > 0)
				{
					if($lev->tipe == $level_lama){
						activity_log("Update User", $nama, $level_lama, $lev->tipe, $tgl_akhir);
					} else {	
						activity_log("Update Tipe Akun", $nama, $level_lama, $lev->tipe, $tgl_akhir);
					}			
					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
					redirect('user/data_user');
				}
			} else {
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('user/data_user');
			}	
		}
	}
	public function aktivasi_blokir()
	{
		$this->cek_login();
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$level_lama = $this->input->post('level_lama', TRUE);
		$level = $this->input->post('level', TRUE);
		$tgl_akhir = $this->input->post('tgl_akhir', TRUE);
		$get_level  = $this->admin->get_where('tbl_level', ['id' => $level]);
		$lev = $get_level->row();
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			$this->form_validation->set_rules('tgl_akhir', 'Tanggal Berakhir', 'required');
			if ($this->form_validation->run() == TRUE){
				$data = array(
					'status_aktif' => '0',
					'level' => $level,
					'berakhir_pada' => $tgl_akhir,
				);
				$this->admin->update('tbl_user', $data, ['id' => $id]);
				if($this->db->affected_rows() > 0)
				{
					activity_log("Aktivasi Blokir", $nama, $level_lama, $lev->tipe, $tgl_akhir);				
					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
					redirect('user/user_baru');
				}
			} else {
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('user/user_baru');
			}	
		}
	}
	public function blokir()
	{
		$this->cek_login();
		$id = $this->uri->segment(3);		
        $get = $this->admin->get_where('tbl_user', array('id' => $id));
        foreach($get->result() As $key){
            $nama = $key->nama;
			$id_level = $key->level;
			$tgl_akhir = $key->berakhir_pada;
        }
		$get_level  = $this->admin->get_where('tbl_level', ['id' => $id_level]);
		$lev = $get_level->row();

		$data = array(
			'status_aktif' => 2,
		);
		$this->admin->update('tbl_user', $data, array('id'=> $id));
		if($this->db->affected_rows() > 0)
		{   
			activity_log("Blokir User", $nama, $lev->tipe, $lev->tipe, $tgl_akhir);
			$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  User Berhasil Diblokir');
			redirect('user/data_user');
		}
	}
    public function tolak_user()
    {
        $this->cek_login();
        $id = $this->uri->segment(3);
        $get = $this->admin->get_where('tbl_user', array('id' => $id));
        foreach($get->result() As $key){
            $status = $key->status_aktif;
            $nama = $key->nama;
            $id_level = $key->level;
			$tgl_akhir = $key->berakhir_pada;
        }
		$get_level  = $this->admin->get_where('tbl_level', ['id' => $id_level]);
		$lev = $get_level->row();
        if( $status == 1 ){
			$this->admin->delete('tbl_user', array('id' => $id));
			
			if($this->db->affected_rows() > 0)
			{   
				activity_log("Tolak User", $nama, $lev->tipe, $lev->tipe, $tgl_akhir);
				$this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
				redirect('user/user_baru');
			}
        } else {
			$this->session->set_flashdata('danger', '<i class="icon fa fa-warning"></i>  Maaf.. User Masih Aktif <strong>Silahkan Blokir Terlebih Dahulu</strong>');
			redirect('user/user_baru');
        }
	}
    public function hapus_user()
    {
        $this->cek_login();
        $id = $this->uri->segment(3);
        $get = $this->admin->get_where('tbl_user', array('id' => $id));
        foreach($get->result() As $key){
            $status = $key->status_aktif;
            $nama = $key->nama;
            $id_level = $key->level;
			$tgl_akhir = $key->berakhir_pada;
        }
		$get_level  = $this->admin->get_where('tbl_level', ['id' => $id_level]);
		$lev = $get_level->row();
        if( $status == 1 ){
			$this->admin->delete('tbl_user', array('id' => $id));
			
			if($this->db->affected_rows() > 0)
			{   
				activity_log("Hapus User", $nama, $lev->tipe, $lev->tipe, $tgl_akhir);
				$this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
				redirect('user/data_user');
			}
        } else {
			$this->session->set_flashdata('danger', '<i class="icon fa fa-warning"></i>  Maaf.. User Masih Aktif <strong>Silahkan Blokir Terlebih Dahulu</strong>');
			redirect('user/data_user');
        }
	}
}
