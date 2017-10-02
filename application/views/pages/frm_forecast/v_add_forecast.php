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
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>

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
		<li><a href="#">Transaksi</a></li>
		<li class="active">Peramalan</li>
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

            <!-- BOX REKAP PENJUALAN -->
            <section class="col-lg-7 connectedSortable">
                <!-- div box content left -->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header">
                            <i class="fa fa-line-chart"></i> Rekapitulasi Penjualan per Bulan (qty)
                            <span id="loadingbox1" style="display:none;"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <label class="radio-inline">
                            <input type="radio" id="id_rad1" name="radjnsramal" onclick="showTblPenjAll()"> Semua Produk Cat
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="id_rad2" name="radjnsramal" onclick="showTblPenjKat()"> Per Kategori Cat
                            &nbsp;&nbsp;<select id="id_selKat" class="hidden"><!-- ajax load here --></select>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="id_rad3" name="radjnsramal" data-toggle='modal' data-target='#notificationPreview' onclick="showModTop5Itm()"> <span id="id_rad3Lbl"><em>Top Sales Item</em></span>
                        </label>
                        <span id="id_timer" style="display: none; margin-left: 5px; font-style: italic; color: grey;"><!-- timer here --></span>
                        <div id="id_tblPenjDiv">
                            <!-- transaction load here by ajax -->
                        </div>
                        <div align="right" style="padding-top: 5px">
                            <button class="hidden btn btn-info btn-xs" id="id_btnNext1"><i class="fa fa-arrow-right"></i>&nbsp; Lanjut</button>
                        </div>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->

            <!-- BOX PARAMETER -->
            <section class="col-lg-5 connectedSortable hidden" id="id_boxRight">
                <!-- div box content left -->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header">
                            <i class="fa fa-line-chart"></i> Parameter Peramalan
                            <span id="loadingbox2" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <span style="font-size: small">
                            Dari bulan&nbsp;&nbsp;<select id="id_parPeriod" name="txt_parPeriod"></select>&nbsp;&nbsp;&nbsp;
                            Bobot&nbsp;&nbsp;<input type="number" id="id_parNum" name="txt_parNum" style="width: 40px;" min="3">&nbsp;&nbsp;&nbsp;<i>(min 3)</i>
                        </span>
                        <div id="id_tblWmaDiv">
                            <!-- transaction load here by ajax -->
                        </div>
                        <div align="right">
                            <button class="hidden btn btn-info btn-xs" id="id_btnNext2" disabled><i class="fa fa-arrow-down"></i>&nbsp; Hitung</button>
                        </div>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->

            <!-- BOX TABLE WMA-->
            <section class="col-lg-12 connectedSortable hidden" id="id_boxFoot">
                <!-- div box content left -->
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <span id="loadingbox3" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        <div id="id_tblCalcWmaDiv">
                            <!-- WMA calc load here -->
                        </div>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->

            <!-- BOX GRAPHIC WMA -->
            <div class="col-md-12 hidden" id="id_boxChart">
                <div class="nav-tabs-custom">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-9">
                                <p class="text-center">
                                    <i class="fa fa-line-chart"> <strong>Actual (A) vs Forecast (F)</strong></i>
                                    <button class="btn btn-box-tool" onclick="DrawWmaChart()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;</button>
                                </p>
                                <div class="pad bg-warning">
                                    <p class="text-center" id="loadingbox4" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</p>
                                    <canvas id="canvas"><!-- chart will be created here --></canvas>
                                </div>
                            </div><!-- /.col -->
                            <div class="col-md-3">
                                <p class="text-center">
                                    <i class="fa fa-info-circle"> <strong>Info</strong></i>
                                    <button class="btn btn-box-tool" onclick="DrawWmaMean()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;</button>
                                </p>
                                <div class="pad bg-warning">
                                    <span class="loadingbox5" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                                    <ul class="nav nav-stacked" id="id_eqMad"></ul>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>

        </div>
    </section>
</div><!-- /.content-wrapper -->

