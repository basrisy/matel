<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function get_all_user() { 
        $this->datatables->select('tbl_user.id as id_user, email, tbl_user.nama as nama, no_hp, id_propinsi, tbl_kabupaten.nama as kota');
        $this->datatables->from('tbl_user');
        $this->datatables->join('tbl_kabupaten', 'tbl_user.id_kabupaten = tbl_kabupaten.id');
        // $this->datatables->add_column('view', '<a href="world/edit/$1">edit</a> | <a href="world/delete/$1">delete</a>', 'id_user');
        return $this->datatables->generate();
    }
}