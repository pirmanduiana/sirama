<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mutility extends CI_Model {

	function __construct(){
		$this->load->database();
	}

	function MySqlDump(){
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        $this->load->helper('file');
        write_file('<?php echo base_url();?>/downloads', $backup);
        $this->load->helper('download');
        force_download('mybackup.gz', $backup);
    }
}
?>