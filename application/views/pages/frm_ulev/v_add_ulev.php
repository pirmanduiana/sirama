<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
	// session that would be inserted to database
	$ses_start  = $this->session->userdata('ses_start');
	$ses_status = $this->session->userdata('ses_status');
?>

<!-- duallist box select -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/templ/bower_components/duallistbox2/src/prettify.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/templ/bower_components/duallistbox2/src/bootstrap-duallistbox.css">
<script src="<?php echo base_url(); ?>assets/templ/bower_components/duallistbox2/src/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/templ/bower_components/duallistbox2/src/run_prettify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/templ/bower_components/duallistbox2/src/jquery.bootstrap-duallistbox.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	<?php echo $title; ?>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Setup</a></li>
	<li class="active">User & Menu</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

<!-- Main row -->
<div class="row">
<!-- Left col -->
<section class="col-lg-7 connectedSortable">
<div class="nav-tabs-custom"><!-- div SUPER content left -->
	<ul class="nav nav-tabs pull-right"><li class="pull-left header"><i class="fa fa-inbox"></i> Level & User</li></ul>
	<div class="tab-content"><!-- content -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Group Menu</a></li>
			  <li class="" id="idTab2"><a href="#tab_2" data-toggle="tab" aria-expanded="false">User list</a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tab_1">
				<!--  navigation bar -->
				<p class="text-muted well well-sm no-shadow" style="margin-top: 10px; border-bottom:2px solid;">
				<input type="button" class="btn btn-xs btn-primary" data-target="#modaddulev<?php echo "test"; ?>" data-toggle="modal" value="+ Add user level"/>
				</p>
				
				<table id="listobj" class="display compact table-hover" role="grid" aria-describedby="example2_info">
					<thead>
					<tr>
                        <th>User level</th>
                        <th>Number of related object</th>
                        <th>Options</th>
                    </tr>
					</thead>
					<tbody id="tBodyUlev">
					    <!-- ajax load here -->
					</tbody>
				</table>
                <div id="loadingulev">
                    <img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...
                </div>

				<!-- modal form add user level -->
				<div class="modal fade" id="modaddulev<?php echo "test"; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="trued">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- Modal Header -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Add user level</h4>
							</div>
							<!-- Modal Body -->
                            <?php echo form_open('pages/c_crud_user/create_ulev','name="frm_duallistbox" id="demoform"'); ?>
                                <div class="modal-body">
                                    <em>Level name</em>
                                    <input type="text" name="txt_objlev" class="form-control" id="id_usrlev" placeholder="Level name <no space>" style="margin-bottom:10px;" required>
                                    <em>Home page</em>
                                    <select class="form-control" name="txt_objidx" id="id_usridx">
                                        <?php
                                            $query = $this->m_crud_user->select_idxmenu();
                                            foreach($query->result() as $row){
                                                echo "<option value='$row->file_path'>$row->title</option>";
                                            }
                                        ?>
                                    </select>
                                    <select multiple="multiple" size="10" name="duallistbox_demo1[]" id="id_duallistbox">
                                        <?php
                                            $query = $this->m_crud_user->select_sysmenu();
                                            foreach ($query->result() as $row) {
                                                echo "<option value='". $row->id ."'>". $row->id. " | " .$row->title ."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-xs btn-info" data-dismiss="modal"> Close </button>
                                    <input type="submit" class="btn btn-xs btn-info" value="Submit data">
                                </div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<!-- Modal End -->

			  </div><!-- /.tab-pane -->
			  <div class="tab-pane" id="tab_2">				
				<!--  navigation bar -->
				<p class="text-muted well well-sm no-shadow" style="margin-top: 10px; border-bottom:2px solid;">
					<input type="button" id="id_ModAddUsr" class="btn btn-xs btn-primary" data-target="#modaddusr" data-toggle="modal" value="+ Add user" onclick="resetmodal()"/>
				</p>
				<table id="listusr" class="display compact table-hover" role="grid" aria-describedby="example2_info">
					<thead>
					<tr>
						<th>Login ID</th>
						<th>User Full Name</th>
						<th>System Privileges</th>
						<th>Object Level</th>
						<th>Options</th>						
					</tr>
					</thead>
					<tbody id="tBodyUser">
                        <!-- filled by ajax -->
					</tbody>
				</table>
                <div id="loading">
                    <img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...
                </div>

				<!-- modal form add user -->
				<div class="modal fade" id="modaddusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="trued">
					<div class="modal-dialog">
						<div class="modal-content" id="id_modconaddusr">
							<!-- Modal Header -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Add user</h4>
							</div>
							<!-- Modal Body -->
							<div class="modal-body">
                            <form id="frmAddusr" class="form-horizontal">
                                <div>
                                    <label class="labelEdit">Login ID</label>
                                    <div>
                                        <input type="text" name="txtloginid" class="form-control" id="inpLogin" placeholder="login id" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="labelEdit">Password</label>
                                    <div>
                                        <input type="password" name="txtpassword" class="form-control" id="inpPass" placeholder="password" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="labelEdit">Full Name</label>
                                    <div>
                                        <input type="text" name="txtfullname" class="form-control" id="inpFulln" placeholder="full name" required>
                                    </div>
                                </div>
                                <div style="margin-top:10px">
                                    <label class="labelEdit">Object Level</label>
                                    <div>
                                        <select name="txtobjlevel" class="form-control" id="inpLev" required>
                                            <option value="">-- select --</option>
                                            <?php $query = $this->m_crud_user->select_objlist();
                                            foreach ($query->result() as $row) { ?>
                                            <option><?php echo $row->obj_level; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top:10px">
                                    <label class="labelEdit">Privileges   :   </label>
                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="admin">  Admin
                                    <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="guest" checked="checked">  Guest
                                </div>
                                <div id="emptywarn" style="display:none;"></div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-xs btn-info" data-dismiss="modal"> Close </button>
                                    <input type="button" id="btnAddusr" name="commit" value="Submit" class="btn btn-xs btn-info">
                                </div>
                            </form>
						</div>
					</div>
				</div>
				<!-- Modal End -->
			  </div><!-- /.tab-pane -->			  			  			  			  			  						 			  			  			  			  			  	
			</div><!-- /.tab-content -->
		</div>																		
	</div><!-- / MAIN content -->
</div><!-- /div SUPER content left -->
</section>

<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-5 connectedSortable">
	<div class="box box-primary">
		<div class="box-header with-border">
            <i class="fa fa-bar-chart-o"></i>
            <h3 class="box-title">Recently login session</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <div id="id_LoadChartSesLog">
                <img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...
            </div>
		</div>
		<div class="box-body">
            <canvas id="canvas"></canvas>
		</div><!-- /.box-body-->
	</div><!-- /.box -->
	<!-- chart ends -->

	<div class="nav-tabs-custom"><!-- div SUPER content left -->
		<ul class="nav nav-tabs pull-right"><li class="pull-left header"><i class="fa fa-inbox"></i> Session Log</li></ul>
		<div class="tab-content"><!-- content -->
			<table id="sesmonitor" class="display compact table-hover" role="grid" aria-describedby="example2_info">
				<thead>
				<tr>
					<th>Login ID</th>
					<th>Ses. Start</th>
					<th>Ses. Finish</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody id="tBodySes">
					<!-- ajax load here -->
				</tbody>
			</table>
            <div id="loadinguses">
                <img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...
            </div>
		</div>
	</div>
</section>
</div>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->



<script>
    /*************************************************************************/
    /*************************************************************************/
    /************************      FULLY AJAX         ************************/
    /*************************************************************************/
    /*************************************************************************/

    // reset modal when button add user clicked
    function resetmodal(){
        document.getElementById('frmAddusr').reset();
    }

    $(document).ready(function(){
        /* load tab1 (user level) on document ready */
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_user/show_ulev",
            beforeSend: function(){
                $('#loadingulev').show();
            },
            success: function(res) {
                $('#loadingulev').hide();
                $('#tBodyUlev').html(res);
                $('#listobj').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
            }
        });

        /* load user list when tab 2 clicked */
        $("#idTab2").click(function(event){
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_user/showlist",
                beforeSend: function(){
                    $("#loading").show();
                },
                success: function(res) {
                    $("#loading").hide();
                    $('#tBodyUser').html(res);
                    $("#listusr").DataTable({
                        "retrieve": true, // <-- mencegah error reinitilise table.
                        "paging": true,
                        "lengthChange": true,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true
                    });
                }
            });
        });


        /* ajax add user */
        $("#btnAddusr").click(function(event) {
            event.preventDefault();
            var inpLogin   = $("#inpLogin").val();
            var inpPass    = $("#inpPass").val();
            var inpFulln   = $("#inpFulln").val();
            var inpLev     = $("#inpLev").val();
            var optionsrad = $('input[name=optionsRadiosInline]:checked', '#frmAddusr').val();
            if(inpLogin == ""){
                document.getElementById("emptywarn").style.removeProperty('display');
                $('#emptywarn').html('Empty user!');
                $('#emptywarn').fadeOut(2000);
                return false;
            } else if(inpPass == ""){
                document.getElementById("emptywarn").style.removeProperty('display');
                $('#emptywarn').html('Empty password!');
                $('#emptywarn').fadeOut(2000);
                return false;
            } else if(inpFulln == ""){
                document.getElementById("emptywarn").style.removeProperty('display');
                $('#emptywarn').html('Empty name!');
                $('#emptywarn').fadeOut(2000);
                return false;
            } else if(inpLev == ""){
                document.getElementById("emptywarn").style.removeProperty('display');
                $('#emptywarn').html('Empty level!');
                $('#emptywarn').fadeOut(2000);
                return false;
            }
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_user/create",
                data: {
                    inpLogin: inpLogin,
                    inpPass: inpPass,
                    inpFulln: inpFulln,
                    inpLev: inpLev,
                    optionsrad: optionsrad
                },
                beforeSend: function(){
                    $('#loading').show();
                },
                success: function(res) {
                    $('#loading').hide();
                    $('#modaddusr').modal('toggle');
                    $('#tBodyUser').html(res);
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
            return false;
        });


        /* load user session table on document ready */
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_user/show_usrsess",
            beforeSend: function(){
                $('#loadinguses').show();
            },
            success: function(res) {
                $('#loadinguses').hide();
                $('#tBodySes').html(res);
                $("#sesmonitor").DataTable({
                    "order": [[ 1, "desc" ]],
                    "paging": true,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
            }
        });
        return false;
    });



    /* delete user list */
    function deluser(uid) {
        var answer = confirm ("Delete this file?");
        if (answer) {
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_user/delete/" + uid,
                beforeSend: function(){
                    $('#loading').show();
                },
                success: function(res) {
                    $('#loading').hide();
                    $('#tBodyUser').html(res);
                }
            })
        }
    }
