<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="<?php echo $cfg_desc; ?>">
  <meta name="author" content="<?php echo $cfg_author; ?>">
  <link rel="shortcut icon" href="http://48pedia.web.id/assets/images/small/icon.png">
  <title><?php echo $cfg_webname; ?></title>
    
        <!-- DataTables -->
        
        <link href="<?php echo $cfg_baseurl; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    
        <!--Morris Chart CSS -->
        
        <link href="<?php echo $cfg_baseurl; ?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>nako/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $cfg_baseurl; ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo $cfg_baseurl; ?>assets/js/modernizr.min.js"></script>
        <link href="<?php echo $cfg_baseurl; ?>jquery-ui-1.11.4/smoothness/jquery-ui.css" rel="stylesheet" />
        <script src="<?php echo $cfg_baseurl; ?>jquery-ui-1.11.4/external/jquery/jquery.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>jquery-ui-1.11.4/jquery-ui.js"></script>
        <script src="<?php echo $cfg_baseurl; ?>jquery-ui-1.11.4/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="<?php echo $cfg_baseurl; ?>jquery-ui-1.11.4/jquery-ui.theme.css">
        <script>
   $(document).ready(function(){
    $("#tanggal").datepicker({
    })
   })
  </script>
    </head>


    <body>
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="/" class="logo"><span>Administrator<span>Perpustakaan</span></span></a>
                    </div>
                    </br></br></br>
                    <!-- End Logo container-->
                    <div class="menu-extras">
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                        <?php if(isset($_SESSION['user'])) { ?>
                        <ul class="nav navbar-nav navbar-right pull-right">
                                </ul>
                            </li>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                
                </div>
            </div>

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <?php
                            if (isset($_SESSION[ 'user'])) {
                            ?>
                            <?php
                            if ($data_user['level'] == "Admin") {
                            ?>
                            <li>
                                <a href="/nako"><i class="fa fa-home"></i> <span> Dashboard </span> </a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-user"></i> <span> Menu List </span> </a>
                                <ul class="submenu">
                                    <li><a href="<?php echo $cfg_baseurl; ?>admin/menu/add.php">Tambah Data</a></li>
                                    <li><a href="<?php echo $cfg_baseurl; ?>admin/data.php">Kelola Data</a></li>
                                    <li><a href="<?php echo $cfg_baseurl; ?>admin/pencarian.php">Pencarian Data</a></li>
                                </ul>
                            </li>
                            <?php
                            }
                            ?>
                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-user"></i> <span> <?php echo $data_user['username']; ?> </span> </a>
                                <ul class="submenu">
                                    <li><a href="<?php echo $cfg_baseurl; ?>settings.php">Setting Account</a></li>
                                    <li><a href="<?php echo $cfg_baseurl; ?>logout.php">Logout</a></li>
                                </ul>
                            </li>
                            <?php
                            } else {
                            ?>
                            
                            <li>
                                <a href="<?php echo $cfg_baseurl; ?>"><i class="fa fa-sign-in"></i> <span> Masuk </span> </a>
                            </li>
                            <?php
                            }
                            ?>
                            

                            

                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->
        
         <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        </br>
                    </div>
                </div>