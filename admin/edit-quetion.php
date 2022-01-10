<?php include('inc/header.php'); ?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_all_questions'])) {
        $total_update_questions = $_POST['total_questions'];
        $total_new_questions = $_POST['total_new_questions'];
        $exam_id = $_POST['exam_id'];

        $minus_question = 0;

        for ($i=1; $i <= $total_update_questions; $i++) {
            $type = $_POST['type'.$i];
            $question_id = $_POST['question_id'.$i];
            if($type == 'update') {
                $serial = $_POST['serial'.$i];
                $question = $_POST['question'.$i];

                $option_one = $_POST['option_one'.$i];
                $option_two = $_POST['option_two'.$i];
                $option_three = $_POST['option_three'.$i];
                $option_four = $_POST['option_four'.$i];

                $answer = $_POST['answer'.$i];
                $description = $_POST['description'.$i];

                
                $common->update("`questions`", "`serial` = '$serial', `question` = '$question', `option_one` = '$option_one', `option_two` = '$option_two', `option_three` = '$option_three', `option_four` = '$option_four', `answer` = '$answer', `description` = '$description'", "`id` = '$question_id'");
            } elseif($type == 'delete') {
                $common->delete("`questions`", "`id` = '$question_id'");
                $minus_question++;
            }
        }

        for ($i=1; $i <= $total_new_questions; $i++) {
            $new_serial = $_POST['new_serial'.$i];
            $new_question = $_POST['new_question'.$i];

            $new_option_one = $_POST['new_option_one'.$i];
            $new_option_two = $_POST['new_option_two'.$i];
            $new_option_three = $_POST['new_option_three'.$i];
            $new_option_four = $_POST['new_option_four'.$i];

            $new_answer = $_POST['new_answer'.$i];
            $new_description = $_POST['new_description'.$i];

            
            $common->insert("`questions`(`serial`, `exam_id`, `question`, `option_one`, `option_two`, `option_three`, `option_four`, `answer`, `description`)", "('$new_serial', '$exam_id', '$new_question', '$new_option_one', '$new_option_two', '$new_option_three', '$new_option_four', '$new_answer', '$new_description')");
        }

        $final_total_question = $total_update_questions + $total_new_questions - $minus_question;
        $common->update("`add_exam`", "`tquetion` = '$final_total_question'", "`id` = '$exam_id'");
    }

?>

<?php
    if(isset($_GET['editque'])){
        $id = $_GET['editque'];
        $all_question = $exam->AllQuestion($id);
    }
    $all_xm = $exam->ExamById($id);
    if($all_xm) {
        $xmbyid = $all_xm->fetch_assoc();
        $sub_id = $xmbyid['subject_id'];
        
        $sub_query = $common->select("`subject_add`","`id`='$sub_id'");
        $sub_name = mysqli_fetch_assoc($sub_query);
        $total = $xmbyid['tquetion'];
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
                                <button type="submit" name="update_all_questions" class="btn btn-info rounded-pill px-4 waves-effect waves-light">Save</button>
                                <a href="add-exam.php" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">Cancel</a>
                            </div>
                        </div>
                     </div>
                </div>
                <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
                  
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Exam Name</th>
                        <th>Subject Name</th>
                        <th>Duration</th>
                        <th>Question</th>
                    </tr>
                    <tr>
                        <td><?=$xmbyid['examname'];?></td>
                        <td><?=$sub_name['subject_name'];?></td> 
                        <td><?=$xmbyid['duration'];?></td> 
                        <td><?=$xmbyid['tquetion'];?></td>   
                    </tr>
                </table>
                <input type="hidden" name="exam_id" value="<?= $xmbyid['id']; ?>">
                <input type="hidden" id="total_questions" name="total_questions" value="<?=$xmbyid['tquetion'];?>">
                <input type="hidden" id="total_new_questions" name="total_new_questions" value="0">
                <div id="all_update_questions">
                <?php
                    if($all_question){
                        $i = 1;
                        while($values = $all_question->fetch_assoc()) {
                            // exam_in_result check
                            $exam_id = $xmbyid['id'];
                            $exam_in_result = $common->select("`results`", "`exam_id` = '$exam_id'");
                    ?>      
                    <input type="hidden" name="question_id<?= $i; ?>" value="<?=$values['id'];?>">
                    <input type="hidden" id="type<?= $values['id']; ?>" name="type<?= $i; ?>" value="update">
                    <div class="row border-top border-primary pt-4 delete_row<?= $values['id']; ?>">
                        <input type="hidden" id="delete_serial<?= $values['id']; ?>" name="serial<?= $i; ?>" class="set_serial" value="<?= $i; ?>">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <div class="form-control bg-white">
                                    <textarea name="question<?= $i; ?>" class="ck_editor">
                                        <?= $values['question']; ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_one<?= $i; ?>" class="ck_editor">
                                        <?= $values['option_one']; ?>
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer<?= $i; ?>" value="option_one"<?php echo ($values['answer']== 'option_one') ?  "checked" : "" ;  ?> required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_two<?= $i; ?>" class="ck_editor">
                                        <?= $values['option_two']; ?>
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer<?= $i; ?>" value="option_two"<?php echo ($values['answer']== 'option_two') ?  "checked" : "" ;  ?> required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_three<?= $i; ?>" class="ck_editor">
                                        <?= $values['option_three']; ?>
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer<?= $i; ?>" value="option_three"<?php echo ($values['answer']== 'option_three') ?  "checked" : "" ;  ?> required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_four<?= $i; ?>" class="ck_editor">
                                        <?= $values['option_four']; ?>
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                    
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer<?= $i; ?>" value="option_four"<?php echo ($values['answer']== 'option_four') ?  "checked" : "" ;  ?> required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button  data-value="<?= $i; ?>" type="button" class="btn btn-info btn-sm my-1 description_button_toggle">Add Description</button>
                        </div>
                        <div id="description_<?= $i; ?>" class="col-12" style="display: none;">
                            <div class="form-control mb-2 bg-white">
                                <textarea name="description<?= $i; ?>" class="form-control ck_editor" placeholder="Description (optional):"></textarea>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(!$exam_in_result) {
                    ?>
                    <button type="button" onclick="deleteRow(<?=$values['id']?>)"  class="btn btn-danger btn-sm mb-4 float-end delete_row<?= $values['id']; ?>">
                        <i data-feather="trash-2" class="feather-sm fill-white"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm mb-4 float-start addMoreQuestion delete_row<?= $values['id']; ?>">
                        <i class="fa fa-plus-square"></i>
                    </button>
                    <div class="clearfix"></div>
                    <?php
                    } else {
                    ?>
                    <div class="mb-4"></div>
                    <?php
                    }
                    ?>
                    <?php
                    $i++;
                     }
                }
                ?>
                </div>
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
    <!-- -------------------------------------------------------------- -->
    <!-- All Jquery -->
    <!-- -------------------------------------------------------------- -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
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
    <script src="js/custom.js"></script>
    <script src="highlights/highlight.min.js"></script>

    <!-- This Page JS -->
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <script src="assets/libs/ckeditor/samples/js/sample.js"></script>
    <script>
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
            $(document).on('click','.new_description_button_toggle', function(){
                var id = $(this).data('values');
                $("#new_description_" + id).toggle();
            });
        });
    </script>

