<?php
/*
 * Dynmic_menu.php
 */
class Sitemap_menu {
 
    private $ci;            // para CodeIgniter Super Global Referencias o variables globales
    private $id_menu       = 'id="menu"';
    private $class_menu    = 'class="treeview-menu"';
    private $class_parent  = 'class="parent"';
    private $class_last    = 'class="last"';

    function __construct(){
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }
    function build_menu($type){
		// call session library using super global reference CI
		$level = $this->ci->session->userdata('obj_level');
        $menu = array();
		$query = $this->ci->db->query("select * from vw_sys_usr_menu where obj_level = '". $level . "'");		
		//$query  = $this->ci->db->query("select * from sys_menu"); > ORI REMMED
        switch ($type){
            case 0:            // 0 = top menu
                break; 
            case 1:            // 1 = horizontal menu
                $html_out = "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break; 
            case 2:            // 2 = sidebar menu
                $html_out = "\t\t".'<ul '.$this->class_menu.'>'."\n";
				break;
            case 3:            // 3 = footer menu
                break;
            default:        // default = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break;
        }
		foreach ($query->result() as $row){
			$id = $row->id;
			$title = $row->title;
			$link_type = $row->link_type;
			$page_id = $row->page_id;
			$module_name = $row->module_name;
			$url = $row->url;
			$uri = $row->uri;
			$dyn_group_id = $row->dyn_group_id;
			$position = $row->position;
			$target = $row->target;
			$parent_id = $row->parent_id;
			$is_parent = $row->is_parent;
			$show_menu = $row->show_menu;
			$fa_icon = $row->fa_icon;
			if ($show_menu && $parent_id == 0){
				if($is_parent == 1){
					$html_out .= '<li>'.anchor($url, '<i class="'.$fa_icon.'"></i> '.$title."<i class='fa fa-angle-left pull-right'></i>", 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
					$html_out .= $this->get_childs($id);				
				} else {
					$html_out .= '<li>'.anchor($url, '<i class="'.$fa_icon.'"></i> '.$title, 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
					$html_out .= $this->get_childs($id);
				}
			}
		}
		$html_out .= '</li>'."\n";
		$html_out .= "\t\t".'</ul>' . "\n";
		return $html_out;
	}
	
	
	
	
	function get_childs($id){
		/*?><script> alert(<?php echo $id ?>) </script><?php*/
		// call session library using super global reference CI
		$level = $this->ci->session->userdata('obj_level');
		$has_subcats = FALSE;
		$html_out  = '';
		$html_out .= "\t\t\t\t\t".'<ul '.$this->class_menu.'>'."\n";
		//$query2 = $this->ci->db->query("select * from sys_menu where parent_id = $id"); > REMMED ORI
        $query2 = $this->ci->db->query("select * from vw_sys_usr_menu where parent_id = $id and obj_level = '". $level . "'");		
		if(($query2->num_rows()) > 0){
			foreach ($query2->result() as $row){
				$id = $row->id;
				$title = $row->title;
				$link_type = $row->link_type;
				$page_id = $row->page_id;
				$module_name = $row->module_name;
				$url = $row->url;
				$uri = $row->uri;
				$dyn_group_id = $row->dyn_group_id;
				$position = $row->position;
				$target = $row->target;
				$parent_id = $row->parent_id;
				$is_parent = $row->is_parent;
				$show_menu = $row->show_menu;
				$fa_icon = $row->fa_icon;
				$has_subcats = TRUE;
				if ($is_parent == 1){
					$html_out .= '<li>'.anchor($url, '<i class="'.$fa_icon.'"></i> '.$title."<i class='fa fa-angle-left pull-right'></i>", 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
				}
				else{
					$html_out .= '<li>'.anchor($url, '<i class="'.$fa_icon.'"></i> '.$title, 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
				}
				// Recurse call to get more child submenus.
				$html_out .= $this->get_childs($id);
			}
		}
		$html_out .= '</li>' . "\n";
		$html_out .= "\t\t\t\t\t".'</ul>' . "\n";
		return ($has_subcats) ? $html_out : FALSE;
	}
}
?>