<?php

require_once '../../init.php';
$exam = new Exam();
$common = new Common();

if(isset($_FILES['upload']['name'])) {
 $file = $_FILES['upload']['tmp_name'];
 $file_name = $_FILES['upload']['name'];
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
 $new_image_name = rand() . '.' . $extension;
 chmod('upload', 0777);
 $allowed_extension = array("jpg", "gif", "png");
 if(in_array($extension, $allowed_extension)) {
  move_uploaded_file($file, '../../upload_file/question/' . $new_image_name);
  $function_number = $_GET['CKEditorFuncNum'];
  $url = 'http://localhost/batbio/upload_file/question/' . $new_image_name;
  $message = '';
  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
 }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['copy_question'])) {
    $total_quetion = $_POST['total_quetion'];

    $question_rows = '';
    $ser = 0;
    for ($i=0; $i < $total_quetion + 1; $i++) {
        if (isset($_POST['sfw_id'.$i])) {
            $ser++;

            $sfw_id = $_POST['sfw_id'.$i];
            $copy_que = $common->select("`questions`", "`id` = '$sfw_id'");
            $copy_ques = mysqli_fetch_assoc($copy_que);

            if($copy_ques['answer'] == 'option_one') {
                $answer_checked1 = 'checked';
                $answer_checked2 = '';
                $answer_checked3 = '';
                $answer_checked4 = '';
            } elseif ($copy_ques['answer'] == 'option_two') {
                $answer_checked1 = '';
                $answer_checked2 = 'checked';
                $answer_checked3 = '';
                $answer_checked4 = '';
            } elseif ($copy_ques['answer'] == 'option_three') {
                $answer_checked1 = '';
                $answer_checked2 = '';
                $answer_checked3 = 'checked';
                $answer_checked4 = '';
            } elseif ($copy_ques['answer'] == 'option_four') {
                $answer_checked1 = '';
                $answer_checked2 = '';
                $answer_checked3 = '';
                $answer_checked4 = 'checked';
            }

            $question_rows .= '<input type="hidden" name="serial'.$ser.'" value="'.$ser.'">
                    <div class="row border-top border-primary pt-4 mb-4">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <div class="form-control bg-white">
                                    <textarea name="question'.$ser.'" class="ck_editor">
                                    '.$copy_ques['question'].'
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_one'.$ser.'" class="ck_editor">
                                    '.$copy_ques['option_one'].'
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer'.$ser.'" value="option_one" '.$answer_checked1.' required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_two'.$ser.'" class="ck_editor">
                                    '.$copy_ques['option_two'].'
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer'.$ser.'" value="option_two" '.$answer_checked2.' required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_three'.$ser.'" class="ck_editor">
                                    '.$copy_ques['option_three'].'
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer'.$ser.'" value="option_three" '.$answer_checked3.' required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="form-control bg-white">
                                    <textarea name="option_four'.$ser.'" class="ck_editor">
                                    '.$copy_ques['option_four'].'
                                    </textarea>
                                </div>
                                <div class="input-group-text">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkbox4" name="answer'.$ser.'" value="option_four" '.$answer_checked4.' required="">
                                        <label class="form-check-label" for="checkbox4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button  data-values="'.$ser.'" type="button" class="btn btn-info btn-sm my-1 copy_description_button_toggle">Add Description</button>
                        </div>
                        <div id="copy_description_'.$ser.'" class="col-12" style="display: none;">
                            <div class="form-control mb-2 bg-white">
                                <textarea name="description'.$ser.'" class="form-control ck_editor" placeholder="Description (optional):">'.$copy_ques['description'].'</textarea>
                            </div>
                        </div>

                    </div>';
        }
    }
    echo $question_rows;
}

if (isset($_POST['read_exam'])) {
    $id = $_POST['id'];

    $all_question = $common->select("`questions`", "`exam_id` = '$id' ORDER BY `serial` ASC");
    if($all_question) {
        $exams_select_result = '';

        $total_quetion = 0;
        while ($row = mysqli_fetch_assoc($all_question)) {
            if($row['answer'] == 'option_one') {
                $option_one = '<img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">';
                $option_two = '';
                $option_three = '';
                $option_four = '';
            }
            if($row['answer'] == 'option_two') {
                $option_one = '';
                $option_two = '<img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">';
                $option_three = '';
                $option_four = '';
            }
            if($row['answer'] == 'option_three') {
                $option_one = '';
                $option_two = '';
                $option_three = '<img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">';
                $option_four = '';
            }
            if($row['answer'] == 'option_four') {
                $option_one = '';
                $option_two = '';
                $option_three = '<img width="25px" height="25px" src="assets/images/img/iconfinder_check.svg">';
                $option_four = '';
            }

            $exams_select_result .= '<div class="quetion mb-3 bg-white py-2 border border-success">
                        <div class="row mx-2">
                            <div class="col-12 d-flex px-0">
                                <div>
                                    <input type="checkbox" name="sfw_id' . $row['serial'] . '" value="' . $row['id'] . '" id="md_checkbox_25' . $row['serial'] . '" class="material-inputs filled-in chk-col-indigo">
                                    <label for="md_checkbox_25' . $row['serial'] . '"></label>
                                </div>
                                <span><b>' . $row['serial'] . '. &nbsp;</b></span>
                                <div>' . $row['question'] . '</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $option_one . '
                                <div class="px-1">a)</div>
                                <div>' . $row['option_one'] . '</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $option_two . '
                                <div class="px-1">b)</div>
                                <div>' . $row['option_two'] . '</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $option_three . '
                                <div class="px-1">c)</div>
                                <div>' . $row['option_three'] . '</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $option_four . '
                                <div class="px-1">d)</div>
                                <div>' . $row['option_four'] . '</div>
                            </div>
                        </div>
                    </div>';
            $total_quetion++;
        }
        echo '<input type="hidden" name="total_quetion" value="'.$total_quetion.'">'. $exams_select_result;
    } else {
        echo '<h4 class="text-center text-danger mb-0">No question found!</h4>';
    }
}

?>