<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_crud_forecast extends CI_Model {
	function __construct(){
		$this->load->database();
	}

	// select all vw_mod_forc_data
    public function select_penj(){
        //$query = $this->db->query("call f_mod_gen_forc_data('1','')");
        $query = $this->db->query("call f_mod_gen_forc_data('1','','')");
        return $query;
    }

    // select category item untuk combobox
    public function select_cat(){
        $query = $this->db->query("select * from mod_itm_cat");
        return $query;
    }

    // select where vw_mod_forc_data
    public function select_penjkat() {
        $selKat = $this->input->post('selKat');
        //$query = $this->db->query("call f_mod_gen_forc_data('1','$selKat')");
        $query = $this->db->query("call f_mod_gen_forc_data('1','$selKat','')");
        return $query;
    }

    // select untuk konten modal peramalan per item
    public function select_top5itm() {
        $selKat = $this->input->post('selKat');
        $query = $this->db->query("call f_mod_dash_sls_top_qty(0)");
        return $query;
    }

    // select where vw_mod_forc_data
    public function select_penjitm() {
        $itmCode = $this->input->post('itmCode');
        $query = $this->db->query("call f_mod_gen_forc_data('1','','$itmCode')");
        return $query;
    }

    // tampil periode di combobox kanan
    public function select_period(){
        $query = $this->db->query("select m,y,mmmy,no from _tmp_mod_forc_data");
        return $query;
    }

    // tampil temp tbl di box kanan
    public function select_tmptbl(){
        // ambil data dari parameter box kanan
        $id_parPeriod =  $this->input->post('id_parPeriod');
        $id_parNum = $this->input->post('id_parNum');
        $query = $this->db->query("select * from _tmp_mod_forc_data where no >= " . $id_parPeriod . " order by 2,1");
        return $query;
    }
}
?>