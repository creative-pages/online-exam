<?php
    require_once '../../init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['single_page_result_check'])){
        $q_id = $_POST['q_id'];
        $ans = $_POST['ans'];

        // storing id and ans for reloading problem
        if(!isset($_SESSION['reload_session_result'])){
            $_SESSION['reload_session_result'] = array();
        }

        $_SESSION['reload_session_result'][$q_id] = $ans;

        $result_check = $common->select('`questions`', "`id` = '$q_id'");
        $result_checks = mysqli_fetch_assoc($result_check);

        if ($result_checks['answer'] == $ans) {
            echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg"> Right';
        } else {
            $cor_ans = $result_checks[$result_checks['answer']];
            echo '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg"> Wrong <br> <div class="d-flex mt-2"><img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">&nbsp; ' . $cor_ans . '</div>';
        }
    }

    // exam information
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['exam_detail']) && $_POST['exam_detail'] == 'exam_detail'){
        $id = $_POST['id'];

        $exam_detail = $common->select("`add_exam`", "`id` = '$id'");
        if ($exam_detail) {
            $exam_details = mysqli_fetch_assoc($exam_detail);
            echo json_encode($exam_details);
        }
    }

?>