<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_crud_user extends CI_Controller
{

    /* i. function construct */
    function __construct()
    {
        parent::__construct();
    }

    /* 1. show user list */
    public function showlist()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        // view to be used by ajax call
        $query = $this->m_crud_user->select_usrlist();
        foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td>&nbsp;&nbsp;<i class='fa fa-user'></i> " . $row->username . "</td>";
            echo "<td>" . $row->fullname . "</td>";
            echo "<td>" . $row->access . "</td>";
            echo "<td>" . $row->obj_level . "</td>";
            ?>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-xs">Action</button>
                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a onclick="deluser(<?php echo $row->uid ?>)" style="cursor:pointer">Delete</a></li>
                        <li class="divider"></li>
                        <li><a onclick="loadmodal()" style="cursor:pointer">Edit</a></li>
                    </ul>
                </div>
            </td>
            <?php
            echo "</tr>";
        }
    }

    /* 2. create */
    public function create()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $this->m_crud_user->insert();
        //redirect('cpage/vulev');
        // view to be used by ajax call
        $query = $this->m_crud_user->select_usrlist();
        foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td>&nbsp;&nbsp;<i class='fa fa-user'></i> " . $row->username . "</td>";
            echo "<td>" . $row->fullname . "</td>";
            echo "<td>" . $row->access . "</td>";
            echo "<td>" . $row->obj_level . "</td>";
            ?>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-xs">Action</button>
                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a onclick="deluser(<?php echo $row->uid ?>)" style="...">Delete</a></li>
                        <li class="divider"></li>
                        <li><a onclick="loadmodal()" style="cursor:pointer">Edit</a></li>
                    </ul>
                </div>
            </td>
            <?php
            echo "</tr>";
        }
    }

    /* 3. update */
    public function update($uid)
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $this->m_crud_user->update($uid);
        redirect('cpage/vuser');
    }

    /* 4. delete */
    public function delete($uid)
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $this->m_crud_user->delete($uid);
        //redirect('cpage/vulev');
        // view to be used by ajax call
        $query = $this->m_crud_user->select_usrlist();
        foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td>&nbsp;&nbsp;<i class='fa fa-user'></i> " . $row->username . "</td>";
            echo "<td>" . $row->fullname . "</td>";
            echo "<td>" . $row->access . "</td>";
            echo "<td>" . $row->obj_level . "</td>";
            ?>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-xs">Action</button>
                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a onclick="deluser(<?php echo $row->uid ?>)" style="...">Delete</a></li>
                        <li class="divider"></li>
                        <li><a onclick="loadmodal()" style="cursor:pointer">Edit</a></li>
                    </ul>
                </div>
            </td>
            <?php
            echo "</tr>";
        }
    }

    /* 5. delete selected by checkbox */
    public function delete_selected()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $this->m_crud_user->delete_selected();
        redirect('cpage/vuser');
    }

    /* !6. show user level */
    public function show_ulev()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        //redirect('cpage/vulev');
        $query = $this->m_crud_user->select_objlist();
        foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td>&nbsp;&nbsp;<i class='fa fa-th-list'></i> " . $row->obj_level . "</td>";
            echo "<td>" . $row->count . "</td>";
            ?>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-xs">Action</button>
                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><?php echo anchor('pages/c_crud_user/delete_ulev/' . $row->obj_level, 'Delete', array('onclick' => "return confirm('Delete this level?')")); ?></li>
                        <li class="divider"></li>
                        <li><?php echo anchor('cpage/vulevu/' . $row->obj_level, 'Re-order object', array('onclick' => "return confirm('Re-ordering object, will delete the file and all its object, you may also need to recreating it one by one. Are you sure to re-order this file?')")); ?></li>
                    </ul>
                </div>
            </td>
            <?php
            echo "</tr>";
        }
    }

    /* 6. insert user object duallistbox */
    public function create_ulev()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $this->m_crud_user->insert_usrobj();
        redirect('cpage/vulev');
    }

    /* 7. delete user object*/
    public function delete_ulev($obj_level)
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $this->m_crud_user->delete_objlist($obj_level);
        redirect('cpage/vulev');
    }

    /* 8. delete then insert user object duallistbox */
    public function recreate_ulev($obj_level)
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $this->m_crud_user->delete_objlist($obj_level);
        $this->m_crud_user->insert_usrobj();
        redirect('cpage/vulev');
    }

    /* 9. show table login session */
    public function show_usrsess()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        //redirect('clogin/logout');
        $query = $this->m_crud_user->select_usrsess();
        foreach ($query->result() as $row) {
            echo "<tr>";
            echo "<td>&nbsp;&nbsp;<i class='fa fa-user'></i> " . $row->username . "</td>";
            echo "<td>" . $row->ses_start . "</td>";
            echo "<td>" . $row->ses_finish . "</td>";
            echo "<td>" . $row->ses_status . "</td>";
            echo "</tr>";
        }
    }

    /* 10. show session Flot Chart */
    public function showChartSesLog()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_user');
        $query = $this->m_crud_user->select_chartsess();
        $sesarry = array();
        foreach ($query->result() as $row) {
            $sesarry[] = $row;
        }
        echo json_encode($sesarry);
        header('Content-Type: application/json');
    }
}
?>