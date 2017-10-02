<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
    $ses_start = $this->session->userdata('ses_start');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <LINK REL="SHORTCUT ICON" HREF="<?php echo base_url(); ?>assets/templ/libraries/img/logo.ico">
    <title><?php echo $apptitle; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/templ/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>assets/templ/bower_components/font-awesome/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/iCheck/square/blue.css">
    <!-- Morris chart -->
    <!--<link rel="stylesheet" href="<?php /*echo base_url(); */?>assets/templ/plugins/morris/morris.css">-->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- for datatables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/datatables/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/datatables/buttons.dataTables.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
                <img src="<?php echo base_url(); ?>assets/templ/libraries/img/logo_inv.png" style="height: 30px; weight: 30px;">
            </span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                <img src="<?php echo base_url(); ?>assets/templ/libraries/img/logo_inv.png" style="height: 30px; weight: 30px;">
                <?php echo "<b>&nbsp;&nbsp;". $apptitle ."&nbsp;&nbsp;</b>"; ?>
            </span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- application description -->
                    <li class="dropdown user user-menu">
                        <a href="<?php echo base_url(); ?>index.php/cpage" class="dropdown-toggle">
                            <span class="glyphicon glyphicon-home"></span>
                            <span class="hidden-xs">Home</span>
                        </a>
                    </li>
                    <!-- / -->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="hidden-xs"><?php echo "Hello " . $username . "!"; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo base_url(); ?>assets/templ/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $username ." - ". $level; ?>
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <button id="btnLogout" type="button" class="btn btn-default btn-flat">Logout</button>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/templ/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#btnLogout").click(function(){
            $.ajax({
                url:"<?php echo base_url(); ?>index.php/clogin/logout",
                type: "POST", //request type
                success:function(result){
                    window.location.href = "<?php echo base_url(); ?>index.php/clogin";
                }
            });
        });
    })
</script>

<!-- check idelitme document -->
<script>
    var idleTime = 0;
    $(document).ready(function () {
        console.log(idleTime);
        var idleInterval = setInterval(timerIncrement, 5000); // 60000 = 1 minute
        console.log("Idle Interval: " + idleInterval);
        function bindMouseMove() {
            $(this).unbind('mousemove').one('mousemove', function (e) {
                idleTime = 0;
                SetStatusToDutty();
            });
        }
        function bindKeyPress() {
            $(this).unbind('keypress').one('keypress', function (e) {
                idleTime = 0;
                SetStatusToDutty();
            });
        }
        bindMouseMove();
        bindKeyPress();
        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > 5) { // t detik setelah aktifitas terakhir
                bindMouseMove();
                bindKeyPress();
                SetStatusToIdle();
            }
        }
    });
    
    function SetStatusToIdle() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cutility/StatusToIdle",
            success: function(res) {
                console.log(res);
                $('#id_aUsrStatus').html("<i class='fa fa-circle text-gray'></i> Away");
            },
            error: function (xhr) {
            }
        });
    }
    
    function SetStatusToDutty() {
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/cutility/StatusToDutty",
            success: function(res) {
                console.log(res);
                $('#id_aUsrStatus').html("<i class='fa fa-circle text-yellow'></i> Dutty");
            },
            error: function (xhr) {
            }
        });
    }
</script>