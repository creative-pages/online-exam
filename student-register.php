<?php
    require_once 'init.php';
   // Session::checkAdminSession();
    $exam = new Exam();
    $common = new Common();
    $all = new All();
?>
<?php
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
        $sname = $_POST['sname'];
        $sfname = $_POST['sfname'];
        $smname = $_POST['smname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];
        
        
        if($ms == 'yes') {
            $ssc = $_POST['ssc'];
            $hsc = $_POST['hsc'];
            $st = $_POST['st'];
        } else {
            $ssc = '0';
            $hsc = '0';
            $st = 'no';
        }

        $query = $common->select("`student_table`","`contack`='$contact'");
        $email_check = $common->select("`student_table`","`email`='$email'");

        if($email_check != false) {
            $email_error = "<div class='alert alert-warning mb-0 py-2'>Email Already Exists!</div>";
        } elseif($query != false) {
            $contact_error = "<div class='alert alert-warning mb-0 py-2'>Contact Already Exists!</div>";
        } else {
            $success =$common->insert("`student_table`(`sname`,`sfname`,`smname`,`email`,`contack`,`password`,`ssc`,`hsc`,`ms`,`st`)","('$sname', '$sfname', '$smname', '$email','$contact','$password','$ssc','$hsc','$ms','$st')");
            if($success){
                $get_id = $common->select("`student_table`", "`email` = '$email'");
                $get_student_id = mysqli_fetch_assoc($get_id);
                $student_id = $get_student_id['id'];

                $batch_id = $_POST['batch'];

                $batch_info = $common->select("`add_branch`", "`id` = '$batch_id'");
                $batch_infos = mysqli_fetch_assoc($batch_info);
                if ($batch_infos['type'] == 'paid') {
                    $status = '0';
                } else {
                    $status = '1';
                }
                $batch_fee = $batch_infos['total_fee'];

                $add_to_batch = $common->insert("`batch_students`(`student_id`, `batch_id`, `fee`, `status`)", "('$student_id', '$batch_id', '$batch_fee', '$status')");
                if ($add_to_batch) {
                    header("Location: signin.php");
                } else {
                    $msg = "<div class='alert alert-warning mb-0 py-2'>Something is wrong!</div>";
                }
            }
        }
     }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template">
    <meta name="description" content="MaterialPro is powerful and clean admin dashboard template, inpired from Google's Material Design">
    <meta name="robots" content="noindex,nofollow">
    <title>BatBio</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Favicon icon -->
    <link href="admin/assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="admin/assets/libs/apexcharts/dist/apexcharts.css">
    <!-- Custom CSS -->
    <link href="admin/dist/css/style.min.css" rel="stylesheet">
     <!-- Data table plugin CSS -->
     <link href="admin/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
      <!-- Card Page CSS -->
    <link rel="stylesheet" type="text/css" href="admin/assets/extra-libs/prism/prism.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <link href="admin/dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="highlights/highlight.min.css">
    <!-- search option in select option start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- search option in select option end -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        .select2-container {
            z-index: 99999;
        }
    </style>
