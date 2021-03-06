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
	
	function User_Where_in($where_in)
	{
		$this->db->from('tbl_user');
		$this->db->where_in('status_aktif', $where_in);
		return $this->db->get();
	}
	function count_User($where_in)
	{
		$this->db->from('tbl_user');
		$this->db->where_in('status_aktif', $where_in);

		return $this->db->count_all_results();
	}
	
	function count_LogUser($aksi ='', $level ='', $where)
	{	
		$this->db->select(array('tanggal', 'aksi','user'));
		$this->db->from('tbl_log_user');
		$this->db->where_in('aksi', $aksi);
		$this->db->where_in('new_level', $level);
		$this->db->where($where);
		$this->db->group_by('user');

		return $this->db->count_all_results();
	}
	function admin()
	{
		$this->db->from('tbl_administrator');
		$this->db->where_not_in('id_level', '1');
		return $this->db->get();
	}
}