<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	function __construct()
	{
	parent::__construct();
		$this->load->library(array('template', 'form_validation'));
		$this->load->model('admin');
	}

    function cek_login()
	{
		$id = $this->session->userdata('id');
		$admin = $this->admin->get_where('tbl_administrator',['id'=> $id]);
		foreach($admin->result() As $key){
			$isLogin = $key->isLogin;
		}
		if (!$this->session->userdata('login') || $this->session->userdata('isLogin') == $isLogin )
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
    public function edit_leasing()
    {
		$this->cek_login();
        $id = $this->input->post('id', TRUE);
        $id_cabang = $this->input->post('id_cabang', TRUE);
        $leasing = $this->input->post('leasing', TRUE);
        if ($this->input->post('submit', TRUE) == 'Submit')  {
            //Validasi
            $this->form_validation->set_rules('leasing', 'Leasing', 'required');
            $this->form_validation->set_rules('id_cabang', 'Cabang', 'required');
            if ($this->form_validation->run() == TRUE){
				$data = array(
					'leasing' => $leasing,
					'id_cabang' => $id_cabang
				);
				$this->admin->update('tbl_leasing', $data, array('id_leasing' => $id));
				$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
				redirect('data/data_leasing');
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
		$this->template->admin('admin/data/import');
	}
	public function importFile()
    {
		$this->cek_login();
		if ($this->input->post('submit')) {
					
			$path = 'assets/file/import/';
			require_once APPPATH . "/third_party/PHPExcel.php";
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls|csv';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);            
			if (!$this->upload->do_upload('uploadFile')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			if(empty($error)){
				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file = $data['upload_data']['file_name'];
				} else {
					$import_xls_file = 0;
				}

				$inputFileName = $path . $import_xls_file;
					
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
					$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$flag = true;
					$i=0;
					foreach ($allDataInSheet as $value) {
						if($flag) {
							$flag = false;
							continue;
						}
						
						$inserdata[$i]['`ID_LEASING`'] = $value['A'];
						$inserdata[$i]['`KONSUMEN`'] = $value['B'];
						$inserdata[$i]['`UNIT`'] = $value['C'];
						$inserdata[$i]['`NO_RANGKA`'] = $value['D'];
						$inserdata[$i]['`NO_MESIN`'] = $value['E'];
						$inserdata[$i]['`NO_POL`'] = $value['F'];
						$inserdata[$i]['`OD`'] = $value['G'];
						$inserdata[$i]['`WARNA`'] = $value['H'];
						$inserdata[$i]['`TAHUN`'] = $value['I'];
						$inserdata[$i]['`BULAN_UPDATE`'] = $value['J'];
						$inserdata[$i]['`CATATAN`'] = $value['K'];
						$inserdata[$i]['`SISA_HUTANG`'] = $value['L'];
						$i++;
					}               
					$result = $this->admin->importData($inserdata);
					// Hapus File Upload
					unlink($inputFileName);    
					if($result) {
						$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
						redirect('data/import');
					} else {
						$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Gagal Disimpan');
						redirect('data/import');
					}
				} catch (Exception $e) {
					die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' .$e->getMessage());
				}
			} else {
				$this->session->set_flashdata('warning', '<i class="icon fa fa-smile-o"></i>  Tidak Ada File Import...');
				redirect('data/import');
			}                            
		}
		$this->template->admin('admin/data/import');
    }   
}
