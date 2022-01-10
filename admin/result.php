<?php include('inc/header.php'); ?>
<?php
if (isset($_GET['exam_id'])) {
    $exam_id = $_GET['exam_id'];
    $exam_detail = $common->select("`add_exam`", "`id` = '$exam_id'");
    $exam_details = mysqli_fetch_assoc($exam_detail);

} else {
    header("Location: add-exam.php");
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
                    <div class = "card card-body">
                        <div class="row">
                            <div class="col-12">
                                <h2><?= $exam_details['examname']; ?></h2>
                            </div>
                            <div class="col-3">
                                <strong>Average Score</strong>
                                <p class="mx-2" style="margin-bottom: 1px;">90%</p>
                                <p class="mx-2">90%</p>
                            </div>
                            <div class="col-3">
                                <strong>Average Time</strong>
                                <p class="mx-2" style="margin-bottom: 1px;">90%</p>
                                <p class="mx-2">90%</p>
                            </div>
                            <div class="col-3">
                                <strong>Response</strong>
                                <p class="mx-2">9</p>
                            </div>
                            <div class="col-3">
                                <strong>Score Histogram</strong>
                               
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-4 col-xl-2">
                                <form>
                                    <input type="text" class="form-control product-search" id="input-search" placeholder="Search Result...">
                                </form>
                            </div>
                            <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                                <a href="add-contack.php" id="" class="btn btn-info">
                                    Export Result
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Modal -->
                    
                    <div class="card card-body">
                        <div class="table-responsive">
                            <table class="table search-table v-middle">
                                <thead class="header-item">
                                    <th>Serial</th>
                                    <th>Student Name</th>
                                    <th>Started On</th>
                                    <th>Finished On</th>
                                    <th>Time</th>
                                    <th>Answers</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $exam_id = $_GET['exam_id'];
                                    $all_result = $common->select("`results`", "`exam_id` = '$exam_id'");
                                    if ($all_result) {
                                        $ser = 1;
                                        while ($all_results = mysqli_fetch_assoc($all_result)) {
                                            $student_id = $all_results['student_id'];
                                            $student_detail = $common->select("`student_table`", "`id` = '$student_id'");
                                            if($student_detail) {
                                                $student_details = mysqli_fetch_assoc($student_detail);
                                            }
                                        ?>
                                        <tr class="search-items">
                                            <td>
                                                 <span class="usr-email-addr"><?= $ser; ?></span>
                                            </td>
                                            <td>
                                                <span class="usr-email-addr" data-email="allen@mail.com"><?= isset($student_details['sname']) ? $student_details['sname'] : 'Unknown'; ?></span>
                                            </td>
                                            <td>
                                                <span class="usr-location" data-location="Sydney, Australia"><?= $all_results['start_time']; ?></span>
                                            </td>
                                            <td>
                                                <span class="usr-ph-no" data-phone="+91 (125) 450-1500"><?= $all_results['end_time']; ?></span>
                                            </td>
                                            <td>
                                               <?= $all_results['total_time']; ?>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                    <?php
                                                    $all_qestion = $common->select("`questions`", "`exam_id` = '$exam_id' ORDER BY `serial` ASC");
                                                    while ($all_qestions = mysqli_fetch_assoc($all_qestion)) {
                                                    ?>
                                                    <th class="text-center"><?= $all_qestions['serial']; ?></th>
                                                    <?php
                                                    }
                                                    ?>
                                                    </tr>
                                                    <tr>
                                                    <?php
                                                    $all_qestion = $common->select("`questions`", "`exam_id` = '$exam_id' ORDER BY `serial` ASC");
                                                    while ($all_qestions = mysqli_fetch_assoc($all_qestion)) {
                                                    ?>
                                                        <th class="px-1">
                                                        <?php
                                                        if($all_results['end_time'] == 'offline') {
                                                            $serial_id = $all_qestions['serial'];
                                                        } else {
                                                            $serial_id = $all_qestions['id'];
                                                        }
                                                        
                                                        $question_ans = $all_qestions['answer'];
                                                        if (is_numeric(strpos($all_results['question_ans'],$serial_id.'='.$question_ans))) {
                                                            echo '<img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">';
                                                        } else {
                                                            echo '<img width="25px" height="25px" src="assets/images/img/cross1.png">';
                                                        }
                                                        ?>
                                                        </th>
                                                    <?php
                                                    }
                                                    ?>
                                                    </tr>
                                                </table>
                                            </td>
                                            
                                        </tr>
                                        <?php
                                        $ser++;
                                        }
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="6"> 
                                            <h4 class="text-center text-warning">No results found!</h4>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------- -->
                <!-- End PAge Content -->
                <!-- -------------------------------------------------------------- -->
            </div>
            <!-- Share Modal -->
           
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
</body>

</html>