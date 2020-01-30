<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function cek_login()
	{
		$id = $this->session->userdata('id');
		$admin = $this->admin->get_where('tbl_administrator',['id'=> $id]);
		foreach($admin->result() As $key){
			$isLogin = $key->isLogin;
		}
		if ($this->session->userdata('isLogin') != $isLogin)
		{
			$this->session->sess_destroy();
			redirect('login');
		}
    }

	public function tentang_kami()
	{
		$this->cek_login();
		$id = $this->input->post('id');
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			$this->form_validation->set_rules('id', 'ID', 'required');
			$this->form_validation->set_rules('tentang_kami', 'Tentang Kami', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'konten'  => $this->input->post('tentang_kami', TRUE)
				);
                $this->admin->update('tbl_tentangkami', $data, array('id' => $id));

                $this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                redirect('utility/tentang_kami');
			} else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('utility/tentang_kami');
            }
        }
		$data['tentang_kami'] = $this->admin->get_all('tbl_tentangkami');
		$this->template->admin('admin/utility/tentang_kami', $data);
    }
	public function cara_daftar()
	{
		$this->cek_login();
		$id = $this->input->post('id');
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			$this->form_validation->set_rules('id', 'ID', 'required');
			$this->form_validation->set_rules('cara_daftar', 'Cara Daftar', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'konten'  => $this->input->post('cara_daftar', TRUE)
				);
                $this->admin->update('tbl_caradaftar', $data, array('id' => $id));

                $this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                redirect('utility/cara_daftar');
			} else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('utility/cara_daftar');
            }
        }
		$data['cara_daftar'] = $this->admin->get_all('tbl_caradaftar');
		$this->template->admin('admin/utility/cara_daftar', $data);
    }
	public function kontak()
	{
		$this->cek_login();
		$data['data'] = $this->admin->get_all('tbl_kontak');
		$this->template->admin('admin/utility/kontak', $data);
	}

	public function set_kontak()
	{
		$this->cek_login();
		$id = $this->input->post('id');
		$direct = $this->input->post('direct', TRUE);
		$cekwa = substr($direct, 0,2);
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			$this->form_validation->set_rules('id', 'ID', 'required');
			$this->form_validation->set_rules('direct', 'Direct', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				if ($id == "1"){
					if($cekwa == "62") {
						$data = array(
							'direct'  => $direct,
							'pesan'  => $this->input->post('pesan', TRUE)
						);
						$this->admin->update('tbl_kontak', $data, array('id' => $id));
	
						$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
						redirect('utility/kontak');
					} else {
						$this->session->set_flashdata('warning', '<i class="icon fa fa-frown-o"></i>  Nomor WhatsApp harus menggunakan <b>62</b>');
						redirect('utility/kontak');
					}
				} else {
					
					$data = array(
						'direct'  => $direct,
						'pesan'  => $this->input->post('pesan', TRUE)
					);
					$this->admin->update('tbl_kontak', $data, array('id' => $id));

					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
					redirect('utility/kontak');
				}
			} else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('utility/kontak');
            }
        }
    }
}
