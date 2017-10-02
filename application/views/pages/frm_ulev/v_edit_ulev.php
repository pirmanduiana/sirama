<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
	$query	  = $this->m_crud_user->select_sysmenu();
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
	<li><a href="#">Examples</a></li>
	<li class="active">Blank page</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Title</h3>
	  <div class="box-tools pull-right">
		<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
		<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
		<div class="box-body">

		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Group Menu</a></li>
			  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">User list</a></li>
			  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Session Monitor</a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tab_1">
			  	<b>Re-ordering <code><?php echo $obj_level; ?></code></b>
				<p>Please select the available object in the left box to the right box.</p>
				<?php echo form_open('pages/c_crud_user/recreate_ulev/'.$obj_level,'name="frm_duallistbox" id="demoform"'); ?>
					<input type="text" name="txt_objlev" class="form-control" id="id_usrlev" value=<?php echo $obj_level; ?> style="margin-bottom:10px;" readonly required>
					<select multiple="multiple" size="10" name="duallistbox_demo1[]">
						<?php foreach ($query->result() as $row) {echo "<option value=".$row->id.">".$row->title."</option>";}?>
					</select>
					<div class="box-footer" style="text-align:right">
						<?php echo anchor('cpage/vulev/','Cancel', array('class'=>"btn btn-xs btn-warning")); ?>
						<input type="submit" class="btn btn-xs btn-info" value="Update data">
						<!--button id="demo1-add" type="button" class="btn btn-primary">Add options to demo1</button-->
					</div>
				</form>
			  </div><!-- /.tab-pane -->
			</div><!-- /.tab-content -->
		</div>
		
		</div><!-- /.box-body -->
		<div class="box-footer" style="text-align:right">
		</div><!-- /.box-footer-->		
  </div><!-- /.box -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script>
	var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
	var demo2 = $('select[name="duallistbox_demo1[]_helper2"]');
	$("#demoform").submit(function() {
		if(demo1.val() == null){
			alert("Destination list is empty!!");
			return false;
		} else {
			return true;				  
		}
	});
</script>
<script>
	$("#demo1-add").click(function() {
	  demo1.append(
	  '<?php foreach ($query->result() as $row) {echo "<option value=".$row->id.">".$row->title."</option>";}?>'
	  );
	  demo1.bootstrapDualListbox('refresh', true);
	});
	
	$("#demo2-add").click(function() {
	  demo2.append(
	  '<?php foreach ($query->result() as $row) {echo "<option value=".$row->id.">".$row->title."</option>";}?>'
	  );	  
	  demo2.bootstrapDualListbox('refresh', true);
	});
</script>