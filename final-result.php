<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
    date_default_timezone_set('Asia/Dhaka');
    $cur_date = date('d-m-y');
?>
<?php
    if(!isset($_SESSION['start_exam_time'])) {
        header("Location: start-exam.php?xmid=" . $_GET['xmid']);
    }
    // student info
    $student_id = Session::get("profileid");
    $student_info = $common->select("`student_table`", "`id` = '$student_id'");
    $student_infos = mysqli_fetch_assoc($student_info);

    if(isset($_GET['xmid'])){
        $id = $_GET['xmid'];
        $query = $common->select("`add_exam`","`id`='$id'");
        $exam = mysqli_fetch_assoc($query);
        $subject_id = $exam['subject_id'];
        // subject info
        $subject_info = $common->select("`subject_add`", "`id` = '$subject_id'");
        $subject_infos = mysqli_fetch_assoc($subject_info);
        // publish_exam info
        $publish_exam_info = $common->select("`publish_exam`","`exam_id` = '$id'");
        $publish_exam_infos = mysqli_fetch_assoc($publish_exam_info);
    }


    $exam_id = Session::get('exmid');
    $nagetive_mark = $common->select("`publish_exam`","`exam_id` = '$exam_id' && `other` LIKE '%negative%'");

    // negative marking
    if ($nagetive_mark) {
        $nagetive_marks = mysqli_fetch_assoc($nagetive_mark);
        $negative_percent =  $nagetive_marks['negative_mark'] * 0.01;
        $right_answer_final = $_SESSION['score'] - ($_SESSION['wrong'] * $negative_percent);
    } else {
        $right_answer_final = isset($_SESSION['score']) ? $_SESSION['score'] : '0';
    }
?>