</script>



<script>
	var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();	
	$("#demoform").submit(function() {
		if($('[name="duallistbox_demo1[]"]').val() == null){
			alert("Destination list is empty!!");
			return false;
		} else {
			return true;
		}
	});


    // load modal for edit data user
	function loadmodal(){
		alert("you edit user!");
	}
</script>


<!-- CHART JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/chartjs/Chart.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/bower_components/chartjs/samples/utils.js"></script>
<script>
    function DrawWmaChart(){
        jQuery.ajax({
            type: "POST",
            dataType : "json", // jenis data yg di proses
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_user/showChartSesLog",
            beforeSend: function () {
                $('#id_LoadChartSesLog').show();
            },
            success: function(res) {
                $('#id_LoadChartSesLog').hide();
                /************* draw canvas ***************/
                var admin = [];
                var guest  = [];
                var dates  = [];
                // push data ke variable array
                for(var i in res){
                    console.log(res[i].a);
                    console.log(res[i].g);
                    admin.push(res[i].a);
                    guest.push(res[i].g);
                    dates.push(res[i].y)
                }
                // chart data
                var config = {
                    type: 'bar',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: "Admin",
                            fill: false,
                            backgroundColor: window.chartColors.purple,
                            borderColor: window.chartColors.purple,
                            data: admin
                        }, {
                            label: "Guest",
                            fill: false,
                            backgroundColor: window.chartColors.yellow,
                            borderColor: window.chartColors.yellow,
                            data: guest
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
                                    labelString: 'Date'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Times'
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


<!-- TOGGLE BUTTON EXPORT -->
<script type="text/javascript">
    $(document).ready(function(){
        DrawWmaChart();
    });
</script>