</head>


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
    
       
        <div class="page-wrapper">
            
            <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                       
                        <form class="form-horizontal" action="" method="post">
                            <div class="card-body">
                                <h2 class="text-center border-bottom pb-3 mb-3">Registration</h2>
                                <h4 class="card-title">Personal Info</h4>
                               
                                <div class="mb-3 row">
                                    <label for="sname" class="col-sm-3 text-end control-label col-form-label">Student Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="sname" placeholder="Your name" value="<?= isset($_POST['sname']) ? $_POST['sname'] : ''; ?>" name="sname" required="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="sfname" class="col-sm-3 text-end control-label col-form-label">Father's Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="sfname" placeholder="Your father's name" value="<?= isset($_POST['sfname']) ? $_POST['sfname'] : ''; ?>" name="sfname" required="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="smname" class="col-sm-3 text-end control-label col-form-label">Mother's Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="smname" placeholder="Your mother's name" value="<?= isset($_POST['smname']) ? $_POST['smname'] : ''; ?>" name="smname" required="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 text-end control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" placeholder="Email Here" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" name="email" required="">
                                        <?= isset($email_error) ? $email_error : '';?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="contact" class="col-sm-3 text-end control-label col-form-label">Contact No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="contact" placeholder="Contact number" value="<?= isset($_POST['contact']) ? $_POST['contact'] : ''; ?>" name="contact" pattern=".{11,11}" required title="Please Input Only 11 digit" required="">
                                        <?= isset($contact_error) ? $contact_error : '';?>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="pwd" class="col-sm-3 text-end control-label col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="pwd"  name="password" placeholder="Enter your password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" required="">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <h4 class="card-title">Requirements</h4>
                                
                                <div class="mb-3 row">
                                    <label for="batch" class="col-sm-3 text-end control-label col-form-label">Select Batch</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="batch" id="batch" required="">
                                            <option value="">Choose Your Option</option>
                                            <?php
                                            $query = $common->select("add_branch ORDER BY id DESC");
                                            if($query){
                                                while($raw = mysqli_fetch_assoc($query)){
                                            ?>
                                            <option value="<?= $raw['id']; ?>"<?= isset($_POST['batch']) && $_POST['batch'] == $raw['id'] ? ' selected' : ''; ?>><?= $raw['branch_name'] . ' (' . ucfirst($raw['type']) . ')';?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row mt-4">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label pt-0">Medical Student?</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline ps-0">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="medical_yes" name="ms" value="yes" required=""<?= isset($_POST['ms']) && $_POST['ms'] == 'yes' ? ' checked=""' : ''; ?>>
                                                <label class="custom-control-label" for="medical_yes">Yes</label>
                                            </div>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="medical_no" name="ms" value="no" required=""<?= isset($_POST['ms']) && $_POST['ms'] == 'no' ? ' checked=""' : ''; ?>>
                                                <label class="custom-control-label" for="medical_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="medical_part" style="display: none;">
                                    <div class="mb-3 row">
                                    <label for="ssc" class="col-sm-3 text-end control-label col-form-label">SSC RESULT</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ssc" placeholder="Enter SSC Result" value="<?= isset($_POST['ssc']) ? $_POST['ssc'] : ''; ?>" name="ssc">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="hsc" class="col-sm-3 text-end control-label col-form-label">HSC RESULT</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="hsc" placeholder="Enter HSC Result" value="<?= isset($_POST['hsc']) ? $_POST['hsc'] : ''; ?>" name="hsc">
                                    </div>
                                </div>
                                <div class="mb-3 row mt-4">
                                    <label for="com1" class="col-sm-3 text-end control-label col-form-label pt-0">Second Timer?</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline ps-0">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="second_yes" name="st" value="yes"<?= isset($_POST['st']) && $_POST['st'] == 'yes' ? ' checked=""' : ''; ?>>
                                                <label class="custom-control-label" for="second_yes">Yes</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="second_no" name="st" value="no"<?= isset($_POST['st']) && $_POST['st'] == 'no' ? ' checked=""' : ''; ?>>
                                                <label class="custom-control-label" for="second_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="d-flex justify-content-around">
                                    <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light" name="save">Sign Up</button>
                                    <p>
                                        Already have an account?
                                        <a href="signin.php">Login</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                </div>
                
            </div>
            
            <!-- footer -->
            <!-- -------------------------------------------------------------- -->
           
            <!-- -------------------------------------------------------------- -->
            <!-- End footer -->
            <!-- -------------------------------------------------------------- -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
    
    <!-- -------------------------------------------------------------- -->
    <!-- End Wrapper -->
    <!-- -------------------------------------------------------------- -->
    <!-- All Jquery -->
    <!-- -------------------------------------------------------------- -->
    <script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="admin/dist/js/app.min.js"></script>
    <script src="admin/dist/js/app.init.js"></script>
    <script src="admin/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="admin/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="admin/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
   <script src="admin/dist/js/feather.min.js"></script>
    <script src="admin/dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script src="admin/assets/extra-libs/prism/prism.js"></script>

    <!--This page plugins -->
    <script src="admin/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#medical_yes").click(function(){
               $("#medical_part").slideDown();

               $('#ssc').attr('required', '');
               $('#hsc').attr('required', '');
               $('#st').attr('required', '');
            });
            $("#medical_no").click(function(){
               $("#medical_part").slideUp();

               $('#ssc').removeAttr('required', '');
               $('#hsc').removeAttr('required', '');
               $('#st').removeAttr('required', '');
            });
        });
    </script>
</body>

</html>