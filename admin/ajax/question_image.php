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

if (isset($_POST['copy_question'])) {
    $total_quetion = $_POST['total_quetion'];

    for ($i=0; $i < $total_quetion + 1; $i++) {
        if (isset($_POST['sfw_id'.$i])) {
            echo $sfw_id = $_POST['sfw_id'.$i] . '<br>';
        }
    }
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