<?php include('inc/header.php'); ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set_payment_time'])) {
        $batch_student_id = $fm->validation($_POST['batch_student_id']);
        $payment_time = $fm->validation($_POST['payment_time']);
        $time_update = $common->update("`batch_students`", "`payment_time` = '$payment_time'", "`id` = '$batch_student_id'");
        if ($time_update) {
            header("Location: " . $_SERVER['REQUEST_URI']);
        }
    }
    if(isset($_GET['batch_id']) && !empty($_GET['batch_id']) && is_numeric($_GET['batch_id'])) {
        $batch_id = $_GET['batch_id'];
        $batch_info = $common->select("`add_branch`", "`id` = '$batch_id'");
        if ($batch_info) {
            $batch_infos = mysqli_fetch_assoc($batch_info);
        } else {
            header("Location: add-branch.php");
        }
    } else {
        header("Location: add-branch.php");
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
        <!-- -------------------------------------------------------------- -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- -------------------------------------------------------------- -->
            <!-- Container fluid  -->
            <!-- -------------------------------------------------------------- -->
            <div class="container-fluid">
                <!-- -------------------------------------------------------------- -->
                <!-- Start Page Content -->
                <!-- -------------------------------------------------------------- -->
                <div class="widget-content searchable-container list">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-4 col-xl-2">
                                <form>
                                    <input type="text" class="form-control product-search" id="input-search" placeholder="Search Contacts...">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <td><b>Batch Name</b></td>
                                <td><b><?= $batch_infos['branch_name']; ?></b></td>
                                <td><b>Batch Fee</b></td>
                                <td><b><?= $batch_infos['total_fee'] > 0 ? $batch_infos['total_fee'] . 'Tk' : 'Free'; ?></b></td>
                            </tr>
                        </table>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered search-table v-middle">
                                <thead class="header-item">
                                    <th>Sl No</th>
                                    <th>Student Name</th>
                                    <?php
                                    if ($batch_infos['type'] == 'paid') {
                                    ?>
                                    <th>Paid</th>
                                    <th>Unpaid</th>
                                    <th>Stallment</th>
                                    <th>Stallment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <?php
                                    }
                                    ?>
                                </thead>
                                <tbody>
                                <!-- row -->
                                <?php
                                $batch_student = $common->select("`batch_students`", "`batch_id` = '$batch_id'");
                                    if($batch_student){
                                        $i = 1;
                                        while($batch_students = $batch_student->fetch_assoc()) {
                                        $student_id = $batch_students['student_id'];
                                        $student_info = $common->select("`student_table`", "`id` = '$student_id'");
                                        $student_infos = mysqli_fetch_assoc($student_info);

                                        if ($batch_infos['type'] == 'paid') {
                                            // batch inactive
                                            if ($batch_students['payment_time'] != NULL) {
                                                $date1 = date_create(date("Y-m-d"));
                                                $date2 = date_create($batch_students['payment_time']);
                                                $diff = date_diff($date1, $date2);
                                                $diff_result = $diff->format("%R%a");
                                                if (is_numeric(strpos($diff_result, "-"))) {
                                                    $common->update("`batch_students`", "`status` = '0'", "`student_id` = '$student_id'");
                                                    $batch_status = 'Inactive';
                                                } else {
                                                    $batch_status = $batch_students['status'] == 1 ? 'Active' : 'Inactive';
                                                }
                                            } else {
                                                $batch_status = $batch_students['status'] == 1 ? 'Active' : 'Inactive';
                                            }
                                        }
                                    ?>
                                    <tr class="search-items">
                                        <td>
                                            <span class="usr-email-addr"><?= $i;?></span>
                                        </td>
                                        <td>
                                            <a href="edit-student.php?edts=<?= $student_infos['id']; ?>" target="_blank">
                                                <span class="usr-ph-no">
                                                    <?= $student_infos['sname']; ?>
                                                </span>
                                            </a>
                                        </td>
                                        <?php
                                        if ($batch_infos['type'] == 'paid') {
                                        ?>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?= $batch_students['paid'] == NULL ? 0 : $batch_students['paid']; ?>TK
                                            </span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?= $batch_students['fee'] - $batch_students['paid']; ?>Tk
                                            </span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?php
                                                if ($batch_students['stallment'] == NULL) {
                                                    echo 'First';
                                                } elseif($batch_students['stallment'] == '1') {
                                                    echo 'Second';
                                                } elseif($batch_students['stallment'] == '2') {
                                                    echo 'Third';
                                                } elseif($batch_students['stallment'] == '3') {
                                                    echo 'End';
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?php
                                                if ($batch_students['payment_time'] != NULL) {
                                                    echo '<span class="bg-danger text-white px-2">' . date('d M Y', strtotime($batch_students['payment_time'])) . '</span>';
                                                } else {
                                                    echo 'N/A';
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?= $batch_status; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onClick="setPaymentTime(<?= $batch_students['id']; ?>, '<?= $student_infos['sname']; ?>')" <?= $batch_students['payment_time'] != NULL ? ' disabled=""' : ''; ?>>Set Payment Time</button>
                                        </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                        <?php
                                        $i++;
                                        }
                                    }
                                ?>
                                </tbody>
                                <!-- Modal -->
                                <div class="modal fade" id="set_payment_time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Next Stallment Time - <span id="user_name"></span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                                            <input type="hidden" id="batch_student_id" name="batch_student_id" value="">
                                            <input type="date" name="payment_time" class="form-control" required="">
                                            <button type="submit" class="btn btn-primary float-end mt-3" name="set_payment_time">Set Time</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------- -->
                <!-- End PAge Content -->
                <!-- -------------------------------------------------------------- -->
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