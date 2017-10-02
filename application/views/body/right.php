        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li id="id_LiSysInfo"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-info"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <div id="loadinginfo">
                        <img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading info...
                    </div>
                    <div id="id_DivSysInfo">
                        <!-- ajax load here -->
                    </div>
                    <script>
                        $(document).on('click','#id_LiSysInfo',function(){
                            jQuery.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>" + "index.php/cutility/ShowSysInfo",
                                beforeSend: function () {
                                    $('#loadinginfo').show();
                                },
                                success: function(res) {
                                    $('#loadinginfo').hide();
                                    $('#id_DivSysInfo').html(res);
                                },
                                error: function (xhr) {
                                    $('#loadinginfo').hide();
                                    $('#id_DivSysInfo').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
                                }
                            });
                        })
                    </script>
                </div><!-- /.tab-pane -->

                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">
                    Stats Tab Content
                </div><!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>
                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                Some information about this general settings option
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                Allow mail redirect
                                <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                Other sets of options are available
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                Expose author name in posts
                                <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                Allow the user to show his name in blog posts
                                </p>
                            </div><!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                Show me as online
                                <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                Turn off notifications
                                <input type="checkbox" class="pull-right">
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                Delete chat history
                                <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div><!-- /.form-group -->
                        </form>
                    </div><!-- /.tab-pane -->
            </div>
        </aside><!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/templ/bootstrap/js/bootstrap.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url(); ?>assets/templ/ajax/libs/ui/jquery-ui.min.js"></script>
    <!-- Morris.js charts -->
    <!--<script src="<?php /*echo base_url(); */?>assets/templ/ajax/libs/raphael/raphael-min.js"></script>
    <script src="<?php /*echo base_url(); */?>assets/templ/plugins/morris/morris.min.js"></script>--> <!-- switch here -->
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templ/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/templ/ajax/libs/moment.js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/templ/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/templ/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="<?php /*echo base_url(); */?>assets/templ/dist/js/pages/dashboard.js"></script>--> <!-- switch here -->
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/templ/dist/js/demo.js"></script>

    <!-- AdminLTE Datatables -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/plugins/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/plugins/datatables/buttons.print.min.js"></script>


    <!-- FLOT CHARTS -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/flot/jquery.flot.min.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/flot/jquery.flot.resize.min.js"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/flot/jquery.flot.pie.min.js"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="<?php echo base_url(); ?>assets/templ/plugins/flot/jquery.flot.categories.min.js"></script>

    <!-- WIZARD PADA DAFTAR PASIEN -->
    <script src="<?php echo base_url(); ?>assets/templ/bower_components/wizardmaster/jquery.bootstrap.wizard.js"></script>
    <script src="<?php echo base_url(); ?>assets/templ/bower_components/wizardmaster/prettify.js"></script>

    <!-- for datetime picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/libraries/js/romanize.js"></script>

    <!-- for select2 -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/select2/dist/js/select2.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/templ/bower_components/select2/dist/css/select2.css">
    <script>
      $(function(){
          // turn the element to select2 select style
          $('#select2').select2();
      });
    </script>

    <!-- for push error log -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/templ/libraries/js/pusherrorlog.js"></script>

    <!-- table2excel -->
    <script src="<?php echo base_url(); ?>assets/templ/bower_components/table2excel/src/jquery.table2excel.js"></script>

    <!--  scroll to top -->
    <a href="#" class="back-to-top" style="display: inline;">
        <i class="fa fa-chevron-circle-up"></i>
    </a>
    <style>
        .back-to-top{
            background: none;
            margin: 0;
            position: fixed;
            bottom: 0;
            right: 0;
            width: 70px;
            height: 70px;
            z-index: 100;
            display: none;
            text-decoration: none;
            color: rgba(34, 45, 50, 0.51);
        }
        .back-to-top i{
            font-size: 50px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('.back-to-top').hide();
            var offset = 250;
            var duration = 300;
            $(window).scroll(function () {
                if($(this).scrollTop() > offset){
                    $('.back-to-top').fadeIn(duration);
                } else {
                    $('.back-to-top').fadeOut(duration);
                }
            });
            $('.back-to-top').click(function (event) {
                event.preventDefault();
                $('html, body').animate(
                    {scrollTop: 0},
                    duration
                );
                return false;
            })
        });
    </script>
  </body>
</html>