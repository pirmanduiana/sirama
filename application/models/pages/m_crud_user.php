<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_crud_user extends CI_Model {  
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
	
	
	// fungsi insert new data
	function insert(){
		$username = $this->input->post('inpLogin');
		$password = $this->input->post('inpPass');
		$fullname = $this->input->post('inpFulln');
		$access   = $this->input->post('optionsrad');
		$obj_level = $this->input->post('inpLev');
		$data = array(
			'username' => $username,
			'password' => MD5($password),
			'fullname' => $fullname,
			'access'   => $access,
			'obj_level' => $obj_level
		);
		$this->db->insert('sys_user',$data);    
	}
	
	// fungsi update data
	function update($uid){
		$username = $this->input->post('txtusername');
		$password = $this->input->post('txtpassword');
		$fullname = $this->input->post('txtfullname');
		$level    = $this->input->post('optionsRadiosInline');
		$data = array(
			'username' => $username,
			'password' => MD5($password),
			'fullname' => $fullname,
			'level'    => $level                 
		);
		$this->db->where('uid', $uid);
		$this->db->update('sys_user',$data);
	}	
	
	// fungsi delete data
	function delete($uid){
		$this->db->delete('sys_user', array('uid'=>$uid));
    }
	
	// fungsi delete selected data
	function delete_selected(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
			$this->db->where('uid', $delete[$i]);
			$this->db->delete('sys_user');
		}
    }

    // fungsi tampil index page di group modal
    function select_idxmenu(){
        $query = $this->db->query("
            select title, file_path
            from sys_menu 
            where is_parent = 0 order by id
        ");
        return $query;
    }

	// fungsi tampil menu utk user level
	function select_sysmenu(){
		$username = $this->session->userdata('username');	
		$this -> db -> select('*');
		$this -> db -> from('sys_menu');
		$query = $this -> db -> get();	
		return $query;
	}
	
	// fungsi insert user object
	function insert_usrobj(){
		$obj_level	= $this->input->post('txt_objlev');
        $obj_idx	= $this->input->post('txt_objidx');
		$obj_id		= $this->input->post('duallistbox_demo1');
        // insert into sys_user_obj
		$data_detail = array();
		$opt_length	= count($obj_id);
		for($i = 0; $i < $opt_length; $i++){
			 $data_detail[$i] = array(
				'obj_level'	 => $obj_level,
				'obj_id'	 => $obj_id[$i]
			);
		}
		$this->db->insert_batch('sys_user_obj', $data_detail);
        // insert into sys_user_idx
        $SqlInsertIdx = $this->db->query("
            insert into sys_user_idx
            values('$obj_level','$obj_idx')
        ");
	}
	
	// fungsi tampil list role
	function select_objlist(){
		$username = $this->session->userdata('username');
		$query = $this->db->query("SELECT obj.obj_level, COUNT(obj.`obj_id`) as count FROM sys_user_obj as obj group by 1");
		return $query;
	}
	
	// fungsi delete list role
	function delete_objlist($obj_level){
		$username = $this->session->userdata('username');
		$query = $this->db->query("delete from `sys_user_obj` where obj_level = '". $obj_level ."'");
		return $query;
	}
	
	// fungsi tampil list user di tab2 manage role and user
	function select_usrlist(){
		$username = $this->session->userdata('username');
		$query = $this->db->query("SELECT * from sys_user");
		return $query;
	}
	
	// fungsi tampil list session di box sebelah kanan manage role and user
	function select_usrsess(){
		$username = $this->session->userdata('username');
		$query = $this->db->query("SELECT * from sys_user_session order by ses_id desc limit 5");
		return $query;
	}
	
	// fungsi chart user session di box sebelah kanan manage role and user
	function select_chartsess(){
		$username = $this->session->userdata('username');
		$query = $this->db->query("SELECT * from vw_chart_usr_sess");
		return $query;
	}
}
?>