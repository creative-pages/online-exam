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

        // omr check
        $omr_check = $common->select("`omr_upload`", "`student_id` = '$student_id' && `exam_id` = '$exam_id'");

        // omr upload start
        $exam_publish_info = $common->select("`publish_exam`", "`exam_id` = '$exam_id'");
        if ($exam_publish_info && !$omr_check) {
            $exam_publish_infos = mysqli_fetch_assoc($exam_publish_info);
            if($exam_publish_infos['omr_upload'] == 'yes') {
                $omr_upload_form = '<form action="" method="POST" enctype="multipart/form-data">
                            <h4 class="mt-4">Please upload your OMR file <sup class="text-danger">*</sup></h4>
                            <input type="hidden" name="exam_id" value="' . $exam_id . '" required="">
                            <div class="input-group mb-3">
                              <input class="form-control" type="file" id="omr_upload" name="omr_upload" accept=".jpg, .jpeg, .png" required="">
                              <button class="btn btn-primary" type="submit" name="omr_upload_submit">Submit</button>
                            </div>
                        </form>';
            } else {
                $omr_upload_form = '';
            }
        } else {
            $omr_upload_form = '';
        }
        // omr upload end

        $student_results = '<h4>Exam Name: ' . ucfirst($exam_infos['examname']) . '<h4>';
        $all_result = $common->select("`results`", "`exam_id` = '$exam_id' && `student_id` = '$student_id' ORDER BY `id` DESC");
        if ($all_result) {
            while ($all_results = mysqli_fetch_assoc($all_result)) {
            $student_results .= '<a class="btn btn-primary w-100 mb-2" href="result-view.php?result=' . $all_results['id'] . '">' . date("d-M-y h:ia", strtotime($all_results['add_time'])) . '</a>';
            }
            echo $student_results;
        } else {
            echo '<h4 class="text-danger mb-0">No results found in this exam!</h4>' . $omr_upload_form;
        }
    }
?>