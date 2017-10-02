<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Page Authorization
 */
class Pageauth {
    // para CodeIgniter Super Global Referencias o variables globales
	protected $CI;
    function __construct() {
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
    }

	// cek user level and session
    function sess_level_auth() {
		// ensure user is signed in
		if ( $this->CI->session->userdata('login_state') == FALSE ) {
			redirect( "clogin/" );
		} else {
			// avoid access by a non admin level
			if ($this->CI->session->userdata('access') != 'admin') {
				?>
				<script>
					window.alert("Sorry, you don not have any privilleges to access this function!.");
					window.location="<?php echo base_url().'index.php/cpage/'; ?>";
				</script>
				<?php
			}
		}
    }
	
	// cek only session
    function sess_auth() {
		// ensure user is signed in
		if ( $this->CI->session->userdata('login_state') == FALSE ) {
			redirect( "clogin/" );
		}
    }

	// cek session, page_id, and username
	function sess_page_auth($obj_id) {
		$username = $this->CI->session->userdata('username');
		// query
		$query = $this->CI->db->query("
			select *
			from `sys_user_obj` obj
			join `sys_user` usr on obj.`obj_level` = usr.`obj_level`
			where obj.`obj_id` = $obj_id and usr.`username` = '$username'
		");
		$rwcnt = $query->num_rows();
		// ensure user is signed in and have access to the page
		if($this->CI->session->userdata('login_state') == FALSE) {
			redirect( "clogin/" );
		} elseif($rwcnt == 0){
			redirect( "cpage/" );
		}
	}
}
?>