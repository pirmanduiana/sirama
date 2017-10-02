<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_crud_report extends CI_Controller
{

    /* i. function construct */
    function __construct()
    {
        parent::__construct();
    }

    /***************************************************************************************************************/
    /*************************************************** SESSION REPORT ********************************************/
    /***************************************************************************************************************/
    /* !6. show radio button report on document ready */
    public function show_radrpt()
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_report');
        $query = $this->m_crud_report->select_radrpt();
        foreach ($query->result() as $row) {
            echo "<input onclick='GetRadValue()' type='radio' name='".$row->el_name."' value='".$row->rpt_code."'>  ".$row->rpt_name."&nbsp;&nbsp;&nbsp;";
        }
    }

    /* !6. show report parameter */
    public function show_prmrpt($rpt_code)
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_report');
        $query = $this->m_crud_report->select_prmrpt($rpt_code);
        foreach ($query->result() as $row) {
            if($row->prm_type == "button"){
                echo "&nbsp; ".$row->prm_input."";
            } else if($row->prm_type == "inputtext"){
                echo $row->prm_label." &nbsp; : &nbsp; ".$row->prm_input." &nbsp;&nbsp;";
            } else {
                echo "DOM does not registered on database";
            }
        }
    }

    /* session report > user list */
    public function show_usrlist($eltxtusr)
    {
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $this->load->model('pages/m_crud_report');
        $query = $this->m_crud_report->select_usrlist($eltxtusr);
        ?>
        <!-- tampilkan ketika dalam mode print -->
        <div class="title" align="center" style="margin-top: 10px;">
            DAFTAR PENGGUNA (USER)<br/>
            YANG TERDAFTAR DALAM SISTEM
        </div>
        <table id="id_tblusr" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <th>NAMA USER</th>
                <th>KATA KUNCI</th>
                <th>AKSES</th>
                <th>NAMA LENGKAP</th>
                <th>OTORISASI</th>
            </tr>
            </thead>
            <tbody id="id_TbodyRptUsr">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr>";
                echo " <td>". $row->username ."</td>";
                echo " <td>". $row->password ."</td>";
                echo " <td>". $row->access ."</td>";
                echo " <td>". $row->fullname ."</td>";
                echo " <td>". $row->obj_level ."</td>";
                echo " </tr>";
            }
            ?>
            </tbody>
        </table>
        <?php
    }

    /* session report > login report */
    public function show_seslist(){
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $datarptlog=array(
            'txt_datestart'  =>$this->input->post('txt_datestart'),
            'txt_datefinish' =>$this->input->post('txt_datefinish')
        );
        $this->load->model('pages/m_crud_report');
        $query = $this->m_crud_report->select_seslist($datarptlog);
        ?>
        <!-- tampilkan ketika dalam mode print -->
        <div class="title" align="center" style="margin-top: 10px;">
            LOGIN/OUT SISTEM
        </div>
        <table id="id_tblusr" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <th>ID</th>
                <th>USER</th>
                <th>LOGIN</th>
                <th>LOGOUT</th>
                <th>STATUS</th>
            </tr>
            </thead>
            <tbody id="id_TbodyRptUsr">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr>";
                echo " <td>". $row->ses_id ."</td>";
                echo " <td>". $row->username ."</td>";
                echo " <td>". $row->ses_start ."</td>";
                echo " <td>". $row->ses_finish ."</td>";
                echo " <td>". $row->ses_status ."</td>";
                echo " </tr>";
            }
            ?>
            </tbody>
        </table>
        <?php
    }



    /***************************************************************************************************************/
    /*************************************************** SALES SAREPORT ********************************************/
    /***************************************************************************************************************/
    public function RptSls_ShowPrm1(){
        ?>
        Dari tgl.   <input type="text" id="id_DateTimePick1" class="text-inline" name="txt_trndate1" data-date-format="YYYY/MM/DD"/>&nbsp;&nbsp;&nbsp;
        Sampai tgl. <input type="text" id="id_DateTimePick2" class="text-inline" name="txt_trndate2" data-date-format="YYYY/MM/DD"/>&nbsp;&nbsp;&nbsp;
        <button class="btn-inline btn-info btn-xs" id="id_BtnSearch1"><i class="fa fa-search"></i>&nbsp; Tampilkan</button>
        <?php
    }

    public function RptSls_ShowPrm2(){
        ?>
        Dari tgl.   <input type="text" id="id_DateTimePick3" class="text-inline" name="txt_trndate3" data-date-format="YYYY/MM/DD"/>&nbsp;&nbsp;&nbsp;
        Sampai tgl. <input type="text" id="id_DateTimePick4" class="text-inline" name="txt_trndate4" data-date-format="YYYY/MM/DD"/>&nbsp;&nbsp;&nbsp;
        <button class="btn-inline btn-info btn-xs" id="id_BtnSearch2"><i class="fa fa-search"></i>&nbsp; Tampilkan</button>
        <?php
    }

    public function RptSls_ShowPrm3(){
        ?>
        Dari tgl.   <input type="text" id="id_DateTimePick5" class="text-inline" name="txt_trndate5" data-date-format="YYYY/MM/DD"/>&nbsp;&nbsp;&nbsp;
        Sampai tgl. <input type="text" id="id_DateTimePick6" class="text-inline" name="txt_trndate6" data-date-format="YYYY/MM/DD"/>&nbsp;&nbsp;&nbsp;
        <button class="btn-inline btn-info btn-xs" id="id_BtnSearch3"><i class="fa fa-search"></i>&nbsp; Tampilkan</button>
        <?php
    }

    public function RptSls_ShowRpt1(){
        $fullname = $this->session->userdata('fullname');
        $level    = $this->session->userdata('obj_level');
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        $query = $this->db->query("
            select
            cast(date_format(trn.`trn_date`, '%c') as SIGNED) AS m,
            cast(date_format(trn.`trn_date`, '%Y') as SIGNED) AS y,
            date_format(trn.`trn_date`, '%M %Y') AS `mmmy`,
            coalesce(sum(trn.`itm_qty`), 0) as qty
            from `mod_trn_itm` trn
            where trn.`trn_date` between '$date1' and '$date2'
            group by 1,2,3
            order by 2,1
        ");
        $queryttl = $this->db->query("
            select
            coalesce(sum(trn.`itm_qty`), 0) as qty
            from `mod_trn_itm` trn
            where trn.`trn_date` between '$date1' and '$date2'
        ");
        ?>
        <div style="text-align: right">
            <?php $RptFileName = "SIRAMA_SLSRPB_" . $date1 ."_". $date2 ?>
            <button id="id_BtnXls" onclick="Export2Excel('#id_TblRpt1','<?php echo $RptFileName ?>')" class="btn btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> Excel</button>
            <button id="id_BtnPrt" onclick="PrintDivElement('id_RptDiv2')" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <div id="id_RptDiv2">
            <div id="id_RptTitle">
                <div style="text-align: center;">
                    <img id="id_ImgSpo" src="<?= base_url(); ?>/assets/templ/libraries/img/mitra10.png">
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    REKAPITULASI PENJUALAN PER BULAN<br>
                    Dari tgl. <?= $date1 ?> - <?= $date2 ?>
                </div>
            </div>
            <table id="id_TblRpt1">
                <thead>
                    <tr>
                        <TH class='alLeft' width="10%">Bulan ke-</TH>
                        <TH class='alLeft' width="70%">Periode</TH>
                        <TH class='alRight' width="20%">Qty Terjual</TH>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query->result() as $row) {
                        echo " <tr style='cursor: pointer'>";
                        echo " <td class='alLeft'>". $row->m ."</td>";
                        echo " <td class='alLeft'>". $row->mmmy ."</td>";
                        echo " <td class='alRight'>". $row->qty ."</td>";
                        echo " </tr>";
                    } ?>
                </tbody>
                <tfoot>
                    <?php
                    foreach ($queryttl->result() as $row) {
                        echo " <tr>";
                        echo " <td class='alRight' colspan='2'>Total: </td>";
                        echo " <td class='alRight'>". $row->qty ."</td>";
                        echo " </tr>";
                    }
                    ?>
                </tfoot>
            </table>
            <span id="id_SignTemp1">
                <div id="id_SignTemp1Top">Denpasar, <?php echo date('Y-m-d'); ?><br> Disiapkan oleh,</div>
                <div id="id_SignTemp1Bot">(<?php echo $fullname ?>)</div>
                <div id="id_SignTemp1Lev"><?php echo $level; ?></div>
            </span>
            <style>
                #id_RptTitle{
                    padding-bottom: 10px;
                    margin-bottom: 20px;
                }
                .alLeft{text-align: left;}
                .alRight{text-align: right;}
                #id_ImgSpo{
                    width: 15%;
                    height: 15%;
                }
                table#id_TblRpt1{
                    border-collapse: collapse;
                    margin: 10px 0px 50px 0px;
                    width: 100%;
                }
                #id_TblRpt1 th, #id_TblRpt1 td{
                    border: 1px solid;
                    padding: 5px;
                }
                #id_SignTemp1{
                    width: 200px;
                    float: right;
                    text-align: center;
                }
                #id_SignTemp1Top{
                    margin-bottom: 50px;
                }
                #id_SignTemp1Bot{
                    border-bottom: 1px solid;
                }
            </style>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <?php
    }


    public function RptSls_ShowRpt2(){
        $fullname = $this->session->userdata('fullname');
        $level    = $this->session->userdata('obj_level');
        $date3 = $this->input->post('date3');
        $date4 = $this->input->post('date4');
        $query = $this->db->query("
            select
            CONCAT('(', cat.cat_code, ')  ', cat.cat_desc) as cat_desc,
            SUM(trn.itm_qty) as itm_qty
            from mod_trn_itm as trn
            join mod_itm_list as itm on trn.itm_code = itm.itm_code
            join mod_itm_cat as cat on cat.cat_code = itm.cat_code
            where trn.trn_date between '$date3' and '$date4'
            group by 1
            order by 2 desc
        ");
        $queryttl2 = $this->db->query("
            select
            SUM(trn.itm_qty) as qtyttl
            from mod_trn_itm as trn
            join mod_itm_list as itm on trn.itm_code = itm.itm_code
            join mod_itm_cat as cat on cat.cat_code = itm.cat_code
            where trn.trn_date between '$date3' and '$date4'           
        ");
        ?>
        <div style="text-align: right">
            <?php $RptFileName = "SIRAMA_SLSRPK_" . $date3 ."_". $date4 ?>
            <button id="id_BtnXls" onclick="Export2Excel('#id_TblRpt2','<?php echo $RptFileName ?>')" class="btn btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> Excel</button>
            <button id="id_BtnPrt" onclick="PrintDivElement('id_RptDiv2')" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <div id="id_RptDiv2">
            <div id="id_RptTitle">
                <div style="text-align: center;">
                    <img id="id_ImgSpo" src="<?= base_url(); ?>/assets/templ/libraries/img/mitra10.png">
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    LAPORAN REKAPITULASI PER KATEGORI<br>
                    Tgl. <?= $date3 ?> - <?= $date4 ?>
                </div>
            </div>
            <table id="id_TblRpt2">
                <thead>
                    <tr>
                        <TH class="alLeft" width="10%">No.</TH>
                        <TH class="alLeft" width="80%">(Kode) Kategori</TH>
                        <TH class="alRight" width="20%">Qty Terjual</TH>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($query->result() as $row) {
                        echo " <tr>";
                        echo " <td class='alLeft'>". $i ."</td>";
                        echo " <td class='alLeft'>". $row->cat_desc ."</td>";
                        echo " <td class='alRight'>". $row->itm_qty ."</td>";
                        echo " </tr>";
                        $i++;
                    } ?>
                </tbody>
                <tfoot>
                    <?php
                    foreach ($queryttl2->result() as $row) {
                        echo " <tr>";
                        echo " <td class='alRight' colspan='2'>Total: </td>";
                        echo " <td class='alRight'>". $row->qtyttl ."</td>";
                        echo " </tr>";
                    } ?>
                </tfoot>
            </table>
            <span id="id_SignTemp1">
                <div id="id_SignTemp1Top">Denpasar, <?php echo date('Y-m-d'); ?><br> Disiapkan oleh,</div>
                <div id="id_SignTemp1Bot">(<?php echo $fullname ?>)</div>
                <div id="id_SignTemp1Lev"><?php echo $level; ?></div>
            </span>
            <style>
                #id_RptTitle{
                    padding-bottom: 10px;
                    margin-bottom: 20px;
                }
                .alLeft{text-align: left;}
                .alRight{text-align: right;}
                #id_ImgSpo{
                    width: 15%;
                    height: 15%;
                }
                table#id_TblRpt2{
                    border-collapse: collapse;
                    margin: 10px 0px 50px 0px;
                    width: 100%;
                }
                #id_TblRpt2 th, #id_TblRpt2 td{
                    border: 1px solid;
                    padding: 5px;
                }
                #id_SignTemp1{
                    width: 200px;
                    float: right;
                    text-align: center;
                }
                #id_SignTemp1Top{
                    margin-bottom: 50px;
                }
                #id_SignTemp1Bot{
                    border-bottom: 1px solid;
                }
            </style>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <?php
    }


    public function RptSls_ShowRpt3(){
        $fullname = $this->session->userdata('fullname');
        $level    = $this->session->userdata('obj_level');
        $date5 = $this->input->post('date5');
        $date6 = $this->input->post('date6');
        $querygrp = $this->db->query("
            select
            trn.trn_date,          
            sum(trn.itm_qty) as itm_qty
            from mod_trn_itm as trn
            where trn.trn_date between '$date5' and '$date6'
            group by trn.trn_date
            order by trn_date
        ");
        $querydet = $this->db->query("
            select
            trn.trn_date,
            trn.trn_code,
            trn.itm_code,
            trn.itm_desc,
            trn.itm_qty
            from mod_trn_itm as trn
            where trn.trn_date between '$date5' and '$date6'
            order by trn_date, trn_code
        ");
        $queryttl2 = $this->db->query("
            select
            sum(trn.itm_qty) as qtyttl
            from mod_trn_itm as trn
            where trn.trn_date between '$date5' and '$date6'
        ");
        ?>
        <div style="text-align: right">
            <?php $RptFileName = "SIRAMA_SLSDPP_" . $date5 ."_". $date6 ?>
            <button id="id_BtnXls" onclick="Export2Excel('#id_TblRpt3','<?php echo $RptFileName ?>')" class="btn btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> Excel</button>
            <button id="id_BtnPrt" onclick="PrintDivElement('id_RptDiv3')" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <div id="id_RptDiv3">
            <div id="id_RptTitle">
                <div style="text-align: center;">
                    <img id="id_ImgSpo" src="<?= base_url(); ?>/assets/templ/libraries/img/mitra10.png">
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    LAPORAN DETAIL PER PERIODE<br>
                    Tgl. <?= $date5 ?> - <?= $date6 ?>
                </div>
            </div>
            <table id="id_TblRpt3">
                <thead id="id_TblRpt3Thead">
                <tr>
                    <TH class="alLeft" width="5%">No.</TH>
                    <TH class="alLeft" width="20%">No. Bill</TH>
                    <TH class="alLeft" width="10%">Kd. Item</TH>
                    <TH class="alLeft" width="55%">Nm. Item</TH>
                    <TH class="alRight" width="10%">Qty Terjual</TH>
                </tr>
                </thead>
                <tbody id="id_TblRpt3Tbody">
                <?php
                foreach ($querygrp->result() as $row) {
                    /* group header */
                    ?>
                    <tr bgcolor="#d3d3d3">
                        <td colspan="5"><em>Tanggal: <?=$row->trn_date?></em></td>
                    </tr>
                    <!-- group data -->
                    <?php
                    $no = 1;
                    foreach($querydet->result() as $rowd){
                        if($rowd->trn_date == $row->trn_date){
                            ?>
                            <tr>
                                <td class='alLeft'><?=$no?></td>
                                <td class='alLeft'><?=$rowd->trn_code?></td>
                                <td class='alLeft'><?=$rowd->itm_code?></td>
                                <td class='alLeft'><?=$rowd->itm_desc?></td>
                                <td class='alRight'><?=$rowd->itm_qty?></td>
                            </tr>
                            <?php
                        } else {
                            $no = 0;
                        }
                        $no++;
                    }
                    /* group footer */
                    $querysub = $this->db->query("
                        select sum(itm_qty) as itm_qty
                        from mod_trn_itm where trn_date = '$row->trn_date'
                    ");
                    foreach($querysub->result() as $rowb){
                        ?>
                        <tr bgcolor="#d3d3d3">
                            <td class="alRight" colspan="4"><em>Subtotal:</td>
                            <td class="alRight"><em><?=$rowb->itm_qty?></em></td>
                        </tr>
                        <?php
                    }
                } ?>
                </tbody>
                <tfoot id="id_TblRpt3Tfoot">
                <?php
                foreach ($queryttl2->result() as $row) {
                    echo " <tr>";
                    echo " <td colspan='4' class='alRight'>Total: </td>";
                    echo " <td class='alRight'>". $row->qtyttl ."</td>";
                    echo " </tr>";
                } ?>
                </tfoot>
            </table>
            <span id="id_SignTemp1">
                <div id="id_SignTemp1Top">Denpasar, <?php echo date('Y-m-d'); ?><br> Disiapkan oleh,</div>
                <div id="id_SignTemp1Bot">(<?php echo $fullname ?>)</div>
                <div id="id_SignTemp1Lev"><?php echo $level; ?></div>
            </span>
            <style>
                #id_RptTitle{
                    padding-bottom: 10px;
                    margin-bottom: 20px;
                }
                .alLeft{text-align: left;}
                .alRight{text-align: right;}
                #id_ImgSpo{
                    width: 15%;
                    height: 15%;
                }
                table#id_TblRpt3{
                    border-collapse: collapse;
                    margin: 10px 0px 50px 0px;
                    width: 100%;
                }
                #id_TblRpt3 th, #id_TblRpt3 td{
                    border: 1px solid;
                    padding: 5px;
                }
                #id_SignTemp1{
                    width: 200px;
                    float: right;
                    text-align: center;
                }
                #id_SignTemp1Top{
                    margin-bottom: 50px;
                }
                #id_SignTemp1Bot{
                    border-bottom: 1px solid;
                }
            </style>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <?php
    }


    // Fungsi generate table WMA berdasarkan parameter
    public function RptFrc_ShowRpts($cat_code, $cat_desc){
        $fullname = $this->session->userdata('fullname');
        $level    = $this->session->userdata('obj_level');
        $query1 = $this->db->query("
            select DISTINCT record_by, record_date
            from mod_trn_forc a
            where cat_code = '$cat_code'
            order by record_by DESC limit 1
        ");
        $query4 = $this->db->query("select * from vw_mod_forc_table where cat_code = '$cat_code' and mmmy not in ('Jumlah','Rata-rata')");
        $query5 = $this->db->query("select * from vw_mod_forc_table where cat_code = '$cat_code' and mmmy in ('Jumlah')");
        $query6 = $this->db->query("select * from vw_mod_forc_table where cat_code = '$cat_code' and mmmy in ('Rata-rata')");
        ?>
        <div style="text-align: right">
            <?php $RptFileName = "SIRAMA_FRC_" . $cat_code ."_". $cat_desc ?>
            <button id="id_BtnXls" onclick="Export2Excel('#id_TblRpt4','<?php echo $RptFileName ?>')" class="btn btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> Excel</button>
            <button id="id_BtnPrt" onclick="PrintDivElement('id_RptDiv4')" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <div id="id_RptDiv4">
            <div id="id_RptTitle">
                <div style="text-align: center;">
                    <img id="id_ImgSpo" src="<?= base_url(); ?>/assets/templ/libraries/img/mitra10.png">
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    TABEL <em>WEIGHTED MOVING AVERAGE</em><br>
                    <?php echo "KATEGORI: " . strtoupper($cat_desc) ."<br>"; ?>
                </div>
                <div style="text-align: right; font-size: x-small;">
                    <?php
                    foreach($query1->result() as $row){
                        echo "<em>Proceed by $row->record_by on $row->record_date.</em>";
                    }
                    ?>
                </div>
            </div>
            <table id="id_TblRpt4">
                <thead>
                <tr class="titlerow">
                    <TH width="5%" class="trnOpt">No.</TH>
                    <TH width="15%">&nbsp;Periode <i>(t)</i></TH>
                    <TH width="10%" class="alRight">&nbsp;Actual <i>(A<sub>t</sub>)</i></TH>
                    <TH width="10%" class="alRight">&nbsp;Forecast <i>(F<sub>t</sub>)</i></TH>
                    <TH width="15%" class="alRight">&nbsp;Error <i>(A<sub>t</sub>-F<sub>t</sub>)</i></TH>
                    <TH width="15%" class="alRight">&nbsp;Absolute <i>(MAD)</i></TH>
                    <TH width="15%" class="alRight">&nbsp;Squared <i>(MSE)</i></TH>
                    <TH width="15%" class="alRight">&nbsp;% <i>(MAPE)</i></TH>
                </tr>
                </thead>
                <tbody>
                <!-- data -->
                <?php foreach ($query4->result() as $row) { ?>
                    <tr>
                        <td class="trnOpt"><?= $row->no ?></td>
                        <td><?= $row->mmmy ?></td>
                        <td class="alRight"><?= $row->qty ?></td>
                        <td class="alRight"><?= $row->wma ?></sub></td>
                        <td class="alRight"><?= $row->error ?></td>
                        <td class="alRight"><?= $row->mad ?></td>
                        <td class="alRight"><?= $row->mse ?></td>
                        <td class="alRight"><?= $row->mape ?></td>
                    </tr>
                <?php } ?>
                <!-- sum -->
                <?php foreach ($query5->result() as $row) { ?>
                    <tr class="trnTtl">
                        <td class="trnOpt"></td>
                        <td></td>
                        <td class="alRight"></td>
                        <td class="alRight">Sigma (&#931;)</sub></td>
                        <td class="alRight"><?= $row->error ?></td>
                        <td class="alRight"><?= $row->mad ?></td>
                        <td class="alRight"><?= $row->mse ?></td>
                        <td class="alRight"><?= $row->mape ?></td>
                    </tr>
                <?php } ?>
                <!-- avg -->
                <?php foreach ($query6->result() as $row) { ?>
                    <tr class="trnTtl">
                        <td class="trnOpt"></td>
                        <td></td>
                        <td class="alRight"></td>
                        <td class="alRight">Mean (X&#772;)</sub></td>
                        <td class="alRight"><?= $row->error ?></td>
                        <td class="alRight"><?= $row->mad ?></td>
                        <td class="alRight"><?= $row->mse ?></td>
                        <td class="alRight"><?= $row->mape ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <span id="id_SignTemp1">
                <div id="id_SignTemp1Top">Denpasar, <?php echo date('Y-m-d'); ?><br> Disiapkan oleh,</div>
                <div id="id_SignTemp1Bot">(<?php echo $fullname ?>)</div>
                <div id="id_SignTemp1Lev"><?php echo $level; ?></div>
            </span>
            <style>
                #id_RptTitle{
                    padding-bottom: 10px;
                    margin-bottom: 20px;
                }
                .alLeft{text-align: left;}
                .alRight{text-align: right;}
                #id_ImgSpo{
                    width: 15%;
                    height: 15%;
                }
                table#id_TblRpt4{
                    border-collapse: collapse;
                    margin: 10px 0px 50px 0px;
                    width: 100%;
                }
                #id_TblRpt4 th, #id_TblRpt4 td{
                    border: 1px solid;
                    padding: 5px;
                }
                #id_SignTemp1{
                    width: 200px;
                    float: right;
                    text-align: center;
                }
                #id_SignTemp1Top{
                    margin-bottom: 50px;
                }
                #id_SignTemp1Bot{
                    border-bottom: 1px solid;
                }
            </style>
            <canvas id="canvas"><!-- chart will be created here --></canvas>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <?php
    }

    // report forecast
    public function RptFrc_ShowRpt1(){
        $this->RptFrc_ShowRpts('','ALL');
    }

    public function RptFrc_ShowRpt2(){
        $selKatVal = $this->input->post('selKatVal');
        $selKatTxt = $this->input->post('selKatTxt');
        $this->RptFrc_ShowRpts($selKatVal, $selKatTxt);
    }

    public function RptFrc_ShowRpt3(){
        $selKatVal = $this->input->post('itmCode');
        $selKatTxt = $this->input->post('itmDesc');
        $this->RptFrc_ShowRpts($selKatVal, $selKatTxt);
    }

    public function RptFrc_ShowPrm4(){
        ?>
        Periode   <input type="text" id="id_DateTimePick1" class="text-inline" name="txt_trndate1" data-date-format="MMMM YYYY"/>
        <button class="btn-inline btn-info btn-xs" id="id_BtnSearch1"><i class="fa fa-search"></i>&nbsp; Tampilkan</button>
        <?php
    }

    public function RptFrc_ShowRpt4(){
        $fullname = $this->session->userdata('fullname');
        $level    = $this->session->userdata('obj_level');
        $RptPeriod = $this->input->post('RptPeriod');
        $query = $this->db->query("
            select
            cat.`cat_desc` as sub_category,
            itm.`itm_code` as itm_code,
            itm.`itm_desc` as itm_desc,
            itm.`itm_unit` as itm_unit,
            round(frc.`qty`,2) as act_sales,
            round(frc.`wma`,2) as frc_sales
            from `mod_trn_forc` as frc
            join `mod_itm_list` as itm on itm.`itm_code` = frc.`cat_code`
            join `mod_itm_cat` as cat on cat.`cat_code` = itm.`cat_code`
            where frc.`mmmy` = '$RptPeriod'
            order by sub_category, frc_sales desc;
        ");
        ?>
        <div style="text-align: right">
            <?php $RptFileName = "SIRAMA_SUG_" . $RptPeriod ?>
            <button id="id_BtnXls" onclick="Export2Excel('#id_TblRpt5','<?php echo $RptFileName ?>')" class="btn btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> Excel</button>
            <button id="id_BtnPrt" onclick="PrintDivElement('id_RptDiv5')" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <div id="id_RptDiv5">
            <div id="id_RptTitle">
                <div style="text-align: center;">
                    <img id="id_ImgSpo" src="<?= base_url(); ?>/assets/templ/libraries/img/mitra10.png">
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    <em>SUGGEST ORDER</em><br>
                    <?php echo "PERIODE: " . strtoupper($RptPeriod) ."<br>"; ?>
                </div>
            </div>
            <table id="id_TblRpt5">
                <thead>
                <tr class="titlerow">
                    <TH width="8%" class="alLeft">Kode Item</TH>
                    <TH width="37%" class="alLeft">Nama Item</TH>
                    <TH width="10%" class="alRight">Penj. Aktual (qty)</TH>
                    <TH width="10%" class="alRight">Penj. <em>Forecast</em> (qty)</TH>
                    <TH width="5%" class="alLeft">Unit</TH>
                </tr>
                </thead>
                <tbody>
                <!-- data -->
                <?php $lastsub_category = 'havenotseeinityet'; ?>
                <?php foreach ($query->result() as $row) { ?>
                    <?php
                    if($lastsub_category != $row->sub_category) {
                        $lastsub_category = $row->sub_category;
                        ?>
                        <tr bgcolor="#d3d3d3">
                            <td class="alLeft" colspan="5"><em>Kategori: <?= $row->sub_category ?></em></td>
                        </tr>
                        <tr>
                            <td class="alLeft"><?= $row->itm_code ?></td>
                            <td class="alLeft"><?= $row->itm_desc ?></sub></td>
                            <td class="alRight"><?= $row->act_sales ?></td>
                            <td class="alRight"><?= $row->frc_sales ?></td>
                            <td class="alLeft"><?= $row->itm_unit ?></td>
                        </tr>
                    <?php } else {
                        ?>
                        <tr>
                            <td class="alLeft"><?= $row->itm_code ?></td>
                            <td class="alLeft"><?= $row->itm_desc ?></sub></td>
                            <td class="alRight"><?= $row->act_sales ?></td>
                            <td class="alRight"><?= $row->frc_sales ?></td>
                            <td class="alLeft"><?= $row->itm_unit ?></td>
                        </tr>
                        <?php
                    } ?>
                <?php } ?>
                </tbody>
            </table>
            <span id="id_SignTemp1">
                <div id="id_SignTemp1Top">Denpasar, <?php echo date('Y-m-d'); ?><br> Disiapkan oleh,</div>
                <div id="id_SignTemp1Bot">(<?php echo $fullname ?>)</div>
                <div id="id_SignTemp1Lev"><?php echo $level; ?></div>
            </span>
            <style>
                #id_RptTitle{
                    padding-bottom: 10px;
                    margin-bottom: 20px;
                }
                .alLeft{text-align: left;}
                .alRight{text-align: right;}
                #id_ImgSpo{
                    width: 15%;
                    height: 15%;
                }
                table#id_TblRpt5{
                    border-collapse: collapse;
                    margin: 10px 0px 50px 0px;
                    width: 100%;
                }
                #id_TblRpt5 th, #id_TblRpt5 td{
                    border: 1px solid;
                    padding: 5px;
                }
                #id_SignTemp1{
                    width: 200px;
                    float: right;
                    text-align: center;
                }
                #id_SignTemp1Top{
                    margin-bottom: 50px;
                }
                #id_SignTemp1Bot{
                    border-bottom: 1px solid;
                }
            </style>
        </div>
        <!------------------------------------- print layout ------------------------------------->
        <?php
    }
}
?>