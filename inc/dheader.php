<?php
// Start output buffering:
ob_start();

// Initialize a session:
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if(isset($page_title)){  echo $page_title;}else{ echo "Like Minds For Peter Obi";} ?></title> 

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    a{
      color: #036622 !important;
    }

    .btn-primary{
      background: #036622 !important;
      border:#036622 !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo BASE_URL; ?>" class="nav-link">Return Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

   
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
    <img src="images/logo/logo.png" alt="Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light" style="opacity:0;">:::</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['first_name']." ". $_SESSION['last_name'] ?></a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open active">
            <a href="dashboard.php"  class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          
          </li>

  <li class="nav-item  active ">
          <li class="nav-item  ">
            <a href="view_users.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Members
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="view_users.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>All Members</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="state_users.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Members By State</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="lga_users.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Members by LGA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ward_users.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Members By Ward</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pu_users.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Members By Polling Unit</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Add New Member</p>
                </a>
              </li>
       </ul>
</li>

      
          <li class="nav-item active ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Officials
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>All Exco</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>State Exco</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>LGA Exco</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Ward Exco</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Polling Unit Exco</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Add New Exco</p>
                </a>
              </li>
       </ul>

          </li>  
        

          <li class="nav-item  active">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
               System Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs "></i>
                  <p>General Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-comment nav-icon"></i>
                  <p>SMS Settings</p>
                </a>
              </li>

              <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="fas fa-map-marker-alt mr-1"></i>
              
              <p>
               Manage States
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="fas fa-map-marker-alt mr-1"></i>
              <p>
               Manage LGA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="fas fa-map-marker-alt mr-1"></i>
              <p>
               Manage Wards
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="addpu.php" class="nav-link">
              <i class="fas fa-map-marker-alt mr-1"></i>
              <p>
               Manage Polling Units
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          </ul>
          </li>

          <li class="nav-item menu-open">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
               Logout
                <i class="right fas fa-sign-out"></i>
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $page_title; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item "><?php echo $page_title; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
