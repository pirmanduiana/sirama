<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clogin extends CI_Controller {

	/* i. function construct */
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('mlogin');
		$this->load->library('session');
	}

	/* 1. fungsi memanggail halaman login */
	public function index() {
		// get db configuration to show in login page
		$dbconfig = array(
			'host'     => $this->db->hostname,
			'db'       => $this->db->database,
			'user'     => $this->db->username,
			'pass'     => $this->db->password,
			'apptitle' => 'S I R A M A',
			'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
		);
		$this->load->view('login', $dbconfig);
	}
	
	/* 2. fungsi autentikasi login */
	public function auth(){
	    // set default php memory_limit
        ini_set('memory_limit', '128M');
        // set default timezone
        date_default_timezone_set("Asia/Singapore");
		// array untuk select sql
		$datauser=array(
			'txtusername'    =>$this->input->post('txtusername'),
			'txtpassword'    =>$this->input->post('txtpassword')
		);
		$query = $this->mlogin->selectsession($datauser);
		$cek   = $this->mlogin->selectuser($datauser);
		if($cek == 1){
			foreach ($query->result() as $row) {
			    // array untuk session
				$user_sess = array(
                    'apptitle'    => 'S I R A M A',
                    'appver'      => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
					'username'    => $this->input->post('txtusername'),
					'password'    => $this->input->post('txtpassword'),
                    'fullname'    => $row->fullname,
					'access'	  => $row->access,
					'obj_level'	  => $row->obj_level,
					'login_state' => TRUE,
					// part of these sessions will insert into database as a NEW SESSION
					'ses_start'   => date('Y-m-d H:i:s'),
					'ses_status'  => 'running'
				);
				// set session data by array $user_sess
				$this->session->set_userdata($user_sess);
				// insert part of session into database
				$this->load->model('pages/mlogin');
				$this->mlogin->insertsession($this->input->post('txtusername'));
			}
		    echo true;
		} else {
			echo false;
		}
	}
		
	/* 3. fungsi logout */
    public function logout() {
		$this->session->sess_destroy();
		// update session in database :: update column ses_finish
		$this->load->model('pages/mlogin');
		$this->mlogin->udpatesession();
		//redirect('clogin/');
	}
}
?>