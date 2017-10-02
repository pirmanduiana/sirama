<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model {  
	function __construct(){
		$this->load->database();
	}

	// return the number of row
	function selectuser($datauser) {
		$this -> db -> select('*');
		$this -> db -> from('sys_user');
		$this -> db -> where('username', $datauser['txtusername']);
		$this -> db -> where('password', MD5($datauser['txtpassword']));
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		return $query->num_rows();
	}
	
	// return record, display in clogin controller
	function selectsession($datauser) {
		$this -> db -> select('*');
		$this -> db -> from('sys_user');
		$this -> db -> where('username', $datauser['txtusername']);
		$this -> db -> where('password', MD5($datauser['txtpassword']));
		$query = $this -> db -> get();	
		return $query;
	}
	
	// insert login session into database
	function insertsession($txtusername){
		$username   = $txtusername;
		$ses_start  = $this->session->userdata('ses_start');
		$ses_status = $this->session->userdata('ses_status');
		$data = array(
			'username'   => $username,
			'ses_start'  => $ses_start,
			'ses_finish' => '',
			'ses_status' => $ses_status
		);
		$this->db->insert('sys_user_session',$data);    
	}
	
	// update login session database :: UPDATE column ses_finish
	function udpatesession(){
		$username   = $this->session->userdata('username');
		$ses_start  = $this->session->userdata('ses_start');
		$ses_status = 'stop';
		$data = array(
			'ses_finish' => date('Y/m/d H:i:s'),
			'ses_status' => $ses_status        
		);
		$this->db->where('username', $username);
		$this->db->where('ses_start', $ses_start);
		$this->db->update('sys_user_session',$data);
	}

    // get new document number
    function getdocnum($dateVal){
        $query = $this->db->query("call f_sys_gen_docnumber('_tmp_mod_trn_daily','no','BIL',6,'$dateVal')");
        return $query;
    }
}
?>