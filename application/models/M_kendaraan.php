<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kendaraan extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    private $_table = "tbl_kendaraan";

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

    function data_kendaraan()
    {
		$this->db->from('tbl_kendaraan');

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
        $this->db->where('EXISTS (SELECT * FROM tbl_kendaraan AS b  WHERE b.NO_POL = a.NO_POL AND b.LEASING = a.LEASING)', '', FALSE);
        return $this->db->get()->result();
    }
    
    function count_kendaraan_sama()
	{
        $this->db->from('tbl_kendaraan_temp as a');
        $this->db->where('EXISTS (SELECT * FROM tbl_kendaraan AS b  WHERE b.NO_POL = a.NO_POL AND b.LEASING = a.LEASING)', '', FALSE);
        return $this->db->count_all_results();
	}
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }
        
	public function importData($data)
	{
        $qwery = $this->db->insert_batch($this->_table, $data);
        if ($qwery) {
            return TRUE;
        } else {
            return FALSE;
        }
    
    }
    function truncate_table()
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
    function get_all() { 
        $this->datatables->select('ID, LEASING, CABANG, KONSUMEN, UNIT, NO_RANGKA, NO_MESIN, NO_POL, OD, WARNA, TAHUN, BULAN_UPDATE, CATATAN, INPUT_DATA, SISA_HUTANG');
        $this->datatables->from('tbl_kendaraan');
        $this->datatables->add_column('view', '<a href="world/edit/$1">edit</a> | <a href="world/delete/$1">delete</a>', 'ID');
        return $this->datatables->generate();
    }

    // SERVER-SIDE
    var $table = 'tbl_kendaraan'; //nama tabel dari database
    var $column_order = array(null, 'ID', 'LEASING', 'CABANG', 'KONSUMEN', 'UNIT', 'NO_RANGKA', 'NO_MESIN', 'NO_POL', 'OD', 'WARNA', 'TAHUN', 'BULAN_UPDATE', 'CATATAN', 'INPUT_DATA', 'SISA_HUTANG'); //field yang ada di table user
    var $column_search = array('LEASING', 'CABANG', 'KONSUMEN', 'UNIT', 'NO_RANGKA', 'NO_MESIN', 'NO_POL', 'OD', 'WARNA', 'TAHUN', 'BULAN_UPDATE', 'CATATAN', 'INPUT_DATA', 'SISA_HUTANG'); //field yang diizin untuk pencarian 
    var $order = array('ID' => 'asc'); // default order 
    
    private function _get_datatables_query()
    {         
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
}