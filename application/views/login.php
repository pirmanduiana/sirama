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
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/plugins/iCheck/square/blue.css">
    <style>
        #id_ImgSpo{
            width: 102px;
            height: 57px;
        }
        #id_Thxto{
            background-color: transparent;
            width: 45%;
            color: darkblue;
            font-size: small;
            font-family: "Century Gothic";
            float: left;
            margin: 12px 0px 0px 0px;
            padding: 9px 30px 0px 0px;
            text-align: right;
        }
        #id_ThxImg{
            background-color: transparent;
            width: 55%;
            float: right;
            margin: 12px 0px 0px 0px;
            padding: 0px 0px 0px 29px;
            border-left: 3px solid orangered;
            border-radius: 30px 8px;
        }
        #id_AppTtl{
            color: orangered;
            font-weight: bold;
            font-family: "Century Gothic";
        }
        #id_AppVer{
            text-align: center;
            margin-bottom: 15px;
            color: darkblue;
            font-size: 12px;
            font-family: "Century Gothic";
        }
        #id_Str1{
            color: darkblue;
        }
        .login-pages{
            background-color: white;
        }
        .login-box-body{
            background-color: #ffff99;
        }
        #id_RcmdBrow{
            text-align: center;
            color: darkblue;
            font-size: x-small;
            font-family: "Century Gothic";
            margin-bottom: -11px;
            margin-top: 11px;
        }
        #id_RcmdBrow img{
            height: 16px;
            width: 16px;
        }
    </style>
</head>
<body class="hold-transition login-pages">
    <div class="login-box">
        <div style="font-weight: bold; text-align: center;">
            <h1 id="id_AppTtl"><?php echo "<span id='id_Str1'>".substr($apptitle, 0, 8)."</span>" . "<span id='id_Str2'>".substr($apptitle, 8, 13)."</span>"; ?></h1>
        </div>
        <div id="id_AppVer">
            <?php echo $appver; ?>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form id="frmLogin" name="myForm">
                <div class="form-group has-feedback">
                    <input type="text" id="iduname" name="txtusername" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="idpwd" name="txtpassword" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div id="warning" style="display:none;"></div>
                        <div id="loadinglogin">
                            <img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button id="id_submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div><!-- /.col -->
                </div>
                <div id="id_RcmdBrow">
                    Gunakan
                    <img src="<?php echo base_url(); ?>assets/templ/libraries/img/chrome.png">
                    Google Chrome untuk hasil optimal
                </div>
            </form>
        </div><!-- /.login-box-body -->
        <!-- logo disponsori oleh -->
        <div id="id_Thxto">
            Terima kasih <br> kepada:
        </div>
        <div id="id_ThxImg">
            <img id="id_ImgSpo" src="<?= base_url(); ?>/assets/templ/libraries/img/mitra10.png">
        </div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/templ/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready(
            function(){
                $("#loadinglogin").hide();
                /* spinner hidden when ajaxstop */
                $(document).ajaxStop(function(){
                    $("#loadinglogin").hide();
                });
                /* spinner show when ajaxstart */
                $(document).ajaxStart(function(){
                    $("#loadinglogin").show();
                });

                $("#id_submit").click(function(event) {
                    event.preventDefault();
                    var uname = $("input#iduname").val();
                    var paswd = $("input#idpwd").val();
                    $('#warning').html('');
                    document.getElementById("warning").style.removeProperty('display');
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/clogin/auth",
                        data: {txtusername: uname, txtpassword: paswd},
                        success: function(res) {
                            if(res==true){
                                $('#warning').html('Redirecting...');
                                $('#warning').fadeOut(5000);
                                window.location.href = "<?php echo base_url(); ?>" + "index.php/cpage";
                            } else {
                                $('#warning').html('Wrong username/password!');
                                $('#warning').fadeOut(5000);
                            }
                        }
                    });
                    return false;
                });
            }
        )
    </script>
    <script>
        $(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>
</html>