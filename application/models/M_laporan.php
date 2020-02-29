<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

	function __construct()
	{
		parent::__construct();
    }

    function getUserPrabayar($where_in, $where)
	{
		$this->db->select( array(
			'a.tanggal as tanggal ',
			'a.time as time ',
			'a.aksi as aksi',
			'a.user as nama',
			'b.email as email',
			'b.id_kabupaten as id_kabupaten',
            'b.alamat as alamat',
            'b.no_hp as no_hp',
			'a.new_level as level',
            'b.berakhir_pada as berakhir_pada'));
		$this->db->from('tbl_log_user AS a');
		$this->db->join('tbl_user AS b', 'b.nama = a.user', ' left outer');
		$this->db->where_in('a.new_level', $where_in);
		$this->db->where($where);
		$this->db->group_by('a.user');
		return $this->db->get();
	}
    function getUserFree($where_in, $where)
	{
		$this->db->select( array(
			'a.tanggal as tanggal ',
			'a.time as time ',
			'a.aksi as aksi',
			'a.user as nama',
			'b.email as email',
			'b.id_kabupaten as id_kabupaten',
            'b.alamat as alamat',
            'b.no_hp as no_hp',
			'a.new_level as level',
            'b.berakhir_pada as berakhir_pada'));
		$this->db->from('tbl_log_user AS a');
		$this->db->join('tbl_user AS b', 'b.nama = a.user', ' left outer');
		$this->db->where_in('a.new_level', $where_in);
		$this->db->where($where);
		$this->db->group_by('a.user');
		return $this->db->get();
	}
}