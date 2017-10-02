<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
	// session that would be inserted to database
	$ses_start  = $this->session->userdata('ses_start');
	$ses_status = $this->session->userdata('ses_status');
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          <?php echo $title; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Laporan</a></li>
        <li class="active"><?php echo $title; ?></li>
      </ol>
    </section>

    <section class="content">
        <!-- Main row -->
        <div class="row">

            <!-- modal for everything -->
            <div class="modal" id="notificationPreview" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <span id="loadingmod" style="padding-left: 41%"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        <div class="modal-body" id="id_mdlBdy">
                            <!-- ajax load here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- radio report box -->
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-inbox"></i> Pilih laporan</li>
                    </ul>
                    <div class="tab-content" id="id_RadioRpt">
                        <label class="radio-inline">
                            <input type="radio" id="id_RptRad1" name="RptRad" onclick="OnRadio1Click()" value="1">Semua Produk Cat
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="id_RptRad2" name="RptRad" onclick="OnRadio2Click()" value="2">Per Kategori Cat&nbsp;&nbsp;
                            <select id="id_RptSel" class="hidden"><!-- load by ajax --></select>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="id_RptRad3" name="RptRad" data-toggle='modal' data-target='#notificationPreview' onclick="OnRadio3Click()"> <span id="id_rad3Lbl"><em>Top Sales Item</em></span>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="id_RptRad4" name="RptRad" onclick="OnRadio4Click()"><em>Suggest Order</em></span>
                        </label>
                    </div>
                    <span id="id_LoadingRpt" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                    <div class="box-footer box-comments">
                        <div id="id_PrmBox">
                            <span id="id_SpnCbx" class="hidden">
                                <label class="checkbox-inline"><input type="checkbox" id="id_RptCbx3" value="3">
                                    Tampilkan hanya kolom penjualan aktual<code>(A<sub>t</sub>)</code> dan hasil peramalan<code>(F<sub>t</sub>)</code>
                                </label>
                            </span>
                        </div>
                        <span style="display: none;" id="loadingprm"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->

            <!-- view report box -->
            <section id="id_RptBox" class="col-lg-12 connectedSortable hidden">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-inbox"></i><em>Preview</em></li>
                    </ul>
                    <div class="tab-content" id="id_RptCont">
                        <!-- ajax load here -->
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->
        </div><!-- /.content-wrapper -->
    </section>
</div>

