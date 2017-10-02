<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpage extends CI_Controller {

	/* i. function construct */
	function __construct(){
		parent::__construct();
	}


	/* fungsi call library error log */
	public function adderrlog(){
        $module = $this->input->post('errmodule');
        $status = $this->input->post('status');
        $statusText = $this->input->post('statusText');
        $responseText = $this->input->post('responseText');
        $this->errlogpush->PushErrorLog($status, $statusText, $responseText, $module);
    }


	/* 0. Index Page */
	public function index() {
		// load library to cek user session
		$this->pageauth->sess_auth();
        // set default timezone
        date_default_timezone_set("Asia/Singapore");
        $obj_level = $this->session->userdata('obj_level');
		$this->load->model('mlogin');
        // select home page berdasarkan level user
        $SqlSelectIdx = $this->db->query("
            select idx.obj_idx, mnu.title from sys_user_idx idx
            left join sys_menu mnu on mnu.file_path = idx.obj_idx
            where idx.obj_level = '$obj_level'
        ");
        foreach($SqlSelectIdx->result() as $rows){
            $IdxPage = $rows->obj_idx;
            $IdxTitle = $rows->title;
            $data = array(
                'apptitle' => 'S I R A M A',
                'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
                'title'    => $IdxTitle,
                'page'     => $IdxPage
            );
        }
		$this->load->view('wrapper', $data);
	}


    /* 0. Dashboard */
    public function dash() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(1);
        $this->load->model('pages/m_crud_user');
        $data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
            'title'    => 'Dashboard',
            'page'     => 'pages/dashboard'
        );
        $this->load->view('wrapper', $data);
    }


	/* 1. Setup > User & Menu */
	public function vulev() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(11);
		$this->load->model('pages/m_crud_user');
		$data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
			'title'    => 'Manage User & Session',
			'page'     => 'pages/frm_ulev/v_add_ulev'
		);
		$this->load->view('wrapper', $data);
	}

	/* 1. Setup > User & Menu > Group Menu > Re-order Object */
	public function vulevu($obj_level) {
		// load library to cek user session and level
		$this->pageauth->sess_level_auth();
		$this->load->model('pages/m_crud_user');
		$data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
			'title'     => 'Manage User and Menu',
			'page'      => 'pages/frm_ulev/v_edit_ulev',
			'obj_level' => $obj_level
		);
		$this->load->view('wrapper', $data);
	}
	
	/* 1. Setup > Sitemap */
	public function vsm() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(12);
		$data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
			'title'    => 'Sitemap Menu',
			'page'     => 'pages/sitemapmenu'
		);
		$this->load->view('wrapper', $data);
	}


    /* 2. Master Data > Kelola Barang */
    public function vmdb() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(41);
        // load model untuk keperluan generate doc number
        $this->load->model('mlogin');
        $data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
            'title'    => 'Kelola Barang',
            'page'     => 'pages/frm_inpbrg/v_add_barang'
        );
        $this->load->view('wrapper', $data);
    }


    /* 3. Forecasting > Input Transaksi Harian */
    public function vfcin() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(61);
        // load model untuk keperluan generate doc number
        $this->load->model('mlogin');
        $data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
            'title'    => 'Input Transaksi',
            'page'     => 'pages/frm_inptrn/v_add_trans'
        );
        $this->load->view('wrapper', $data);
    }


    /* 3. Forecasting > Proses WMA */
    public function vfcp() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(62);
        // load model untuk keperluan generate doc number
        $this->load->model('mlogin');
        $data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
            'title'    => 'Proses WMA',
            'page'     => 'pages/frm_forecast/v_add_forecast'
        );
        $this->load->view('wrapper', $data);
    }

    /* 4. Report > login/out */
    public function vrptses() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(81);
        $data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
            'title'     => 'Session Report',
            'page'      => 'pages/frm_report/v_view_rpt_usrses.php'
        );
        $this->load->view('wrapper', $data);
    }

    /* 5. Report > penjualan */
    public function vrptsls() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(82);
        $data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
            'title'     => 'Lap. Penjualan',
            'page'      => 'pages/frm_report/v_view_rpt_sales.php'
        );
        $this->load->view('wrapper', $data);
    }

    /* 6. Report > peramalan */
    public function vrptfrc() {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(83);
        $data = array(
            'apptitle' => 'S I R A M A',
            'appver'   => 'SISTEM PERAMALAN PENJUALAN CAT <Br> DENGAN MENGGUNAKAN <i>WEIGHTED MOVING AVERAGE</i> <br> PADA MITRA 10 DENPASAR',
            'title'     => 'Lap. Peramalan',
            'page'      => 'pages/frm_report/v_view_rpt_forecast.php'
        );
        $this->load->view('wrapper', $data);
    }
}
?>