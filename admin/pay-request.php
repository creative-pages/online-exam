
<?php include('inc/header.php'); ?>
<?php
  if(isset($_GET['confirm'])){
      $id=$_GET['confirm'];
      $confirm_query = $common->update("`pay_requests`","`status`='1'","`id`='$id'");
      if ($confirm_query) {
          header("Location: pay-request.php");
      }
  }
  if(isset($_GET['delete'])){
      $id=$_GET['delete'];
      $delete_row = $common->delete("`pay_requests`", "`id`='$id'");
      if ($delete_row) {
          header("Location: pay-request.php");
      }
  }
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
                                        <input type="text" class="form-control product-search" id="input-search" placeholder="Search Contacts...">
                                    </form>
                                </div>
                                <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                                    
                                        <a href="pay-request.php" id="btn-add-contact" class="btn btn-warning mx-2">
                                            pending
                                         </a>
                                         <a href="?active" id="btn-add-contact" class="btn btn-success">
                                            active
                                         </a>
                                </div>
                        </div>
                    </div>
                    
                    <div class="card card-body">
                    
                        <div class="table-responsive">
                            <table class="table search-table v-middle">
                                <thead class="header-item">
                                    <th>Sl No</th>
                                    <th>Student Id</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Transection Id</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <!-- row -->
                                    <?php
                                        if(isset($_GET['active'])) {

                                        $r_payment = $common->select("`pay_requests`","`status`='1' ORDER BY `id` DESC");
                                            if($r_payment){
                                                $i = 1;
                                                while($value = $r_payment->fetch_assoc()){
                                                  $profile_id = $value['user_id'];
                                                  $user = $common->select("`student_table`","`id` = '$profile_id'");
                                                  $userid = $user->fetch_assoc();  

                                    ?>
                                   
                                    <tr class="search-items">
                                        
                                       
                                        <td>
                                            <span class=""><?= $i; ?></span>
                                        </td>
                                       
                                        <td>
                                            <span class="usr-ph-no"><?=$userid['sid'];?></span>
                                        </td>

                                        <td>
                                            <span class="usr-ph-no"><?=$userid['sname'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['pnumber'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['tid'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['method'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['amount'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?= $fm->formatDate($value['created_at']);?></span>
                                        </td>
                                        
                                        <td>
                                            N/A
                                        </td>
                                    </tr>
                                    <?php }} else {?>
                                        <tr>
                                        <td colspan="9"> 
                                            <h4 class="text-center text-warning">No results found!</h4>
                                        </td>
                                    </tr>
                                    <?php }} else {?>
                                        <?php
                                        $r_payment = $common->select("`pay_requests`","`status`='0'ORDER BY `id` DESC");
                                            if($r_payment){
                                                $i = 1;
                                                while($value = $r_payment->fetch_assoc()){
                                                  $profile_id = $value['user_id'];
                                                  $user = $common->select("`student_table`","`id` = '$profile_id'");
                                                  $userid = $user->fetch_assoc();  

                                    ?>
                                   
                                    <tr class="search-items">
                                        
                                       
                                        <td>
                                            <span class=""><?= $i;?></span>
                                        </td>
                                       
                                        <td>
                                            <span class="usr-ph-no"><?=$userid['sid'];?></span>
                                        </td>

                                        <td>
                                            <span class="usr-ph-no"><?=$userid['sname'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['pnumber'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['tid'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['method'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?=$value['amount'];?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no"><?= $fm->formatDate($value['created_at']);?></span>
                                        </td>
                                        
                                        <td>
                                            <a onclick="return confirm('Are you sure to confirm?');" href="?confirm=<?=$value['id'];?>" class="btn btn-primary btn-sm">Active</a>
                                            <a onclick="return confirm('Are you sure to delete?');" href="?delete=<?=$value['id'];?>" class="btn btn-danger btn-sm">Danger</a>
                                        </td>
                                    </tr>
                                        <?php }} else { ?>
                                            <tr>
                                        <td colspan="9"> 
                                            <h4 class="text-center text-warning">No results found!</h4>
                                        </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
           
            <?php include('inc/footer.php'); ?>
           
        </div>
       
    </div>
    
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
</body>

</html>