<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('obj_level');
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
	<h1><?php echo $title ?></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?php echo $title ?></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Main row -->
  <div class="row">
	<!-- Left col -->
	<section class="col-lg-12 connectedSortable">
	  <!-- div box content left -->
	  <div class="nav-tabs-custom">
		<!-- Tabs within a box -->
		<ul class="nav nav-tabs pull-right">
		  <li class="pull-left header"><i class="fa fa-inbox"></i> <em>Modules</em> untuk <?= $level ?></li>
		</ul>
		<div class="tab-content">
			<?php echo $this->sitemap_menu->build_menu('1'); ?>
		</div>
	  </div><!-- /.nav-tabs-custom -->	  
	</section><!-- /.Left col -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->		