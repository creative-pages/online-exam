<?php
    require_once '../../init.php';
    $common = new Common();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_detail']) && $_POST['user_detail'] == 'user_detail'){
        $id = $_POST['id'];
        $exam_detail = $common->select("`users`", "`id` = '$id'");
        if ($exam_detail) {
            $exam_details = mysqli_fetch_assoc($exam_detail);
            echo json_encode($exam_details);
        }
    }
?>