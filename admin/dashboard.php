<?php
    require_once '../init.php';
    Session::checkAdminSession();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

    <?php include('inc/header.php'); ?>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#1e88e5" stroke-width="2"></path>
          <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#1e88e5" stroke-width="2"></path>
          <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
          <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#1e88e5"></path>
          <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
          <?php include('inc/topbar.php'); ?>
         <!-- End Topbar header -->
        
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php include('inc/left-sidebar.php'); ?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Dashboard</h3>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                        <div class="d-flex me-3 ms-2">
                            <div class="chart-text me-2">
                                <h6 class="mb-0"><small>THIS MONTH</small></h6>
                                <h4 class="mt-0 text-info">$58,356</h4>
                            </div>
                            <div class="spark-chart">
                                <div id="monthchart"></div>
                            </div>
                        </div>
                        <div class="d-flex ms-2">
                            <div class="chart-text me-2">
                                <h6 class="mb-0"><small>LAST MONTH</small></h6>
                                <h4 class="mt-0 text-primary">$48,356</h4>
                            </div>
                            <div class="spark-chart">
                                <div id="lastmonthchart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
               
               
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card bg-primary w-100">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="me-3 align-self-center">
                                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1>
                                    </div>
                                    <div>
                                        <h3 class="card-title text-white">Bandwidth usage</h3>
                                        <h6 class="card-subtitle text-white op-5">March 2021</h6>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 col-xl-7 align-self-center">
                                        <h2 class="fw-light text-white text-nowrap">50 GB</h2>
                                    </div>
                                    <div class="col-8 col-xl-5 pb-3 pt-2 align-self-center">
                                        <div id="bandwidth-usage"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card bg-success w-100">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="me-3 align-self-center">
                                        <h1 class="text-white"><i class="icon-cloud-download"></i></h1>
                                    </div>
                                    <div>
                                        <h3 class="card-title text-white">Download count</h3>
                                        <h6 class="card-subtitle text-white op-5">March 2021</h6>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-4 col-xl-7 align-self-center">
                                        <h2 class="fw-light text-white text-nowrap text-truncate">35487</h2>
                                    </div>
                                    <div class="col-8 col-xl-5 pb-3 pt-2 text-end">
                                        <div id="download-count" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card w-100">
                            <img class="rounded-top" src="assets/images/background/weatherbg.jpg"
                                alt="Card image cap" style="max-height: 105px;">
                            <div class="card-img-overlay" style="height:110px;">
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title text-white mb-0 d-inline-block">New Delhi</h3>
                                    <div class="ms-auto">
                                        <small class="card-text text-white fw-light">Sunday 15
                                            march</small>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 weather-small">
                                <div class="row">
                                    <div class="col-8 border-end align-self-center">
                                        <div class="d-flex">
                                            <div class="display-6 text-info"><i class="wi wi-day-rain-wind"></i></div>
                                            <div class="ms-3">
                                                <h1 class="fw-light text-info mb-0">32<sup>0</sup></h1>
                                                <small>Sunny Rainy day</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h1 class="fw-light mb-0">25<sup>0</sup></h1>
                                        <small>Tonight</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-5 col-xl-4">
                        <!-- Column -->
                        <div class="card">
                            <img class="card-img-top w-100 profile-bg-height"
                                src="assets/images/background/profile-bg.jpg" alt="Card image cap">
                            <div class="card-body little-profile text-center">
                                <div class="pro-img"><img src="assets/images/users/4.jpg" alt="user"
                                        class="rounded-circle shadow-sm" width="128" /></div>
                                <h3 class="mb-0">Angela Dominic</h3>
                                <p>Web Designer &amp; Developer</p>
                                <a href="javascript:void(0)"
                                    class="mt-2 waves-effect waves-dark btn btn-primary btn-md btn-rounded">Follow</a>
                                <div class="row text-center mt-3 justify-content-center">
                                    <div class="col-6 col-md-4 mt-3">
                                        <h3 class="mb-0 fw-light">1099</h3><small class="text-muted">Articles</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-3">
                                        <h3 class="mb-0 fw-light">23,469</h3><small class="text-muted">Followers</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-3">
                                        <h3 class="mb-0 fw-light">6035</h3><small class="text-muted">Following</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-body bg-info rounded-top">
                                <h4 class="text-white card-title">My Contacts</h4>
                                <h6 class="card-subtitle text-white mb-0 op-5">Checkout my contacts here</h6>
                            </div>
                            <div class="message-box contact-box position-relative">
                                <div class="message-widget contact-widget position-relative">
                                    <!-- contact -->
                                    <a href="#"  class="p-3 d-flex align-items-start rounded-3">
                                        <div class="user-img position-relative d-inline-block me-2"> <img
                                                src="assets/images/users/1.jpg" alt="user"
                                                class="rounded-circle w-100">
                                            <span
                                                class="profile-status pull-right d-inline-block position-absolute bg-success rounded-circle"></span>
                                        </div>
                                        <div class="ps-2 v-middle d-md-flex align-items-center w-100">
                                            <div>
                                                <h5 class="my-1 text-dark font-weight-medium">James Smith</h5>
                                                <span class="text-muted fs-2">you were in video call</span>
                                                <span class="text-muted fs-2 d-block">45 mins ago</span>
                                            </div>
                                            <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                <button type="button" href="#" class="btn btn-sm btn-light-danger text-danger">
                                                    <i data-feather="video" class="feather-sm"></i>
                                                </button>
                                                <button type="button" href="#" class="btn btn-sm btn-light-primary text-primary">
                                                    <i data-feather="phone-incoming" class="feather-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- contact -->
                                    <a href="#"  class="p-3 d-flex align-items-start rounded-3">
                                        <div class="user-img position-relative d-inline-block me-2"> <img
                                                src="assets/images/users/2.jpg" alt="user"
                                                class="rounded-circle w-100">
                                            <span
                                                class="profile-status pull-right d-inline-block position-absolute bg-success rounded-circle"></span>
                                        </div>
                                        <div class="ps-2 v-middle d-md-flex align-items-center w-100">
                                            <div>
                                                <h5 class="my-1 text-dark font-weight-medium">Joseph Garciar</h5>
                                                <span class="text-muted fs-2">you were in video call</span>
                                                <span class="text-muted fs-2 d-block">2 mins ago</span>
                                            </div>
                                            <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                <button type="button" href="#" class="btn btn-sm btn-light-danger text-danger">
                                                    <i data-feather="video" class="feather-sm"></i>
                                                </button>
                                                <button type="button" href="#" class="btn btn-sm btn-light-success text-success">
                                                    <i data-feather="phone-outgoing" class="feather-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- contact -->
                                    <a href="#"  class="p-3 d-flex align-items-start rounded-3">
                                        <div class="user-img position-relative d-inline-block me-2"> <img
                                                src="assets/images/users/6.jpg" alt="user"
                                                class="rounded-circle w-100">
                                            <span
                                                class="profile-status pull-right d-inline-block position-absolute bg-success rounded-circle"></span>
                                        </div>
                                        <div class="ps-2 v-middle d-md-flex align-items-center w-100">
                                            <div>
                                                <h5 class="my-1 text-dark font-weight-medium">Maria Rodriguez</h5>
                                                <span class="text-muted fs-2">you missed john call</span>
                                                <span class="text-muted fs-2 d-block">1 hour ago</span>
                                            </div>
                                            <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                <button type="button" href="#" class="btn btn-sm btn-light-danger text-danger">
                                                    <i data-feather="video" class="feather-sm"></i>
                                                </button>
                                                <button type="button" href="#" class="btn btn-sm btn-light-info text-info">
                                                    <i data-feather="phone-missed" class="feather-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- contact -->
                                    <a href="#"  class="p-3 d-flex align-items-start rounded-3">
                                        <div class="user-img position-relative d-inline-block me-2"> <img
                                                src="assets/images/users/4.jpg" alt="user"
                                                class="rounded-circle w-100">
                                            <span
                                                class="profile-status pull-right d-inline-block position-absolute bg-success rounded-circle"></span>
                                        </div>
                                        <div class="ps-2 v-middle d-md-flex align-items-center w-100">
                                            <div>
                                                <h5 class="my-1 text-dark font-weight-medium">Henry Hernandez</h5>
                                                <span class="text-muted fs-2">you were in phone call</span>
                                                <span class="text-muted fs-2 d-block">2 days ago</span>
                                            </div>
                                            <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                <button type="button" href="#" class="btn btn-sm btn-light-danger text-danger">
                                                    <i data-feather="video" class="feather-sm"></i>
                                                </button>
                                                <button type="button" href="#" class="btn btn-sm btn-light-success text-success">
                                                    <i data-feather="phone-outgoing" class="feather-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- contact -->
                                    <a href="#"  class="p-3 d-flex align-items-start rounded-3">
                                        <div class="user-img position-relative d-inline-block me-2"> <img
                                                src="assets/images/users/5.jpg" alt="user"
                                                class="rounded-circle w-100">
                                            <span
                                                class="profile-status pull-right d-inline-block position-absolute bg-success rounded-circle"></span>
                                        </div>
                                        <div class="ps-2 v-middle d-md-flex align-items-center w-100">
                                            <div>
                                                <h5 class="my-1 text-dark font-weight-medium">James Johnson</h5>
                                                <span class="text-muted fs-2">you were call forwarded</span>
                                                <span class="text-muted fs-2 d-block">55 mins ago</span>
                                            </div>
                                            <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                <button type="button" href="#" class="btn btn-sm btn-light-danger text-danger">
                                                    <i data-feather="video" class="feather-sm"></i>
                                                </button>
                                                <button type="button" href="#" class="btn btn-sm btn-light-warning text-warning">
                                                    <i data-feather="phone-forwarded" class="feather-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-8">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab nav-justified" role="tablist">
                                <li class="nav-item"> 
                                    <a class="nav-link active text-center" data-bs-toggle="tab" href="#home" role="tab">
                                        <i data-feather="activity" class="fill-white feather-sm"></i>
                                        <span class="d-none d-md-inline-block fw-normal">Activity</span>
                                    </a>
                                </li>
                                <li class="nav-item"> 
                                    <a class="nav-link text-center" data-bs-toggle="tab" href="#profile" role="tab">
                                        <i data-feather="users" class="fill-white feather-sm"></i>
                                        <span class="d-none d-md-inline-block fw-normal">Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item"> 
                                    <a class="nav-link text-center" data-bs-toggle="tab" href="#settings" role="tab">
                                        <i data-feather="settings" class="fill-white feather-sm"></i>
                                        <span class="d-none d-md-inline-block fw-normal">Settings</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <div class="profiletimeline position-relative">
                                            <div class="sl-item mt-2 mb-3">
                                                <div class="sl-left float-left me-3"> <img
                                                        src="assets/images/users/1.jpg" alt="user"
                                                        class="rounded-circle"> </div>
                                                <div class="sl-right">
                                                    <div>
                                                        <div class="d-md-flex align-items-center">
                                                            <h5 class="mb-0 font-weight-medium">
                                                                <a href="#" class="link">John Doe</a>
                                                            </h5>
                                                            <span class="sl-date text-muted ms-1">5 minutes ago</span>
                                                        </div>

                                                        <p>assign a new task <a href="#"> Design weblayout</a></p>
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 mb-3"><img
                                                                    src="assets/images/big/img1.jpg" alt="user"
                                                                    class="img-fluid rounded-3"></div>
                                                            <div class="col-lg-3 col-md-6 mb-3"><img
                                                                    src="assets/images/big/img2.jpg" alt="user"
                                                                    class="img-fluid rounded-3"></div>
                                                            <div class="col-lg-3 col-md-6 mb-3"><img
                                                                    src="assets/images/big/img3.jpg" alt="user"
                                                                    class="img-fluid rounded-3"></div>
                                                            <div class="col-lg-3 col-md-6 mb-3"><img
                                                                    src="assets/images/big/img4.jpg" alt="user"
                                                                    class="img-fluid rounded-3"></div>
                                                        </div>
                                                        <div class="text-nowrap"> 
                                                            <a href="javascript:void(0)" class="link me-2 font-weight-medium"><i data-feather="message-circle" class="fill-white feather-sm text-info"></i> comments</a> 
                                                            <a href="javascript:void(0)" class="link me-2 font-weight-medium"><i data-feather="heart" class="fill-white feather-sm text-danger"></i> 5 Likes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sl-item my-4 border-top pt-4">
                                                <div class="sl-left float-left me-3"> <img
                                                        src="assets/images/users/2.jpg" alt="user"
                                                        class="rounded-circle"> </div>
                                                <div class="sl-right">
                                                    <div>
                                                        <div class="d-md-flex align-items-center">
                                                            <h5 class="mb-0 font-weight-medium"><a href="#"
                                                                    class="link">James Smith</a></h5>
                                                            <span class="sl-date text-muted ms-1">5
                                                                minutes ago</span>
                                                        </div>
                                                        <div class="mt-3 row">
                                                            <div class="col-md-3 col-xs-12"><img
                                                                    src="assets/images/big/img1.jpg" alt="user"
                                                                    class="img-fluid rounded-3"></div>
                                                            <div class="col-md-9 mt-3 mt-md-0">
                                                                <p class="fs-3"> Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit. Integer nec odio. Praesent libero. Sed cursus
                                                                    ante dapibus diam. </p> <a href="#"
                                                                    class="btn btn-success">
                                                                    Design weblayout</a>
                                                            </div>
                                                        </div>
                                                        <div class="text-nowrap mt-3">
                                                            <a href="javascript:void(0)" class="link me-2 font-weight-medium"><i data-feather="message-circle" class="fill-white feather-sm text-info"></i> comments</a> 
                                                            <a href="javascript:void(0)" class="link me-2 font-weight-medium"><i data-feather="heart" class="fill-white feather-sm text-danger"></i> 5 Likes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sl-item my-4 border-top pt-4">
                                                <div class="sl-left float-left me-3"> <img
                                                        src="assets/images/users/3.jpg" alt="user"
                                                        class="rounded-circle"> </div>
                                                <div class="sl-right">
                                                    <div>
                                                        <div class="d-md-flex align-items-center">
                                                            <h5 class="mb-0 font-weight-medium"><a href="#"
                                                                    class="link">Maria Hernandez</a></h5>
                                                            <span class="sl-date text-muted ms-1">5
                                                                minutes ago</span>
                                                        </div>
                                                        <p class="mt-2 fs-3"> Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Integer nec odio. Praesent libero. Sed
                                                            cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh
                                                            elementum imperdiet. Duis sagittis ipsum. Praesent mauris.
                                                            Fusce nec tellus sed augue semper </p>
                                                    </div>
                                                    <div class="text-nowrap mt-3">
                                                        <a href="javascript:void(0)" class="link me-2 font-weight-medium"><i data-feather="message-circle" class="fill-white feather-sm text-info"></i> comments</a> 
                                                            <a href="javascript:void(0)" class="link me-2 font-weight-medium"><i data-feather="heart" class="fill-white feather-sm text-danger"></i> 5 Likes</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sl-item my-4 border-top pt-4">
                                                <div class="sl-left float-left me-3"> <img
                                                        src="assets/images/users/4.jpg" alt="user"
                                                        class="rounded-circle"> </div>
                                                <div class="sl-right">
                                                    <div>
                                                        <div class="d-md-flex">
                                                            <h5 class="mb-0 font-weight-medium"><a href="#"
                                                                    class="link">John Doe</a></h5>
                                                            <span class="sl-date text-muted ms-1">5
                                                                minutes ago</span>
                                                        </div>
                                                        <blockquote class="mt-2 fs-3">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                            sed do eiusmod tempor incididunt
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 border-end"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">Johnathan Deo</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 border-end"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">(123) 456 7890</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 border-end"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">johnathan@admin.com</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                <br>
                                                <p class="text-muted">London</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="mt-4">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                            Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus.
                                            Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo
                                            ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and scrambled it to
                                            make a type specimen book. It has survived not only five centuries </p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets
                                            containing Lorem Ipsum passages, and more recently with desktop publishing
                                            software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                        <h4 class="font-medium mt-4">Skill Set</h4>
                                        <hr>
                                        <h5 class="mt-4">Wordpress <span class="pull-right">80%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80"
                                                aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;">
                                                <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="mt-4">HTML 5 <span class="pull-right">90%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90"
                                                aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;">
                                                <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="mt-4">jQuery <span class="pull-right">50%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50"
                                                aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;">
                                                <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="mt-4">Photoshop <span class="pull-right">70%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70"
                                                aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;">
                                                <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group mb-3">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Johnathan Doe"
                                                        class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com"
                                                        class="form-control form-control-line" name="example-email"
                                                        id="example-email">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" value="password"
                                                        class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="col-md-12">Phone No</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890"
                                                        class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5"
                                                        class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="col-sm-12">Select Country</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
             <?php include('inc/footer.php'); ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench fs-6"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#chat" role="tab"
                        aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply fs-6"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false"><i
                            class="mdi mdi-star-circle fs-6"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-3 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-weight-medium mb-2 mt-2">Layout Settings</h5>
                        <div class="form-check mt-3">
                            <input type="checkbox" name="theme-view" class="form-check-input" id="theme-view">
                            <label class="form-check-label" for="theme-view"> <span>Dark Theme</span> </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" class="sidebartoggler form-check-input" name="collapssidebar"
                                id="collapssidebar">
                            <label class="form-check-label" for="collapssidebar"> <span>Collapse Sidebar</span> </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" name="sidebar-position" class="form-check-input"
                                id="sidebar-position">
                            <label class="form-check-label" for="sidebar-position"> <span>Fixed Sidebar</span> </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" name="header-position" class="form-check-input" id="header-position">
                            <label class="form-check-label" for="header-position"> <span>Fixed Header</span> </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" name="boxed-layout" class="form-check-input" id="boxed-layout">
                            <label class="form-check-label" for="boxed-layout"> <span>Boxed Layout</span> </label>
                        </div>
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-weight-medium mb-2 mt-2">Logo Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-logobg="skin1"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-logobg="skin2"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-logobg="skin3"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-logobg="skin4"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-logobg="skin5"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-logobg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-weight-medium mb-2 mt-2">Navbar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-navbarbg="skin1"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-navbarbg="skin2"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-navbarbg="skin3"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-navbarbg="skin4"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-navbarbg="skin5"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-navbarbg="skin6"></a></li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-weight-medium mb-2 mt-2">Sidebar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-sidebarbg="skin1"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-sidebarbg="skin2"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-sidebarbg="skin3"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-sidebarbg="skin4"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-sidebarbg="skin5"></a></li>
                            <li class="theme-item list-inline-item me-1"><a href="javascript:void(0)"
                                    class="theme-link rounded-circle d-block" data-sidebarbg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
                <!-- End Tab 1 -->
                <!-- Tab 2 -->
                <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="mailbox list-style-none mt-3">
                        <li>
                            <div class="message-center chat-scroll position-relative">
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_1' data-user-id='1'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/1.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle online"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">Just see the my
                                            admin!</span> <span class="fs-2 text-nowrap d-block text-muted">9:30
                                            AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_2' data-user-id='2'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/2.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle busy"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Sonu Nigam</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">I've sung a
                                            song! See you at</span> <span
                                            class="fs-2 text-nowrap d-block text-muted">9:10 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_3' data-user-id='3'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/3.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle away"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Arijit Sinh</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">I am a
                                            singer!</span> <span class="fs-2 text-nowrap d-block text-muted">9:08
                                            AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_4' data-user-id='4'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/4.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Nirav Joshi</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">Just see the my
                                            admin!</span> <span class="fs-2 text-nowrap d-block text-muted">9:02
                                            AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_5' data-user-id='5'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/5.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Sunil Joshi</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">Just see the my
                                            admin!</span> <span class="fs-2 text-nowrap d-block text-muted">9:02
                                            AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_6' data-user-id='6'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/6.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Akshay Kumar</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">Just see the my
                                            admin!</span> <span class="fs-2 text-nowrap d-block text-muted">9:02
                                            AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_7' data-user-id='7'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/7.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">Just see the my
                                            admin!</span> <span class="fs-2 text-nowrap d-block text-muted">9:02
                                            AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)"
                                    class="message-item d-flex align-items-center border-bottom px-3 py-2"
                                    id='chat_user_8' data-user-id='8'>
                                    <span class="user-img position-relative d-inline-block"> <img
                                            src="assets/images/users/8.jpg" alt="user" class="rounded-circle w-100">
                                        <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Varun Dhavan</h5> <span
                                            class="fs-2 text-nowrap d-block text-muted text-truncate">Just see the my
                                            admin!</span> <span class="fs-2 text-nowrap d-block text-muted">9:02
                                            AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
                <!-- Tab 3 -->
                <div class="tab-pane fade p-3" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h6 class="mt-3 mb-3">Activity Timeline</h6>
                    <div class="steamline">
                        <div class="sl-item">
                            <div class="sl-left bg-light-success text-success"> 
                                <i data-feather="user" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-light-info text-info">
                                <i data-feather="camera" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user"
                                    src="assets/images/users/2.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Go to the Doctor <span class="sl-date">5 minutes
                                        ago</span>
                                </div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user"
                                    src="assets/images/users/1.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-light-primary text-primary">
                                <i data-feather="user" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-light-info text-info">
                                <i data-feather="send" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user"
                                    src="assets/images/users/4.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Go to the Doctor <span class="sl-date">5 minutes
                                        ago</span>
                                </div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user"
                                    src="assets/images/users/6.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab 3 -->
            </div>
        </div>
    </aside>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/app.init.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/feather.min.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Chart JS -->
    <script src="dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>