<?php include('inc/header.php'); ?>

<style>
    /* owl carousel prev next */
    .owl-carousel .owl-nav button.owl-next,
    .owl-carousel .owl-nav button.owl-prev {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    .owl-carousel .owl-nav button.owl-prev {
        left: -20px;
    }
    .owl-carousel .owl-nav button.owl-next {
        right: -20px;
    }

    .owl-carousel .owl-nav button.owl-next span,
    .owl-carousel .owl-nav button.owl-prev span {
        width: 40px;
        height: 40px;
        display: block;
        background: #7fc4e5;
        color: white;
        font-size: 30px;
        text-align: center;
        line-height: 35px;
    }
</style>

<?php
if (isset($_GET['exam_id']) && $_GET['exam_id'] != '' && is_numeric($_GET['exam_id'])) {
    $main_exam_id = $_GET['exam_id'];

    if (isset($_GET['delete_omr'])) {
        $omr_delete = $common->select("`omr_upload`", "`exam_id` = '$main_exam_id'");
        if($omr_delete) {
            while ($omr_deletes = mysqli_fetch_assoc($omr_delete)) {
                $delete_id = $omr_deletes['id'];
                $delete_file_name = $omr_deletes['file'];
                $common->delete("`omr_upload`", "`id` = '$delete_id'");
                unlink("../upload_file/omr_sheet/" . $delete_file_name);
            }
            header("Location: omr.php?exam_id=" . $main_exam_id);
        } else {
            header("Location: omr.php?exam_id=" . $main_exam_id);
        }
    }
} else {
    header("Location: add-exam.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['xlsx_file_import'])) {
    require 'XLSXReader.php';
    $excel = new XLSXReader($_FILES['upxlsx']['tmp_name']);
    $dataexcel = $excel->getSheetData('Sheet0');

    foreach ($dataexcel as $i => $value) {
        if ($value[0] != 'Exam' && $value[4] != '') {
            $exam_id = $value[0];
            $student_id = $value[2];
            $total_marks = $value[4];
            $right_ans = $value[7];
            $wrong_ans = $value[8];
            $blank_ans = $value[9];
            $total_row = (count($dataexcel[$i]) - 11) / 3;

            $column = 11;
            $serial = 1;
            $all_ans = '';
            do {
                if ($dataexcel[$i][$column] == 'A') {
                    $ans = 'option_one';
                } elseif ($dataexcel[$i][$column] == 'B') {
                    $ans = 'option_two';
                } elseif ($dataexcel[$i][$column] == 'C') {
                    $ans = 'option_three';
                } elseif ($dataexcel[$i][$column] == 'D') {
                    $ans = 'option_four';
                } elseif ($dataexcel[$i][$column] == '') {
                    $ans = '';
                }

                $all_ans .= $serial . '=' . $ans . ',';
                $column += 3; 
                $serial++;
            } while ($serial < ($total_row + 1));
            $all_ans = rtrim($all_ans,",");

            $common->insert("`results`(`exam_id`, `student_id`, `score`, `wrongans`, `rightans`, `blankans`, `question_ans`, `start_time`, `end_time`, `total_time`)", "('$exam_id', '$student_id', '$total_marks', '$wrong_ans', '$right_ans', '$blank_ans', '$all_ans', 'offline', 'offline', 'offline')");
        }
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
                <!-- Button trigger modal -->
                <button id="after_copy_dnone" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#import_xlsx_button">
                  <i data-feather="download" class="feather-sm fill-white me-1"></i>
                    Import XLSX
                </button>
                <br>
                <?php
                    if (isset($imported_result)) {
                        echo $imported_result;
                    }
                ?>

                <div class="owl-carousel owl-theme mt-5">
                    <?php
                    $omr_check = $common->select("`omr_upload`", "`exam_id` = '$main_exam_id'");
                    if($omr_check) {
                        $i = 1;
                        $omr_check_total = mysqli_num_rows($omr_check);
                        while ($omr_checks = mysqli_fetch_assoc($omr_check)) {
                        ?>
                        <div class="item">
                            <h4 class="mt-4">
                                User ID: <?= $omr_checks['student_id']; ?>
                                <span class="float-end me-3">Total: <?= $i . '/' . $omr_check_total; ?></span>
                            </h4>
                            <img height="100%" src="../upload_file/omr_sheet/<?= $omr_checks['file']; ?>" alt="">
                        </div>
                        <?php
                        $i++;
                        }
                    }
                    ?>
                </div>
                <?php
                if($omr_check) {
                ?>
                <a class="btn btn-danger float-end mt-3" href="<?= $_SERVER['REQUEST_URI']; ?>&delete_omr" onclick="return confirm('Are you sure to delete all omr?');">Delete All OMR</a>
                <?php
                }
                ?>
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

    <!-- modals start -->
    <!-- Modal -->
    <div class="modal fade" id="import_xlsx_button" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Choose XLSX File Only</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" id="xlsx_file_import" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <input class="form-control" type="file" name="upxlsx" accept=".xlsx" required="">
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="xlsx_file_import" form="xlsx_file_import" class="btn btn-primary">Set Result</button>
          </div>
        </div>
      </div>
    </div>

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
    <!-- owlCarousel JS -->
    <script src="assets/extra-libs/owlCarousel/owl.carousel.min.js"></script>

    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- This Page JS -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <script src="assets/libs/ckeditor/samples/js/sample.js"></script>

    <!-- search option in select option start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop:false,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
</body>

</html>