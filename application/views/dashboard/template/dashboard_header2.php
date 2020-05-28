<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIPADU ALUMNI | <?php echo $small_title ?> </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/custom_css/custom_style.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>PD</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SIPADU</b> Alumni <b>STIS</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->



                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo $this->session->userdata('nama'); ?>
                                        <small>NIP. <?php echo $this->session->userdata('nip'); ?> </small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('index.php/auth/logout') ?>" class="btn btn-default btn-flat">Logout</a>
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
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->session->userdata('nama') ?></p>
                        <?php echo $this->session->userdata('nip') ?>
                    </div>
                </div>

                <!-- QUERY MENU -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>

                    <?php

                    $role_id = $this->session->userdata('role_id');

                    $queryMenu = "SELECT user_menu.id, menu
                        FROM user_menu JOIN user_access_menu 
                          ON user_menu.id = user_access_menu.menu_id
                        WHERE user_access_menu.role_id = $role_id 
                        ORDER BY user_access_menu.menu_id ASC 
                      ";
                    $menu = $this->db->query($queryMenu)->result_array();
                    ?>

                    <!-- Looping Menu -->
                    <?php foreach ($menu as $m) : ?>
                        <div class="sidebar-menu">
                        </div>

                        <!-- Sub menunya -->
                        <?php
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT *
                        FROM user_sub_menu JOIN user_menu 
                          ON user_sub_menu.menu_id = user_menu.id
                        WHERE user_sub_menu.menu_id = $menuId
                        AND user_sub_menu.is_active = 1 
      ";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>

                        <?php foreach ($subMenu as $sm) : ?>
                            <?php if ($title == $sm['title']) : ?>
                                <li class="nav-item active">
                                <?php else : ?>
                                <li class="nav-item">
                                <?php endif; ?>
                                <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                    <span><?= $sm['title']; ?></span>
                                </a>
                                </li>
                            <?php endforeach; ?>

                        <?php endforeach; ?>


                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $title ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('petugas/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <?php
                    if (!empty($breadcumb)) {
                        foreach ($breadcumb as $br) {
                            echo ('<li class="active">' . $br . '</li>');
                        }
                    }
                    ?>

                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->