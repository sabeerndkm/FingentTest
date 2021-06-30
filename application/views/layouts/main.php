<?php
$admin_user = $this->session->userdata(SESSION_ADMIN_NAME);
if($admin_user == null) {
    redirect('admin');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee Database</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('resources/css/font-awesome.min.css');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Datetimepicker -->
    <link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap-datetimepicker.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('resources/css/AdminLTE.min.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('resources/css/_all-skins.min.css');?>">
    <script src="<?php echo base_url('resources/js/jquery-2.2.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url('resources/js/bootstrap.min.js');?>"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">E D</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Employee Database</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">
                                 <?=strtoupper($this->session->userdata(SESSION_ADMIN_NAME))?>
                             </span>
                         </a>
                         <ul class="dropdown-menu">
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <?php
    $menu_selection_header =  $this->session->userdata('menu_selection_header');
    $menu_selection_link   =  $this->session->userdata('menu_selection_link');

    $dashboard_link_active = "";
    $employee_link_active = "";
    $user_link_active = "";

    if ($menu_selection_header == "dashboard_mgnt") {
        if ($menu_selection_link == "dashboard_link_active") {
            $dashboard_link_active = "active";
        }
    } else if ($menu_selection_header == "employee_mgnt") {
        $dashboard_link_active = "";
        if ($menu_selection_link == "employee_link_active") {
            $employee_link_active = "active";
        }
    } else if ($menu_selection_header == "user_mgnt") {
        $employee_link_active = "";
        if ($menu_selection_link == "user_link_active") {
            $user_link_active = "active";
        }
    }

    ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <!-- <img src="#" class="img-circle" alt="User Image"> -->
                </div>
                <div class="pull-left info">
                    <p> </p>
                    <a href="#"> </a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->

            <ul class="sidebar-menu"> 
                <li class="<?php echo $dashboard_link_active; ?>">
                    <a href="<?php echo site_url('Dashboard/index'); ?>">
                        <i class="fa fa-desktop"></i> <span>Dahsboard</span>
                    </a> 
                </li>
                <li class="<?php echo $employee_link_active; ?>">
                    <a href="<?php echo site_url('employee/index'); ?>">
                        <i class="fa fa-user"></i> <span>Employee</span>
                    </a> 
                </li> 

                <li class="<?php echo $user_link_active; ?>">
                    <a href="<?php echo site_url('users/index'); ?>">
                        <i class="fa fa-user-circle-o"></i> <span>Users</span>
                    </a> 
                </li> 
            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content" id="view-load-id">
            <?php                    
            if(isset($_view) && $_view)
                $this->load->view($_view);
            ?>                    
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright 2021</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->

        </div>
    </aside>
    <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                immediately after the control sidebar -->
                <div class="control-sidebar-bg"></div>
            </div>
            <!-- ./wrapper -->

            <!-- jQuery 2.2.3 -->

            <!-- FastClick -->
            <script src="<?php echo base_url('resources/js/fastclick.js');?>"></script>
            <!-- AdminLTE App -->
            <script src="<?php echo base_url('resources/js/app.min.js');?>"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="<?php echo base_url('resources/js/demo.js');?>"></script>
            <!-- DatePicker -->
            <script src="<?php echo base_url('resources/js/moment.js');?>"></script>
            <script src="<?php echo base_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
            <script src="<?php echo base_url('resources/js/global.js');?>"></script>
        </body>
        </html>
