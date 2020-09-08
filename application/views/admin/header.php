<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/dist/css/skins/_all-skins.min.css">
  
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  
    <!-- Morris charts -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/bower_components/morris.js/morris.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/croppie/croppie.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/croppie/demo.css" />
  
  
  <style>
      .table_div{
            overflow: scroll;
      }
      .student_image{
        height: 100px;
      }
      .data-ci-pagination-page{

      }


    #crop_area{
      display: none;
    }
    .cr-boundary{
    min-height: 250px;
  }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>Admin/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>m</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Student </b>Management</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            
            <a href="<?php echo base_url();?>Admin/logout" class="btn btn-danger btn-flat">Sign out</a>
           
          </li>
      
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>uploadfiles/students/<?php echo $this->session->userdata('aimage'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('aname'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="<?php if($this->uri->segment(2)=='dashboard'){ echo 'active';}?>"><a href="<?php echo base_url();?>Admin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>


        <li class="<?php if($this->uri->segment(2)=='student'){ echo 'active';}?>"><a href="<?php echo base_url();?>Admin/student"><i class="fa fa-users"></i> <span>Student</span></a></li>


        <?php if($this->session->userdata('atype')=='admin' || $this->session->userdata('atype')=='teacher'){ ?>

        <li class="<?php if($this->uri->segment(2)=='class_group'){ echo 'active';}?>"><a href="<?php echo base_url();?>Admin/class_group"><i class="fa fa-th"></i> <span>Class Group</span></a></li>
      <?php } ?>

        <?php if($this->session->userdata('atype')=='admin'){ ?>
        <li class="<?php if($this->uri->segment(2)=='users'){ echo 'active';}?>"><a href="<?php echo base_url();?>Admin/users"><i class="fa fa-shield"></i> <span>Users</span></a></li>
        <?php } ?>


        

        
        
        <!--li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->