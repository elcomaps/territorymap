<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php
        session_start();
        if(!isset($_SESSION['islogged']))
        {
            ?>
            <script type="text/javascript">
                window.location.href = "./login";
            </script>
            <?php
        }
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Territory Map</title>
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/toastr/toastr.min.js"></script>
    <link href="./assets/libs/toastr/toastr.min.css" rel="stylesheet">
    <script src="./assets/global.js"></script>
    <script src="./assets/header.js"></script>
    <link href="./assets/style.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index">
                        <b class="logo-icon">
                            <img src="./assets/images/logo.png" alt="homepage" class="dark-logo" style="max-width: 110px;" />
                        </b>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i data-feather="more-horizontal"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ml-2">
                        <li class="nav-item">
                            <a class="nav-link" href="./index">Home</a>
                        </li>
                <?php
                    if($_SESSION["userrole"] == "Administrator")
                    {
                ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sales People <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="salespeople">Sales People List</a>
                                <a class="dropdown-item" href="add">Add New</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Users <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="user-list">User List</a>
                                <a class="dropdown-item" href="user-add">Add User</a>
                                <a class="dropdown-item" href="user-approved">Approve Users</a>
                                <a class="dropdown-item" href="user-pending">Pending Users</a>
                                <a class="dropdown-item" href="user-deleted">Deleted Users</a>
                            </div>
                        </li>
                <?php
                    }
                ?>
                    </ul>
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="d-lg-flex align-items-center user-dd">
                                    <img src="./assets/images/users/<?php echo $_SESSION['usericon']; ?>" alt="user" class="rounded-circle user-photo"
                                        width="40">
                                    <div class="ml-2 d-none d-lg-flex">
                                        <span class="font-normal text-dark name"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>
                                            <i class="fa fa-angle-down ml-1"></i></span>
                                        <span class="font-14 role text-muted"><?php echo $_SESSION['userrole']; ?></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="user-profile" id="user-settings"><i class="mr-2"
                                        data-feather="settings"></i>Settings</a>
                                <a class="dropdown-item" href="#" id="user-logout"><i class="mr-2" data-feather="log-out"></i>Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>