<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_crud_master extends CI_Controller
{

    /* i. function construct */
    function __construct()
    {
        parent::__construct();
    }


    /* item list untuk diperlihatkan di modal */
    public function show_kategori()
    {
        // load library to cek user session and obj id
        $this->pageauth->sess_page_auth(41);
        $this->load->model('pages/m_crud_master');
        $query = $this->m_crud_master->select_kategori();
        ?>
        <table id="id_tblKat" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <TH width="30%">Kode Kategori</TH>
                <TH width="40%">Nama Kategori</TH>
                <TH width="10%">&nbsp;</TH>
            </tr>
            </thead>
            <tbody id="id_tbodyKat">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr style='cursor: pointer' class='trtblKat'>";
                echo " <td>". $row->cat_code ."</td>";
                echo " <td>". $row->cat_desc ."</td>";
                echo " <td><span class='btn btn-default btn-xs'><a onclick='editkat(\"$row->cat_code\")'><i class='fa fa-edit'></i> Edit</a></span></td>";
                echo " </tr>";
            } ?>
            </tbody>
        </table>
        <?php
    }

    // edit kategori dengan keluaran json
    public function show_1kategori(){
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $cat_code = $this->input->post('cat_code');
        $this->load->model('pages/m_crud_master');
        $query = $this->m_crud_master->select_1kategori($cat_code);
        // return to json
        $katjson = array();
        foreach ($query->result() as $row) {
            $katjson = $row;
        } echo json_encode($row);
    }

    // fungsi tambah kategori
    public function add_kategori(){
        $this->load->model('pages/m_crud_master');
        $this->m_crud_master->insert_kategori();
        $query = $this->show_kategori();
        return $query;
    }

    // fungsi update kategori
    public function upd_kategori(){
        $this->load->model('pages/m_crud_master');
        $this->m_crud_master->update_kategori();
        $query = $this->show_kategori();
        return $query;
    }

    // fungsi show item berdasarkan cat_Code
    public function show_item(){
        $cat_code = $this->input->post('cat_code');
        $this->load->model('pages/m_crud_master');
        $query = $this->m_crud_master->select_item($cat_code);
        ?>
        <table id="id_tblItm" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <TH width="20%">Kode Item</TH>
                <TH width="60%">Nama Item</TH>
                <TH width="20%">Unit Item</TH>
                <TH width="20%">&nbsp;</TH>
            </tr>
            </thead>
            <tbody id="id_tbodyItm">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr style='cursor: pointer'>";
                echo " <td>". $row->itm_code ."</td>";
                echo " <td>". $row->itm_desc ."</td>";
                echo " <td>". $row->itm_unit ."</td>";
                echo " <td><span class='btn btn-default btn-xs'><a onclick='edititm(\"$row->itm_code\")'><i class='fa fa-edit'></i> Edit</a></span></td>";
                echo " </tr>";
            } ?>
            </tbody>
        </table>
        <?php
    }

    // fungsi tampil uom saat buat item baru
    public function show_uom(){
        $this->load->model('pages/m_crud_master');
        $query = $this->m_crud_master->select_uom();
        ?>
        <table id="id_tblUom" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <TH width="20%">Kode</TH>
                <TH width="40%">Unit</TH>
            </tr>
            </thead>
            <tbody id="id_tbodyUom">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr class='id_trUom' style='cursor: pointer'>";
                echo " <td>". $row->uom_code ."</td>";
                echo " <td>". $row->uom_desc ."</td>";
                echo " </tr>";
            } ?>
            </tbody>
        </table>
        <?php
    }

    // fungsi simpan item
    public function save_item(){
        $this->load->model('pages/m_crud_master');
        $query = $this->m_crud_master->insert_itm();

        // show kategori tertentu
        $cat_code = $this->input->post('tmpText');
        $query = $this->m_crud_master->select_item($cat_code);
        ?>
        <table id="id_tblItm" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <TH width="20%">Kode Item</TH>
                <TH width="60%">Nama Item</TH>
                <TH width="20%">Unit Item</TH>
                <TH width="20%">&nbsp;</TH>
            </tr>
            </thead>
            <tbody id="id_tbodyItm">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr style='cursor: pointer'>";
                echo " <td>". $row->itm_code ."</td>";
                echo " <td>". $row->itm_desc ."</td>";
                echo " <td>". $row->itm_unit ."</td>";
                echo " <td><span class='btn btn-default btn-xs'><a onclick='edititm(\"$row->itm_code\")'><i class='fa fa-edit'></i> Edit</a></span></td>";
                echo " </tr>";
            } ?>
            </tbody>
        </table>
        <?php
    }

    // select item keluaran json utk keperluan editing
    public function show_1item(){
        // load library to cek user session and level
        $this->pageauth->sess_level_auth();
        $itm_code = $this->input->post('itm_code');
        $this->load->model('pages/m_crud_master');
        $query = $this->m_crud_master->select_1item($itm_code);
        // return to json
        $itmjson = array();
        foreach ($query->result() as $row) {
            $itmjson = $row;
        } echo json_encode($row);
    }

    // fungsi update item
    public function upd_item(){
        $this->load->model('pages/m_crud_master');
        $this->m_crud_master->update_item();

        // show kategori tertentu
        $cat_code = $this->input->post('tmpText');
        $query = $this->m_crud_master->select_item($cat_code);
        ?>
        <table id="id_tblItm" class="display compact table-hover" role="grid" aria-describedby="example2_info">
            <thead>
            <tr>
                <TH width="20%">Kode Item</TH>
                <TH width="60%">Nama Item</TH>
                <TH width="20%">Unit Item</TH>
                <TH width="20%">&nbsp;</TH>
            </tr>
            </thead>
            <tbody id="id_tbodyItm">
            <?php
            foreach ($query->result() as $row) {
                echo " <tr style='cursor: pointer'>";
                echo " <td>". $row->itm_code ."</td>";
                echo " <td>". $row->itm_desc ."</td>";
                echo " <td>". $row->itm_unit ."</td>";
                echo " <td><span class='btn btn-default btn-xs'><a onclick='edititm(\"$row->itm_code\")'><i class='fa fa-edit'></i> Edit</a></span></td>";
                echo " </tr>";
            } ?>
            </tbody>
        </table>
        <?php
    }

    // fungsi show form import
    public function show_importfrm(){
        ?>
        <div id="id_impFile" style="/*margin: 0% 18% 0% 20%;*/" class="input-groups">
            <form name="frm_uploadCsv" id="id_uploadCsv" style="width: 100%">
                Langkah-langkah import transaksi dari *.csv file
                <ol>
                    <li>
                        Download contoh format *.csv
                        <ul>
                            <li>Kategori brg.: <a href="<?php echo base_url(); ?>assets/templ/libraries/share/imp_cat.csv" download="imp_cat.csv">imp_cat.csv</a></li>
                            <li>Daftar brg.: <a href="<?php echo base_url(); ?>assets/templ/libraries/share/imp_itm.csv" download="imp_itm.csv">imp_itm.csv</a></li>
                        </ul>
                    </li>
                    <li>Lengkapi data sesuai format standar.</li>
                    <li>Save as > pilih "CSV"</li>
                    <li><i class="fa fa-file-excel-o"></i> Import transaksi dari *.csv file.</li>
                </ol>
                </p>
                <div style="display: flex; margin-top: 5px;">
                    <input name="csv" type="file" id="csv" class="btn btn-default btn-xs"  accept=".csv"/>&nbsp;&nbsp;
                    <button class="btn btn-default btn-xs" id="id_btnImps"><i class="fa fa-check"></i>&nbsp; Upload</button>
                </div>
            </form>
            <!--<span id="loadingimp" style="display: none;"><img src="<?php /*echo base_url(); */?>assets/templ/libraries/img/loading.svg">Loading...</span>-->
            <div id="progress"></div>
            <div id="id_staMes"><!-- ajax result load here --></div>
        </div>
        <?php
    }

    // fungsi call captcha
    public function callcaptcha(){
        $values = array(
            'word' => '',
            'word_length' => 7,
            'img_path' => './images/',
            'img_url' => base_url() .'images/',
            'font_path' => base_url() . 'system/fonts/texb.ttf',
            'img_width' => '140',
            'img_height' => 70,
            'expiration' => 4600
        );
        // create captcha image
        $data = create_captcha($values);
        // store image html code in a variable
        $capimg = $data['image'];
        $_SESSION['captchaWord'] = $data['word'];
        ?>
        <div class="info-box">
            <?php echo $capimg; ?>
            <span class="info-box-text">Ketik captcha</span>
            <span class="info-box-number">
                <input size="13" type="text" name="txt_Captcha" id="id_Captcha" style="background-color: grey" required>
                <input type="button" id="id_BtnCap" value="Cek">
            </span>
        </div>
        <script>
            $('#id_BtnCap').click(function () {
                var eljs = $('#id_Captcha').val();
                var elph = "<?= $data['word'] ?>";
                // alert(eljs + '  ' + elph);
                if(eljs==elph){
                   return true;
                } else {
                    return false;
                }
            })
        </script>
        <?php
    }
}
?>