<script>
    hljs.initHighlightingOnLoad();

    $('.addMoreQuestion').click(function () {
        
        var total_new_questions = $('#total_new_questions').val();
        var i = parseInt(total_new_questions) + parseInt(1);

        $('#total_new_questions').val(i)

        var new_item = '<div class="row border-top border-primary pt-4 mb-4"> <input type="hidden" name="new_serial'+ i +'" class="set_serial"> <div class="col-12"> <div class="input-group mb-2"> <div class="form-control bg-white"> <textarea name="new_question'+ i +'" class="new_ck_editor'+ i +'"></textarea> </div> </div> </div> <div class="col-lg-3"> <div class="input-group"> <div class="form-control bg-white"> <textarea name="new_option_one'+ i +'" class="new_ck_editor'+ i +'"></textarea> </div> <div class="input-group-text"> <div class="form-check"> <input type="radio" class="form-check-input" id="checkbox4" name="new_answer'+ i +'" value="option_one" required=""> <label class="form-check-label" for="checkbox4"></label> </div> </div> </div> </div> <div class="col-lg-3"> <div class="input-group"> <div class="form-control bg-white"> <textarea name="new_option_two'+ i +'" class="new_ck_editor'+ i +'"></textarea> </div> <div class="input-group-text">  <div class="form-check"> <input type="radio" class="form-check-input" id="checkbox4" name="new_answer'+ i +'" value="option_two" required=""> <label class="form-check-label" for="checkbox4"></label> </div> </div> </div> </div> <div class="col-lg-3"> <div class="input-group"> <div class="form-control bg-white"> <textarea name="new_option_three'+ i +'" class="new_ck_editor'+ i +'"></textarea> </div> <div class="input-group-text"> <div class="form-check"> <input type="radio" class="form-check-input" id="checkbox4" name="new_answer'+ i +'" value="option_three" required=""> <label class="form-check-label" for="checkbox4"></label> </div> </div> </div> </div> <div class="col-lg-3"> <div class="input-group"> <div class="form-control bg-white"> <textarea name="new_option_four'+ i +'" class="new_ck_editor'+ i +'"></textarea> </div> <div class="input-group-text"> <div class="form-check"> <input type="radio" class="form-check-input" id="checkbox4" name="new_answer'+ i +'" value="option_four" required=""> <label class="form-check-label" for="checkbox4"></label> </div> </div> </div> </div> <div class="col-12"> <button  data-values="'+ i +'" type="button" class="btn btn-info btn-sm my-1 new_description_button_toggle">Add Description</button> </div> <div id="new_description_'+ i +'" class="col-12" style="display: none;"> <div class="form-control mb-2 bg-white"> <textarea name="new_description'+ i +'" class="form-control new_ck_editor'+ i +'" placeholder="Description (optional):"></textarea> </div> </div> </div>';


        $(this).next("div").after(new_item);

        $(".set_serial").each(function(index, el) {
            $(this).val(index+1);
        });

        $(".new_ck_editor" + i).each(function() {
            CKEDITOR.inline(this, {
                extraPlugins: 'ckeditor_wiris',
                filebrowserUploadUrl: "ajax/question_image.php",
                filebrowserUploadMethod:"form"
            });
        });
        
    });
    function deleteRow(id){
        $(".delete_row" + id).hide();
        $("#type" + id).val('delete');
        $('#delete_serial' + id).remove();
        $(".set_serial").each(function(index, el) {
            $(this).val(index+1);
        });
    }
</script>

</body>

</html>