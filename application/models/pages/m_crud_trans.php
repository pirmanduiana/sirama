<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_crud_trans extends CI_Model {
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
	function select_itmlist(){
		$username = $this->session->userdata('username');
		$query = $this->db->query("select * from mod_itm_list");
		return $query;
	}


	// fungsi ambil toal qty berdasarkan tanggal transaksi
    function select_sumqty($dateqty){
        $query = $this -> db -> query("select trn_date, sum(itm_qty) as ttlqty from mod_trn_itm where trn_date = '" . $dateqty . "' group by 1");
        return $query;
    }


	// fungsi insert data transaksi
    function insert_trans(){
        $txt_trndate = $this->input->post('txt_trndate');
        $txt_trnnum  = $this->input->post('txt_trnnum');
        $txt_trnref  = $this->input->post('txt_trnref');
        $txt_trnseq = $this->input->post('txt_trnseq'); // untuk keperluan delete update saja
        $txt_itmcode = $this->input->post('txt_itmcode');
        $txt_itmname = $this->input->post('txt_itmname');
        $txt_itmqty  = $this->input->post('txt_itmqty');
        $data = array(
            'trn_date' => $txt_trndate,
            'trn_code' => $txt_trnnum,
            'trn_ref'  => $txt_trnref,
            'itm_code' => $txt_itmcode,
            'itm_desc' => $txt_itmname,
            'itm_qty'  => $txt_itmqty
        );
        $dataupd = array(
            'trn_date' => $txt_trndate,
            'trn_code' => $txt_trnnum,
            'trn_ref'  => $txt_trnref,
            'trn_seq'  => $txt_trnseq,
            'itm_code' => $txt_itmcode,
            'itm_desc' => $txt_itmname,
            'itm_qty'  => $txt_itmqty
        );
        $this->db->delete('mod_trn_itm', array('trn_seq'=>$txt_trnseq)); //delete dulu
        if($txt_trnseq == ''){
            // kondisi jika data baru di-input
            $this->db->insert('mod_trn_itm',$data); // baru insert
        } else {
            // kondisi jika data di-edit
            $this->db->insert('mod_trn_itm',$dataupd); // baru insert
        }
    }

    // fungsi select data transaksi
    function select_trans($date){
        $this -> db -> select('*');
        $this -> db -> from('mod_trn_itm');
        $this -> db -> where('trn_date = ', $date);
        $this -> db -> order_by("trn_seq", "desc");
        $query = $this -> db -> get();
        return $query;
    }

    // funcsi select 1 data transaksi utk keperluan editing
    function select_1trans($trn_seq){
        $this -> db -> select('*');
        $this -> db -> from('mod_trn_itm');
        $this -> db -> where('trn_seq = ', $trn_seq);
        $query = $this -> db -> get();
        return $query;
    }

    // funcsi delete 1 data transaksi
    function delete_1trans($trn_seq){
        $this->db->delete('mod_trn_itm', array('trn_seq'=>$trn_seq)); //delete dulu
    }

    // fungsi delete before import
    function delete_importtrn(){
        $this->db->query("delete from mod_trn_itm");
    }
    function delete_importcat(){
        $this->db->query("delete from mod_itm_cat");
    }
    function delete_importitm(){
        $this->db->query("delete from mod_itm_list");
    }

    // fungsi insert import transaction
    function insert_import_trn($data){
        $datacsv = array(
            //'trn_seq'  => addslashes($data[0]), // auto increment
            'trn_date' => addslashes($data[1]),
            'trn_code' => addslashes($data[2]),
            'trn_ref'  => addslashes($data[3]),
            'itm_code' => addslashes($data[4]),
            'itm_desc' => addslashes($data[5]),
            'itm_qty'  => addslashes($data[6])
        );
        $this->db->insert('mod_trn_itm',$datacsv);
    }

    // fungsi insert import category item
    function insert_import_cat($data){
        $datacsv = array(
            'cat_code'  => addslashes($data[0]),
            'cat_desc' => addslashes($data[1])
        );
        $this->db->insert('mod_itm_cat',$datacsv);
    }

    // fungsi insert import item list
    function insert_import_itm($data){
        $datacsv = array(
            'itm_code' => addslashes($data[0]),
            'itm_desc' => addslashes($data[1]),
            'itm_unit' => addslashes($data[2]),
            'cat_code' => addslashes($data[3])
        );
        $this->db->insert('mod_itm_list',$datacsv);
    }
}
?>