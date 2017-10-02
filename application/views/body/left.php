<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="margin: 0px 0px 10px 0px">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/templ/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $username; ?></p>
                <a href="#" id="id_aUsrStatus"><i class="fa fa-circle text-yellow"></i> Dutty</a>
            </div>
        </div>

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu">
            <!--li class="header">MAIN NAVIGATION</li-->
            <!--@@@@ DYNAMIC MENU CALLS LIBRARY @@@-->
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-reorder"></i> <span>Modules</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php echo $this->sitemap_menu->build_menu('2'); ?>
            </li>

            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-info"></i> <span>Info</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#" id="40">
                            <i class="fa fa-desktop"></i> <em><?= $this->db->hostname ?></em>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="40">
                            <i class="fa fa-database"></i> <em><?= $this->db->database ?></em>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
<!-- /.sidebar -->
</aside>