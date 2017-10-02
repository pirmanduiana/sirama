<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
	// session that would be inserted to database
	$ses_start  = $this->session->userdata('ses_start');
	$ses_status = $this->session->userdata('ses_status');
?>

<!-- modal for detail bill -->
<div class="modal" id="notificationPreview1" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="id_mdlHead1"></div>
            <div class="modal-body" id="id_mdlBdy1">
                <!-- ajax load here -->
            </div>
        </div>
    </div>
</div>
<!-- modal for detail cashier online -->
<div class="modal" id="notificationPreview2" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="id_mdlHead2"></div>
            <div class="modal-body" id="id_mdlBdy2">
                <!-- ajax load here -->
            </div>
        </div>
    </div>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-info"></i>
        <i>User <?= $username ?>, session start on <?= $ses_start ?>. App. title <?= $apptitle ?></i>
    </div>
    <div class="row">
        <!-- ROW 1 INFO -->
        <div class="col-lg-3 col-xs-6">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-calculator"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">HARI INI ADA <i class="fa fa-fw fa-square" id="id_blip1_1"></i></span>
                    <span class="info-box-number" id="id_dsbrow1_1"><!-- ajax load here --></span>
                    <span class="progress-description">
                    Transaksi per bill
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TRANSAKSI AWAL <i class="fa fa-fw fa-square" id="id_blip1_2"></i></span>
                    <span class="info-box-number" id="id_dsbrow1_2"><!-- ajax load here --></span>
                    <span class="progress-description">
                    Tgl. <?= date('Y-m-d') ?>
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="info-box bg-orange">
                <span class="info-box-icon"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">KASIR ONLINE <i class="fa fa-fw fa-square" id="id_blip1_3"></i></span>
                    <span class="info-box-number" id="id_dsbrow1_3"><!-- ajax load here --></span>
                    <span class="progress-description">
                    Orang
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="info-box bg-orange">
                <span class="info-box-icon"><i class="fa fa-sign-in"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">LOGIN PERTAMA <i class="fa fa-fw fa-square" id="id_blip1_4"></i></span>
                    <span class="info-box-number" id="id_dsbrow1_4"><!-- ajax load here --></span>
                    <span class="progress-description" id="id_dsbrow1_5">
                    Pukul 12:59:59
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div><!-- ./col -->

        <!-- ROW 2 SALES ANALYSIS -->
        <div class="col-md-6">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?= base_url() ?>/assets/templ/libraries/img/logo.png" alt="user image">
                        <span class="username"><a href="#">5 Item Penjualan Terbaik Bulan Ini</a></span>
                        <span class="description" id="id_RefreshTime2_1"></span>
                    </div><!-- /.user-block -->
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-toggle="tooltip"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" id="id_dsbrow2_1">
                    <!-- ajax load here -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?= base_url() ?>/assets/templ/libraries/img/logo.png" alt="user image">
                        <span class="username"><a href="#"><em>5 Dead Movement Product</em> 6 Bulan Terakhir</a></span>
                        <span class="description" id="id_RefreshTime2_2"></span>
                    </div><!-- /.user-block -->
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-toggle="tooltip"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" id="id_dsbrow2_2">
                    <!-- ajax load here -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <!-- ROW 3 SALES ITEM PER QTY -->
        <div class="col-md-12">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?= base_url() ?>/assets/templ/libraries/img/logo.png" alt="user image">
                        <span class="username"><a href="#">Rekapitulasi Penjualan</a></span>
                        <span class="description" id="id_RefreshTime3_1"></span>
                    </div><!-- /.user-block -->
                    <div class="box-tools">
                        <button id="id_BtnEm3_1" class="btn btn-box-tool" data-toggle="tooltip"><i class="fa fa-envelope"></i>
                            <span id="id_SpEm3_1"></span>
                        </button>
                        <button class="btn btn-box-tool" data-toggle="tooltip"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" id="id_dsbrow3_1">
                    <!-- ajax load here -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <!-- ROW 4 FORECASTING -->
        <div class="col-md-12">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?= base_url() ?>/assets/templ/libraries/img/logo.png" alt="user image">
                        <span class="username"><a href="#">Ramalan Penjualan</a></span>
                        <span class="description">Tanpa auto update, update secara manual</span>
                    </div><!-- /.user-block -->
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-toggle="tooltip"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <input type="radio" id="id_rad1" name="radjnsramal" onclick=""> Semua Produk Cat &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="id_rad2" name="radjnsramal" onclick=""> Per Kategori Cat &nbsp;&nbsp;&nbsp;&nbsp;
                        <select id="id_sel_dsbrow4_1" class="hidden">
                            <!-- load by ajax -->
                        </select>
                    </div>
                    <div class="col-md-9">
                        <div id="id_dsbrow4_1">
                            <p class="text-center" id="loadingbox4" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</p>
                            <canvas id="canvas"><!-- chart will be created here --></canvas>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <span class="loadingbox5" style="display: none"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        <span id="id_chartInfo"><!-- ajax load here --></span>
                        <ul class="nav nav-stacked" id="id_eqMad"></ul>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- auto load html request -->
