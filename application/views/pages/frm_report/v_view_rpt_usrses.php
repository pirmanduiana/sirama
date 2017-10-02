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

<!-- css untuk datetime picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<!-- PRINT AREA -->
<link href="<?php echo base_url(); ?>assets/templ/bower_components/printarea/style.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>assets/templ/bower_components/printarea/print.css" rel="stylesheet" media="print">
<script src="<?php echo base_url(); ?>assets/templ/bower_components/printarea/jquery.PrintArea.js"></script>
<script>
    (function($) {
        // fungsi dijalankan setelah seluruh dokumen ditampilkan
        $(document).ready(function(e) {
            // aksi ketika tombol cetak ditekan
            $("#id_print").bind("click", function(event) {
                // cetak data pada area <div id="#id_RptContent"></div>
                $('#id_RptContent').printArea({
                    mode       : "iframe",
                    standard   : "html5",
                    retainAttr : ["id","class"],
                    rintDelay : 500,
                    printAlert : true
                });
            });
        });
    }) (jQuery);
</script>


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
                    <div class="tab-content" id="RadioRpt">
                        <!-- filled by ajax -->
                    </div>
                    <span id="loadingrad"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                    <!-- parameter tampil dibawah diambil dari DB oleh AJAX call -->
                    <div class="box-footer box-comments">
                        <div id="param1">
                            <!-- filled by ajax -->
                        </div>
                        <span style="display: none;" id="loadingprm"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        <div id="warningmes">
                            <!-- warning message will displayed here -->
                        </div>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->


            <!-- view report box -->
            <section id="id_BoxReport" class="col-lg-12 connectedSortable hidden">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-inbox"></i><em>Preview</em></li>
                        <li class="pull-right header"><button class="btn btn-xs btn-primary" id="id_print"><i class="fa fa-print"></i> Print Report</button></li>
                    </ul>
                    <div class="tab-content" id="id_RptContent">
                        <!-- ajax load here -->
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->
        </div><!-- /.content-wrapper -->
    </section>
</div>


<!-- 1. load radio button on document ready -->
<script>
    $(document).ready(function(){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/show_radrpt",
            beforeSend: function(){
                $('#loadingrad').show();
            },
            success: function(res) {
                $('#loadingrad').hide();
                $('#RadioRpt').html(res);
            },
            error: function(xhr){
                $('#RadioRpt').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
            }
        });
    })
</script>


<!-- 2. generate parameter berdasarkan radio button yg dipilih -->
<script>
    function GetRadValue(){
        $("input[name=rad_ses]:radio").change(function(){
            $('#id_RptPrm').addClass("show").removeClass("hidden");
            $('#id_BoxReport').addClass("hidden").removeClass("show");
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/show_prmrpt/" + this.value,
                beforeSend: function(){
                    $('#loadingprm').show();
                },
                success: function(res) {
                    $('#loadingprm').hide();
                    $('#param1').addClass("show").removeClass("hidden").html(res);
                    // inisialisasi ulang datetime picker berdasarkan attribute class=
                    $('.cdatetimepicker').datetimepicker({
                        showClose: true,
                        showTodayButton: true
                    });
                },
                error: function(xhr){
                    $('#param1').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
                }
            });
        });
    };
</script>


<!-- 3. show report table berdasarkan parameter -->
<script>
    // ketika tombol search di param1 diklik
    function schusr(){
        $('#id_BoxReport').addClass("show").removeClass("hidden");
        var eltxtusr =  document.getElementById('id_txtusr').value;
        /* check if input text is empty/null */
        if(!$('#id_txtusr').val()) {
            eltxtusr = "ANY";
        }
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/show_usrlist/" + eltxtusr,
            beforeSend: function(){
                $('#loadingprm').show();
            },
            success: function(res) {
                $('#loadingprm').hide();
                $('#id_RptContent').html(res);
                // table configuration
                $('#id_tblusr').DataTable({
                    "order": [[ 0, "asc" ]],
                    "paging": false,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
            },
            error: function(xhr){
                $('#id_RptContent').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
            }
        });
    }

    // ketika tombol search di param2 diklik
    function schdate(){
        console.log(this.value);
        $('#id_BoxReport').addClass("show").removeClass("hidden");
        var datefrom = $("input#id_datestart").val();
        var dateto = $("input#id_datefinish").val();
        /* check if input text is empty/null */
        if(!$('#id_datestart').val()) {
            datefrom = "ANY";
        }
        if(!$('#id_datefinish').val()) {
            dateto = "ANY";
        }
        console.log(datefrom + "  " + dateto);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_report/show_seslist",
            data: {txt_datestart: datefrom, txt_datefinish: dateto},
            beforeSend: function(){
                $('#loadingprm').show();
            },
            success: function(res) {
                $('#loadingprm').hide();
                $('#id_RptContent').html(res);
                // table configuration
                $('#id_tblusr').DataTable({
                    "order": [[1, "asc"],[2, "desc"]],
                    "paging": false,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    // group row
                    "drawCallback": function ( settings ) {
                        var api  = this.api();
                        var rows = api.rows( {page:'current'} ).nodes();
                        var last = null;
                        var total = null;
                        api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                            if ( last !== group ) {
                                $(rows).eq( i ).before('<tr class="group"><td colspan="5"><b>' + group + '</b></td></tr>');
                                last = group;
                            }
                        });
                    }
                    // end group row
                });
            },
            error: function(xhr){
                $('#id_RptContent').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
            }
        });
    }
</script>