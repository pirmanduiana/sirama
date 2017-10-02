<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('access');
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
            <!-- radio report box -->
            <section class="col-lg-12 connectedSortable">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-inbox"></i> Pilih laporan</li>
                    </ul>
                    <div class="tab-content" id="id_RadioRpt">
                        <label class="radio-inline"><input type="radio" id="id_RptRad1" name="RptRad" onclick="OnRadioClick()" value="1">Rekap. per Bulan</label>
                        <label class="radio-inline"><input type="radio" id="id_RptRad2" name="RptRad" onclick="OnRadioClick()" value="2">Rekap. per Kategori</label>
                        <label class="radio-inline"><input type="radio" id="id_RptRad3" name="RptRad" onclick="OnRadioClick()" value="3">Detail per Periode</label>
                    </div>
                    <span id="id_LoadingRpt" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                    <div class="box-footer box-comments">
                        <div id="id_PrmBox">
                            <!-- filled by ajax -->
                        </div>
                        <span style="display: none;" id="loadingprm"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        <div id="id_WarnMsg">
                            <!-- warning message will displayed here -->
                        </div>
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
    // munculkan paramter report berdasarkan radio button
    function OnRadioClick(){
        $("input[name=RptRad]:radio").change(function(){
            $('#id_RptBox').addClass('hidden');
            switch (this.value){
                case "1":
                    var url = "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptSls_ShowPrm1";
                    break;
                case "2":
                    url = "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptSls_ShowPrm2";
                    break;
                case "3":
                    url = "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptSls_ShowPrm3";
                    break;
            }
            jQuery.ajax({
                type: "POST",
                url: url,
                beforeSend: function(){
                    $('#id_LoadingRpt').show();
                },
                success: function(res) {
                    $('#id_LoadingRpt').hide();
                    $('#id_PrmBox').html(res);
                    $('#id_DateTimePick1').datetimepicker({
                        showClose: true,
                        showTodayButton: true
                    });
                    $('#id_DateTimePick2').datetimepicker({
                        showClose: true,
                        showTodayButton: true
                    });
                    $('#id_DateTimePick3').datetimepicker({
                        showClose: true,
                        showTodayButton: true
                    });
                    $('#id_DateTimePick4').datetimepicker({
                        showClose: true,
                        showTodayButton: true
                    });
                    $('#id_DateTimePick5').datetimepicker({
                        showClose: true,
                        showTodayButton: true
                    });
                    $('#id_DateTimePick6').datetimepicker({
                        showClose: true,
                        showTodayButton: true
                    });
                    $('#id_BtnSearch1').click(function(){
                        BtnSearch1Click();
                    });
                    $('#id_BtnSearch2').click(function(){
                        BtnSearch2Click();
                    });
                    $('#id_BtnSearch3').click(function(){
                        BtnSearch3Click();
                    });
                },
                error: function(xhr){
                    $('#id_PrmBox').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
                    $('#id_LoadingRpt').hide();
                }
            });
        })
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

    // tombol search1 diklik
    function BtnSearch1Click(){
        var url = "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptSls_ShowRpt1";
        var date1 = $('#id_DateTimePick1').val();
        var date2 = $('#id_DateTimePick2').val();
        jQuery.ajax({
            type: "POST",
            url: url,
            data: {
                date1 : date1,
                date2 : date2
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
            },
            error: function(xhr){
                $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
                $('#id_LoadingRpt').hide();
            }
        });
    }


    function BtnSearch2Click(){
        var url = "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptSls_ShowRpt2";
        var date3 = $('#id_DateTimePick3').val();
        var date4 = $('#id_DateTimePick4').val();
        jQuery.ajax({
            type: "POST",
            url: url,
            data: {
                date3 : date3,
                date4 : date4
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
            },
            error: function(xhr){
                $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
                $('#id_LoadingRpt').hide();
            }
        });
    }

    function BtnSearch3Click(){
        var url = "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/RptSls_ShowRpt3";
        var date5 = $('#id_DateTimePick5').val();
        var date6 = $('#id_DateTimePick6').val();
        jQuery.ajax({
            type: "POST",
            url: url,
            data: {
                date5 : date5,
                date6 : date6
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
            },
            error: function(xhr){
                $('#id_RptCont').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
                $('#id_LoadingRpt').hide();
            }
        });
    }
</script>