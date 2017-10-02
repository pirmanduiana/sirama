<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
	// session that would be inserted to database
	$ses_start  = $this->session->userdata('ses_start');
	$ses_status = $this->session->userdata('ses_status');
?>

<style>
    .cl_errmsg{
        color: red;
        font-style: italic;
        display: none;
        font-size: small;
        text-align: center;
    }
</style>

<!-- =============================================== -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		  <?php echo $title; ?>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Master Data</a></li>
		<li class="active">Kelola Barang</li>
	  </ol>
	</section>

    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- modal for everything -->
            <div class="modal" id="notificationPreview" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" id="id_BtnModClose" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="id_ModImpTtl">Import Data</h4>
                        </div>
                        <span id="loadingmod" style="padding-left: 41%"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        <div class="modal-body" id="id_mdlBdy">
                            <!-- ajax load here -->
                        </div>
                    </div>
                </div>
            </div>

            <section class="col-lg-5 connectedSortable">
                <!-- div box content left -->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-cubes"></i> Kategori Barang</li>
                        <li class="pull-left header"><span id="loadingkat"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span></li>
                        <div class="box-tools pull-right" style="padding: 0px 5px 5px 5px;">
                            <button id="id_BtnRefresh" class="btn btn-box-tool" onclick="showcategory()"><i class="fa fa-refresh"></i></button>
                            <button id="id_BtnModConf1" class="btn btn-box-tool" data-toggle='modal' data-backdrop="static" data-keyboard="false" data-target='#notificationPreview' onclick="ModConf('mscat')"><i class="fa fa-upload"></i></button>
                        </div>
                    </ul>
                    <div class="tab-content">
                        <form id="id_frmKat" class="form-horizontal">
                            <TABLE ID="id_tblInpKat" class="table table-striped table-hover dataTable">
                                <TR>
                                    <TH width="30%">Kode Kategori</TH>
                                    <TH width="40%">Nama Kategori</TH>
                                    <TH width="10%">&nbsp;</TH>
                                </TR>
                                <tr>
                                    <td>
                                        <INPUT TYPE='text' NAME='txt_kodkat' CLASS='form-control' id="id_kodkat">
                                        <div id="id_errkodkat" class="cl_errmsg">err_kodkat</div>
                                    </td>
                                    <td>
                                        <INPUT TYPE='text' NAME='txt_namkat' CLASS='form-control' id="id_namkat">
                                        <div id="id_errnamkat" class="cl_errmsg">err_namkat</div>
                                    </td>
                                    <td>
                                        <button class="btn btn-default btn-sm" id="id_btnSaveKat"><i class="fa fa-save"></i>&nbsp; Save</button>
                                    </td>
                                </tr>
                            </TABLE>
                            <div id="id_errformkat" class="cl_errmsg">err_frmkat</div>
                            <div id="id_tblKatDiv">
                                <!-- transaction load here by ajax -->
                            </div>
                        </form>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->


            <section class="col-lg-7 connectedSortable">
                <!-- div box content left -->
                <div id="id_boxItm" class="nav-tabs-custom hidden">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-cubes" id="id_boxTitleItm"></i> Data Barang</li>
                        <li class="pull-left header"><span id="loadingitm" style="display:none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span></li>
                        <div class="box-tools pull-right" style="padding: 0px 5px 5px 5px;">
                            <button id="id_BtnModConf2" class="btn btn-box-tool" data-toggle='modal' data-backdrop="static" data-keyboard="false" data-target='#notificationPreview' onclick="ModConf('msitm')"><i class="fa fa-upload"></i></button>
                        </div>
                    </ul>
                    <div class="tab-content">
                        <form id="id_frmItm" class="form-horizontal">
                            <input type="hidden" name="txt_tmpText" id="id_tmpText" />
                            <TABLE ID="id_tblInpItm" class="table table-striped table-hover dataTable">
                                <TR>
                                    <TH width="20%">Kode Item</TH>
                                    <TH width="60%">Nama Item</TH>
                                    <TH width="20%">Unit Item</TH>
                                    <TH width="20%">&nbsp;</TH>
                                </TR>
                                <tr>
                                    <td>
                                        <INPUT TYPE='text' NAME='txt_koditm' CLASS='form-control' id="id_koditm">
                                        <div id="id_errkoditm" class="cl_errmsg">err_koditm</div>
                                    </td>
                                    <td>
                                        <INPUT TYPE='text' NAME='txt_namitm' CLASS='form-control' id="id_namitm">
                                        <div id="id_errnamitm" class="cl_errmsg">err_namitm</div>
                                    </td>
                                    <td>
                                        <div class='input-group' style="cursor: pointer">
                                            <INPUT TYPE='text' NAME='txt_untitm' CLASS='form-control' id='id_untitm' readonly>
                                            <span class='input-group-addon' data-toggle='modal' data-target='#notificationPreview' onclick="showUomTbl()">
                                                <span class='glyphicon glyphicon-folder-open'></span>
                                            </span>
                                        </div>
                                        <div id="id_erruntitm" class="cl_errmsg">err_untitm</div>
                                    </td>
                                    <td>
                                        <button class="btn btn-default btn-sm" id="id_btnSaveItm"><i class="fa fa-save"></i>&nbsp; Save</button>
                                    </td>
                                </tr>
                            </TABLE>
                            <div id="id_errformitm" class="cl_errmsg">err_frmitm</div>
                            <div id="id_tblItmDiv">
                                <!-- transaction load here by ajax -->
                            </div>
                        </form>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->
        </div>
    </section>