<script>
    // global variable
    SelectedRow = '';

    // function reset ketika radio berganti
    function ResetOnRadio1Click(){
        $('#id_selKat').addClass('hidden');
        $('#id_selKat option:selected').text('');
        $('#id_selKat').val('');
        $('#id_tblPenjDiv').html('');
        $('#id_btnNext1').removeClass('hidden');
        $('#id_boxRight').addClass('hidden');
        $('#id_boxChart, #id_boxFoot').addClass('hidden');
        $('#id_timer').html('');
        $('#id_rad3Lbl').html('<em>Top Sales Item</em>');
    }
    function ResetOnRadio2Click(){
        $('#id_selKat').removeClass('hidden');
        $('#id_tblPenjDiv').html('');
        $('#id_btnNext1').addClass('hidden');
        $('#id_boxRight').addClass('hidden');
        $('#id_boxChart, #id_boxFoot').addClass('hidden');
        $('#id_timer').html('');
        $('#id_rad3Lbl').html('<em>Top Sales Item</em>');
    }
    function ResetOnRadio3Click(){
        $('#id_selKat').addClass('hidden');
        $('#id_selKat option:selected').text('');
        $('#id_selKat').val('');
        $('#id_boxRight').addClass('hidden');
        $('#id_boxChart, #id_boxFoot').addClass('hidden');
        $('#id_timer').html('');
    }

    // radio button all produk diklik
    function showTblPenjAll(){
        var confirmclick = confirm("This may take a long time, continue?");
        if(confirmclick){
            ResetOnRadio1Click();
            var start_time = new Date().getTime();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_rekappenj",
                beforeSend: function(){
                    $('#loadingbox1').show();
                },
                success: function(res) {
                    var request_time = (new Date().getTime() - start_time)/1000;
                    $('#id_timer').show().html(request_time + " seconds");
                    $('#loadingbox1').hide();
                    $('#id_tblPenjDiv').html(res);
                    $('#id_tblPenj').DataTable({
                        "retrieve": true, // <-- mencegah error reinitilise table.
                        // "order": [[ 1, "asc" ]],
                        "paging": false,
                        "lengthChange": true,
                        "searching": false,
                        "ordering": true,
                        "info": false,
                        "autoWidth": true,
                        fixedHeader: {
                            header: true,
                            footer: true
                        }
                    });
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
            return false;
        } else {
            $('#id_rad1').attr('checked', false);
            $('#id_selKat').addClass('hidden');
            $('#id_selKat option:selected').text('');
        }
    }

    // radio button kategori diklik
    function showTblPenjKat(){
        ResetOnRadio2Click();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_rekapkat",
            beforeSend: function(){
                $('#loadingbox1').show();
            },
            success: function(res) {
                $('#loadingbox1').hide();
                // 1. munculkan element select
                $('#id_selKat').html(res);
                // 2. ketika element select onchange value
                $('#id_selKat').change(function(){
                    var start_time = new Date().getTime();
                    var selKat = document.getElementById('id_selKat').value;
                    $('#id_btnNext1').removeClass('hidden');
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_rekappenjkat",
                        data: {
                            selKat: selKat
                        },
                        beforeSend: function(){
                            $('#loadingbox1').show();
                        },
                        success: function(res) {
                            var request_time = (new Date().getTime() - start_time)/1000;
                            $('#id_timer').show().html(request_time + " seconds");
                            $('#loadingbox1').hide();
                            // 3. munculkan data dalam table
                            $('#id_tblPenjDiv').html(res);
                            $('#id_tblPenj').DataTable({
                                "retrieve": true, // <-- mencegah error reinitilise table.
                                // "order": [[ 1, "asc" ]],
                                "paging": false,
                                "lengthChange": true,
                                "searching": false,
                                "ordering": true,
                                "info": false,
                                "autoWidth": true,
                                fixedHeader: {
                                    header: true,
                                    footer: true
                                }
                            });
                        },
                        error: function(xhr){
                            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                        }
                    });
                })

            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
        return false;
    }


    // radio button per item diklik
    function showModTop5Itm(){
        ResetOnRadio3Click();
        // konten modal 5 item terbaik sepanjang masa
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
                    SelectedRow = theTbl.rows[Ridx].cells[1].innerHTML;
                    $('#id_rad3Lbl').html('').html('<em>Top Sales Item</em>&nbsp;&nbsp;<i class=\'fa fa-barcode\'>&nbsp;' + SelectedRow + '</i>');
                    $('#notificationPreview').modal('hide');
                    $('#id_btnNext1').removeClass('hidden');
                    var start_time = new Date().getTime();
                    // show table penjualan per item
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_rekappenjitm",
                        data: {
                            itmCode: SelectedRow
                        },
                        beforeSend: function(){
                            $('#loadingbox1').show();
                        },
                        success: function(res) {
                            var request_time = (new Date().getTime() - start_time)/1000;
                            $('#id_timer').show().html(request_time + " seconds");
                            $('#loadingbox1').hide();
                            // 3. munculkan data dalam table
                            $('#id_tblPenjDiv').html(res);
                            $('#id_tblPenj').DataTable({
                                "retrieve": true, // <-- mencegah error reinitilise table.
                                // "order": [[ 1, "asc" ]],
                                "paging": false,
                                "lengthChange": true,
                                "searching": false,
                                "ordering": true,
                                "info": false,
                                "autoWidth": true,
                                fixedHeader: {
                                    header: true,
                                    footer: true
                                }
                            });
                        },
                        error: function(xhr){
                            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                        }
                    });

                });
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }


    // tombol pilih periode diklik
    $('#id_btnNext1').click(function(){
        $('#id_boxRight').removeClass('hidden');
        // isi combobox parameter
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_cbxperiode",
            beforeSend: function(){
                $('#loadingbox2').show();
            },
            success: function(res) {
                $('#loadingbox2').hide();
                $('#id_parPeriod').html(res);
                $('#id_tblWmaDiv').html('');
                $('#id_btnNext2').addClass('hidden').attr('disabled', true);
                paramDefault();
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    });
    // event ketika select periode berganti nilai
    $('#id_parPeriod').on('change', function(){
        paramChanged();
    });
    // event ketika input nomor berganti nilai
    $('#id_parNum').on('change', function(){
        if((this.value)=='' || (this.value)<3) // minimal periode yg dipilih = 3
            return false;
            $('#id_btnNext2').removeClass('hidden').attr('disabled', false);
        paramChanged();
    });


    // fungsi tampil table di box kanan dengan event change paramter
    function paramChanged(){
        // ambil data dari parameter
        var id_parPeriod = $('#id_parPeriod').val();
        var id_parNum    = $('#id_parNum').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_wmatbl",
            data: {
                id_parPeriod : id_parPeriod,
                id_parNum    : id_parNum
            },
            beforeSend: function(){
                $('#loadingbox2').show();
            },
            success: function(res) {
                $('#loadingbox2').hide();
                // 3. munculkan data dalam table
                $('#id_tblWmaDiv').html(res);
                $('#id_tblWma').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "paging": false,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": false,
                    "autoWidth": true,
                    fixedHeader: {
                        header: true,
                        footer: true
                    }
                });
                // enable/disable button next 2
                $('.cbxWmas').on('change',function(){
                    if ($('.cbxWmas:checked').length) {
                        $('#id_btnNext2').removeAttr('disabled');
                    } else {
                        $('#id_btnNext2').attr('disabled', 'disabled');
                    }
                });
                // set checkboxes checked
                for(var iteratecbx=0; iteratecbx<=(id_parNum-1); iteratecbx++){
                    // checked the checkboxes from above
                    $('#id_cbxWmas_'+iteratecbx).prop('checked',true);
                }
                // tombol 2 diklik/ PROSES WMA
                $('#id_btnNext2').click(function(){
                    btnNext2Click();
                });
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }

    // fungsi tampil table di box kanan dengan event change paramter
    function paramDefault(){
        // set default value utk num bobot = 5
        $('#id_parNum').val(5);
        // ambil data dari parameter
        var id_parPeriod = $('#id_parPeriod').val();
        var id_parNum    = $('#id_parNum').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_wmatbl",
            data: {
                id_parPeriod : id_parPeriod,
                id_parNum    : id_parNum
            },
            beforeSend: function(){
                $('#loadingbox2').show();
            },
            success: function(res) {
                $('#loadingbox2').hide();
                // 3. munculkan data dalam table
                $('#id_tblWmaDiv').html(res);
                $('#id_tblWma').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "paging": false,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": false,
                    "autoWidth": true,
                    fixedHeader: {
                        header: true,
                        footer: true
                    }
                });
                // secara default munculkan tombol next2
                $('#id_btnNext2').removeClass('hidden').attr('disabled', false);
                // enable/disable button next 2
                $('.cbxWmas').on('change',function(){
                    if ($('.cbxWmas:checked').length) {
                        $('#id_btnNext2').removeAttr('disabled');
                    } else {
                        $('#id_btnNext2').attr('disabled', 'disabled');
                    }
                });
                // set checkboxes checked
                for(var iteratecbx=0; iteratecbx<=(id_parNum-1); iteratecbx++){
                    // checked the checkboxes from above
                    $('#id_cbxWmas_'+iteratecbx).prop('checked',true);
                }
                // tombol 2 diklik/ PROSES WMA
                $('#id_btnNext2').click(function(){
                    btnNext2Click();
                });
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }


    // tombol hitung WMA diklik
    function btnNext2Click() {
        console.log('slctd row : '+SelectedRow);
        $('#id_boxFoot').removeClass('hidden');
        // ambil data dari parameter
        var selKat = $("#id_selKat option:selected").text();
        var SelectedRad = $('input[name=radjnsramal]:checked');
        var IdSelectedRad = SelectedRad.attr('id');
        switch (IdSelectedRad){
            case "id_rad1":
                var selKatVal = '';
                break;
            case "id_rad2":
                selKatVal = document.getElementById('id_selKat').value;
                break;
            case "id_rad3":
                selKatVal = SelectedRow;
                break;
        }
        console.log(selKatVal);
        var id_parPeriod2 = $('#id_parPeriod').val();
        var id_parNum2    = $('#id_parNum').val();
        var myCheckboxes = [];
        $("input[name='cbxWmadd[]']:checked").each(function ()
        {
            myCheckboxes.push(parseInt($(this).val()));
        });

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/calcWMA",
            data: {
                myCheckboxes : myCheckboxes,
                id_parPeriod2 : id_parPeriod2,
                selKat : selKat,
                selKatVal : selKatVal,
                ItmCode : SelectedRow
            },
            beforeSend: function () {
                $('#loadingbox3').show();
            },
            success: function(res) {
                $('#loadingbox3').hide();
                console.log(res);
                // 3. munculkan data dalam table
                $('#id_tblCalcWmaDiv').html(res);
                $('#id_tblCalcWma').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "paging": false,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": false,
                    "info": true,
                    "autoWidth": true,
                    fixedHeader: {
                        header: true,
                        footer: true
                    }
                });
                // show box chart
                $('#id_boxChart').removeClass('hidden');
                // tampilkan wma chart
                DrawWmaChart();
                DrawWmaMean();
            },
            error: function (xhr) {
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }
</script>



