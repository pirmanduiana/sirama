<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_crud_trans extends CI_Controller
{

    /* i. function construct */
    function __construct()
    {
        parent::__construct();
    }


    /* get doc number */
    public function getDocNum(){
        $this->load->model('mlogin');
        $dateVal = $this->input->post('dateVal');
        $query = $this->mlogin->getdocnum($dateVal);
        foreach($query->result() as $row){
            echo $row->docnumber;
        }
    }

    /* item list untuk diperlihatkan di modal */
    public function show_itmlist()
    {
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_trans');
        $query = $this->m_crud_trans->select_itmlist();
        ?>
        <table id="id_tblItm" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <th>KODE</th>
                <th>DESC</th>
                <th>CAT.</th>
            </tr>
            </thead>
            <tbody id="id_TbodyTblItm">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr class='rwTblItm' style='cursor: pointer'>";
                echo " <td>". $row->itm_code ."</td>";
                echo " <td>". $row->itm_desc ."</td>";
                echo " <td>". $row->cat_code ."</td>";
                echo " </tr>";
            } ?>
            </tbody>
        </table>
        <?php
    }


    /* show transaction */
    public function show_trans($trndate){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_trans');
        $query = $this->m_crud_trans->select_trans($trndate);
        $query2 = $this->m_crud_trans->select_sumqty($trndate);
        ?>
        <table id="id_tblTrn" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr class="titlerow">
                <TH width="10%">&nbsp;Line</TH>
                <TH width="20%">&nbsp;Pilih Item</TH>
                <TH width="40%">&nbsp;Nama Item</TH>
                <TH width="10%" class="trnNum">&nbsp;Qty Item</TH>
                <TH width="20%" class="trnOpt">Pilihan</TH>
            </tr>
            </thead>
            <tbody id="id_TbodyRptTrn">
                <?php
                foreach ($query->result() as $row) {
                    echo " <tr>";
                    echo " <td>". $row->trn_seq ."</td>";
                    echo " <td>". $row->itm_code ."</td>";
                    echo " <td>". $row->itm_desc ."</td>";
                    echo " <td class='trnNum'>". $row->itm_qty ."</td>";
                    echo " <td class='trnOpt'>
                            <span class='btn btn-default btn-xs'><a onclick='edituser($row->trn_seq)'><i class='fa fa-edit'></i> Edit</a></span>
                            <span class='btn btn-default btn-xs'><a onclick='deluser($row->trn_seq)'><i class='fa fa-trash'></i> Del</a></span>                     
                           </td>";
                    echo " </tr>";
                }
                ?>
            </tbody>
            <tfoot>
            <tr class="totalColumn">
                <td colspan="3" align="right">&nbsp;<b>T o t a l : </b></td>
                <td width="10%" id="id_celSumQty" class="trnNum">
                    <?php
                    if($query2->num_rows() == 0){
                        echo "<b>0</b>";
                    } else {
                        foreach ($query2->result() as $row2) {
                            echo "<b>" . $row2->ttlqty . "</b>";
                        }
                    }
                    ?>
                </td>
                <td width="20%">&nbsp;</td>
            </tr>
            </tfoot>
        </table>
        <style>.trnNum{text-align: right;} .trnOpt{text-align: center;}</style>
        <?php
    }

    /* show number of trans row on particular date */
    public function show_numtrans(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $txt_tmpText = $this->input->post('txt_tmpText');
        $this->load->model('pages/m_crud_trans');
        $query = $this->m_crud_trans->select_sumqty($txt_tmpText);
        if($query->num_rows()==0){
            echo 0;
        } else {
            echo 1;
        }
    }

    /* show trans after date change */
    public function show_trn_afterdatechg(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $dateVal  = $this->input->post('dateVal');
        $this->show_trans($dateVal);
    }


    /* insert transaction */
    public function create_trans(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_trans');
        $this->m_crud_trans->insert_trans();
        // setelah insert select lagi transaksinya
        $txt_tmpText = $this->input->post('txt_tmpText');
        $this->show_trans($txt_tmpText);
    }


    /* ambil informasi data untuk edit baris */
    public function show_1trans(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $trn_seq  = $this->input->post('trn_seq');
        $this->load->model('pages/m_crud_trans');
        $query = $this->m_crud_trans->select_1trans($trn_seq);
        // data dikoleksi di JSON
        $arrow = array();
        foreach ($query->result() as $row) {
            $arrow = $row;
        } echo json_encode($row);
    }

    /* hapus data yang dipilih */
    public function del_1trans(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $trn_seq  = $this->input->post('trn_seq');
        $this->load->model('pages/m_crud_trans');
        $query = $this->m_crud_trans->delete_1trans($trn_seq);
        // setelah delete, select lagi transaksinya
        $txt_tmpText = $this->input->post('txt_tmpText');
        $this->show_trans($txt_tmpText);
    }


    /* fungsi import excel */
    public function proc_imp() {
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $this->load->model('pages/m_crud_trans');
        $datatype = $this->uri->segment(4);
        ini_set('max_execution_time', 600); //600 seconds = 60 minutes
        ini_set('memory_limit', '-1'); // overide memory limit of php.ini
        $row = 1; // utk skip header table
        $rcount = 0; // utk count jumlah baris data
        if(!empty($_FILES['csv']['size']) && $_FILES['csv']['size'] > 0){
            /* delete before insert */
            if($datatype == "trans"){
                // $this->m_crud_trans->delete_importtrn();
            } else if($datatype == "mscat") {
                $this->m_crud_trans->delete_importitm();
                $this->m_crud_trans->delete_importcat();
            } else if($datatype == "msitm") {
                $this->m_crud_trans->delete_importitm();
            } else {
                echo "Jenis data tidak ditentukan";
            }

            /* prepare progressbar buffer */
            ?>
            <span id="id_PrgFnm"></span><br>
            <progress id="id_progress" value="0" max="100"></progress>
            <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/templ/libraries/css/progress.css">
            <?php
            ob_implicit_flush(true);

            /* begin iteration */
            $file = $_FILES['csv']['tmp_name'];
            $handle = fopen($file,"r");
            while ($data = fgetcsv($handle,100000,",","'")){
                if($row == 1){ $row++; continue; } // skip the header table on excel.
                if ($data[0]) {
                    // load model insert_import, pass $data agar model mengenali data csv
                    if($datatype == "trans"){
                        $this->m_crud_trans->insert_import_trn($data);
                    } else if($datatype == "mscat") {
                        $this->m_crud_trans->insert_import_cat($data);
                    } else if($datatype == "msitm") {
                        $this->m_crud_trans->insert_import_itm($data);
                    } else {
                        echo "Jenis data tidak ditentukan";
                    }
                }
                // handle progress bar while inserting...
                $filenm = $_FILES['csv']['name'];
                $prgttl = count(file($_FILES['csv']['tmp_name'])) - 1; // hitung ttl row tanpa header
                $prgite = $rcount + 1;
                $prgval = ($prgite/$prgttl) * 100;
                ?><script>
                    /* update progress bar */
                    $("#id_PrgFnm").html('Uploading <em><?=$filenm?></em> ... <b><?=round($prgval)?>%</b>');
                    $("#id_progress").val(<?=$prgval?>); // update progressbar
                    /* disabled element while progress */
                    $('#id_btnImps').prop('disabled','disabled');
                    $('#csv').prop('disabled','disabled');
                    $('#id_BtnModClose').hide();
                </script><?php
                flush();
                ob_flush();
                usleep(500); // 1000000 = 1 second
                $rcount++;
            }
            /* after progress is complete */
            ?><script>
                $('#id_btnImps').prop('disabled',false);
                $('#csv').prop('disabled',false);
                $("#id_PrgFnm").html('Selesai, <a style="cursor: pointer" id="id_LnImpDet"><?=$rcount?></a> data di-<em>import</em>.');
                $('#id_BtnModClose').show();
                $('#id_PrgFnm, #id_progress').fadeOut(30000);
                $(window).unbind('beforeunload');
            </script><?php
            exit();
        } else {
            echo "Gagal! (File berukuran 0 kb/belum dipilih)";
        }
    }

    /* show data after import */
    public function ShowImpRes(){
        $numofrowins = $this->input->post('numofrowins');
        $query = $this->db->query("
            select * from `mod_trn_itm`
            order by trn_seq desc
            limit $numofrowins;
        ");
        $queryttl = $this->db->query("
            select sum(itm_qty) as itm_qty from `mod_trn_itm`
            order by trn_seq desc
            limit $numofrowins;
        ")->row();
        ?>
        <div align="center">
            <h4>
                DATA HASIL IMPORT<br>
                Jml.: <?=$numofrowins?>. Ttl. qty: <?=$queryttl->itm_qty?><br>
                Invalid data: <span id="id_invalidrw"></span>!
            </h4>
        </div>
        <table id="id_tblAftImp" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr class="titlerow">
                <TH width="2%">&nbsp;Seq.</TH>
                <TH width="15%">&nbsp;Tanggal</TH>
                <TH width="15%">&nbsp;Bill#</TH>
                <TH width="15%">&nbsp;Kd. Item</TH>
                <TH width="50%"> Nm. Item</TH>
                <TH width="3%"> Qty</TH>
            </tr>
            </thead>
            <tbody>
            <?php
            $invalid = 0;
            foreach ($query->result() as $row) {
                echo " <tr>";
                echo " <td class='col_idseq'><input style='border-style: none; background-color: initial;' type='text' name='id_seq[$row->trn_seq]' value='$row->trn_seq' size='4' readonly></td>";
                if($row->trn_date == '0000-00-00'){
                    echo " <td bgcolor='#deb887'>". $row->trn_date ."</td>";
                    $invalid++;
                } else {
                    echo " <td>". $row->trn_date ."</td>";
                }
                if(empty($row->trn_code)){
                    echo " <td bgcolor='#deb887'>". $row->trn_code ."</td>";
                    $invalid++;
                } else {
                    echo " <td>". $row->trn_code ."</td>";
                }
                if(empty($row->itm_code)){
                    echo " <td bgcolor='#deb887'>". $row->itm_code ."</td>";
                    $invalid++;
                } else {
                    echo " <td>". $row->itm_code ."</td>";
                }
                if(empty($row->itm_desc)){
                    echo " <td bgcolor='#deb887'>". $row->itm_desc ."</td>";
                    $invalid++;
                } else {
                    echo " <td>". $row->itm_desc ."</td>";
                }
                if($row->itm_qty == 0){
                    echo " <td bgcolor='yellow'>". $row->itm_qty ."</td>";
                    $invalid++;
                } else {
                    echo " <td>". $row->itm_qty ."</td>";
                }
                echo " </tr>";
                ?>
                <script>
                    $('#id_invalidrw').html('<?=$invalid?>');
                </script>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div>
            <button class="btn btn-primary btn-xs" id="id_btnDelImp">Hapus semua data</button>
        </div>
        <style>.trnNum{text-align: right;} .trnOpt{text-align: center;}</style>
        <?php
    }


    /* del imported data */
    public function DelImpData(){
        $id_seqs = array();
        foreach($_POST['id_seq'] as $id_seq=>$on){
            $id_seqs[] = $_POST['id_seq'][$id_seq];
        }
        //print_r($id_seqs);
        $this->db->where_in('trn_seq', $id_seqs);
        $this->db->delete('mod_trn_itm');
    }


    /* ambil informasi item ketika kode item diketikan langsung */
    public function show_1item(){
        // load library to cek user session and level
        $this->pageauth->sess_auth();
        $itm_code  = $this->input->post('itm_code');
        $query = $this->db->query("select * from mod_itm_list where itm_code = '$itm_code'");
        // data dikoleksi di JSON
        $arrow = array();
        foreach ($query->result() as $row) {
            $arrow = $row;
        } echo json_encode($row);
    }

    /* get ttl qty for particular date */
    public function ShowTtlQty(){
        $txt_trndate = $this->input->post('txt_trndate');
        $query = $this->db->query("
            select coalesce(sum(itm_qty), 0.00) as ttlqty
            from mod_trn_itm where trn_date = '$txt_trndate'
        ");
        foreach($query->result() as $row){
            echo "<h1><b>".$row->ttlqty."</b></h1>";
        }
    }

    /* get ttl itm for particular date */
    public function ShowTtlItm(){
        $txt_trndate = $this->input->post('txt_trndate');
        $query = $this->db->query("
            select count(trn_seq) as ttlitm
            from mod_trn_itm where trn_date = '$txt_trndate'
        ");
        foreach($query->result() as $row){
            echo "<h1><b>".$row->ttlitm."</b></h1>";
        }
    }
}
?>