<DOCTYPE html>
  <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    <link href="admin/dist/css/style.min.css" rel="stylesheet">
    </head>
    <style>
        body{
        background:url(image/start.jpg) repeat fixed 0 0 #000;position: relative;
        }
        @media print {    
            .no_print {
                display: none!important;
            }
        }
    </style>
    <body>
            <div class="container-fluid">
                <div class="quetion" style="width: 700px;margin:0px auto;">
                    <div class="main bg-white" style="margin-top: 30px;">
                        <div class="examheader text-center mt-2">
                            <h3 class='text-capitalize pt-2' style="margin-top:-23px;"><?=$exam['examname'];?></h3>
                            <h3>Subject: <?= $subject_infos['subject_name']; ?></h3>
                        </div>
                        <div class="row mx-1">
                            <div class="col-4">
                                <h3 class="text-muted">Your Score: <?= $publish_exam_infos['display_question']; ?>/<?php
                                    echo $right_answer_final;
                                ?>
                                </h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Wrong Score:
                                <?php
                                    echo $_SESSION['wrong'];
                                ?>

                                </h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Date: <?=$cur_date;?></h3>
                            </div>
                        </div>  
                        
                    </div>

                    <div class="bg-white p-3 mt-3">
                    <?php
                    $question_ans = '';
                    $not_answered = 0;
                    $limit = $publish_exam_infos['display_question'];

                    $all_question = $common->select("`questions`", "`exam_id` = '$id' ORDER BY `serial` ASC LIMIT $limit");

                    while ($all_questions = mysqli_fetch_assoc($all_question)) {
                        if (isset($_SESSION['exam_sheet'][$all_questions['id']]) && $_SESSION['exam_sheet'][$all_questions['id']] != '') {
                            if ($all_questions['answer'] == $_SESSION['exam_sheet'][$all_questions['id']]) {
                                ?>
                                <div class="quetion mb-2 bg-white py-2 border border-success" style="border-width: 3px!important;">
                                    <div class="row mx-2">
                                        <div class="col-12 d-flex">
                                            <span><b><?= $all_questions['serial'] ?>. &nbsp;</b></span>
                                            <div><?= $all_questions['question'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">
                                            
                                            <?php
                                            if ($all_questions['answer'] == 'option_one') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            ?>
                                            
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_one'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">

                                            <?php
                                            if ($all_questions['answer'] == 'option_two') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            ?>
                                          
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_two'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">

                                            <?php
                                            if ($all_questions['answer'] == 'option_three') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            ?>
                                            
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_three'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">

                                            <?php
                                            if ($all_questions['answer'] == 'option_four') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            ?>
                                           
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_four'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="quetion mb-2 bg-white py-2 border border-danger" style="border-width: 3px!important;">
                                    <div class="row mx-2">
                                        <div class="col-12 d-flex">
                                            <span><b><?= $all_questions['serial'] ?>. &nbsp;</b></span>
                                            <div><?= $all_questions['question'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">
                                            
                                            <?php
                                            if ($all_questions['answer'] == 'option_one') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            if ($_SESSION['exam_sheet'][$all_questions['id']] == 'option_one') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                                            }
                                            ?>
                                            
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_one'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">

                                            <?php
                                            if ($all_questions['answer'] == 'option_two') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            if ($_SESSION['exam_sheet'][$all_questions['id']] == 'option_two') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                                            }
                                            ?>
                                          
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_two'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">

                                            <?php
                                            if ($all_questions['answer'] == 'option_three') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            if ($_SESSION['exam_sheet'][$all_questions['id']] == 'option_three') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                                            }
                                            ?>
                                            
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_three'] ?></div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3 d-flex">

                                            <?php
                                            if ($all_questions['answer'] == 'option_four') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                            }
                                            if ($_SESSION['exam_sheet'][$all_questions['id']] == 'option_four') {
                                                echo '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                                            }
                                            ?>
                                           
                                            <div>&nbsp; a) &nbsp;</div>
                                            <div><?= $all_questions['option_four'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            $question_ans .= $all_questions['id'] . '=' . $_SESSION['exam_sheet'][$all_questions['id']] . ',';
                        } else {
                            $not_answered++;
                        ?>
                        <div class="quetion mb-2 bg-white py-2 border border-dark" style="border-width: 3px!important;">
                            <div class="row mx-2">
                                <div class="col-12 d-flex">
                                    <span><b><?= $all_questions['serial'] ?>. &nbsp;</b></span>
                                    <div><?= $all_questions['question'] ?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">
                                    
                                    <?php
                                    if ($all_questions['answer'] == 'option_one') {
                                        echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                    }
                                    ?>
                                    
                                    <div>&nbsp; a) &nbsp;</div>
                                    <div><?= $all_questions['option_one'] ?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">

                                    <?php
                                    if ($all_questions['answer'] == 'option_two') {
                                        echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                    }
                                    ?>
                                  
                                    <div>&nbsp; a) &nbsp;</div>
                                    <div><?= $all_questions['option_two'] ?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">

                                    <?php
                                    if ($all_questions['answer'] == 'option_three') {
                                        echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                    }
                                    ?>
                                    
                                    <div>&nbsp; a) &nbsp;</div>
                                    <div><?= $all_questions['option_three'] ?></div>
                                </div>

                                <div class="col-sm-6 col-lg-3 d-flex">

                                    <?php
                                    if ($all_questions['answer'] == 'option_four') {
                                        echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
                                    }
                                    ?>
                                   
                                    <div>&nbsp; a) &nbsp;</div>
                                    <div><?= $all_questions['option_four'] ?></div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $question_ans .= $all_questions['id'] . '=' . ',';
                        }
                    }

                    $question_ans = rtrim($question_ans,",");
                    $wrong_answer = $_SESSION['wrong'];
                    $right_answer = isset($_SESSION['score']) ? $_SESSION['score'] : '0';

                    $start_time = $_SESSION['start_exam_time'];
                    $end_time = date("Y-m-d h:i:s");
                        $to_time = strtotime($end_time);
                        $from_time = strtotime($start_time);
                    $total_time = round(abs($to_time - $from_time) / 60,2). " Minutes";

                    if ($student_infos['ms'] == 'yes') {
                        if($student_infos['st'] == 'yes') {
                            $second_timer = 5;
                        } else {
                            $second_timer = 0;
                        }
                        $final_score = $right_answer_final - (200 - (($student_infos['hsc'] * 25) + ($student_infos['ssc'] * 15) + $second_timer + 2.5));
                    }

                    $submit_result = $common->insert("`results`(`exam_id`, `student_id`, `score`, `wrongans`, `rightans`, `blankans`, `question_ans`, `start_time`, `end_time`, `total_time`)", "('$exam_id', '$student_id', '$right_answer_final', '$wrong_answer', '$right_answer', '$not_answered', '$question_ans', '$start_time', '$end_time', '$total_time')");
                    unset($_SESSION['start_exam_time']);

                    if ($publish_exam_infos['notification'] == 'yes') {
                        //---------------Email sender---------------
                        // $recipient = 'arifh3261@gmail.com'; //recipient 
                        // $email = $student_infos['email']; //senders e-mail adress 
                        
                        // $mail_body  = "New exam submit from: \r\n\n";
                        // $mail_body  = "--------------------------------------- \r\n";
                        // $mail_body  = "Name: $student_infos['sname'] \r\n";
                        // $mail_body .= "Email: $email \r\n";

                        // $subject = "New exam submited."; //subject 
                        // $from = $email;
                        // $header = 'From: '.$from."\r\n". 'Reply-To: '.$from."\r\n" . 'X-Mailer: PHP/' . phpversion();

                        // mail($recipient, $subject, $mail_body, $header); //mail command :) 
                        //-------------Email Sender Ends------------
                    }
                    ?>
                    </div>
                    <div class="d-flex justify-content-between my-2 bg-white p-3 no_print">
                        <div>
                            <a href="start-exam.php?xmid=<?=$exam_id?>"class="btn btn-primary btn-rounded me-2">Try Again</a>
                            <a href="index.php" class="btn btn-secondary btn-rounded">Home</a>
                        </div>
                        <button onclick="window.print()" class="ml-auto btn btn-primary btn-sm">Download PDF</button>
                    </div>
                
                </div>
            </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>