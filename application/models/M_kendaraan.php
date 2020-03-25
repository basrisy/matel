<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kendaraan extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    private $_table = "tbl_kendaraan";
    private $_tableTemp = "tbl_kendaraan_temp";

    public $id;

    public function rules()
    {
        return [
            ['field' => 'leasing',
            'label' => 'Leasing',
            'rules' => 'required'],

            ['field' => 'unit',
            'label' => 'Unit',
            'rules' => 'required'],
            
            ['field' => 'no_pol',
            'label' => 'No. Polisi',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    public function getAll_temp()
    {
        return $this->db->get($this->_tableTemp)->result();
    }

    function data_kendaraan()
    {
		$this->db->from('tbl_kendaraan');

		return $this->db->get()->result();
    }
    function data_leasing()
    {
		$this->db->select('LEASING');
		$this->db->from('tbl_kendaraan');
		$this->db->group_by('LEASING');
		return $this->db->get()->result();
	}
    function data_cabang()
    {
		$this->db->select('CABANG');
		$this->db->from('tbl_kendaraan');
		$this->db->group_by('CABANG');
		return $this->db->get()->result();
	}

    function data_kendaraan_temp()
	{
        $this->db->from('tbl_kendaraan_temp as a');
        $this->db->where('NOT EXISTS (SELECT * FROM tbl_kendaraan AS b  WHERE b.NO_POL = a.NO_POL AND b.LEASING = a.LEASING)', '', FALSE);
        return $this->db->get()->result();
    }

    function data_kendaraan_sama()
	{
        $this->db->from('tbl_kendaraan_temp as a');
        $this->db->where('EXISTS (SELECT * FROM tbl_kendaraan AS b  WHERE b.NO_POL = a.NO_POL AND b.LEASING = a.LEASING AND DATE_FORMAT(b.UPDATE_AT, "%Y-%m") = DATE_FORMAT(a.UPDATE_AT, "%Y-%m"))', '', FALSE);
        return $this->db->get()->result();
    }
    
    function count_kendaraan_sama()
	{
        $this->db->from('tbl_kendaraan_temp as a');
        $this->db->where('EXISTS (SELECT * FROM tbl_kendaraan AS b  WHERE b.NO_POL = a.NO_POL AND b.LEASING = a.LEASING AND DATE_FORMAT(b.UPDATE_AT, "%Y-%m") = DATE_FORMAT(a.UPDATE_AT, "%Y-%m"))', '', FALSE);
        return $this->db->count_all_results();
	}
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }
    
	public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }    

	function insert_file($data = '')
	{
		$this->db->insert($this->_table, $data);
	}
    
    public function importData($data)
	{
        $qwery = $this->db->insert_batch($this->_tableTemp,$data);
        if ($qwery){
            return TRUE;
        } else {
            return FALSE;
        }
	}
    function truncate_table_temp()
    {
        $this->db->from('tbl_kendaraan_temp');
        $this->db->truncate();
    }
    
    function multi_insert($table = '', $data = array())
    {
        $jumlah = count($data);
        if ($jumlah > 0)
        {
            $this->db->insert_batch($table, $data);
        }
    }
    public function saveReplace($data)
    {
        $query = $this->db->query("SELECT * FROM tbl_kendaraan_temp WHERE NO_POL = '{$data['NO_POL']}' AND NO_MESIN = '{$data['NO_MESIN']}' AND NO_RANGKA = '{$data['NO_RANGKA']}' ");
        $result = $query->result_array();
        $count = count($result);

        if (empty($count)) {
            $this->db->insert('tbl_kendaraan', $data); 
        }
        elseif ($count == 1) {
            $this->db->where('NO_POL', $data['NO_POL']);
            $this->db->where('NO_MESIN', $data['NO_MESIN']);
            $this->db->where('NO_RANGKA', $data['NO_RANGKA']);
            $this->db->update('tbl_kendaraan', $data); 
        }
    }

    // SERVER-SIDE
    var $table = 'tbl_kendaraan'; //nama tabel dari database
    var $column_order = array(null, 'ID', 'LEASING', 'CABANG', 'KONSUMEN', 'UNIT', 'NO_RANGKA', 'NO_MESIN', 'NO_POL', 'OD', 'WARNA', 'TAHUN', 'BULAN_UPDATE', 'CATATAN', 'INPUT_DATA', 'SISA_HUTANG'); //field yang ada di table user
    var $column_search = array('LEASING', 'CABANG', 'KONSUMEN', 'UNIT', 'NO_RANGKA', 'NO_MESIN', 'NO_POL', 'OD', 'WARNA', 'TAHUN', 'BULAN_UPDATE', 'CATATAN', 'INPUT_DATA', 'SISA_HUTANG'); //field yang diizin untuk pencarian 
    var $order = array('ID' => 'asc'); // default order 
    
    private function _get_datatables_query()
    {   
        $request = $this->input->post('request');
            
        
            if($this->input->post('update_at'))
            {
                $this->db->where('BULAN_UPDATE', $this->input->post('update_at'));
            }
            if($this->input->post('leasing'))
            {
                $this->db->where('LEASING', $this->input->post('leasing'));
            }
            if($this->input->post('cabang'))
            {
                $this->db->like('CABANG', $this->input->post('cabang'));
            }
        if($request == 1){
            $this->db->from($this->table); 
            $i = 0;     
            foreach ($this->column_search as $item) // looping awal
            {
                if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
                {                 
                    if($i===0) // looping awal
                    {
                        $this->db->group_start(); 
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    } 
                    if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
                }
                $i++;
            }         
            if(isset($_POST['order'])) 
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
        if($request == 2){
            $update_at = $this->input->post('update_at');
            $leasing = $this->input->post('leasing');
            $cabang = $this->input->post('cabang');
            
            if($update_at && $leasing && $cabang){
                $this->db->delete($this->table, array('BULAN_UPDATE' => $update_at, 'LEASING' => $leasing, 'CABANG' => $cabang));
            } else if($update_at && $leasing){
                $this->db->delete($this->table, array('BULAN_UPDATE' => $update_at, 'LEASING' => $leasing));
            } else if($update_at && $cabang){
                $this->db->delete($this->table, array('BULAN_UPDATE' => $update_at, 'CABANG' => $cabang));
            } else if($leasing && $cabang){
                $this->db->delete($this->table, array('LEASING' => $leasing, 'CABANG' => $cabang));
            } else {
                # code...
                if ($update_at){
                    $this->db->delete($this->table,array('BULAN_UPDATE' => $update_at));
                }
                if ($leasing){
                    $this->db->delete($this->table,array('LEASING' => $leasing));
                }
                if ($cabang){
                    $this->db->delete($this->table,array('CABANG' => $cabang));
                }
            }         
            echo 1;
            exit;
        }
        if($request == 3){
            
            $deleteids_arr = $_POST['deleteids_arr'];
            
            foreach($deleteids_arr  as $deleteid){
               $this->db->delete($this->table,array('ID' => $deleteid) );
            }
         
            echo 1;
            exit;
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_list_leasing()
    {
        $this->db->select('LEASING');
        $this->db->from($this->table);
        $this->db->order_by('LEASING','asc');
        $this->db->group_by('LEASING');
        $query = $this->db->get();
        $result = $query->result();
 
        $leasing = array();
        foreach ($result as $row) 
        {
            $leasing[] = $row->LEASING;
        }
        return $leasing;
    }

    public function get_list_cabang()
    {
        $this->db->select('CABANG');
        $this->db->from($this->table);
        $this->db->order_by('CABANG','asc');
        $this->db->group_by('CABANG');
        $query = $this->db->get();
        $result = $query->result();
 
        $cabang = array();
        foreach ($result as $row) 
        {
            $cabang[] = $row->CABANG;
        }
        return $cabang;
    }

    public function get_tgl_update()
    {
        $this->db->select('BULAN_UPDATE');
        $this->db->from($this->table);
        $this->db->order_by('BULAN_UPDATE','asc');
        $this->db->group_by('BULAN_UPDATE');
        $query = $this->db->get();
        $result = $query->result();
 
        $update_at = array();
        foreach ($result as $row) 
        {
            $update_at[] = $row->BULAN_UPDATE;
        }
        return $update_at;
    }
}