</div><!-- /.content-wrapper -->


<!-- on document ready -->
<script>
    /***************************** box kategori **************************************/
    // fungsi reset form kategori
    function resetfrmkat(){
        document.getElementById('id_frmKat').reset();
        $('#id_kodkat').attr('readonly', false);
    }

    $(document).ready(function(){
        showcategory();
	});

    // fungsi show category
    function showcategory(){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/show_kategori",
            beforeSend: function(){
                $('#loadingkat').show();
            },
            success: function(res) {
                $('#loadingkat').hide();
                $('#id_tblKatDiv').html(res);
                // table configuration
                $('#id_tblKat').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "order": [[ 0, "asc" ]],
                    "paging": false,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
                // fungsi saat baris tabel kategori diklik
                $('.trtblKat').click(function(event){
                    var tridx = $(this).index() + 1;
                    var theTbl     = document.getElementById('id_tblKat');
                    var trcat_code = theTbl.rows[tridx].cells[0].innerHTML;
                    // call a function and pass cat_code
                    showTblItmCatCode(trcat_code);
                    resetfrmkat();
                    resetfrmitm();
                })
            },
            error: function(xhr){
                $().pusherrlog({
                    errtext : 'id_errformkat',
                    cicontr : 'adderrlog',
                    errmodl : 'show category',
                    spinner : 'loadingkat',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            }
        });
        return false;
    }

    // fungsi edit kategori
    function editkat(cat_code){
        $('#id_kodkat').attr('readonly', true);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/show_1kategori",
            data: {
                cat_code : cat_code
            },
            beforeSend: function(){
                $('#loadingkat').show();
            },
            success: function(res) {
                $('#loadingkat').hide();
                /*  {"cat_code":"CR01","cat_desc":"Cat Lokal"}  */
                /* parsing json */
                var myJSON = res;
                var myObj = JSON.parse(myJSON);
                document.getElementById("id_kodkat").value = myObj.cat_code;
                document.getElementById("id_namkat").value = myObj.cat_desc;
                if(document.getElementById('id_btnSaveKat')){
                    document.getElementById('id_btnSaveKat').id = 'id_btnUpdKat'; // ganti id btn sebagai update
                }
                $('#id_kodkat').attr('readonly', true); // readonly kolom cat_code
                // when btn save kat klik sebagai UPDATE
                $(document).on('click','#id_btnUpdKat',function(event){
                    event.preventDefault();
                    updtkat();
                });
            },
            error: function(xhr){
                $().pusherrlog({
                    errtext : 'id_errformkat',
                    cicontr : 'adderrlog',
                    errmodl : 'category row clicked',
                    spinner : 'loadingkat',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            }
        });
        return false;
    }

    // when  btn save kategori klik sebagai SAVE
    $(document).on('click','#id_btnSaveKat',function(event){
        event.preventDefault();
        // colect data from input
        var cat_code = $("#id_kodkat").val();
        var cat_desc = $("#id_namkat").val();

        if(cat_code==""){
            $('#id_errkodkat').show().html("Empty field!").fadeOut(4000);
            if(cat_desc==""){
                $('#id_errnamkat').show().html("Empty field!").fadeOut(4000);
            }
        } else {
            if(cat_desc==""){
                $('#id_errnamkat').show().html("Empty field!").fadeOut(4000);
            } else {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/add_kategori",
                    data: {
                        cat_code : cat_code,
                        cat_desc : cat_desc
                    },
                    beforeSend: function(){
                        $('#loadingkat').show();
                    },
                    success: function(res) {
                        $('#loadingkat').hide();
                        $('#id_tblKatDiv').html(res);
                        // table configuration
                        $('#id_tblKat').DataTable({
                            "retrieve": true, // <-- mencegah error reinitilise table.
                            "order": [[ 0, "asc" ]],
                            "paging": false,
                            "lengthChange": true,
                            "searching": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": true
                        });
                        resetfrmkat(); // reset input kategori
                        // fungsi saat baris tabel kategori diklik
                        $('.trtblKat').click(function(event){
                            var tridx = $(this).index() + 1;
                            var theTbl     = document.getElementById('id_tblKat');
                            var trcat_code = theTbl.rows[tridx].cells[0].innerHTML;
                            // call a function and pass cat_code
                            showTblItmCatCode(trcat_code);
                        })
                    },
                    error: function(xhr){
                        $().pusherrlog({
                            errtext : 'id_errformkat',
                            cicontr : 'adderrlog',
                            errmodl : 'add category',
                            spinner : 'loadingkat',
                            xhrsttx : xhr.statusText,
                            xhrstat : xhr.status,
                            xhrrspn : xhr.responseText
                        });
                    }
                });
                return false;
            }
        }
    });

    // when button save kategori diklik sebagai update
    function updtkat(){
        // colect data from input
        var cat_code = $("#id_kodkat").val();
        var cat_desc = $("#id_namkat").val();

        if(cat_code==""){
            $('#id_errkodkat').show().html("Empty field!").fadeOut(4000);
            if(cat_desc==""){
                $('#id_errnamkat').show().html("Empty field!").fadeOut(4000);
            }
        } else {
            if(cat_desc==""){
                $('#id_errnamkat').show().html("Empty field!").fadeOut(4000);
            } else {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/upd_kategori",
                    data: {
                        cat_code : cat_code,
                        cat_desc : cat_desc
                    },
                    beforeSend: function(){
                        $('#loadingkat').show();
                    },
                    success: function(res) {
                        $('#loadingkat').hide();
                        $('#id_tblKatDiv').html(res);
                        // table configuration
                        $('#id_tblKat').DataTable({
                            "retrieve": true, // <-- mencegah error reinitilise table.
                            "order": [[ 0, "asc" ]],
                            "paging": false,
                            "lengthChange": true,
                            "searching": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": true
                        });
                        resetfrmkat(); // reset input kategori
                        $('#id_kodkat').attr('readonly', false); // hapus readonly kolom cat_code
                        if(document.getElementById('id_btnUpdKat')){
                            document.getElementById('id_btnUpdKat').id = 'id_btnSaveKat'; // kembalikan id btn save
                        }
                        // fungsi saat baris tabel kategori diklik
                        $('.trtblKat').click(function(event){
                            var tridx = $(this).index() + 1;
                            var theTbl     = document.getElementById('id_tblKat');
                            var trcat_code = theTbl.rows[tridx].cells[0].innerHTML;
                            // call a function and pass cat_code
                            showTblItmCatCode(trcat_code);
                        })
                    },
                    error: function(xhr){
                        $().pusherrlog({
                            errtext : 'id_errformkat',
                            cicontr : 'adderrlog',
                            errmodl : 'update category',
                            spinner : 'loadingkat',
                            xhrsttx : xhr.statusText,
                            xhrstat : xhr.status,
                            xhrrspn : xhr.responseText
                        });
                    }
                });
                return false;
            }
        }
    }

    // fungsi tampilkan item berdasarkan kategori yg diklik
    function showTblItmCatCode(trcat_code){
        $('#id_boxItm').removeClass('hidden'); // munculkan box item kanan
        document.getElementById('id_tmpText').value = trcat_code; // isi hidden text dgn cat_code
        // tambah judul box item (isi categori)
        $('#id_boxTitleItm').html("  (" + trcat_code + ")");

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/show_item",
            data: {
                cat_code : trcat_code
            },
            beforeSend: function(){
                $('#loadingitm').show();
            },
            success: function(res) {
                $('#loadingitm').hide();
                $('#id_tblItmDiv').html(res);
                // table configuration
                $('#id_tblItm').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "order": [[ 0, "asc" ]],
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
            },
            error: function(xhr){
                $().pusherrlog({
                    errtext : 'id_errformitm',
                    cicontr : 'adderrlog',
                    errmodl : 'show item',
                    spinner : 'loadingitm',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            }
        });
        return false;
    }


    /***************************** box item **************************************/
    // fungsi reset form item
    function resetfrmitm(){
        document.getElementById('id_frmItm').reset();
        $('#id_koditm').attr('readonly', false); // readonly kolom itm_code
    }

    // munculkan modal utk pilih uom
    function showUomTbl(){
        $('#id_mdlBdy').html('');
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/show_uom",
            beforeSend: function(){
                $('#loadingmod').show();
            },
            success: function(res) {
                $('#loadingmod').hide();
                $('#id_mdlBdy').append(res);
                // table configuration
                $('#id_tblUom').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "order": [[ 0, "asc" ]],
                    "paging": false,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
                <!-- get modal table collection -->
                $(document).on('click', '#id_tblUom tr', function(){
                    var Ridx = $(this).index() + 1;
                    var theTbl = document.getElementById('id_tblUom');
                    // set value
                    var txtitmcode = document.getElementById('id_untitm');
                    txtitmcode.value = theTbl.rows[Ridx].cells[0].innerHTML;
                    // destroy modal
                    $('#notificationPreview').modal('hide')
                    // set focus ketiga
                    $('#id_itmqty').focus();
                });
            },
            error: function(xhr){
                $().pusherrlog({
                    errtext : 'id_errformitm',
                    cicontr : 'adderrlog',
                    errmodl : 'show uom modal',
                    spinner : 'loadingmod',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            }
        });
        return false;
    }


    // ketika tombol save item diklik sebagai SAVE
    $(document).on('click','#id_btnSaveItm',function(event){
        event.preventDefault();
        // collect element value
        var koditm  = $('#id_koditm').val();
        var namitm  = $('#id_namitm').val();
        var untitm  = $('#id_untitm').val();
        var tmpText = $('#id_tmpText').val();

        if(koditm==""){
            $('#id_errkoditm').show().fadeOut(4000).html("Empty field!");
            if(namitm==""){
                $('#id_errnamitm').show().fadeOut(4000).html("Empty field!");
                if(untitm==""){
                    $('#id_erruntitm').show().fadeOut(4000).html("Empty field!");
                }
            } else {
                if(untitm==""){
                    $('#id_erruntitm').show().fadeOut(4000).html("Empty field!");
                }
            }
        } else {
            if(namitm==""){
                $('#id_errnamitm').show().fadeOut(4000).html("Empty field!");
                if(untitm==""){
                    $('#id_erruntitm').show().fadeOut(4000).html("Empty field!");
                }
            } else {
                if(untitm==""){
                    $('#id_erruntitm').show().fadeOut(4000).html("Empty field!");
                } else {
                    SaveItem();
                }
            }
        }

        function SaveItem(){
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/save_item",
                data: {
                    koditm  : koditm,
                    namitm  : namitm,
                    untitm  : untitm,
                    tmpText : tmpText
                },
                beforeSend: function(){
                    $('#loadingitm').show();
                },
                success: function(res) {
                    $('#loadingitm').hide();
                    $('#id_tblItmDiv').html(res);
                    // table configuration
                    $('#id_tblItm').DataTable({
                        "retrieve": true, // <-- mencegah error reinitilise table.
                        "order": [[ 0, "asc" ]],
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true
                    });
                    // reset form item
                    resetfrmitm();
                },
                error: function(xhr){
                    $().pusherrlog({
                        errtext : 'id_errformitm',
                        cicontr : 'adderrlog',
                        errmodl : 'add item',
                        spinner : 'loadingitm',
                        xhrsttx : xhr.statusText,
                        xhrstat : xhr.status,
                        xhrrspn : xhr.responseText
                    });
                }
            });
        }
    });


    // fungsi edit item
    function edititm(itm_code){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/show_1item",
            data: {
                itm_code : itm_code
            },
            beforeSend: function(){
                $('#loadingitm').show();
            },
            success: function(res) {
                $('#loadingitm').hide();
                // parsing json
                /*  "itm_code":"2001","itm_desc":"Pakupaku","itm_unit":"kg","cat_code":"CR02"}  */
                var myJSON = res;
                var myObj = JSON.parse(myJSON);
                document.getElementById("id_tmpText").value = myObj.cat_code;
                document.getElementById("id_koditm").value = myObj.itm_code;
                document.getElementById("id_namitm").value = myObj.itm_desc;
                document.getElementById("id_untitm").value = myObj.itm_unit;

                // ganti id btn sebagai update
                if(document.getElementById('id_btnSaveItm')){
                    document.getElementById('id_btnSaveItm').id = 'id_btnUpdItm';
                }
                $('#id_koditm').attr('readonly', true); // readonly kolom itm_code
                // when btn save itm klik sebagai UPDATE
                $(document).on('click','#id_btnUpdItm',function(event){
                    event.preventDefault();
                    updtitm();
                });
            },
            error: function(xhr){
                $().pusherrlog({
                    errtext : 'id_errformitm',
                    cicontr : 'adderrlog',
                    errmodl : 'edit item',
                    spinner : 'loadingitm',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            }
        });
        return false;
    }

    // fungsi update item
    function updtitm(){
        // colect data from input
        var koditm  = $('#id_koditm').val();
        var namitm  = $('#id_namitm').val();
        var untitm  = $('#id_untitm').val();
        var tmpText = $('#id_tmpText').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/upd_item",
            data: {
                koditm : koditm,
                namitm : namitm,
                untitm : untitm,
                tmpText : tmpText
            },
            beforeSend: function(){
                $('#loadingitm').show();
            },
            success: function(res) {
                $('#loadingitm').hide();
                $('#id_tblItmDiv').html(res);
                // table configuration
                $('#id_tblItm').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "order": [[ 0, "asc" ]],
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
                resetfrmitm(); // reset input kategori
                $('#id_koditm').attr('readonly', false); // hapus readonly kolom itm_code
                if(document.getElementById('id_btnUpdItm')){
                    document.getElementById('id_btnUpdItm').id = 'id_btnSaveItm'; // kembalikan id btn save
                }
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                $().pusherrlog({
                    errtext : 'id_errformitm',
                    cicontr : 'adderrlog',
                    errmodl : 'update item',
                    spinner : 'loadingitm',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            }
        });
        return false;
    }

    // show modal import data
    function ModConf(datatype){
        /* prepare modal */
        $('#id_mdlBdy').html('');
        switch (datatype){
            case 'mscat':
                $('#id_ModImpTtl').html('Import Kategori Barang');
                break;
            case 'msitm':
                $('#id_ModImpTtl').html('Import Data Barang');
                break;
            default:
                $('#id_ModImpTtl').html('Trigger tidak ditemukan!');
        }
        /* avoid user leave the page */
        $(window).bind('beforeunload', function () {
            return "";
        });
        /* isi modal dengan element berikut */
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_master/show_importfrm",
            beforeSend: function(){
                $('#loadingmod').show();
            },
            success: function(res) {
                $('#loadingmod').hide();
                $('#id_mdlBdy').append(res);
                $('#id_btnImps').click(function(){
                    uploadCsv(datatype);
                });
            },
            error: function(xhr){
                $().pusherrlog({
                    errtext : 'id_staMes',
                    cicontr : 'adderrlog',
                    errmodl : 'show modal upl csv cat',
                    spinner : 'loadingmod',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            }
        });
    }

    // proses import
    function uploadCsv(datatype){
        event.preventDefault();
        $('#id_staMes').css('display','').html(""); // hapus css display: none karena efek fadeout() stlh ajax post
        var formData = new FormData($('#id_uploadCsv')[0]); // kenali form, agar element "file" dikenali oleh controler CI.
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/proc_imp/" + datatype,
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                //$('#loadingimp').show();
            },
            success: function(res) {
                //$('#loadingimp').hide();
                //$('#id_staMes').html(res).fadeOut(7000);
                document.getElementById('id_uploadCsv').reset();
            },
            error: function(xhr){
                $().pusherrlog({
                    errtext : 'id_staMes',
                    cicontr : 'adderrlog',
                    errmodl : 'upl csv cat',
                    spinner : 'loadingimp',
                    xhrsttx : xhr.statusText,
                    xhrstat : xhr.status,
                    xhrrspn : xhr.responseText
                });
            },
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.addEventListener("progress", function (e) {
                    var progressval = e.currentTarget.response;
                    $("#progress").html(progressval);
                });
                return xhr;
            }
        });
    }

    // on modal import closed
    $('#id_BtnModClose').click(function(){
        showcategory();
        $(window).unbind('beforeunload');
    })
</script>