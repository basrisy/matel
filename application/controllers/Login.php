<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
      parent::__construct();
	}

	public function index()
    {
        if ($this->input->post('submit') == 'Submit')
        {         
            $user = $this->input->post('username', TRUE);
            $pass = $this->input->post('password', TRUE);
            
            $where = array(
                'username' => $user,
            );
            $cek = $this->admin->login($where);
            if ($cek->num_rows() > 0) {
                $data = $cek->row();
                foreach($cek->result() as $row){
                    $pwd = $row->password;
                }
                $logintime = time();
                if ($pwd == md5($pass))
                {
                    $datauser = array (
                    'id'     => $data->id,
                    'username'  => $data->username,
                    'nama'      => $data->nama,
                    'isLogin'   => $logintime,
                    'id_level'  => $data->id_level,
                    'level'     => $data->level,
                    'login'     => TRUE
                    );
                    $isLogin = array( 'isLogin' => $logintime);
                    $this->admin->update('tbl_administrator', $isLogin, $where);
                    $this->session->set_userdata($datauser);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('danger', '<i class="icon fa fa-warning"></i> Password yang anda masukkan salah..');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('warning', '<i class="icon fa fa-warning"></i> Username Ditolak..');
                redirect('login');
            }
        }

        if ($this->session->userdata('login') == TRUE)
        {
            
            redirect('home');
        }   
      $this->load->view('admin/login_form');
    }  
    function logout()
    {   
        $id = $this->session->userdata('id');
        $isLogin = array( 'isLogin' => '1');
        $this->admin->update('tbl_administrator', $isLogin, array ('id' => $id));
        $this->session->sess_destroy();
        redirect('login');
    }
}