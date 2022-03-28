<?php include('inc/header.php'); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $paydate_prev = $_POST['paydate_prev'];
    $userid = $_POST['userid'];
    $weekid = $_POST['weekid'];
    
    $payout  = $_POST['payout'];
    $up_amounts  = $_POST['up_amounts'];
    $user_amount = $_POST['user_amounts'];
    if($payout != '') {
      $payout  = $_POST['payout'];
    } else {
      $payout = $paydate_prev;  
    }
    $update_result = $common->update("`weekly_status`", "`payout` = '$payout', `up_amounts` = '$up_amounts', `user_amounts` = '$user_amount'", "`id` = '$weekid' && `user_id` = '$userid'");
    if($update_result) {
        $msg = "<div class='alert alert-success py-2'>Data inserted successfully.</div>";
    } else{
        $msg = "<div class='alert alert-warning py-2'>Data does not inserted!</div>";
    }
}
?>

<?php
if(isset($_GET['user']) && isset($_GET['eid'])){
    $uid= $_GET['user'];
    $wid= $_GET['eid'];
    $result = $common->select("`users`","`id`='$uid'");
    $week = $common->select("`weekly_status`","`id`='$wid' && `user_id`='$uid'");
    $value = mysqli_fetch_assoc($result);
    $raw = mysqli_fetch_assoc($week);
    $paydate = $raw['payout'];
    $name = $value['name'];
    $per = $value['per'];
}else{
    header("Location:payment.php");
}

?>
<body>
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
            <div class="container-fluid ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <?= isset($msg) ? $msg : ''; ?>
                        <form class="form-horizontal" method="post" action="">
                            <div class="card-body">
                                <h4 class="card-title">Update Payments</h4>
                                <div class="mb-3 row">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label">User Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="com1" value="<?=$name;?>" required="" name="" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <input type="hidden" name="paydate_prev" value="<?=$paydate;?>">
                                    <input type="hidden" name="userid" value="<?=$uid;?>">
                                    <input type="hidden" name="weekid" value="<?=$wid;?>">
                                    
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label">Payout Date(<?=$paydate;?>)</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="com1" placeholder="" name="payout">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label">Upwork Amount(USD)</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="upamount" onkeyup="uamount();" value="<?=$raw['up_amounts'];?>" name="up_amounts">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label">User Amount(TAKA)</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="ua" placeholder="" name="user_amounts" value="<?=$raw['user_amounts'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="text-end">
                                    <a href="payment.php?user=<?=$uid;?>" class="btn btn-info rounded-pill px-4 waves-effect waves-light">BACK</a>
                                    <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="edit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- footer -->
            <!-- -------------------------------------------------------------- -->
            <?php include('inc/footer.php'); ?>
            <!-- -------------------------------------------------------------- -->
            <!-- End footer -->
            <!-- -------------------------------------------------------------- -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End Wrapper -->
    <div class="chat-windows"></div>
    <!-- -------------------------------------------------------------- -->
    <!-- All Jquery -->
    <!-- -------------------------------------------------------------- -->
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
    <!-- This Page JS -->
    <script src="assets/extra-libs/prism/prism.js"></script>

    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-advanced.init.js"></script> -->
   
    <script>
        $(document).ready(function(){
            $('#uamount').on('keyup',function(){
                var id = this.value;
                $.ajax({
                    url:'ajax/subject.php',
                    type:'POST',
                    data:{
                        id:id
                    },
                    cache:false,
                    success:function(result){
                        $('#subject').html(result);
                    }
                })

            });
        });
        function uamount(){
            let upamount = $('#upamount').val();
            let a = 100;
            let b = <?= $per; ?>;
            let c = a-b;
            let per = c/100;
            let uamount = upamount * per;
            let uamounts =  uamount*76;
            $('#ua').val(Math.floor(uamounts));   
        }
    </script>
   
</body>

</html>