<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Page Authorization
 */
class Errlogpush {
    // para CodeIgniter Super Global Referencias o variables globales
	protected $CI;
    function __construct() {
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
    }


    function PushErrorLog($status, $statusText, $responseText, $module){
        $username = $this->CI->session->userdata('username');
        $errdata = array(
            'username' => $username,
            'err_module' => $module,
            'err_datetime' => date('Y/m/d H:m:s'),
            'err_msgstatus' => $status,
            'err_msgstatustext' => $statusText,
            'err_msgresponsetext' => $responseText
        );
        $this->CI->db->insert('sys_error_log', $errdata);
    }
}
?>