<script>
    // document ready
    $(document).ready(function(){
        FilSelCat();
    });

    // fill combobox select category
    function FilSelCat(){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_rekapkat",
            beforeSend: function(){
                $('#id_LoadingRpt').show();
            },
            success: function(res) {
                $('#id_LoadingRpt').hide();
                $('#id_RptSel').html(res);
                // 2. ketika element select onchange value
                $('#id_RptSel').change(function(){
                    var selKatVal = $('#id_sel_dsbrow4_1').val();
                })
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }

    function ShowCbxAtFt(){
        $('#id_PrmBox').html('').html(
            "<span id='id_SpnCbx' class='hidden'>" +
            "<label class='checkbox-inline'><input type='checkbox' id='id_RptCbx3' value='3'>" +
            "Tampilkan hanya kolom penjualan aktual<code>(A<sub>t</sub>)</code> dan hasil peramalan<code>(F<sub>t</sub>)</code>" +
            "</label>" +
            "</span>"
        );
    }

    function ShowAtFtTdTh(){
        $(document).on('change','#id_RptCbx3', function(){
            var tdth5 = 'th:nth-child(5),td:nth-child(5)';
            var tdth6 = 'th:nth-child(6),td:nth-child(6)';
            var tdth7 = 'th:nth-child(7), td:nth-child(7)';
            var tdth8 = 'th:nth-child(8), td:nth-child(8)';
            var trTtl = '.trnTtl';
            if($(this).is(':checked')){
                $(tdth5).hide();
                $(tdth6).hide();
                $(tdth7).hide();
                $(tdth8).hide();
                $(trTtl).hide();
            } else {
                $(tdth5).show();
                $(tdth6).show();
                $(tdth7).show();
                $(tdth8).show();
                $(trTtl).show();
            }
        });
    }

    function PrintDivElement(idDiv){
        $('#id_RptTitle').css('display','');
        $('#id_SignTemp1').css('display','');
        var NewTab = window.open();
        var SelectedDiv = document.getElementById(idDiv).innerHTML;
        NewTab.document.body.innerHTML =
            "<html>" +
            "<head>" +
            "<title>Cetak</title>" +
            "</head>" +
            "<body>" +
            SelectedDiv +
            "</body>" +
            "</html>";
        NewTab.print();
        NewTab.close();
        $('#id_RptTitle').css('display','none');
        $('#id_SignTemp1').css('display','none');
    }

    function Export2Excel(TblId, FileName){
        $(TblId).table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: FileName,
            fileext: ".xls",
            exclude_img: false,
            exclude_links: false,
            exclude_inputs: false
        });
    }

    function OnRadio1Click(){
        ShowCbxAtFt();
        $('#id_RptSel').addClass('hidden');
        $('#id_RptBox').removeClass('hidden');
        $('#id_SpnCbx').removeClass('hidden');
        $('#id_rad3Lbl').html('Top Sales Item');
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptFrc_ShowRpt1",
            beforeSend: function(){
                $('#id_LoadingRpt').show();
            },
            success: function(res) {
                $('#id_LoadingRpt').hide();
                $('#id_RptCont').html(res);
                $('#id_RptTitle').css('display','none');
                $('#id_SignTemp1').css('display','none');
                ShowAtFtTdTh();
                $('#id_RptCbx3, #id_RptCbx4').prop('checked', false);
            },
            error: function(xhr){
                $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }

    function OnRadio2Click(){
        $('#id_PrmBox').html('');
        $('#id_RptSel').removeClass('hidden');
        $('#id_RptBox').addClass('hidden');
        $('#id_SpnCbx').addClass('hidden');
        $('#id_rad3Lbl').html('Top Sales Item');
        $('#id_RptSel').change(function(){
            ShowCbxAtFt();
            $('#id_SpnCbx').removeClass('hidden');
            var selKatVal = $('#id_RptSel').val();
            var selKatTxt = $('#id_RptSel option:selected').text();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptFrc_ShowRpt2",
                data: {
                    selKatVal : selKatVal,
                    selKatTxt : selKatTxt
                },
                beforeSend: function(){
                    $('#id_LoadingRpt').show();
                },
                success: function(res) {
                    $('#id_LoadingRpt').hide();
                    $('#id_RptBox').removeClass('hidden');
                    $('#id_RptCont').html(res);
                    $('#id_RptTitle').css('display','none');
                    $('#id_SignTemp1').css('display','none');
                    ShowAtFtTdTh();
                    $('#id_RptCbx3, #id_RptCbx4').prop('checked', false);
                },
                error: function(xhr){
                    $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })
    }

    function OnRadio3Click(){
        ShowCbxAtFt();
        $('#id_RptSel').addClass('hidden');
        $('#id_RptBox').removeClass('hidden');
        $('#id_SpnCbx').removeClass('hidden');
        $('#id_rad3Lbl').html('Top Sales Item');
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_top5itm",
            beforeSend: function(){
                $('#loadingmod').show();
            },
            success: function(res) {
                $('#loadingmod').hide();
                $('#id_mdlBdy').html(res);
                // table configuration
                $('#id_tblTop5Itm').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "order": [[ 0, "asc" ]],
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
                <!-- get modal table collection -->
                $(document).on('click', '#id_tblTop5Itm tr', function(){
                    var Ridx = $(this).index() + 1;
                    var theTbl = document.getElementById('id_tblTop5Itm');
                    SelectedRow = theTbl.rows[Ridx].cells[1].innerHTML; // set to global variable
                    SelectedRowTxt = theTbl.rows[Ridx].cells[2].innerHTML; // set to global variable
                    $('#id_rad3Lbl').html('').html('<em>Top Sales Item</em>&nbsp;&nbsp;<i class=\'fa fa-barcode\'>&nbsp;' + SelectedRow + '</i>');
                    $('#notificationPreview').modal('hide');
                    // show table peramalan per item
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptFrc_ShowRpt3",
                        data: {
                            itmCode: SelectedRow,
                            itmDesc: SelectedRowTxt
                        },
                        beforeSend: function(){
                            $('#loadingbox1').show();
                        },
                        success: function(res) {
                            $('#loadingbox1').hide();
                            $('#id_RptCont').html(res);
                            $('#id_RptTitle').css('display','none');
                            $('#id_SignTemp1').css('display','none');
                            ShowAtFtTdTh();
                            $('#id_RptCbx3, #id_RptCbx4').prop('checked', false);
                        },
                        error: function(xhr){
                            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                        }
                    });

                });
            },
            error: function(xhr){
                $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }

    function OnRadio4Click(){
        $('#id_RptSel').addClass('hidden');
        $('#id_RptBox').removeClass('hidden');
        $('#id_SpnCbx').addClass('hidden');
        $('#id_rad3Lbl').html('Top Sales Item');
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptFrc_ShowPrm4",
            beforeSend: function(){
                $('#id_LoadingRpt').show();
            },
            success: function(res) {
                $('#id_LoadingRpt').hide();
                $('#id_PrmBox').html(res);
                $('#id_DateTimePick1').datetimepicker({
                    format: 'MMMM YYYY',
                    viewMode: 'months'
                });
                // show report table
                $(document).on('click','#id_BtnSearch1', function(){
                    var RptPeriod = $('#id_DateTimePick1').val();
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptFrc_ShowRpt4",
                        data: {
                            RptPeriod: RptPeriod
                        },
                        beforeSend: function(){
                            $('#id_LoadingRpt').show();
                        },
                        success: function(res) {
                            $('#id_LoadingRpt').hide();
                            $('#id_RptCont').html(res);
                            $('#id_RptTitle').css('display','none');
                            $('#id_SignTemp1').css('display','none');
                        },
                        error: function(xhr){
                            $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                        }
                    });
                })
            },
            error: function(xhr){
                $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }
</script>