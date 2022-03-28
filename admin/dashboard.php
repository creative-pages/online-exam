
<?php include('inc/header.php'); ?>
<?php
$u_query = $common->select("`users`");
if($u_query != false){
 $t_user = mysqli_num_rows($u_query);   
}else{
    $t_user = 0;
}
    $weekly = $common->select("`weekly_status`");
    $payments = $common->select("`payments`");
    if($weekly != FALSE){
        $total_amount=0;
        $total_usd=0;
        while($value = mysqli_fetch_assoc($weekly)){
             $total_amount += $value['user_amounts'];
             $total_usd += $value['up_amounts'];
        }
    }
    else{
        $total_amount=0;
        $total_usd=0; 
    }
    if($payments != FALSE){
        $total_pay=0;
        while($value = mysqli_fetch_assoc($payments)){
             $total_pay += $value['amounts'];
        }
    }
    else{
        $total_pay=0; 
    }
    $total_unpaid = $total_amount-$total_pay;
?>
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
    <div id="main-wrapper">
          <?php include('inc/topbar.php'); ?>
        <?php include('inc/left-sidebar.php'); ?>
        <div class="page-wrapper">
          <div class="container-fluid">
              <div class="row">
                    <div class="col-lg-4">
                        <a class="d-block" href="">
                      		<div class="card bg-info w-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                          <h1 class="text-white me-2"><i class="mdi mdi-account-box"></i></h1>
                                          <h3 class="card-title text-white mt-2">Total User</h3>
                                        </div>
                                        <h3 class="card-title text-white mt-2"><?=$t_user;?></h3>
                                    </div>
                                </div>
                            </div>
                      	</a>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4">
                        <a class="d-block" href="">
                      		<div class="card bg-warning w-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                          <h1 class="text-white me-2"><i class="fab fa-cc-mastercard"></i></h1>
                                          <h3 class="card-title text-white mt-2">Total Earn Doller</h3>
                                        </div>
                                        <h3 class="card-title text-white mt-2"><?=$total_usd;?> USD</h3>
                                    </div>
                                </div>
                            </div>
                      	</a>
                    </div>
                    <!-- Column -->
                     <div class="col-lg-4">
                        <a class="d-block" href="">
                      		<div class="card bg-success w-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                          <h1 class="text-white me-2"><i class="fab fa-cc-mastercard"></i></h1>
                                          <h3 class="card-title text-white mt-2">Total Stuff Amount</h3>
                                        </div>
                                        <h3 class="card-title text-white mt-2"><?=$total_amount;?> TAKA</h3>
                                    </div>
                                </div>
                            </div>
                      	</a>
                    </div>
                     <!-- Column -->
                     <div class="col-lg-4">
                        <a class="d-block" href="">
                      		<div class="card bg-danger w-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                          <h1 class="text-white me-2"><i class="fab fa-cc-mastercard"></i></h1>
                                          <h3 class="card-title text-white mt-2">Total Pay Amount</h3>
                                        </div>
                                        <h3 class="card-title text-white mt-2"><?=$total_pay;?> TAKA</h3>
                                    </div>
                                </div>
                            </div>
                      	</a>
                    </div>
                    <!-- Column -->
                    <div class="col-lg-4">
                        <a class="d-block" href="">
                      		<div class="card bg-secondary w-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                          <h1 class="text-white me-2"><i class="fab fa-cc-mastercard"></i></h1>
                                          <h3 class="card-title text-white mt-2"><?php if($total_unpaid>0){?><p class="text-danger">Total Unpaid </p><?php } else { ?> <p class="text-warning">Total Due </p> <?php }?></h3>
                                        </div>
                                        <h3 class="card-title text-white mt-2"><?=$total_unpaid;?> TAKA</h3>
                                    </div>
                                </div>
                            </div>
                      	</a>
                    </div>
                    <!-- Column -->
                </div>      
            </div>
            <?php include('inc/footer.php'); ?>
          </div>
        </div>
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