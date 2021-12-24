<?php include('inc/header.php'); ?>
<?php
    if(isset($_GET['edts'])){
        $ids = $_GET['edts'];
        $student = $common->select("`student_table`","`id`='$ids'");
        $allstudent =mysqli_fetch_assoc($student);
       
    }

?>

<?php
  
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $sname = $_POST['sname'];
        $sfname = $_POST['sfname'];
        $smname = $_POST['smname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $sid = $_POST['sid'];
        $batch = $_POST['batch'];
        $batchfee = $_POST['batchfee'];
        $advancefee = $_POST['advancefee'];
        $duefee = $_POST['duefee'];
       
         
           
           $success = $common->update("`student_table`","`sname` = '$sname',`sfname` = '$sfname',`smname` = '$smname',`email` = '$email',`contack` = '$contact',`sid` = '$sid',`batch` = '$batch',`batchfee`= '$batchfee',`advancefee` = 'advancefee',`duefee` = 'duefee'","`id`='$ids'");

           if($success){
               header("Location:add-student.php");
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
    <!-- -------------------------------------------------------------- -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- -------------------------------------------------------------- -->
    <div id="main-wrapper">
        <!-- -------------------------------------------------------------- -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- -------------------------------------------------------------- -->
        <?php include('inc/topbar.php'); ?>
        <!-- -------------------------------------------------------------- -->
        <!-- End Topbar header -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- -------------------------------------------------------------- -->
        <?php include('inc/left-sidebar.php'); ?>
        <!-- -------------------------------------------------------------- -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Page wrapper  -->
        
        <div class="page-wrapper">
            
            <div class="container-fluid ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                       
                        <form class="form-horizontal" action="" method="post">
                            <div class="card-body">
                                <h4 class="card-title">Personal Info</h4>
                                   
                                <div class="mb-3 row">
                                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Student Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  value="<?=$allstudent['sname'];?>" name="sname">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="lname" class="col-sm-3 text-end control-label col-form-label">Student Father Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lname" value="<?=$allstudent['sfname'];?>" name="sfname">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="lname" class="col-sm-3 text-end control-label col-form-label">Student Mother Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lname" value="<?=$allstudent['smname'];?>" name="smname">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email1" class="col-sm-3 text-end control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email1" value="<?=$allstudent['email'];?>" name="email">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Contact No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="contact" onkeyup="ran()" value="<?=$allstudent['contack'];?>" name="contact" pattern=".{11,11}"required title="Please Input Only 11 digit">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Student ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="sid" value="<?=$allstudent['sid'];?>"  name="sid"readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <h4 class="card-title">Requirements</h4>
                                
                                <div class="mb-3 row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Select Batch</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="batch" id="batch">
                                            <option>Choose Your Option</option>
                                             <?php
                                                $query = $common->select("`add_branch` ORDER BY `id` DESC");
                                                if($query){
                                                    while($raw = mysqli_fetch_assoc($query)){
                                                 
                                             ?>
                                            <option  <?php if($allstudent['batch']==$raw['id']){?> selected="selected"<?php } ?> value =" <?= $raw['id'];?>"><?= $raw['branch_name'];?></option>
                                           <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label">Batch Fee</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  value=<?=$allstudent['batchfee'];?> name="batchfee" id="batchfee" onkeyup="feedue()">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label">Advance Fee</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value=<?=$allstudent['advancefee'];?> name="advancefee" id ="advancefee" onkeyup="feedue()">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label">Due Fee</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="duefee" id="duef" value=<?=$allstudent['duefee'];?>>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="p-3 border-top">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="update">Update</button>
                                    <button type="submit" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                
            </div>
            
            <!-- footer -->
            <!-- -------------------------------------------------------------- -->
            <footer class="footer text-center">
                   All Rights Reserved by Materialpro admin.
            </footer>
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
            $(".description_button_toggle").click(function(){
                var id = $(this).data('value');
                $("#description_" + id).toggle();
            });
        });
    </script>

    <script> 
        function feedue() {
            
            var batchfee = document.getElementById('batchfee').value;
            var advancefee = document.getElementById('advancefee').value;
            var due = batchfee-advancefee;
           
                document.getElementById('duef').value=due;
           


        }
        function ran() {
             
            var contact = document.getElementById('contact').value;
            var sid = contact.substring(Math.floor(3, 6),Math.floor(9, 11));
            
            document.getElementById('sid').value=sid;
        }
    </script>
</body>

</html>