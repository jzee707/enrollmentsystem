<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Western College</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/logo.ico">
  
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Western College</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/profile.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo  $this->session->userdata('name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <img src="<?php echo base_url(); ?>assets/dist/img/profile.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo  $this->session->userdata('name'); ?>
                      <small><?php echo  $this->session->userdata('usertype'); ?></small>
                    </p>
                    
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <!--<a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profile</a>-->
                    </div>
                    <div class="pull-right">
                    <a href="<?php echo base_url(); ?>admin/myaccount" class="btn btn-default btn-flat"><i class="fa fa-info"></i> My Account</a>
                    <a href="<?php echo base_url(); ?>changepassword" class="btn btn-default btn-flat"><i class="fa fa-gear"></i> Change Password</a>
                    <a href="<?php echo base_url(); ?>admin/signout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            

            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>DASHBOARD</a></li>

            <li class="treeview active">
              <a href="#">
                <i></i> <span>TRANSACTION</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>enrollment"><i class="fa fa-users"></i>Enrollment</a></li>
                <li><a href="<?php echo base_url(); ?>schedule"><i class="fa fa-users"></i>Schedule</a></li>
                <li><a href="<?php echo base_url(); ?>preenrollmentlist"><i class="fa fa-users"></i>Pre-Enroll</a></li>
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i></i> <span>DATA ENTRY</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>student"><i class="fa fa-users"></i>Student</a></li>
                <li><a href="<?php echo base_url(); ?>faculty"><i class="fa fa-users"></i>Faculty</a></li>
                <li><a href="<?php echo base_url(); ?>preregistration"><i class="fa fa-users"></i>Pre-Registration</a></li>   
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i></i> <span>MAINTENANCE</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>strand"><i class="fa fa-users"></i>Strand</a></li>
                <li><a href="<?php echo base_url(); ?>section"><i class="fa fa-users"></i>Section</a></li>
                <li><a href="<?php echo base_url(); ?>jhsubject"><i class="fa fa-users"></i>JHS Subject</a></li>
                <li><a href="<?php echo base_url(); ?>shsubject"><i class="fa fa-users"></i>SHS Subject</a></li>
                <li><a href="<?php echo base_url(); ?>schoolyear"><i class="fa fa-users"></i>School Year</a></li>
                <li><a href="<?php echo base_url(); ?>semester"><i class="fa fa-users"></i>Semester</a></li>
              </ul>
            </li>
            
            <li class="treeview active">
              <a href="#">
                <i></i> <span>ARCHIVED DATA</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>archivedstudent"><i class="fa fa-users"></i>Student</a></li>
                <li><a href="<?php echo base_url(); ?>archivedfaculty"><i class="fa fa-users"></i>Faculty</a></li>
                <li><a href="<?php echo base_url(); ?>archivedschedule"><i class="fa fa-users"></i>Schedule</a></li>
                <li><a href="<?php echo base_url(); ?>archivedstrand"><i class="fa fa-users"></i>Strand</a></li>
                <li><a href="<?php echo base_url(); ?>archivedenrollment"><i class="fa fa-users"></i>Enrollment</a></li>
                <li><a href="<?php echo base_url(); ?>archivedpreregistration"><i class="fa fa-users"></i>Pre-Registration</a></li>
                <li><a href="<?php echo base_url(); ?>archivedpreenrollment"><i class="fa fa-users"></i>Pre-Enrollment</a></li>
              </ul>
            </li>

            
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>