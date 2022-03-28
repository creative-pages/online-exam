<?php include('inc/header.php'); ?>

<?php
if(isset($_GET['user'])){
    $uid= $_GET['user'];
    $result = $common->select("`users`","`id`='$uid'");
    $weekly = $common->select("`weekly_status`","`user_id`='$uid'");
    $payments = $common->select("`payments`","`user_id`='$uid' AND `type`='payments'");
    $borrow = $common->select("`payments`","`user_id`='$uid' AND `type`='borrow'");
    $lend = $common->select("`payments`","`user_id`='$uid' AND `type`='lend'");
    $user = mysqli_fetch_assoc($result);
    $name = $user['name'];
    if($weekly != FALSE){
        $total_amount=0;
        while($value = mysqli_fetch_assoc($weekly)){
             $total_amount += $value['user_amounts'];
        }
    }
    else{
        $total_amount=0;
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
     if($borrow != FALSE){
        $total_borrow=0;
        while($value = mysqli_fetch_assoc($borrow)){
             $total_borrow += $value['borrow'];
        }
    }
    else{
        $total_borrow=0; 
    }
    if($lend != FALSE){
        $total_lend=0;
        while($value = mysqli_fetch_assoc($lend)){
             $total_lend += $value['lend'];
        }
    }
    else{
        $total_lend=0;
    }
    $total_unpaid = (($total_amount-$total_pay)+$total_borrow)-$total_lend;
}else{
    header("Location:user.php");
}
?>
<?php
 

?>
<body>
    <!-- -------------------------------------------------------------- -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- -------------------------------------------------------------- -->
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
                <div class="widget-content searchable-container list">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-4 col-xl-2">
                                <form>
                                    <input type="text" class="form-control product-search" id="input-search" placeholder="Search...">
                                </form>
                            </div>
                            <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                            <a href="dashboard.php" id="btn-add-contact" class="btn btn-info">
                                HOME</a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <?= isset($dltmsg) ? $dltmsg : ''; ?>
                        <table>
                            <tr>
                                <td>
                                     <a href="payment.php?user=<?=$uid;?>" id="btn-add-contact" class="btn btn-primary mx-2 mb-1">
                             payment status
                            </a>
                           
                           
                            <a href="payment.php?user=<?=$uid;?>&borrow" id="btn-add-contact" class="btn btn-info mx-2 mb-1">
                             Borrow
                            </a>
                        
                            
                            <a href="payment.php?user=<?=$uid;?>&lend" id="btn-add-contact" class="btn btn-dark mx-2 mb-1">
                             Lend
                            </a>
                           
                            
                            <a href="payment.php?user=<?=$uid;?>&weekly" id="btn-add-contact" class="btn btn-danger mx-2 mb-1">
                             Show Weekly status
                            </a>
                           
                            
                            <a href="weekly-status.php?puser=<?=$uid?>" id="btn-add-contact" class="btn btn-warning mx-2 mb-1">
                             Add Weekly 
                            </a>
                            
                            
                            <a href="add-payments.php?usr=<?=$uid?>" id="btn-add-contact" class="btn btn-success mx-2 mb-1">
                             Add payment
                            </a>
                                    
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <td><b>User Name</b><br><?=$name;?></br></td>
                                    <td><b>Total Borrow<br><?=$total_borrow;?> TK</br></b></td>
                                    <td><b>Total Lend<br><?=$total_lend;?> TK</br></b></td>
                                    <td><b>Total Income<br><?=$total_amount;?> TK</br></b></td>
                                    <td><b>Total Paid<br><?=$total_pay;?> TK</br></b></td>
                                    <td><b><?php if($total_unpaid>0){?>Total Unpaid<?php } else { ?>Total Due <?php }?><br><?=$total_unpaid;?> TK</br></b></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <?php 
                            if(isset($_GET['borrow'])){
                            ?>
                            <div class="col-md-12 text-center btn btn-info   mb-1">Borrow Status</div>
                            <table class="table table-bordered search-table v-middle">
                                <thead class="header-item">
                                    <th>Sl No</th>
                                    <th>Borrow Date</th>
                                    <th>Borrow Amount</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr class="search-items">
                                    <?php
                                        $result = $common->select("`payments`","`user_id`='$uid' AND `type`='borrow' ORDER BY `id` DESC");
                                        if($result){
                                            $i=1;
                                            while($value = mysqli_fetch_assoc($result)){
                                    ?>
                                        <td>
                                            <span class="usr-email-addr"><?=$i;?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                 <?=$fm->formatDate($value['created_on']);?>
                                            </span>
                                            </a>
                                        </td>
                                       <td>
                                         <span class="usr-ph-no">
                                           <?=$value['borrow'];?> Taka
                                         </span>
                                        </td>
                                        <td>
                                            <a href="edit-week.php?user=<?=$value['user_id'];?>&eid=<?=$value['id'];?>" class="btn btn-warning btn-sm">
                                            edit
                                            <a onclick="return confirm('Are you sure to delete?')" href="payment.php?dlt=<?=$value['id'];?>" class="btn btn-danger btn-sm">
                                            delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }}?>
                                </tbody>
                            </table>
                            
                            <?php } elseif(isset($_GET['lend'])){?>
                            <div class="col-md-12 text-center btn btn-info   mb-1">Lend Status</div>
                            <table class="table table-bordered search-table v-middle">
                                <thead class="header-item">
                                    <th>Sl No</th>
                                    <th>Lend Date</th>
                                    <th>Lend Amount</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr class="search-items">
                                    <?php
                                        $result = $common->select("`payments`","`user_id`='$uid' AND `type`='lend' ORDER BY `id` DESC");
                                        if($result){
                                            $i=1;
                                            while($value = mysqli_fetch_assoc($result)){
                                    ?>
                                        <td>
                                            <span class="usr-email-addr"><?=$i;?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                               <?=$fm->formatDate($value['created_on']);?>
                                            </span>
                                            </a>
                                        </td>
                                       <td>
                                         <span class="usr-ph-no">
                                           <?=$value['lend'];?> Taka
                                         </span>
                                        </td>
                                        <td>
                                            <a href="edit-week.php?user=<?=$value['user_id'];?>&eid=<?=$value['id'];?>" class="btn btn-warning btn-sm">
                                            edit
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }}?>
                                </tbody>
                            </table>
                            <?php }elseif(isset($_GET['weekly'])){?>
                            <div class="col-md-12 text-center btn btn-info   mb-1">Weekly Status</div>
                            <table class="table table-bordered search-table v-middle">
                                <thead class="header-item">
                                    <th>Sl No</th>
                                    <th>Payout Date</th>
                                    <th>Amount(USD)</th>
                                    <th>User Amount(Taka)</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr class="search-items">
                                    <?php
                                        $result = $common->select("`weekly_status`","`user_id`='$uid' ORDER BY `id` DESC");
                                        if($result){
                                            $i=1;
                                            while($value = mysqli_fetch_assoc($result)){
                                    ?>
                                        <td>
                                            <span class="usr-email-addr"><?=$i;?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?=$value['payout'];?>
                                            </span>
                                            </a>
                                        </td>
                                       <td>
                                         <span class="usr-ph-no">
                                           <?=$value['up_amounts'];?> USD
                                         </span>
                                        </td>
                                        <td>
                                         <span class="usr-ph-no">
                                           <?=$value['user_amounts'];?> Taka
                                         </span>
                                        </td>
                                        <td>
                                            <a href="edit-week.php?user=<?=$value['user_id'];?>&eid=<?=$value['id'];?>" class="btn btn-warning btn-sm">
                                            edit
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }}?>
                                </tbody>
                            </table>
                            <?php } else { ?>
                                <table class="table table-bordered search-table v-middle">
                                <div class="col-md-12 text-center btn btn-success   mb-1">Payments Status</div>
                                <thead class="header-item">
                                    <th>Sl No</th>
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr class="search-items">
                                    <?php
                                        $result = $common->select("`payments`","`user_id`='$uid' AND `type`='payments' ORDER BY `id` DESC");
                                        if($result){
                                            $i=1;
                                            while($value = mysqli_fetch_assoc($result)){
                                    ?>
                                        <td>
                                            <span class="usr-email-addr"><?=$i;?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?=$fm->formatDate($value['created_on']);?>
                                            </span>
                                            </a>
                                        </td>
                                       <td>
                                         <span class="usr-ph-no">
                                           <?=$value['amounts'];?>
                                         </span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                            <?=$value['description'];?>
                                            </span>
                                        </td>
                                        <td>
                                             <a href="edit-payment.php?user=<?=$value['user_id'];?>&pid=<?=$value['id'];?>" class="btn btn-warning btn-sm">
                                            edit
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }}?>
                                </tbody>
                            </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------- -->
                <!-- End PAge Content -->
                <!-- -------------------------------------------------------------- -->
                     <!-- Edit borrow Modal -->
                     <!-- End Edit Modal -->
                    
            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End Container fluid  -->
            <!-- -------------------------------------------------------------- -->
            <!-- -------------------------------------------------------------- -->
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
    <!--This page plugins -->
    <script src="dist/js/pages/contact/contact.js"></script>
    <script>
        function setPaymentTime(id, user_name) {
            $('#user_name').text(user_name);
            $('#batch_student_id').val(id);
            $('#set_payment_time').modal('show');
        }
    </script>
</body>

</html>