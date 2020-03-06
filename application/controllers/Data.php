<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

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

	public function data_cabang()
	{
		$this->cek_login();
		$data['cabang'] = $this->admin->get_all('tbl_cabang');
		$this->template->admin('admin/data/data_cabang', $data);
	}
    public function tambah_cabang()
    {
		$this->cek_login();
        $cabang = $this->input->post('cabang', TRUE);
        if ($this->input->post('submit', TRUE) == 'Submit')  {
            $this->form_validation->set_rules('cabang', 'Cabang', 'required|min_length[2]');
            if ($this->form_validation->run() == TRUE){
                $cek = $this->admin->get_where('tbl_cabang', array('cabang' => $cabang));
                if ($cek->num_rows() <= 0) {
                    $data = array(
                        'cabang' => $cabang,
                    );
                    $this->admin->insert('tbl_cabang', $data);
                    $this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                    redirect('data/data_cabang');
                } else {
                    $this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Cabang Sudah Dipakai...');
                    redirect('data/data_cabang');
                }
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('data/data_cabang');
            }	
        }
	}	
    public function edit_cabang()
    {
		$this->cek_login();
        $id = $this->input->post('id', TRUE);
        $cabang = $this->input->post('cabang', TRUE);
        if ($this->input->post('submit', TRUE) == 'Submit')  {
            //Validasi
            $this->form_validation->set_rules('cabang', 'Cabang', 'required|min_length[2]');
            if ($this->form_validation->run() == TRUE){
                $cek = $this->admin->get_where('tbl_cabang', array('cabang' => $cabang));
                $cek1 = $this->admin->get_where('tbl_cabang', array('id_cabang' => $id,'cabang' => $cabang));
                if ($cek->num_rows() <= 0 && $cek1->num_rows() <= 1 ) {
                    $data = array(
                        'cabang' => $cabang,
                    );
                    $this->admin->update('tbl_cabang', $data, array('id_cabang' => $id));
                    $this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
                    redirect('data/data_cabang');
                } else {
                    $this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Cabang Sudah Dipakai...');
                    redirect('data/data_cabang');
                }
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('data/data_cabang');
            }	
        }
	}	
    public function hapus_cabang()
    {
		$this->cek_login();
        $id = $this->uri->segment(3);
        $cek = $this->admin->get_where('tbl_leasing', array('id_cabang' => $id));
        if ($cek->num_rows() <= 0) {
            $this->admin->delete('tbl_cabang', array('id_cabang' => $id));
            $this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
			redirect('data/data_cabang');
        } else {
            $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i> Maaf.. Cabang Sedang Digunakan');
			redirect('data/data_cabang');
        }
    }

	public function data_leasing()
	{
		$this->cek_login();
		$data['leasing'] = $this->admin->get_all('tbl_leasing');
		$data['cabang'] = $this->admin->get_all('tbl_cabang');
		$this->template->admin('admin/data/data_leasing', $data);
	}
    public function tambah_leasing()
    {
		$this->cek_login();
        $id_cabang = $this->input->post('id_cabang', TRUE);
        $leasing = $this->input->post('leasing', TRUE);
        if ($this->input->post('submit', TRUE) == 'Submit')  {
            $this->form_validation->set_rules('leasing', 'Leasing', 'required');
            $this->form_validation->set_rules('id_cabang', 'Cabang', 'required');
            if ($this->form_validation->run() == TRUE){
				$cek1 = $this->admin->get_where('tbl_leasing', array('id_cabang' => $id_cabang, 'leasing' => $leasing));
                if ($cek1->num_rows() <= 0 ) {
					$data = array(
						'leasing' => $leasing,
						'id_cabang' => $id_cabang
					);
					$this->admin->insert('tbl_leasing', $data);
					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
					redirect('data/data_leasing');
				} else {
					$this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Leasing Sudah Dipakai...');
					redirect('data/data_leasing');
				}
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('data/data_leasing');
            }	
        }
	}	
    public function edit_leasing()
    {
		$this->cek_login();
        $id = $this->input->post('id', TRUE);
        $id_cabang = $this->input->post('id_cabang', TRUE);
        $leasing = $this->input->post('leasing', TRUE);
        if ($this->input->post('submit', TRUE) == 'Submit')  {
            $this->form_validation->set_rules('leasing', 'Leasing', 'required');
            $this->form_validation->set_rules('id_cabang', 'Cabang', 'required');
            if ($this->form_validation->run() == TRUE){
				$cek1 = $this->admin->get_where('tbl_leasing', array('id_cabang' => $id_cabang, 'leasing' => $leasing));
                if ($cek1->num_rows() <= 0 ) {
					$data = array(
						'leasing' => $leasing,
						'id_cabang' => $id_cabang
					);
					$this->admin->update('tbl_leasing', $data, array('id_leasing' => $id));
					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
					redirect('data/data_leasing');
				} else {
					$this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Leasing Sudah Dipakai...');
					redirect('data/data_leasing');
				}
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
				redirect('data/data_leasing');
            }	
        }
	}		
    public function hapus_leasing()
    {
		$this->cek_login();
        $id = $this->uri->segment(3);
        $cek = $this->admin->get_where('tbl_kendaraan', array('id_leasing' => $id));
        if ($cek->num_rows() <= 0) {
            $this->admin->delete('tbl_leasing', array('id_cabang' => $id));
            $this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
			redirect('data/data_leasing');
        } else {
            $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i> Maaf.. Cabang Sedang Digunakan');
			redirect('data/data_leasing');
        }
    }

	public function data_kendaraan()
	{
		$this->cek_login();
		$data['kendaraan'] = $this->admin->data_kendaraan();
		$data['leasing'] = $this->admin->get_all('tbl_leasing');
		$data['cabang'] = $this->admin->get_all('tbl_cabang');
		$this->template->admin('admin/data/data_kendaraan', $data);
	}
	public function hapus_kendaraan()
    {
		$this->cek_login();
        $id = $this->input->post('id',TRUE);
		$pass = $this->input->post('password_admin',TRUE);
		if ($this->input->post('submit', TRUE) == 'Submit')
        {
            $this->form_validation->set_rules('password_admin', 'Password Admin', "required");

            if ($this->form_validation->run() == TRUE)
            {
                $get_data = $this->admin->get_where('tbl_administrator',['id_level' => 1])->row();

                if (md5($pass) == $get_data->password)
                {
					$this->admin->delete('tbl_kendaraan', array('id' => $id));
					$this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
                    redirect('data/data_kendaraan');
                } else {
                    $this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  <strong>Maaf..</strong> Password yang anda masukan salah');
                    redirect('data/data_kendaraan');
                }
            } else {
                $this->session->set_flashdata('danger', '<i class="icon fa fa-warning"></i> Masukkan Password <strong>admin</strong> untuk menghapus data.');
                redirect('data/data_kendaraan');
            }
        }
		
	}
	public function import()
    {
		$this->cek_login();

		if ($this->input->post('submit', TRUE) == 'Submit'){			
			$this->form_validation->set_rules('preview', 'File Import', 'required');
			// $this->form_validation->set_rules('id_cabang', 'Cabang', 'required');
			// $this->form_validation->set_rules('id_leasing', 'Leasing', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				// $this->session->set_userdata('id_cabang', $this->input->post('id_cabang', TRUE));
				// $this->session->set_userdata('id_leasing', $this->input->post('id_leasing', TRUE));
				
				// $cabang  = $this->admin->get_where('tbl_cabang', array('id_cabang' => $this->input->post('id_cabang', TRUE)))->row();
				// $leasing  = $this->admin->get_where('tbl_leasing', array('id_leasing' => $this->input->post('id_leasing', TRUE)))->row();
				// $this->session->set_userdata(array('cabang' => $cabang->cabang));
				// $this->session->set_userdata(array('leasing' => $leasing->leasing));
				redirect('data/import');
			}
		}
		$data['leasing'] = $this->admin->get_all('tbl_leasing');
		$data['cabang'] = $this->admin->get_all('tbl_cabang');
		$this->template->admin('admin/data/import', $data);
	}
	public function import_file()
    {
		$this->cek_login();
		if ($this->input->post('submit', TRUE) == 'Submit'){			
			$this->form_validation->set_rules('id_cabang', 'Cabang', 'required');
			$this->form_validation->set_rules('id_leasing', 'Leasing', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				$this->session->set_userdata('id_cabang', $this->input->post('id_cabang', TRUE));
				$this->session->set_userdata('id_leasing', $this->input->post('id_leasing', TRUE));
				
				$cabang  = $this->admin->get_where('tbl_cabang', array('id_cabang' => $this->input->post('id_cabang', TRUE)))->row();
				$leasing  = $this->admin->get_where('tbl_leasing', array('id_leasing' => $this->input->post('id_leasing', TRUE)))->row();
				$this->session->set_userdata(array('cabang' => $cabang->cabang));
				$this->session->set_userdata(array('leasing' => $leasing->leasing));
				redirect('data/import');
			}
		}
		$data['leasing'] = $this->admin->get_all('tbl_leasing');
		$data['cabang'] = $this->admin->get_all('tbl_cabang');
		$this->template->admin('admin/data/form_import', $data);
	}
	public function preview()
    {
		$this->cek_login();
		if ($this->input->post('preview', TRUE) == 'Preview') {
					
			$path = 'assets/file/import/';
			require_once APPPATH . "/third_party/PHPExcel.php";
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = time();

			$this->load->library('upload', $config);
			$this->upload->initialize($config);            
			if (!$this->upload->do_upload('uploadFile')) {
				$error = array('error' => $this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i> Silahkan Upload File Terlebih Dahulu...'));				
				redirect('data/import');
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			if(empty($error)){
				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file = $data['upload_data']['file_name'];
					$this->session->set_userdata('file_name', $import_xls_file);
				} else {
					$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;

				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			}
		}		
		$data['kendaraan'] = $this->admin->data_kendaraan1();
		$data['allDataInSheet'] = $allDataInSheet;
		$this->template->admin('admin/data/preview', $data);
	}
	public function importFile()
    {
		$this->cek_login();
							
		$path = 'assets/file/import/';
		require_once APPPATH . "/third_party/PHPExcel.php";

		$file = $this->session->userdata('file_name');
		$inputFileName = $path.$file;
			
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);			
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
			. '": ' .$e->getMessage());
		}          
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			$flag = true;
			$i=0;
			foreach ($allDataInSheet as $value) {
				if($flag) {
					$flag = false;
					continue;
				}
				// $inserdata[$i]['`ID_LEASING`'] = $this->session->userdata('id_leasing');;
				$inserdata[$i]['`KONSUMEN`'] = $value['A'];
				$inserdata[$i]['`UNIT`'] = $value['B'];
				$inserdata[$i]['`NO_RANGKA`'] = $value['C'];
				$inserdata[$i]['`NO_MESIN`'] = $value['D'];
				$inserdata[$i]['`NO_POL`'] = $value['E'];
				$inserdata[$i]['`OD`'] = $value['F'];
				$inserdata[$i]['`WARNA`'] = $value['G'];
				$inserdata[$i]['`TAHUN`'] = $value['H'];
				$inserdata[$i]['`BULAN_UPDATE`'] = $value['I'];
				$inserdata[$i]['`CATATAN`'] = $value['J'];
				$inserdata[$i]['`SISA_HUTANG`'] = $value['K'];
				$inserdata[$i]['`LEASING`'] = $value['L'];
				$inserdata[$i]['`CABANG`'] = $value['M'];
				$inserdata[$i]['`USER_SYNCHRONE`'] = " ";
				$i++;
			}
										
			if (empty($i)){
				unlink($inputFileName);  
				$this->session->unset_userdata('file_name');
				$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Kosong...');
			} else {
				$this->admin->importData($inserdata);
								
				unlink($inputFileName);   
				// $this->session->unset_userdata('id_cabang'); 
				// $this->session->unset_userdata('id_leasing');
				// $this->session->unset_userdata('cabang');
				// $this->session->unset_userdata('leasing');
				$this->session->unset_userdata('file_name');
				$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
			}
			redirect('data/import');
		$this->template->admin('admin/data/import');
	}
	function batal()
	{   
		$path = 'assets/file/import/';
		require_once APPPATH . "/third_party/PHPExcel.php";

		$file = $this->session->userdata('file_name');
		$inputFileName = $path.$file;
		
		unlink($inputFileName);   
		// $this->session->unset_userdata('id_cabang'); 
		// $this->session->unset_userdata('id_leasing');
		// $this->session->unset_userdata('cabang');
		// $this->session->unset_userdata('leasing');
		// $this->session->unset_userdata('file_name');
		redirect('data/import');
	}
		
	function get_leasing()
	{
        $id_cabang = $this->input->post('id_cabang',TRUE);
        $data = $this->admin->get_where('tbl_leasing', array('id_cabang' => $id_cabang))->result();
        echo json_encode($data);
	}
}
