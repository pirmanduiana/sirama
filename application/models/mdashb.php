<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdashb extends CI_Model {

	function __construct(){
		$this->load->database();
	}

	function mLoadDsbRow1_1(){
	    $datenow = date('Y-m-d');
	    $query = $this->db->query("
	        select
	        count(DISTINCT trn_code) as counttrncode
	        from mod_trn_itm
	        where trn_date = '$datenow'
	    ");
        return $query;
    }

    function mLoadDsbRow1_2(){
        $datenow = date('Y-m-d');
        $query = $this->db->query("
	        select
	        min(trn_code) as counttrncode
	        from mod_trn_itm
	        where trn_date = '$datenow'
	    ");
        return $query;
    }

    function mLoadDsbRow1_3(){
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            select count(ses.username) as countusr
            from sys_user_session as ses
            join sys_user as usr on ses.username = usr.username
            where lower(usr.obj_level) in (
              lower('cashier'),
              lower('kasir')
            )
            and date(ses.ses_start) = '$datenow'
            and ses.ses_status not in (
              'stop', ''
            )
	    ");
        return $query;
    }

    function mLoadDsbRow1_4(){
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            select
            username
            from sys_user_session as ses1
            where ses1.ses_id in (
            select
            min(ses.ses_id)
            from sys_user_session as ses
            where date(ses.ses_start) = '$datenow'
            )
	    ");
        return $query;
    }

    function mLoadDsbRow1_5(){
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            select
            DATE_FORMAT(ses1.ses_start, '%H:%m:%s') as jam
            from sys_user_session as ses1
            where ses1.ses_id in (
            select
            min(ses.ses_id)
            from sys_user_session as ses
            where date(ses.ses_start) = '$datenow'
            )
	    ");
        return $query;
    }

    function mLoadDsbRow2_1(){
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            call f_mod_dash_sls_top_qty(5)
	    ");
        return $query;
    }

    function mLoadDsbRow2_2(){
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            call f_mod_dash_sls_wor_qty('')
	    ");
        return $query;
    }

    function mLoadDsbRow3_1(){
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            call f_mod_dash_sls_qty
	    ");
        return $query;
    }

    function mLoadDsbRow4_1_chartInfo(){
        $selKatVal = $this->input->post('selKatVal');
        $query = $this->db->query("
            select DISTINCT record_by, max(record_date) as record_date, cat_code 
            from mod_trn_forc
            where cat_code = '$selKatVal'
        ");
        return $query;
    }
}
?>