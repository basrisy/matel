<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model {

	function __construct()
	{
		parent::__construct();
    }
    
	function get_all($table)
	{
		$this->db->from($table);

		return $this->db->get();
	}

	function get_where($table = null, $where = null)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
    }

	function insert($table = '', $data = '')
	{
		$this->db->insert($table, $data);
	}
	function insert_batch($table = '', $data = '')
	{
		$this->db->insert_batch($table, $data);
	}

	function select_all($select, $table)
	{
		$this->db->select($select);
		$this->db->from($table);

		return $this->db->get();
	}

	function select_where($select, $table, $where)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}
	function update($table = null, $data = null, $where = null)
	{
		$this->db->update($table, $data, $where);
	}
	function delete($table = null, $where = null)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	function count($table='')
	{
		return $this->db->count_all($table);
	}
	function count_where($table='', $where = '')
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->count_all_results();
	}
	function last($table, $limit, $order)
	{
		$this->db->from($table);
		$this->db->limit($limit);
		$this->db->order_by($order, 'DESC');

		return $this->db->get();
	}
	function group_by($table='', $order='')
	{
		$this->db->from($table);
		$this->db->group_by($order);

		return $this->db->get();
	}
	function replace($table = null, $data = null, $where = null)
	{
		$this->db->replace($table, $data, $where);
	}

    function data_kendaraan()
	{
		$columns = '`ID` AS id,
					`NO_POL` AS plat,
                    `UNIT` AS model,
                    `WARNA`AS warna,
                    `LEASING` AS leasing,
                    `CABANG` AS cabang,
                    `NO_RANGKA` AS no_rangka,
                    `NO_MESIN` AS no_mesin,
                    `KONSUMEN` AS pemilik,
                    `SISA_HUTANG` AS sisa_hutang,
                    `OD` AS overdue,
                    `INPUT_DATA` AS ket_data_masuk,
                    `CATATAN` AS catatan';
		$this->db->select($columns, FALSE);

		$this->db->from('tbl_kendaraan');

		return $this->db->get();
	}
    
    public function importData($data) {

        $qwery = $this->db->insert_batch('tbl_kendaraan',$data);
        if ($qwery){
            return TRUE;
        } else {
            return FALSE;
        }
    
	}
	
	function login($where = '')
	{
		$this->db->select(array('a.id AS id','username','a.nama As nama','password','b.nama AS level','id_level','isLogin'));
		$this->db->from('tbl_administrator a JOIN tbl_leveladmin b ON (a.id_level = b.id)');
		$this->db->where($where);
		return $this->db->get();
	}
	function isLogin($where='')
	{
		$this->db->select(array('id', 'isLogin'));
		$this->db->from('tbl_administrator');
		$this->db->where($where);
		return $this->db->get();
	}
}