<script>
    $(document).ready(function(){
        LoadDsbRow1_1();
        LoadDsbRow1_2();
        LoadDsbRow1_3();
        LoadDsbRow1_4();
        LoadDsbRow1_5();
        LoadDsbRow2_1();
        LoadDsbRow2_2();
        LoadDsbRow3_1();
        filSelDsbRow4_1();
        DrawWmaChart('');
        DrawWmaMean('');
        DrawChartInfo('');
    });

    function shakeClickable1_2(){
        $('#id_dsbrow1_2').effect('shake', {times:2, distance:5}, 250);
    }
    function shakeClickable1_3(){
        $('#id_dsbrow1_3').effect('shake', {times:2, distance:5}, 250);
    }
    setInterval(
        function () {
            shakeClickable1_2();
            shakeClickable1_3();
        }, 3500
    );

    function LoadDsbRow1_1() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow1_1",
            beforeSend: function(){
                $('#id_blip1_1').show();
            },
            success: function(res) {
                $('#id_blip1_1').hide();
                $('#id_dsbrow1_1').html(res);
            },
            error: function(xhr){
                $('#id_dsbrow1_1').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow1_1();
        }, 2000
    );

    function LoadDsbRow1_2() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow1_2",
            beforeSend: function(){
                $('#id_blip1_2').show();
            },
            success: function(res) {
                $('#id_blip1_2').hide();
                $('#id_dsbrow1_2').html(res);
                var trn_code_ = $('#id_trnCodeVal').text();
                ShowBillDetail(trn_code_);
            },
            error: function(xhr){
                $('#id_dsbrow1_2').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow1_2();
        }, 30000
    );
    function ShowBillDetail(trn_code){
        $('#notificationPreview1').addClass('modal-info');
        $('#id_mdlHead1').html("BILL# " + trn_code);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow1_2_billdetail",
            data: {
                trn_code: trn_code
            },
            beforeSend: function(){
            },
            success: function(res) {
                $('#id_mdlBdy1').html(res);
            },
            error: function(xhr){
                $('#id_mdlBdy1').html("error");
            }
        });
    }

    function LoadDsbRow1_3() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow1_3",
            beforeSend: function(){
                $('#id_blip1_3').show();
            },
            success: function(res) {
                $('#id_blip1_3').hide();
                $('#id_dsbrow1_3').html(res);
                ShowCashOnline();
            },
            error: function(xhr){
                $('#id_dsbrow1_3').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow1_3();
        }, 2000
    );
    function ShowCashOnline(){
        $('#notificationPreview2').addClass('modal-warning');
        $('#id_mdlHead2').html("Detail kasir yang online");
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow1_3_cashonline",
            beforeSend: function(){
            },
            success: function(res) {
                $('#id_mdlBdy2').html(res);
            },
            error: function(xhr){
                $('#id_mdlBdy2').html("error");
            }
        });
    }


    function LoadDsbRow1_4() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow1_4",
            beforeSend: function(){
                $('#id_blip1_4').show();
            },
            success: function(res) {
                $('#id_blip1_4').hide();
                $('#id_dsbrow1_4').html(res);
            },
            error: function(xhr){
                $('#id_dsbrow1_4').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow1_4();
        }, 30000
    );

    function LoadDsbRow1_5() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow1_5",
            beforeSend: function(){
            },
            success: function(res) {
                $('#id_dsbrow1_5').html(res);
            },
            error: function(xhr){
                $('#id_dsbrow1_5').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow1_5();
        }, 30000
    );

    function LoadDsbRow2_1() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow2_1",
            beforeSend: function(){
            },
            success: function(res) {
                var date = new Date();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                var strTime = hours + ':' + minutes + ':' + seconds;
                $('#id_RefreshTime2_1').html('Last update ' + strTime);
                $('#id_dsbrow2_1').html(res);
            },
            error: function(xhr){
                $('#id_dsbrow2_1').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow2_1();
        }, 30000
    );

    function LoadDsbRow2_2() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow2_2",
            beforeSend: function(){
            },
            success: function(res) {
                var date = new Date();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                var strTime = hours + ':' + minutes + ':' + seconds;
                $('#id_RefreshTime2_2').html('Last update ' + strTime);
                $('#id_dsbrow2_2').html(res);
                setInterval(
                    function () {
                        //$('.progress-number.text-info.DetDeadItm').effect('shake', {times:2, distance:1}, 350);
                    }, 3500
                );
            },
            error: function(xhr){
                $('#id_dsbrow2_2').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow2_2();
        }, 30000
    );

    function LoadDsbRow3_1() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow3_1",
            beforeSend: function(){
            },
            success: function(res) {
                var date = new Date();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var seconds = date.getSeconds();
                var strTime = hours + ':' + minutes + ':' + seconds;
                $('#id_RefreshTime3_1').html('Last update ' + strTime);
                $('#id_dsbrow3_1').html(res);
            },
            error: function(xhr){
                $('#id_dsbrow3_1').html("error");
            }
        });
    }
    setInterval(
        function () {
            LoadDsbRow3_1();
        }, 30000
    );

    // ketika radion button 1 ramalan semua diklik
    $('#id_rad1').click(function(){
        $('#id_sel_dsbrow4_1').addClass('hidden');
        DrawWmaChart('');
        DrawWmaMean('');
        DrawChartInfo('');
    });

    // ketika radio button 2 ramalan per kategori cat diklik
    $('#id_rad2').click(function(){
        $('#id_sel_dsbrow4_1').removeClass('hidden');
    });

    // isi combobox pilih kategori
    function filSelDsbRow4_1(){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_forecast/show_rekapkat",
            beforeSend: function(){
                $('#id_sel_dsbrow4_1').html("loading kategori...");
            },
            success: function(res) {
                $('#id_sel_dsbrow4_1').html(res);
                // 2. ketika element select onchange value
                $('#id_sel_dsbrow4_1').change(function(){
                    var selKatVal = $('#id_sel_dsbrow4_1').val();
                    DrawWmaChart(selKatVal);
                    DrawWmaMean(selKatVal);
                    DrawChartInfo(selKatVal);
                })
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
        return false;
    }
</script>

<!-- CHART JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/chartjs/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/chartjs/samples/utils.js"></script>
<script>
    function DrawWmaChart(selKatVal){
        var selKatVal = selKatVal;
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

                var CountJson =  Object.keys(res).length;
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myLine = new Chart(ctx, config);
                /************* draw canvas ***************/
            },
            error: function (xhr) {
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }

    // show mean value
    function DrawWmaMean(selKatVal){
        // ambil data dari parameter
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

    // tampilkan keterangan chart forecast
    function DrawChartInfo(selKatVal){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/LoadDsbRow4_1_chartInfo",
            data: {
                selKatVal : selKatVal
            },
            beforeSend: function () {
                $('.loadingbox5').show();
            },
            success: function(res) {
                $('.loadingbox5').hide();
                $('#id_chartInfo').html(res);
            },
            error: function (xhr) {
                $('#id_chartInfo').html("error");
            }
        });
    }

    // email box 3_!
    $(document).on('click','#id_BtnEm3_1', function () {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cdashb/SendEm3_1",
            beforeSend: function () {
                $('#id_SpEm3_1').show().html("").html("Sending...");
            },
            success: function(res) {
                $('#id_SpEm3_1').html(res).fadeOut(10000);
            },
            error: function (xhr) {
                $('#id_SpEm3_1').html(xhr.status + ": Error sending email").fadeOut(10000);
            }
        });
    })
</script>
