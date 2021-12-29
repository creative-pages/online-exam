<?php include('inc/header.php'); ?>

<?php
    $add_question = $common->select("`add_exam`", "`status` = '0' ORDER BY `id` DESC LIMIT 1");
    if($add_question) {
        $add_questions = mysqli_fetch_assoc($add_question);
        $sub_id = $add_questions['subject_id'];
        $sub_query = $common->select("`subject_add`","`id`='$sub_id'");
        $sub_name = mysqli_fetch_assoc($sub_query);
        $total_questions = $add_questions['tquetion'] + 1;
    } else {
        header("Location: add-exam.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_all_questions'])) {
        $total_add_questions = $_POST['total_questions'];
        $exam_id = $_POST['exam_id'];
        
            
        for ($i=1; $i < $total_add_questions + 1; $i++) {
            $serial = $_POST['serial'.$i];
            $question = $_POST['question'.$i];
            
            $option_one = $_POST['option_one'.$i];
            $option_two = $_POST['option_two'.$i];
            $option_three = $_POST['option_three'.$i];
            $option_four = $_POST['option_four'.$i];

            $answer = $_POST['answer'.$i];
            $description = $_POST['description'.$i];

            $common->insert("`questions`(`serial`, `exam_id`, `question`, `option_one`, `option_two`, `option_three`, `option_four`, `answer`, `description`)", "('$serial', '$exam_id', '$question', '$option_one', '$option_two', '$option_three', '$option_four', '$answer', '$description')");
        }
        $success = $common->update("`add_exam`", "`tquetion` = '$total_add_questions', `status` = '1'", "`id` = '$exam_id'");
        if($success){
            header("Location:add-exam.php");
        }
    }
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['csv_file_import'])) {
  // (B) READ UPLOADED CSV
  $fh = fopen($_FILES["upcsv"]["tmp_name"], "r");
  if ($fh === false) { exit("Failed to open uploaded CSV file"); }

  // (C) IMPORT ROW BY ROW
  $new_import_test = '';
  $ser = 1;

  $end_code = 0;

  $option_ser = 1;
  while (($row = fgetcsv($fh)) !== false) {
    if ($row[0] != 'HTML') {
        if ($row[0] == '*' || $row[0] == '') {
            $end_code++;
            if($end_code == 1) {
                $dynamic_options = 'option_one';
            } elseif ($end_code == 2) {
                $dynamic_options = 'option_two';
            } elseif ($end_code == 3) {
                $dynamic_options = 'option_three';
            } elseif ($end_code == 4) {
                $dynamic_options = 'option_four';
            }

            if ($row[0] == '*') {
                $new_import_test .= '<div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="'.$dynamic_options.$option_ser.'" class="ck_editor">
                                    '.$row[1].'
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer'.$option_ser.'" value="'.$dynamic_options.'" checked required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>';
            } else {
                $new_import_test .= '<div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="'.$dynamic_options.$option_ser.'" class="ck_editor">
                                    '.$row[1].'
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer'.$option_ser.'" value="'.$dynamic_options.'" required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }

            if($end_code == 4) {
                $option_ser++;

                $end_code = 0;
                $new_import_test .= '<div class="col-12">
                            <button  data-value="'.$ser.'" type="button" class="btn btn-info btn-sm my-1 description_button_toggle">Add Description</button>
                        </div>
                        <div id="description_'.$ser.'" class="col-12" style="display: none;">
                            <div class="form-control mb-2 bg-white">
                                <textarea name="description'.$ser.'" class="form-control ck_editor" placeholder="Description (optional):"></textarea>
                            </div>
                        </div>

                    </div>';
            }

        } else {
            $new_import_test .= '<input type="hidden" name="serial'.$ser.'" value="'.$ser.'">
                    <div class="row border-top border-primary pt-4 mb-4">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <div class="form-control bg-white">
                                    <textarea name="question'.$ser.'" class="ck_editor">
                                    '.$row[0].'
                                    </textarea>
                                </div>
                            </div>
                        </div>';
            $ser++;
        }
    }
  }
  fclose($fh);
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
                <form action="" method="post">
                <div class="p-3 border-buttom">
                    <div class="d-md-flex align-items-center">
                        <div class="action-form">
                            <div class="text-center">
                                <button type="submit" name="add_all_questions" class="btn btn-info rounded-pill px-4 waves-effect waves-light">Save</button>
                                <button type="reset" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">Cancel</button>
                            </div>
                        </div>
                        <div class="ms-auto">
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] != "POST" && !isset($_POST['csv_file_import'])) {
                            ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enter_input_question">
                              <i data-feather="download" class="feather-sm fill-white me-1"></i>
                                Enter input question
                            </button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#copy_other_button">
                              <i data-feather="download" class="feather-sm fill-white me-1"></i>
                                Copy Form Other Exam
                            </button>
                            <!-- Button trigger modal -->
                            <button id="after_copy_dnone" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#import_csv_button">
                              <i data-feather="download" class="feather-sm fill-white me-1"></i>
                                Import CSV
                            </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
                  
                </div>
                <table class="table table-bordered border-success">
                    <tr>
                        <th>Exam Name</th>
                        <th>Subject Name</th>
                        <th>Duration</th>
                        <th>Question</th>
                    </tr>
                    <tr>
                        <td><?= $add_questions['examname']; ?></td>
                        <td><?= $sub_name['subject_name']; ?></td>
                        <td><?= $add_questions['duration']; ?></td>
                        <td id="total_questions"><?= isset($ser) ? $ser - 1 : 0; ?></td>
                    </tr>
                </table>
                <input type="hidden" name="exam_id" value="<?= $add_questions['id']; ?>">
                <input type="hidden" name="total_questions" value="<?= isset($ser) ? $ser -1 : 0; ?>">

                <?php
                    if (isset($new_import_test)) {
                        echo $new_import_test;
                    }
                ?>
                <div id="exams_copy_result"></div>
                </form>
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
    <div class="modal fade" id="import_csv_button" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Choose CSV File Only</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" id="csv_file_import" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <input class="form-control" type="file" name="upcsv" accept=".csv" required="">
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="csv_file_import" form="csv_file_import" class="btn btn-primary">Set Question</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="copy_other_button" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header flex-column">
            <div class="d-flex align-items-center w-100 border-bottom pb-1">
                <h4 class="modal-title text-primary" id="staticBackdropLabel">
                    Copy From Other Exam
                </h4>
                <div>
                    &nbsp;&nbsp;&nbsp;
                    Total Selected - <span id="selected_question">0</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <br>
            <select id="exams_select" style="width: 100%;">
                <option selected="">Choose...</option>
                <?php
                $all_exam = $common->select("`add_exam`", "`status` = '1'");
                if ($all_exam) {
                    while ($all_exams = mysqli_fetch_assoc($all_exam)) {
                    ?>
                    <option value="<?= $all_exams['id']; ?>"><?= $all_exams['examname'] . ' - ' . $all_exams['subjectname']; ?></option>
                    <?php
                    }
                }
                ?>
            </select>
          </div>
          <div class="modal-body border-top border-bottom">
            <form id="exams_copy_form">
                <input type="hidden" name="copy_question" value="copy_question">
                <input type="hidden" id="serial_set_copy" name="serial_set_copy" value="0">
                <input type="hidden" id="copy_input_step" name="copy_input_step" value="0">
                <div id="exams_select_result">
                    <h4 class="text-center text-danger my-5">Select Exam First!</h4>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="exams_copies();" id="exams_copy" form="exams_copy_form" class="btn btn-primary" disabled="">Copy</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="enter_input_question" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Enter input question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body border-top border-bottom">
            <!-- <input type="hidden" name="copy_question" value="copy_question"> -->
            <input type="number" class="form-control" id="input_question_number" placeholder="Enter total question">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="input_question();" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modals end -->

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

    <!-- This Page JS -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <script src="assets/libs/ckeditor/samples/js/sample.js"></script>

    <!-- search option in select option start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- search option in select option end -->

    <script>
        $('#exams_select').select2();
        CKEDITOR.plugins.addExternal('ckeditor_wiris', 'https://www.wiris.net/demo/plugins/ckeditor/', 'plugin.js');
        $(".ck_editor").each(function() {
            CKEDITOR.inline(this, {
                extraPlugins: 'ckeditor_wiris',
                filebrowserUploadUrl: "ajax/question_image.php",
                filebrowserUploadMethod:"form"
            });
        });

        $(document).ready(function(){
            $(".description_button_toggle").click(function(){
                var id = $(this).data('value');
                $("#description_" + id).toggle();
            });
            $(document).on('click','.copy_description_button_toggle', function(){
                var id = $(this).data('values');
                $("#copy_description_" + id).toggle();
            });
        });
        $('#exams_select').on('change', function() {
            var id = $(this).val();

            if (id !== 'Choose...') {
                $.ajax({
                    url: 'ajax/question_image.php',
                    type: 'POST',
                    data: {id:id, read_exam:'read_exam'},
                    success:function(data) {
                        $('#exams_select_result').html(data);
                        $('#exams_copy').attr("disabled",false);
                    }
                });
            } else {
                $('#exams_select_result').html('<h4 class="text-center text-danger my-5">Select Exam First!</h4>');
                $('#exams_copy').attr("disabled","disabled");
                $('#selected_question').text('0');
            }
        });
        
        $(document).on('change','#select_all_question', function(){
            if($(this).prop("checked") == true){
                $('.select_all_question').prop("checked", true);
                $('#selected_question').text($('.select_all_question').length);
            } else if($(this).prop("checked") == false){
                $('.select_all_question').prop("checked", false);
                $('#selected_question').text('0');
            }
        });

        function exams_copies() {
           $.ajax({
                url: 'ajax/question_image.php',
                type: 'POST',
                data: $("#exams_copy_form").serialize(),
                success:function(data) {
                    $('#exams_copy_result').append(data);
                    $('#exams_select_result').html('<h4 class="text-center text-danger mb-0">Select Exam First!</h4>');

                    var copy_input_step = $('#copy_input_step').val();
                    $(".ck_editor" + copy_input_step).each(function() {
                        CKEDITOR.inline(this, {
                            extraPlugins: 'ckeditor_wiris',
                            filebrowserUploadUrl: "ajax/question_image.php",
                            filebrowserUploadMethod:"form"
                        });
                    });
                    $('#copy_input_step').val(parseInt(copy_input_step) + parseInt(1));

                    var i = 1;
                    while ($("[name='serial"+i+"']").length) {
                        i++;
                    }
                    $("[name='total_questions']").val(i - parseInt(1));
                    $("#total_questions").text(i - parseInt(1));
                    $('#serial_set_copy').val(i - parseInt(1));

                    $('#after_copy_dnone').hide();

                    $("#copy_other_button").modal('hide');
                    $('#exams_copy').attr("disabled","disabled");
                }
            });
        }
        function input_question() {
            if($('#input_question_number').val()) {
                var input_question_number = $('#input_question_number').val();
                var serial_set_copy = $('#serial_set_copy').val();
                var copy_input_step = $('#copy_input_step').val();

               $.ajax({
                    url: 'ajax/question_image.php',
                    type: 'POST',
                    data: {serial_set_copy:serial_set_copy, copy_input_step:copy_input_step, input_question_number:input_question_number, input_question:'input_question'},
                    success:function(data) {
                        $('#exams_copy_result').append(data);
                        $('#input_question_number').val('')

                        var copy_input_step = $('#copy_input_step').val();
                        $(".ck_editor" + copy_input_step).each(function() {
                            CKEDITOR.inline(this, {
                                extraPlugins: 'ckeditor_wiris',
                                filebrowserUploadUrl: "ajax/question_image.php",
                                filebrowserUploadMethod:"form"
                            });
                        });
                        $('#copy_input_step').val(parseInt(copy_input_step) + parseInt(1));

                        var i = 1;
                        while ($("[name='serial"+i+"']").length) {
                            i++;
                        }
                        $("[name='total_questions']").val(i - parseInt(1));
                        $("#total_questions").text(i - parseInt(1));
                        $('#serial_set_copy').val(i - parseInt(1));

                        $('#after_copy_dnone').hide();

                        $("#enter_input_question").modal('hide');
                    }
                });
            } else {
                alert('Field is required!');
            }
        }

        function copyCount() {
            var i = 1;
            var ti = 1;
            while ($("[name='sfw_id"+i+"']").length) {
                if ($("[name='sfw_id"+i+"']:checked").length) {
                    $("#selected_question").text(ti);
                    ti++;
                }
                i++;
            }
        }
    </script>
</body>

</html>