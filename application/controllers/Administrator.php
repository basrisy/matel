<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

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
        
        if ($this->agent->is_browser()){
			$data['agent'] = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_mobile()){
			$data['agent'] = $this->agent->mobile();
		}else{
			$data['agent'] = 'Data user gagal di dapatkan';
        }
        
        $data['data'] = $this->admin->admin();
        $data['level'] = $this->admin->get_all('tbl_leveladmin');
        $this->template->admin('admin/admin/administrator', $data);
    }
    
    public function tambah_akun()
    {
		$this->cek_login();
        $username = $this->input->post('username', TRUE);
        if ($this->input->post('submit', TRUE) == 'Submit') 
        {
            $this->form_validation->set_rules('username', 'Username', "required|min_length[2]|regex_match[/^[a-zA-Z0-9]+$/]");
            $this->form_validation->set_rules('nama', 'Nama', "required");
            $this->form_validation->set_rules('password', 'Password', "required|min_length[5]");
            $this->form_validation->set_rules('level', 'Level', "required|numeric");
            
            if ($this->form_validation->run() == TRUE)
            {
                $cek = $this->admin->get_where('tbl_administrator', array('username' => $username));
                if ($cek->num_rows() <= 0) {
                    $password = $this->input->post('password', TRUE);
                    $data = array(
                        'username'  => $username,
                        'nama'      => $this->input->post('nama', TRUE),
                        'id_level'  => $this->input->post('level', TRUE),
                        'password'  => md5($password)
                    );
                    $this->admin->insert('tbl_administrator', $data);
                    $this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                    redirect('administrator');
                } else {
                    $this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Username Sudah Dipakai...');
                    redirect('administrator');
                }
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
                redirect('administrator');
            }	
        } 
    }    
    public function edit_akun()
    {
		$this->cek_login();
        $id_level = $this->session->userdata('id_level');
        $id = $this->input->post('id',TRUE);
        $pass_lama = $this->input->post('pass_lama',TRUE);
        $pass_baru = $this->input->post('pass_baru',TRUE);
        $pass = $this->input->post('password_admin',TRUE);

        if ($this->input->post('submit', TRUE) == 'Submit')
        {
            $this->form_validation->set_rules('nama', 'Nama', "required");
            $this->form_validation->set_rules('password_admin', 'Password Admin', "required");

            if ($this->form_validation->run() == TRUE)
            {
                $get_data = $this->admin->get_where('tbl_administrator',['id_level' => $id_level])->row();
                $get_data2 = $this->admin->get_where('tbl_administrator',['id' => $id])->row();

                if (md5($pass) == $get_data->password || md5($pass_lama) == $get_data2->password)
                {
                    $data = array(
                        'nama'      => $this->input->post('nama', TRUE),
                        'id_level'  => $this->input->post('level', TRUE),
                        'password'  => md5($pass_baru),
                        'isLogin'   => 1,
                    );
                    $this->admin->update('tbl_administrator', $data, array('id' => $id));
                    $this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                    redirect('administrator');
                } else {
                    echo '<script type="text/javascript">alert("Password yang anda masukkan salah");window.location.replace("'.base_url().'administrator")</script>';
                }
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
                redirect('administrator');
            }
        }
    }
    public function del_akun()
    {
        $this->cek_login();
        $id = $this->uri->segment(3);
        $admin = $this->admin->get_where('tbl_administrator', array('id' => $id));
        foreach($admin->result() As $key){
            $isLogin = $key->isLogin;
        }
        if( $isLogin == 1 ){
            $this->admin->delete('tbl_administrator', array('id' => $id));
            $this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
            redirect('administrator');
        } else {
			$this->session->set_flashdata('danger', '<i class="icon fa fa-warning"></i>  Maaf.. Akun sedang Login');
            redirect('administrator');
        }
    }

    public function level()
    {
		$this->cek_login();
        $level = $this->input->post('level', TRUE);
		if ($this->input->post('submit', TRUE) == 'Submit')  {
			//Validasi
			$this->form_validation->set_rules('level', 'Level', 'required|min_length[2]');
			if ($this->form_validation->run() == TRUE){
				$cek = $this->admin->get_where('tbl_leveladmin', array('nama' => $level));
				if ($cek->num_rows() <= 0) {
					$satuan = array(
						'nama' => $this->input->post('level', TRUE),
					);
					$this->admin->insert('tbl_leveladmin', $satuan);
					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                    redirect('administrator/level');
				} else {
                    $this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Level Sudah Dipakai...');
                    redirect('administrator/level');
                }
			} else {
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
                redirect('administrator/level');
			}	
		}
        $data['data'] = $this->admin->get_all('tbl_leveladmin');
        $this->template->admin('admin/admin/level_administrator', $data);
    }
    public function edit_level()
    {
		$this->cek_login();
        $id = $this->input->post('id', TRUE);
        $level = $this->input->post('level', TRUE);
        if ($this->input->post('submit', TRUE) == 'Submit')  {
            //Validasi
            $this->form_validation->set_rules('level', 'Level', 'required|min_length[2]');
            if ($this->form_validation->run() == TRUE){
                $cek = $this->admin->get_where('tbl_leveladmin', array('nama' => $level));
                $cek1 = $this->admin->get_where('tbl_leveladmin', array('id' => $id,'nama' => $level));
                if ($cek->num_rows() <= 0 && $cek1->num_rows() <= 1 ) {
                    $data = array(
                        'nama'		=> $level,
                    );
                    $this->admin->update('tbl_leveladmin', $data, array('id' => $id));
                    $this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                    redirect('administrator/level');
                } else {
                    $this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Level Sudah Dipakai...');
                    redirect('administrator/level');
                }
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
                redirect('administrator/level');
            }	
        }
    }
    public function del_level()
    {
		$this->cek_login();
        $id = $this->uri->segment(3);
        $cek = $this->admin->get_where('tbl_administrator', array('id_level' => $id));
        if ($cek->num_rows() <= 0) {
            $this->admin->delete(['tbl_leveladmin'], ['id' => $id]);
            $this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
            redirect('administrator/level');
        } else {
            $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i> Maaf.. Level Sedang Digunakan');
            redirect('administrator/level');
        }
    }
}