<?php
    require_once '../../init.php';
    $exam = new Exam();
    $common = new Common();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type']) && $_POST['type'] == 'exam_in_batch') {
    	$id = $_POST['id'];

    	$option = '<option selected="">Choose...</option>';
        $all_exam = $common->select("`add_exam`", "`batch_id` = '$id'");
        if ($all_exam) {
            while ($all_exams = mysqli_fetch_assoc($all_exam)) {
                $subject_id = $all_exams['subject_id'];
                // subject info
                $subject_info = $common->select("`subject_add`", "`id` = '$subject_id'");
                $subject_infos = mysqli_fetch_assoc($subject_info);
            $option .= '<option value="' . $all_exams['id'] . '">' . $all_exams['examname'] . ' - ' . $subject_infos['subject_name'] . '</option>';
            }
            echo $option;
        } else {
        	echo '<option selected="">No exam found!</option>';
        }
    }
?>