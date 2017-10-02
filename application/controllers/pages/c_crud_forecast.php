<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_crud_forecast extends CI_Controller
{

    /* i. function construct */
    function __construct()
    {
        parent::__construct();
    }


    /* show recap all transaction by qty */
    public function show_rekappenj(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_forecast');
        ini_set('max_execution_time', 600); //600 seconds = 60 minutes
        $query = $this->m_crud_forecast->select_penj();
        ?>
        <table id="id_tblPenj" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr class="titlerow">
                <TH width="5%" class="trnNum"> No.</TH>
                <TH width="20%" class='trnNum'> Bulan ke-</TH>
                <TH width="20%"class='trnOpt'>&nbsp;Tahun</TH>
                <TH width="40%">&nbsp;Periode</TH>
                <TH width="15%" class="trnNum">&nbsp;Qty</TH>
            </tr>
            </thead>
            <tbody id="id_TbodyRptTrn">
                <?php
                foreach ($query->result() as $row) {
                    echo " <tr>";
                    echo " <td class='trnNum'>". $row->no ."</td>";
                    echo " <td class='trnNum'>". $row->m ."</td>";
                    echo " <td class='trnOpt'>". $row->y ."</td>";
                    echo " <td>". $row->mmmy ."</td>";
                    echo " <td class='trnNum'>". $row->qty ."</td>";
                    echo " </tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="totalColumn">
                </tr>
            </tfoot>
        </table>
        <style>.trnNum{text-align: right;} .trnOpt{text-align: center;}</style>
        <?php
    }

    // show element select ketika radio button diklik
    public function show_rekapkat(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_forecast');
        $query = $this->m_crud_forecast->select_cat();
        echo "<option>- PILIH -</option>";
        foreach ($query->result() as $row){
            echo "<option value='$row->cat_code'>" . $row->cat_desc . "</option>";
        }
    }

    /* show recap category transaction by qty */
    public function show_rekappenjkat(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        ini_set('max_execution_time', 600); //600 seconds = 60 minutes
        $this->load->model('pages/m_crud_forecast');
        $query = $this->m_crud_forecast->select_penjkat();
        ?>
        <table id="id_tblPenj" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr class="titlerow">
                <TH width="5%" class="trnNum"> No.</TH>
                <TH width="20%" class='trnNum'> Bulan ke-</TH>
                <TH width="20%"class='trnOpt'>&nbsp;Tahun</TH>
                <TH width="40%">&nbsp;Periode</TH>
                <TH width="15%" class="trnNum">&nbsp;Qty</TH>
            </tr>
            </thead>
            <tbody id="id_TbodyRptTrn">
                <?php
                foreach ($query->result() as $row) {
                    echo " <tr>";
                    echo " <td class='trnNum'>". $row->no ."</td>";
                    echo " <td class='trnNum'>". $row->m ."</td>";
                    echo " <td class='trnOpt'>". $row->y ."</td>";
                    echo " <td>". $row->mmmy ."</td>";
                    echo " <td class='trnNum'>". $row->qty ."</td>";
                    echo " </tr>";
                }
                ?>
            </tbody>
            <tfoot>
            <tr class="totalColumn">
            </tr>
            </tfoot>
        </table>
        <style>.trnNum{text-align: right;} .trnOpt{text-align: center;}</style>
        <?php
    }

    // fungsi tampilkan konten modal peramalan per item
    public function show_top5itm(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_forecast');
        $query = $this->m_crud_forecast->select_top5itm();
        ?>
        <h4>Pilih salah satu item dengan penjualan terbaik bulan ini!</h4>
        <table id="id_tblTop5Itm" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr class="titlerow">
                <TH width="1%"> No.</TH>
                <TH width="14%"> Kode</TH>
                <TH width="45%">&nbsp;Nm. Item</TH>
                <TH width="15%" class="trnNum">&nbsp;Qty</TH>
                <TH width="35%" class="trnNum">&nbsp;Diproses</TH>
            </tr>
            </thead>
            <tbody id="id_TbodyRptTrn">
            <?php
            $i=1;
            foreach ($query->result() as $row) {
                echo " <tr>";
                echo " <td>". $i ."</td>";
                echo " <td>". $row->itm_code ."</td>";
                echo " <td>". $row->itm_desc ."</td>";
                echo " <td class='trnNum'>". $row->qty . " " . $row->itm_unit ."</td>";
                echo " <td class='trnNum'>".  $row->status ."</td>";
                echo " </tr>";
                $i++;
            }
            ?>
            </tbody>
        </table>
        <style>
            .trnNum{text-align: right;}
            .trnOpt{text-align: center;}
            tbody tr{cursor: pointer;}
        </style>
        <?php
    }

    // show rekap penj by item
    public function show_rekappenjitm(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        ini_set('max_execution_time', 600); //600 seconds = 60 minutes
        $this->load->model('pages/m_crud_forecast');
        $query = $this->m_crud_forecast->select_penjitm();
        ?>
        <table id="id_tblPenj" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr class="titlerow">
                <TH width="5%" class="trnNum"> No.</TH>
                <TH width="20%" class='trnNum'> Bulan ke-</TH>
                <TH width="20%"class='trnOpt'>&nbsp;Tahun</TH>
                <TH width="40%">&nbsp;Periode</TH>
                <TH width="15%" class="trnNum">&nbsp;Qty</TH>
            </tr>
            </thead>
            <tbody id="id_TbodyRptTrn">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr>";
                echo " <td class='trnNum'>". $row->no ."</td>";
                echo " <td class='trnNum'>". $row->m ."</td>";
                echo " <td class='trnOpt'>". $row->y ."</td>";
                echo " <td>". $row->mmmy ."</td>";
                echo " <td class='trnNum'>". $row->qty ."</td>";
                echo " </tr>";
            }
            ?>
            </tbody>
            <tfoot>
            <tr class="totalColumn">
            </tr>
            </tfoot>
        </table>
        <style>.trnNum{text-align: right;} .trnOpt{text-align: center;}</style>
        <?php
    }


    // fungsi isi combobox paramter di box kanan
    public function show_cbxperiode(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_forecast');
        $query = $this->m_crud_forecast->select_period();
        foreach ($query->result() as $row){
            echo "<option class='checkbox' value='$row->no'>" . $row->mmmy . "</option>";
        }
    }


    // fungsi show table wma box kanan
    public function show_wmatbl(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_forecast');
        $query = $this->m_crud_forecast->select_tmptbl();
        ?>
        <table id="id_tblWma" class="display compact table-hover" role="grid" aria-describedby="example2_info">
        <thead>
        <tr class="titlerow">
            <TH width="5%" class="trnNum"></TH>
            <TH width="35%">&nbsp;Periode</TH>
            <TH width="10%" class="trnNum">&nbsp;Qty</TH>
        </tr>
        </thead>
        <tbody id="id_TbodyRptTrn">
            <?php
            $rw = 0; // untuk id masing2 chx
            foreach ($query->result() as $row) {
                echo " <tr class='rwTblWma'>";
                echo " <td><input id='id_cbxWmas_$rw' type='checkbox' class='cbxWmas' name='cbxWmadd[]' value='$row->no' disabled></td>";
                echo " <td>". $row->mmmy ."</td>";
                echo " <td class='trnNum'>". $row->qty ."</td>";
                echo " </tr>";
                $rw++;
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="totalColumn">
            </tr>
        </tfoot>
        </table>
        <style>.trnNum{text-align: right;} .trnOpt{text-align: center;}</style>
        <?php
    }

    // fungsi show tabel wma 2 (bawah)
    public function calcWMA(){
        $this->pageauth->sess_auth();
        /**************************** tahap 0 ambil POST data ****************************/
        date_default_timezone_set("Asia/Singapore");
        $username = $this->session->userdata('username');
        $myCheckboxes = $this->input->post('myCheckboxes');
        $id_parPeriod2 = $this->input->post('id_parPeriod2');
        $selKat = $this->input->post('selKat');
        $selKatVal = $this->input->post('selKatVal');
        $ItmCode = $this->input->post('ItmCode');

        /**************************** tahap 1 delete insert ******************************/
        // call a function delete then insert
        $this->db->query("call f_mod_gen_forc_hist($id_parPeriod2)");
        $countchecked = count($myCheckboxes); // jumlah checkboxes yang tercentang

        /**************************** tahap 2 hitung WMA *********************************/
        $this->db->query("delete from mod_trn_forc where cat_code = '$selKatVal'");       // delete data hasil forecast
        $query3 = $this->db->query("select * from _tmp_mod_forc_hist");
        /* inisialisasi variable */
        $p = count($query3->result())-1;                    // jumlah data
        $y = $countchecked;                                 // jumlah tercentang
        $z = 0;                                             // counter 2
        $Eqw = 0;                                           // nilai awal SUM(Dt * Botot)
        $Ew  = 0;                                           // nilai awal SUM(bobot)
        // simpan data no ke array
        $arryno = array();
        foreach ($query3->result() as $row){
            $arryno[] = $row->no;
        }
        // simpan data periode ke array
        $arrymm = array();
        foreach ($query3->result() as $row){
            $arrymm[] = $row->mmmy;
        }
        // simpan data qty ke array
        $arryqty = array();
        foreach ($query3->result() as $row){
            $arryqty[] = $row->qty;
        }

        /********************************************* WEIGHTED MOVING AVERAGE *******************************************/
        $s = $y;
        for($q=0; $q<=$p; $q++){                                            // loop sebanyak data
            if($q>=$y){                                                     // jika iterasi data >= periode terpilih
                $w = 1;                                                     // nilai awal Weight
                for($n=$z; $n<=$y-1; $n++){                                 // loop sebanyak data terpilih
                                                                            // echo " (" . $arryqty[$n] . " x " . $w . ") "; // log: WMA
                    $qw     = $arryqty[$n] * $w;                            // WMA = Dt * Botot
                    $Eqw    = $Eqw + $qw;                                   // WMA = SUM(Dt * Botot)
                    $Ew     = $Ew + $w;                                     // WMA = SUM(Bobot)
                    $w++;                                                   // nilai weight ditambah 1 selama looping
                }
                $wma = $Eqw/$Ew;                                            // WMA = SUM(Dt * Bobot)/SUM(Bobot)
                $err = $arryqty[$q] - $wma;                                 // ERROR = (aktual qty) - WMA
                if ($err<0){
                    $mad = $err * (-1);
                } else {
                    $mad = $err;                                            // MAD = abaikan nilai minus ERROR
                }
                $mse = exp(2 * log($mad));                                  // MSE = MAD(pangkat 2)
                if($arryqty[$q]==0){
                    $mape = 0;
                } else {
                    $mape = $mad/$arryqty[$q] * 100;                        // MAPE = MAD/Aktual Qty
                    $mape = round($mape,2);
                }
                $dataforecast = array(                                      // simpan data forecast ke array
                    'record_by' => $username,
                    'record_date' => date('Y-m-d H:i:s'),
                    'cat_code' => $selKatVal,
                    'no'    => ($q+1),
                    'mmmy'  => $arrymm[$q],
                    'qty'   => $arryqty[$q],
                    'wma'   => $wma,
                    'error' => $err,
                    'MAD'   => $mad,
                    'MSE'   => $mse,
                    'MAPE'  => $mape
                );
                $this->db->insert('mod_trn_forc', $dataforecast);           // insert data forecast ke db

                /*log log log log log log log log log log log log log log log log*/
                // echo " err = " . $arryqty[$q] . " - " . $wma; // log: ERROR
                // echo " mad = " . $mad . " (Absolut +)"; // log: MAD
                // echo " mse = " . $mad . "<sup>2</sup>"; // log: MSE
                // echo " mape = " . $mad . "/" . $arryqty[$q] . "<br>"; // log: MAPE
                /*log log log log log log log log log log log log log log log log*/

                $w = 0;                                                     // nilai weight kembali jadi 0 setelah looping
                $y++; $z++; $Eqw=0; $Ew=0;                                  // kembalikan variable ke 0 dan tambah 1
            } else {
                                                                            // echo "  |  " . ($q+1) . "  |  " . $arrymm[$q] . "  |  " . $arryqty[$q] . "  |  null | null | null | null | null<br>";
                $datahistory = array(                                       // simpan data history ke array
                    'record_by' => $username,
                    'record_date' => date('Y-m-d H:i:s'),
                    'cat_code' => $selKatVal,
                    'no'    => ($q+1),
                    'mmmy'  => $arrymm[$q],
                    'qty'   => $arryqty[$q],
                    'wma'   => NULL,
                    'error' => NULL,
                    'MAD'   => NULL,
                    'MSE'   => NULL,
                    'MAPE'  => NULL
                );
                $this->db->insert('mod_trn_forc', $datahistory);            // insert data history ke db
            }
        }
        /********************************************* WEIGHTED MOVING AVERAGE *******************************************/

        /********************* tahap 3 tampilkan data ke tabel WMA ***********************/
        $query4 = $this->db->query("select * from vw_mod_forc_table where cat_code = '$selKatVal' and mmmy not in ('Jumlah','Rata-rata')");
        $query5 = $this->db->query("select * from vw_mod_forc_table where cat_code = '$selKatVal' and mmmy in ('Jumlah')");
        $query6 = $this->db->query("select * from vw_mod_forc_table where cat_code = '$selKatVal' and mmmy in ('Rata-rata')");
        ?>
        <p class="text-center"><strong>
            <?php
                if($selKatVal!=''){
                    echo "TABEL WMA UNTUK KATEGORI " . strtoupper($selKatVal);
                } else {
                    echo "TABEL WMA UNTUK SEMUA KATEGORI";
                }
            ?>
        </strong></p>
        <table id="id_tblCalcWma" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
                <tr class="titlerow">
                    <TH width="5%" class="trnOpt">No.</TH>
                    <TH width="15%">&nbsp;Periode <i>(t)</i></TH>
                    <TH width="10%" class="trnNum">&nbsp;Actual <i>(A<sub>t</sub>)</i></TH>
                    <TH width="10%" class="trnNum">&nbsp;Forecast <i>(F<sub>t</sub>)</i></TH>
                    <TH width="15%" class="trnNum">&nbsp;Error <i>(A<sub>t</sub>-F<sub>t</sub>)</i></TH>
                    <TH width="15%" class="trnNum">&nbsp;Absolute <i>(MAD)</i></TH>
                    <TH width="15%" class="trnNum">&nbsp;Squared <i>(MSE)</i></TH>
                    <TH width="15%" class="trnNum">&nbsp;% <i>(MAPE)</i></TH>
                </tr>
            </thead>
            <tbody>
            <!-- data -->
            <?php foreach ($query4->result() as $row) { ?>
                <tr>
                    <td class="trnOpt"><?= $row->no ?></td>
                    <td><?= $row->mmmy ?></td>
                    <td class="trnNum At trnTtl"><?= $row->qty ?></td>
                    <td class="trnNum Ft trnTtl"><?= $row->wma ?></sub></td>
                    <td class="trnNum"><?= $row->error ?></td>
                    <td class="trnNum"><?= $row->mad ?></td>
                    <td class="trnNum"><?= $row->mse ?></td>
                    <td class="trnNum"><?= $row->mape ?></td>
                </tr>
            <?php } ?>
            <!-- sum -->
            <?php foreach ($query5->result() as $row) { ?>
                <tr class="trnTtl">
                    <td class="trnOpt"></td>
                    <td></td>
                    <td class="trnNum"></td>
                    <td class="trnNum">Sigma (&#931;)</sub></td>
                    <td class="trnNum"><?= $row->error ?></td>
                    <td class="trnNum"><?= $row->mad ?></td>
                    <td class="trnNum"><?= $row->mse ?></td>
                    <td class="trnNum"><?= $row->mape ?></td>
                </tr>
            <?php } ?>
            <!-- avg -->
            <?php foreach ($query6->result() as $row) { ?>
                <tr class="trnTtl">
                    <td class="trnOpt"></td>
                    <td></td>
                    <td class="trnNum"></td>
                    <td class="trnNum">Mean (X&#772;)</sub></td>
                    <td class="trnNum"><?= $row->error ?></td>
                    <td class="trnNum"><?= $row->mad ?></td>
                    <td class="trnNum"><?= $row->mse ?></td>
                    <td class="trnNum"><?= $row->mape ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <style> .trnTtl{font-weight: bold;} .At{color: blue;} .Ft{color: orange;}</style>
        <?php
    }

    // chrat data
    public function showChartWmaData(){
        $this->pageauth->sess_auth();
        $selKatVal = $this->input->post('selKatVal');
        $query = $this->db->query("select mmmy, qty, wma from vw_chart_forc_data where cat_code = '$selKatVal'");
        $data = array();
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    // show mean value
    public function showMeanVal(){
        $this->pageauth->sess_auth();
        $selKatVal = $this->input->post('selKatVal');
        $query = $this->db->query("select * from vw_mod_forc_info where cat_code = '$selKatVal'");
        foreach($query->result() as $row){
            ?>
            <li>
                <a href="#">
                    <i class="fa fa-arrow-right">&nbsp;&nbsp;&nbsp;<?= $row->description ?></i>
                    <span class="pull-right badge <?= $row->color ?>"><?= $row->value ?></span>
                </a>
            </li>
            <?php
        }
    }
}
?>