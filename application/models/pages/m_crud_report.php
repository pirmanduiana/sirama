<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_crud_report extends CI_Model {
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

	// fungsi tampil radio button kategori report
	function select_radrpt(){
		$username = $this->session->userdata('username');
		$query = $this->db->query("select * from sys_reports");
		return $query;
	}

    // fungsi tampil report parameter berdasarkan radio yang dipilih
    function select_prmrpt($rpt_code){
        $username = $this->session->userdata('username');
        $query = $this->db->query("select * from sys_reports_prm where rpt_code = '". $rpt_code ."'");
        return $query;
    }

    /* session report > user list */
    function select_usrlist($eltxtusr){
        $username = $this->session->userdata('username');
        if($eltxtusr == "ANY"){
            $query = $this->db->query("select * from vw_rpt_usrlist");
        } else {
            $query = $this->db->query("select * from vw_rpt_usrlist where username = '". $eltxtusr ."'");
        }
        return $query;
    }

    /* session report > login session */
    function select_seslist($datarptlog){
        $username = $this->session->userdata('username');

        if($datarptlog['txt_datestart'] == "ANY" && $datarptlog['txt_datefinish'] == "ANY")
        {
            $query = $this->db->query("select * from vw_rpt_usrses");
        }
        elseif($datarptlog['txt_datestart'] != "ANY" && $datarptlog['txt_datefinish'] != "ANY")
        {
            $query = $this->db->query("
            select * from vw_rpt_usrses
            where date(ses_start) between '".$datarptlog['txt_datestart']."' and '".$datarptlog['txt_datefinish']."'
            or date(ses_finish) between '".$datarptlog['txt_datestart']."' and '".$datarptlog['txt_datefinish']."'
            ");
        }
        return $query;
    }
}
?>