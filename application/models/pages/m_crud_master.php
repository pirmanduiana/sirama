<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_crud_master extends CI_Model {
	function __construct(){
		$this->load->database();
	}

	// return record, display in clogin controller
	function index() {
		$username = $this->session->userdata('username');	
		$this -> db -> select('*');
		$this -> db -> from('sys_user');
		$this -> db -> where('username !=', $username);
		$query = $this -> db -> get();	
		return $query;
	}

	// fungsi tampil item list di modal pilih item.
	function select_kategori(){
		$username = $this->session->userdata('username');
		$query = $this->db->query("select * from mod_itm_cat");
		return $query;
	}

	// fungsi select 1 kategori utk keperluan edit
    function select_1kategori($cat_code){
        $query = $this->db->query("select * from mod_itm_cat where cat_code = '". $cat_code ."'");
        return $query;
    }

    // fungsi insert kategori
    function insert_kategori(){
        $cat_code = $this->input->post('cat_code');
        $cat_desc = $this->input->post('cat_desc');
        $data = array(
            'cat_code' => $cat_code,
            'cat_desc' => $cat_desc
        );
        $this->db->insert('mod_itm_cat', $data);
    }

    // fungsi update kategori
    function update_kategori(){
        $cat_code = $this->input->post('cat_code');
        $cat_desc = $this->input->post('cat_desc');
        $data = array(
            'cat_desc' => $cat_desc
        );
        $this->db->where('cat_code', $cat_code);
        $this->db->update('mod_itm_cat', $data);
    }

    // fungsi select item berdasarkan cat_code
    function select_item($cat_code){
        $query = $this->db->query("select * from mod_itm_list where cat_code = '" . $cat_code . "'");
        return $query;
    }

    // fungsi select uom item utk keperluan tambah item
    function select_uom(){
        $query = $this->db->query("select * from mod_itm_uom");
        return $query;
    }

    // fungsi insert item
    function insert_itm(){
        $koditm  = $this->input->post('koditm');
        $namitm  = $this->input->post('namitm');
        $untitm  = $this->input->post('untitm');
        $cat_code = $this->input->post('tmpText');
        $data = array(
            'itm_code' => $koditm,
            'itm_desc' => $namitm,
            'itm_unit' => $untitm,
            'cat_code' => $cat_code
        );
        $this->db->insert('mod_itm_list', $data);
    }

    // fungsi select 1 item utk keperluan editing
    function select_1item($itm_code){
        $query = $this->db->query("select * from mod_itm_list where itm_code = '" . $itm_code . "'");
        return $query;
    }

    // fungsi update item
    function update_item(){
        $koditm = $this->input->post('koditm');
        $namitm = $this->input->post('namitm');
        $untitm = $this->input->post('untitm');
        $tmpText = $this->input->post('tmpText');
        $data = array(
            'itm_code' => $koditm,
            'itm_desc' => $namitm,
            'itm_unit' => $untitm,
            'cat_code' => $tmpText
        );
        $this->db->where('itm_code', $koditm);
        $this->db->update('mod_itm_list', $data);
    }
}
?>