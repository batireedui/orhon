<?php
  if(isset($_SESSION['userid']) != null)
  {
    $title = "Өвөрхангай ХДТ";
  $page = $_SESSION['page'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        <?=$title?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#" target="_blank">
                <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold"> <?=$title?></span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == "index" ? "active" : ""?>" href="index.php">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-diamond <?php echo $page == "index" ? "text-light" : "text-dark"?>"></i>
                        </div>
                        <span class="nav-link-text ms-1">Эхлэл</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == "movie" ? "active" : ""?>" href="movies.php">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-camera-compact <?php echo $page == "movie" ? "text-light" : "text-dark"?>"></i>
                        </div>
                        <span class="nav-link-text ms-1">Үзвэр</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == "huvaari" ? "active" : ""?>" href="huvaari.php">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 <?php echo $page == "huvaari" ? "text-light" : "text-dark"?>"></i>
                        </div>
                        <span class="nav-link-text ms-1">Хуваарь</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $page == "report" ? "active" : ""?>" href="report.php">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-folder-17 <?php echo $page == "report" ? "text-light" : "text-dark"?>"></i>
                        </div>
                        <span class="nav-link-text ms-1">Тайлан үзэлт</span>
                    </a>
                </li>
               <li class="nav-item">
                    <a class="nav-link <?php echo $page == "reporto" ? "active" : ""?>" href="reporto.php">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-folder-17 <?php echo $page == "reporto" ? "text-light" : "text-dark"?>"></i>
                        </div>
                        <span class="nav-link-text ms-1">Тайлан хуваарь</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Захиалгын систем</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Үзвэр захиалгын систем</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none"><?=$_SESSION['username']?></span>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center" style="margin-left: 20px;">
                            <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-sign-out me-sm-1"></i>
                                <span class="d-sm-inline d-none">Гарах</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<?php }
else
    redirect("login.php");?>