<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cutility extends CI_Controller
{

    /* i. function construct */
    function __construct()
    {
        parent::__construct();
    }


    public function CreateDump()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mutility');
        $query = $this->mutility->MySqlDump();
        if($query){
            echo "mysqldump success";
        } else {
            echo "mysqldump failed";
        }
    }

    public function ShowSysInfo()
    {
        ?>
        <h3 style="color: orange">S I R A M A</h3>
        <p style="color: whitesmoke">Sistem Peramalan Penjualan Cat Dengan Menggunakan <em>Weighted Moving Average</em> Pada Mitra 10 Denpasar</p>
        <ul class="control-sidebar-menu">
            <li>
                <a href="javascript::;">
                    <i class="menu-icon fa fa-graduation-cap bg-orange"></i>
                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><em>Skripsi</em></h4>
                        <p>Sistem ini dibangun untuk tugas akhir dan syarat administrasi akademik
                            menyelesaikan jenjang studi S1 STIKOM BALI.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="javascript::;">
                    <i class="menu-icon fa fa-bookmark bg-orange"></i>
                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><em>Rilis</em></h4>
                        <p>Versi <em>Beta</em> tanggal 7 Mei 2017.</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="javascript::;">
                    <i class="menu-icon fa fa-user bg-orange"></i>
                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><em>Perancang</em></h4>
                        <p>I Made Pirman Duiana (130030347).</p>
                    </div>
                </a>
            </li>
        </ul><!-- /.control-sidebar-menu -->
        <?php
    }

    /**
     * @return object
     */
    public function StatusToIdle()
    {
        $username   = $this->session->userdata('username');
        $ses_start  = $this->session->userdata('ses_start');
        $ses_status = 'away';
        $data = array(
            'ses_status' => $ses_status
        );
        $this->db->where('username', $username);
        $this->db->where('ses_start', $ses_start);
        $this->db->update('sys_user_session',$data);
        echo "User $username is away!";
    }

    /**
     * @return object
     */
    public function StatusToDutty()
    {
        $username   = $this->session->userdata('username');
        $ses_start  = $this->session->userdata('ses_start');
        $ses_status = 'dutty';
        $data = array(
            'ses_status' => $ses_status
        );
        $this->db->where('username', $username);
        $this->db->where('ses_start', $ses_start);
        $this->db->update('sys_user_session',$data);
        echo "User $username is back!. $ses_start";
    }
}
?>