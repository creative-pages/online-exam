<?php
    require_once '../../init.php';
    $exam = new Exam();
    $common = new Common();
    $format = new Format();

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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type']) && $_POST['type'] == 'select_exam') {
        $id = $format->validation($_POST['id']);

        $option = '<option value="">Choose exam</option>';
        $all_exam = $common->select("`add_exam`", "`batch_id` = '$id'");
        if ($all_exam) {
            while ($all_exams = mysqli_fetch_assoc($all_exam)) {
            $option .= '<option value="' . $all_exams['id'] . '">' . ucfirst($all_exams['examname']) . '</option>';
            }
            echo $option;
        } else {
            echo $option;
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type']) && $_POST['type'] == 'select_results') {
        $student_id = Session::get('profileid');
        $exam_id = $format->validation($_POST['exam_id']);
        // exam information
        $exam_info = $common->select("`add_exam`", "`id` = '$exam_id'");
        $exam_infos = mysqli_fetch_assoc($exam_info);

        $student_results = '<h4>Exam Name: ' . ucfirst($exam_infos['examname']) . '<h4>';
        $all_result = $common->select("`results`", "`exam_id` = '$exam_id' && `student_id` = '$student_id' ORDER BY `id` DESC");
        if ($all_result) {
            while ($all_results = mysqli_fetch_assoc($all_result)) {
            $student_results .= '<a class="btn btn-primary w-100 mb-2" href="result-view.php?result=' . $all_results['id'] . '">' . date("d-M-y h:ia", strtotime($all_results['add_time'])) . '</a>';
            }
            echo $student_results;
        } else {
            echo '<h4 class="text-danger mb-0">No results found in this exam!</h4>';
        }
    }
?>