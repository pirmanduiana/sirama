<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdashb extends CI_Controller
{

    /* i. function construct */
    function __construct()
    {
        parent::__construct();
    }


    public function LoadDsbRow1_1()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow1_1();
        foreach($query->result() as $row){
            echo $row->counttrncode;
        }
    }

    public function LoadDsbRow1_2()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow1_2();
        foreach($query->result() as $row){
            if($row->counttrncode === NULL){
                echo "<i class='fa fa-fw fa-warning'></i> belum ada!";
            } else {
                ?><span id="id_trnCodeVal" data-toggle='modal' data-target='#notificationPreview1' style="cursor: pointer" onclick="ShowBillDetail('<?=$row->counttrncode?>')"><?= $row->counttrncode ?></span><?php
            }
        }
    }

    public function LoadDsbRow1_3()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow1_3();
        foreach($query->result() as $row){
            ?><span data-toggle='modal' data-target='#notificationPreview2' style="cursor: pointer" onclick="ShowCashOnline()"><?= $row->countusr; ?></span><?php
        }
    }

    public function LoadDsbRow1_4()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow1_4();
        foreach($query->result() as $row){
            echo $row->username;
        }
    }

    public function LoadDsbRow1_5()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow1_5();
        foreach($query->result() as $row){
            echo "Pukul " . $row->jam;
        }
    }

    public function LoadDsbRow2_1()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow2_1();
        if($query->num_rows() == 0){
            echo "<i class='fa fa-fw fa-warning'></i> tidak ada data!";
        } else {
            foreach($query->result() as $row){
                ?>
                <div class="progress-group">
                    <span class="text-info"><i class="fa fa-fw fa-thumbs-o-up"></i>&nbsp;&nbsp;<?= $row->itm_desc ?></span>
                    <span class="progress-number text-info"><strong><?= $row->qty ." ". $row->itm_unit ?></strong></span>
                    <div class="progress-sm" style="margin: 5px 0px 10px 0px;">
                        <div class="progress-bar progress-bar-aqua" style="width: <?= $row->qty/$row->sumqty*100 ?>%">
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }

    public function LoadDsbRow2_2()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow2_2();
        if($query->num_rows() == 0) {
            echo "<i class='fa fa-fw fa-warning'></i> tidak ada data!";
        } else {
            foreach($query->result() as $row){
                ?>
                <div class="progress-group">
                    <span class="text-info"><i class="fa fa-fw fa-thumbs-o-down"></i>&nbsp;&nbsp;<?= $row->cat_desc ?></span>
                    <span class="progress-number text-info DetDeadItm"><strong><?= $row->countitm ?> item</strong></span>
                    <div class="progress-sm" style="margin: 5px 0px 10px 0px;">
                        <div class="progress-bar progress-bar-aqua" style="width: <?= $row->countitm/$row->ttlcount*100 ?>%"></div>
                    </div>
                </div>
                <?php
            }
        }
    }

    public function LoadDsbRow3_1()
    {
        $this->pageauth->sess_auth();
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow3_1();
        if($query->num_rows() == 0) {
            echo "<i class='fa fa-fw fa-warning'></i> tidak ada data!";
        } else {
            ?>
            <table class="table no-margin">
                <thead>
                <tr>
                    <th width="20"><i class="fa fa-fw fa-cubes"></i> Kategori Barang</th>
                    <th width="7%"><i class="fa fa-fw fa-shopping-cart"></i> TDY</th>
                    <th width="9%"></th>
                    <th width="7%"><i class="fa fa-fw fa-shopping-cart"></i> MTD</th>
                    <th width="9%"></th>
                    <th width="7%"><i class="fa fa-fw fa-shopping-cart"></i> LMTD</th>
                    <th width="9%"></th>
                    <th width="7%"><i class="fa fa-fw fa-shopping-cart"></i> YTD</th>
                    <th width="9%"></th>
                    <th width="7%"><i class="fa fa-fw fa-shopping-cart"></i> LYTD</th>
                    <th width="9%"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($query->result() as $row){
                    ?>
                    <tr>
                        <td><i class="fa fa-fw fa-caret-right"></i> <?= $row->description ?></td>
                        <td class="text-primary"><?= $row->val_tdy ?></td>
                        <td><div class="progress-sm progress-bar-primary" style="width:<?= $row->pcg_tdy ?>%"></div></td>
                        <td class="text-info"><?= $row->val_mtd ?></td>
                        <td><div class="progress-sm progress-bar-info" style="width:<?= $row->pcg_mtd ?>%"></div></td>
                        <td class="text-green"><?= $row->val_lmtd ?></td>
                        <td><div class="progress-sm progress-bar-success" style="width:<?= $row->pcg_lmtd ?>%"></div></td>
                        <td class="text-yellow"><?= $row->val_ytd ?></td>
                        <td><div class="progress-sm progress-bar-warning" style="width:<?= $row->pcg_ytd ?>%"></div></td>
                        <td class="text-red"><?= $row->val_lytd ?></td>
                        <td><div class="progress-sm progress-bar-danger" style="width:<?= $row->pcg_lytd ?>%"></div></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <div style="margin: 10px 0px 0px 0px">
                <i class="fa fa-circle text-primary"></i> <em>TDY (Today)</em> &nbsp;
                <i class="fa fa-circle text-info"></i> <em>MTD (Month to Date)</em> &nbsp;
                <i class="fa fa-circle text-green"></i> <em>LMTD (Last Month to Date)</em> &nbsp;
                <i class="fa fa-circle text-yellow"></i> <em>YTD (Year to Date)</em> &nbsp;
                <i class="fa fa-circle text-red"></i> <em>LYTD (Last Year to Date)</em>
            </div>
            <?php
        }
    }

    public function LoadDsbRow4_1_chartInfo(){
        $this->pageauth->sess_auth();
        $selKatVal = $this->input->post('selKatVal');
        $this->load->model('mdashb');
        $query = $this->mdashb->mLoadDsbRow4_1_chartInfo();
        foreach($query->result() as $row){
            ?>
            <em>
                Diproses oleh: <?= $row->record_by ?>
                pada: <?= $row->record_date ?>
                <?php
                $terkat = $selKatVal=='' ? 'untuk semua kategori' : 'untuk kategori ' . $row->cat_code;
                echo $terkat;
                ?>
            </em>
            <?php
        }
    }

    public function LoadDsbRow1_2_billdetail(){
        $this->pageauth->sess_auth();
        $trn_code = $this->input->post('trn_code');
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            select * from mod_trn_itm
            where trn_code = '$trn_code'
            and trn_date = '$datenow'
        ");
        ?>
        <table class="table no-margin">
            <thead>
            <tr>
                <th width="20%"><i class="fa fa-fw fa-cubes"></i> Kode Item</th>
                <th width="60%"><i class="fa fa-fw fa-shopping-cart"></i> Nama Item</th>
                <th width="10%"><i class="fa fa-fw fa-shopping-cart"></i> Qty</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($query->result() as $row){
                ?>
                <tr>
                    <td><?=$row->itm_code?></td>
                    <td><?=$row->itm_desc?></td>
                    <td><?=$row->itm_qty?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }

    public function LoadDsbRow1_3_cashonline(){
        $this->pageauth->sess_auth();
        $datenow = date('Y-m-d');
        $query = $this->db->query("
            select ses.username, ses.ses_start, ses.ses_status
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
        ?>
        <table class="table no-margin">
            <thead>
            <tr>
                <th width="20%"><i class="fa fa-fw fa-cubes"></i> Username</th>
                <th width="40%"><i class="fa fa-fw fa-shopping-cart"></i> Login on</th>
                <th width="40%"><i class="fa fa-fw fa-shopping-cart"></i> Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($query->result() as $row){
                ?>
                <tr>
                    <td><?=$row->username?></td>
                    <td><?=$row->ses_start?></td>
                    <td><?=$row->ses_status?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }

    // send email box 3_1
    public function SendEm3_1(){
        $this->load->library('email');
        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['auth']      = false;
        $config['smtp_user'] = 'pirmandwiana@gmail.com';
        $config['smtp_pass'] = 'iloveyoumom1987';
        $config['mailtype']  = 'text';
        $config['charset']   = 'utf-8';
        $config['newline']   = '\r\n';
        $config['validation']   = true;

        $this->email->initialize($config);

        $this->email->from('pirmandwiana@gmail.com');
        $this->email->to('pirmandwiana@gmail.com');
        $this->email->subject("test CI");
        $this->email->message("isi email");
        if($this->email->send()){
            echo "email sent";
        } else {
            show_error($this->email->print_debugger());
        };
    }
}
?>