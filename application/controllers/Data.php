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
	public function kendaraan()
	{
		$this->cek_login();
		$data['admin'] = $this->session->userdata('id_level');
		$data['leasing'] = $this->m_kendaraan->data_leasing();
		$data['cabang'] = $this->m_kendaraan->data_cabang();
		$this->template->admin('admin/data/data_kendaraan', $data);
	}
	public function hapus_kendaraan($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->m_kendaraan->delete($id)) {
			$this->session->set_flashdata('success', '<i class="icon fa fa-frown-o"></i>  Data Berhasil Dihapus');
            redirect(site_url('data/kendaraan'));
        }
    }
	public function import()
    {
		$this->cek_login();
		$data['file'] = $this->m_kendaraan->getAll_temp();
		$this->template->admin('admin/data/import', $data);
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
				} else {
					$import_xls_file = 0;
				}
				$inputFileName = $path.$import_xls_file;
			
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
					if($value['A']=="" && $value['B']=="" && $value['C']=="" && $value['D']=="" && $value['E']=="" && $value['F']=="" && $value['G']=="" && $value['H']=="" && $value['I']=="" && $value['J']=="" && $value['K']=="" && $value['L']=="" && $value['M']=="")
					continue;
					
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
					$this->session->set_flashdata('danger', '<i class="icon fa fa-frown-o"></i>  Data Kosong...');
					redirect('data/import');
				} else {
					$this->m_kendaraan->importData($inserdata);
									
					unlink($inputFileName);
					$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
					redirect('data/preview2');
				}
			}
		}
	}
	public function preview2()
    {
		$this->cek_login();
		$data_temp = $this->m_kendaraan->getAll_temp();
		$data['ttl_sama'] = $this->m_kendaraan->count_kendaraan_sama();		
		$kosong = 0;
		foreach ($data_temp as $key) {
			$unit = ($key->UNIT)? "" : " style='background: #EABBB0;'";
			$no_pol = ($key->NO_POL)? "" : " style='background: #EABBB0;'";
			$leasing = ($key->LEASING)? "" : " style='background: #EABBB0;'";
			if($unit || $no_pol || $leasing){
				$kosong++;
			}
		}
		$data['kosong'] = $kosong;
		$this->template->admin('admin/data/preview', $data);
	}
	public function importFile()
    {
		$this->cek_login();
		$file = $this->m_kendaraan->data_kendaraan_temp();
		foreach($file as $key)
		{
			$data = array(
				'KONSUMEN' => $key->KONSUMEN,
				'UNIT' => $key->UNIT,
				'NO_RANGKA' => $key->NO_RANGKA,
				'NO_MESIN' => $key->NO_MESIN,
				'NO_POL' => $key->NO_POL,
				'OD' => $key->OD,
				'WARNA' => $key->WARNA,
				'TAHUN' => $key->TAHUN,
				'BULAN_UPDATE' => $key->BULAN_UPDATE,
				'CATATAN' => $key->CATATAN,
				'SISA_HUTANG' => $key->SISA_HUTANG,
				'LEASING' => $key->LEASING,
				'CABANG' => $key->CABANG,
				'USER_SYNCHRONE' => " ",
			);
			$this->m_kendaraan->insert_file($data);
		}
		$this->m_kendaraan->truncate_table_temp();
		$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
		redirect('data/import');
	}
	public function importFileUpdate()
    {
		$this->cek_login();		
		$file = $this->m_kendaraan->data_kendaraan_temp();
		foreach($file as $key)
		{
			$data = array(
				'KONSUMEN' => $key->KONSUMEN,
				'UNIT' => $key->UNIT,
				'NO_RANGKA' => $key->NO_RANGKA,
				'NO_MESIN' => $key->NO_MESIN,
				'NO_POL' => $key->NO_POL,
				'OD' => $key->OD,
				'WARNA' => $key->WARNA,
				'TAHUN' => $key->TAHUN,
				'BULAN_UPDATE' => $key->BULAN_UPDATE,
				'CATATAN' => $key->CATATAN,
				'SISA_HUTANG' => $key->SISA_HUTANG,
				'LEASING' => $key->LEASING,
				'CABANG' => $key->CABANG,
				'USER_SYNCHRONE' => " ",
			);
			$this->m_kendaraan->insert_file($data);
		}
		$file = $this->m_kendaraan->getAll_temp;
		foreach($file as $key)
		{
			$data = array(
				'KONSUMEN' => $key->KONSUMEN,
				'UNIT' => $key->UNIT,
				'NO_RANGKA' => $key->NO_RANGKA,
				'NO_MESIN' => $key->NO_MESIN,
				'NO_POL' => $key->NO_POL,
				'OD' => $key->OD,
				'WARNA' => $key->WARNA,
				'TAHUN' => $key->TAHUN,
				'BULAN_UPDATE' => $key->BULAN_UPDATE,
				'CATATAN' => $key->CATATAN,
				'SISA_HUTANG' => $key->SISA_HUTANG,
				'LEASING' => $key->LEASING,
				'CABANG' => $key->CABANG,
				'USER_SYNCHRONE' => " ",
			);
			$this->m_kendaraan->saveReplace($data);
		}
		$this->m_kendaraan->truncate_table_temp();
		$this->session->set_flashdata('success', '<i class="icon fa fa-smile-o"></i>  Data Berhasil Disimpan');
		redirect('data/import');
	}
	function batal()
	{   
		$this->m_kendaraan->truncate_table_temp();
		redirect('data/import');
	}
    function get_data_kendaraan()
    {
        $list = $this->m_kendaraan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            // $row[] = $no;
            $row[] = $field->LEASING;
            $row[] = $field->CABANG;
            $row[] = $field->KONSUMEN;
            $row[] = $field->NO_POL;
            $row[] = $field->UNIT;
			$row[] = $field->WARNA;
            $row[] = $field->SISA_HUTANG;
            $row[] = $field->OD;
            $row[] = $field->NO_RANGKA;
            $row[] = $field->NO_MESIN;
            $row[] = $field->INPUT_DATA;
            $row[] = $field->CATATAN;			
            $row[] = '<a href="hapus_kendaraan/'.$field->ID.'" class="btn btn-sm btn-danger" title="Hapus"><i class="fa fa-trash"></i> Hapus Data Ini</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_kendaraan->count_all(),
            "recordsFiltered" => $this->m_kendaraan->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}
	
    function preview_import()
    {
        $list = $this->m_temp->get_datatables();
        $data = array();
		$no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();
			$row[] = $no;
            $row[] = $field->KONSUMEN;
            $row[] = $field->UNIT;
            $row[] = $field->NO_RANGKA;
            $row[] = $field->NO_MESIN;
            $row[] = $field->NO_POL;
            $row[] = $field->LEASING;
            $row[] = $field->CABANG;
			$row[] = $field->WARNA;
			$row[] = $field->WARNA;
			$row[] = $field->BULAN_UPDATE;
            $row[] = $field->OD;
            $row[] = $field->SISA_HUTANG;
            $row[] = $field->CATATAN;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_temp->count_all(),
            "recordsFiltered" => $this->m_temp->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}
}
