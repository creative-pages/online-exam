<?php include_once('inc/header.php'); ?>
<?php
if (isset($_GET['result']) && $_GET['result'] != '' && is_numeric($_GET['result'])) {
    $result_id = $_GET['result'];
    $result_info = $common->select("`results`", "`id` = '$result_id'");
    if ($result_info) {
        $result_infos = mysqli_fetch_assoc($result_info);
        $all_question = explode(",", $result_infos['question_ans']);
        $total_question = count($all_question);
        // exam info
        $exam_id = $result_infos['exam_id'];
        $exam_info = $common->select("`add_exam`", "`id` = '$exam_id'");
        $exam_infos = mysqli_fetch_assoc($exam_info);
        // subject info
        $subject_id = $exam_infos['subject_id'];
        $subject_info = $common->select("`subject_add`", "`id` = '$subject_id'");
        $subject_infos = mysqli_fetch_assoc($subject_info);

        // question loop start
        $result_overview = '';
        $sl_no = 1;
        foreach ($all_question as $values) {
            $values = explode('=', $values);
            $key = $values[0];
            $value = $values[1];
            if ($result_infos['total_time'] == 'offline') {
                $que_info = $common->select("`questions`", "`exam_id` = '$exam_id' && `serial` = '$key'");
            } else {
                $que_info = $common->select("`questions`", "`exam_id` = '$exam_id' && `id` = '$key'");
            }
            $que_infos = mysqli_fetch_assoc($que_info);
            $correct_option1 = '';
            $correct_option2 = '';
            $correct_option3 = '';
            $correct_option4 = '';
            $wrong_answer1 = '';
            $wrong_answer2 = '';
            $wrong_answer3 = '';
            $wrong_answer4 = '';
            if ($que_infos['answer'] == 'option_one') {
                $correct_option1 = '<img width="25px" height="25px" src="../admin/assets/images/img/iconfinder_check.svg">';
            } elseif ($que_infos['answer'] == 'option_two') {
                $correct_option2 = '<img width="25px" height="25px" src="../admin/assets/images/img/iconfinder_check.svg">';
            } elseif ($que_infos['answer'] == 'option_three') {
                $correct_option3 = '<img width="25px" height="25px" src="../admin/assets/images/img/iconfinder_check.svg">';
            } elseif ($que_infos['answer'] == 'option_four') {
                $correct_option4 = '<img width="25px" height="25px" src="../admin/assets/images/img/iconfinder_check.svg">';
            }
            if ($value == '') {
                $border_type = 'dark';
            } elseif ($que_infos['answer'] == $value) {
                $border_type = 'success';
            } elseif ($que_infos['answer'] != $value) {
                $border_type = 'danger';
                if ($value == 'option_one') {
                    $wrong_answer1 = '<img width="25px" height="25px" src="../admin/assets/images/iconfinder_wrong.jpg">';
                } elseif ($value == 'option_two') {
                    $wrong_answer2 = '<img width="25px" height="25px" src="../admin/assets/images/iconfinder_wrong.jpg">';
                } elseif ($value == 'option_three') {
                    $wrong_answer3 = '<img width="25px" height="25px" src="../admin/assets/images/iconfinder_wrong.jpg">';
                } elseif ($value == 'option_four') {
                    $wrong_answer4 = '<img width="25px" height="25px" src="../admin/assets/images/iconfinder_wrong.jpg">';
                }
            }

            $result_overview .= '<div class="quetion mb-2 bg-white py-2 border border-' . $border_type . '" style="border-width: 3px!important;">
                        <div class="row mx-2">
                            <div class="col-12 d-flex">
                                <span><b>' . $sl_no . '. &nbsp;</b></span>
                                <div>' . $que_infos['question'] . '</div>
                            </div>
                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $wrong_answer1 . $correct_option1 . '
                                <div class="px-1">a)</div>
                                <div>' . $que_infos['option_one'] . '</div>
                            </div>
                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $wrong_answer2 . $correct_option2 . '
                                <div class="px-1">b)</div>
                                <div>' . $que_infos['option_two'] . '</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $wrong_answer3 . $correct_option3 . '
                                <div class="px-1">c)</div>
                                <div>' . $que_infos['option_three'] . '</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                                ' . $wrong_answer4 . $correct_option4 . '
                                <div class="px-1">d)</div>
                                <div>' . $que_infos['option_four'] . '</div>
                            </div>
                        </div>
                    </div>';
            $sl_no++;
        }
        // question loop end
    } else {
        header("Location: result.php");
    }
} else {
    header("Location: result.php");
}
?>
<div class="container-fluid">
    <div class="row">
        <?php include_once('inc/profile_info.php'); ?>
        <div class="col-lg-8 order-lg-1">
            <h2>Exam Result</h2>
            <div class="card">
                <div class="card-body">
                    <div class="main bg-white mb-2 py-2">
                        <div class="examheader text-center mt-2">
                            <h2 class="text-uppercase"><?= $exam_infos['examname']; ?></h2>
                            <h3 class="text-capitalize mb-3">Subject: <?= $subject_infos['subject_name']; ?></h3>
                        </div>
                        <div class="row mx-1">
                            <div class="col-4">
                                <h3 class="text-muted">Time: <?= ucfirst($result_infos['total_time']); ?></h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Quetion: <?= $total_question; ?></h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Date: <?= date("d-M-y", strtotime($result_infos['add_time'])); ?></h3>
                            </div>
                        </div>
                        <table class="table table-bordered mt-2 mb-0">
                            <tr>
                                <th>Right</th>
                                <th>Wrong</th>
                                <th>Blank</th>
                                <th>Final Score</th>
                            </tr>
                            <tr>
                                <td><?= $result_infos['rightans']; ?></td>
                                <td><?= $result_infos['wrongans']; ?></td>
                                <td><?= $result_infos['blankans']; ?></td>
                                <td><?= $result_infos['final_score']; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <?= $result_overview; ?>
                </div>
            </div>
        </div>
    </div> 
</div>

<?php include_once('inc/footer.php'); ?>