<!-- CHART JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/chartjs/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/chartjs/samples/utils.js"></script>
<script>
    function DrawWmaChart(){
        var SelectedRad = $('input[name=radjnsramal]:checked');
        var IdSelectedRad = SelectedRad.attr('id');
        switch (IdSelectedRad){
            case "id_rad1":
                var selKatVal = '';
                break;
            case "id_rad2":
                selKatVal = document.getElementById('id_selKat').value;
                break;
            case "id_rad3":
                selKatVal = SelectedRow;
                break;
        }
        jQuery.ajax({
            type: "POST",
            dataType : "json", // jenis data yg di proses
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/showChartWmaData",
            data: {
                selKatVal: selKatVal
            },
            beforeSend: function () {
                $('#loadingbox4').show();
            },
            success: function(res) {
                $('#loadingbox4').hide();
                /************* draw canvas ***************/
                // deklarasi variable array
                var mmmy = [];
                var qty  = [];
                var wma  = [];
                // push data ke variable array
                for(var i in res){
                    console.log(res[i].mmmy);
                    mmmy.push(res[i].mmmy);
                    qty.push(res[i].qty);
                    wma.push(res[i].wma);
                }
                // chart data
                var config = {
                    type: 'line',
                    data: {
                        labels: mmmy,
                        datasets: [{
                            label: "Actual(At)",
                            fill: false,
                            backgroundColor: window.chartColors.blue,
                            borderColor: window.chartColors.blue,
                            data: qty
                        }, {
                            label: "Forecast(Ft)",
                            fill: false,
                            backgroundColor: window.chartColors.orange,
                            borderColor: window.chartColors.orange,
                            data: wma
                        }]
                    },
                    options: {
                        responsive: true,
                        title:{
                            display:false,
                            text:'Aktual vs WMA'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Periode(t)'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Qty(Dt)'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                };
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myLine = new Chart(ctx, config);
                /************* draw canvas ***************/
            },
            error: function (xhr) {
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }
</script>



<link rel="stylesheet" href="<?= base_url(); ?>assets/templ/bower_components/mathscribe/unifrakturmaguntia.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/templ/bower_components/mathscribe/jqmath-0.4.3.css">
<script src="<?= base_url(); ?>assets/templ/bower_components/mathscribe/jqmath-etc-0.4.5.min.js" charset="utf-8"></script>
<script>
    // show mean value
    function DrawWmaMean(){
        // ambil data dari parameter
        var SelectedRad = $('input[name=radjnsramal]:checked');
        var IdSelectedRad = SelectedRad.attr('id');
        switch (IdSelectedRad){
            case "id_rad1":
                var selKatVal = '';
                break;
            case "id_rad2":
                selKatVal = document.getElementById('id_selKat').value;
                break;
            case "id_rad3":
                selKatVal = SelectedRow;
                break;
        }
        var id_parPeriod2 = $('#id_parPeriod').val();
        var id_parNum2    = $('#id_parNum').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/showMeanVal",
            data: {
                id_parPeriod2 : id_parPeriod2,
                id_parNum2 : id_parNum2,
                selKatVal : selKatVal
            },
            beforeSend: function () {
                $('.loadingbox5').show();
            },
            success: function(res) {
                $('.loadingbox5').hide();
                $('#id_eqMad').html(res);
            },
            error: function (xhr) {
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }
</script>