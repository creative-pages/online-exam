<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $exam_id = $_POST['xmid']
        $process=$exam->ExamProcess($_POST,$exam_id);

    }

?>