<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
  
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $right_answer = 0;
    $wrong_answer = 0;
    $not_answered = 0;

    $preview_answer = '';

    $totalquetion = $_POST['totalquetion'];

    for($i = 1; $i <= $totalquetion; $i++){
        $serial = $_POST['serial'.$i];

        $que_info = $common->select("questions", "`id` = '$serial'");
        $que_infos = mysqli_fetch_assoc($que_info);
        if ($que_infos["answer"] == 'option_one') {
            $correct_option1 = '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
            $correct_option2 = '';
            $correct_option3 = '';
            $correct_option4 = '';
        } elseif ($que_infos["answer"] == 'option_two') {
            $correct_option1 = '';
            $correct_option2 = '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
            $correct_option3 = '';
            $correct_option4 = '';
        } elseif ($que_infos["answer"] == 'option_three') {
            $correct_option1 = '';
            $correct_option2 = '';
            $correct_option3 = '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
            $correct_option4 = '';
        } elseif ($que_infos["answer"] == 'option_four') {
            $correct_option1 = '';
            $correct_option2 = '';
            $correct_option3 = '';
            $correct_option4 = '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">';
        }

        if(isset($_POST['ans'.$i])) {
            $ans = $_POST['ans'.$i];

            $result_check = $common->select("questions", "`id` = '$serial' && `answer` = '$ans'");

            if($result_check) {
                $right_answer++;
            $preview_answer .= '<div class="quetion mb-2 bg-white py-2 border border-success" style="border-width: 3px!important;">
                    <div class="row mx-2">
                        <div class="col-12 d-flex">
                            <span><b>'.$i.'. &nbsp;</b></span>
                            <div>'.$que_infos["question"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option1.'
                            
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_one"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option2.'
                          
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_two"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option3.'
                            
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_three"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option4.'
                           
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_four"].'</div>
                        </div>
                    </div>
                </div>';
            } else {
                $wrong_answer++;

                if ($ans == 'option_one') {
                    $wrong_option1 = '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                    $wrong_option2 = '';
                    $wrong_option3 = '';
                    $wrong_option4 = '';
                } elseif ($ans == 'option_two') {
                    $wrong_option1 = '';
                    $wrong_option2 = '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                    $wrong_option3 = '';
                    $wrong_option4 = '';
                } elseif ($ans == 'option_three') {
                    $wrong_option1 = '';
                    $wrong_option2 = '';
                    $wrong_option3 = '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                    $wrong_option4 = '';
                } elseif ($ans == 'option_four') {
                    $wrong_option1 = '';
                    $wrong_option2 = '';
                    $wrong_option3 = '';
                    $wrong_option4 = '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg">';
                }
            $preview_answer .= '<div class="quetion mb-2 bg-white py-2 border border-danger" style="border-width: 3px!important;">
                        <div class="row mx-2">
                            <div class="col-12 d-flex">
                                <span><b>'.$i.'. &nbsp;</b></span>
                                <div>'.$que_infos["question"].'</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option1.'
                                '.$wrong_option1.'
                                
                                <div>&nbsp; a) &nbsp;</div>
                                <div>'.$que_infos["option_one"].'</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option2.'
                                '.$wrong_option2.'
                              
                                <div>&nbsp; a) &nbsp;</div>
                                <div>'.$que_infos["option_two"].'</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option3.'
                                '.$wrong_option3.'

                                <div>&nbsp; a) &nbsp;</div>
                                <div>'.$que_infos["option_three"].'</div>
                            </div>

                            <div class="col-sm-6 col-lg-3 d-flex">
                            
                                '.$correct_option4.'
                                '.$wrong_option4.'
                               
                                <div>&nbsp; a) &nbsp;</div>
                                <div>'.$que_infos["option_four"].'</div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            $not_answered++;
        $preview_answer .= '<div class="quetion mb-2 bg-white py-2 border border-dark" style="border-width: 3px!important;">
                    <div class="row mx-2">
                        <div class="col-12 d-flex">
                            <span><b>'.$i.'. &nbsp;</b></span>
                            <div>'.$que_infos["question"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">
                            
                            '.$correct_option1.'
                            
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_one"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">

                            '.$correct_option2.'
                          
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_two"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">

                            '.$correct_option3.'
                            
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_three"].'</div>
                        </div>

                        <div class="col-sm-6 col-lg-3 d-flex">

                            '.$correct_option4.'
                           
                            <div>&nbsp; a) &nbsp;</div>
                            <div>'.$que_infos["option_four"].'</div>
                        </div>
                    </div>
                </div>';
        }
    }

    $exam_id = Session::get('exmid');
    $nagetive_mark = $common->select("`publish_exam`","`exam_id`='$exam_id' && `other` LIKE '%negative%'");
    if ($nagetive_mark) {
        $nagetive_marks = mysqli_fetch_assoc($nagetive_mark);
    }

} else {
    header("Location: http://localhost/batbio/exam.php?vi=".Session::get('exmid'));
}

?>
<DOCTYPE html>
  <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    <!-- Custom CSS -->
    <link href="admin/dist/css/style.min.css" rel="stylesheet">
    </head>
    <style>
        body{
        background:url(image/start.jpg) repeat fixed 0 0 #000;position: relative;
        }
    </style>
    <body>
            <div class="container-fluid">
                <div class="quetion" style="max-width: 900px; margin:0px auto;">
                    <div class="main bg-white mb-2 py-2">
                        <div class="examheader text-center mt-2">
                            <h3 class='text-uppercase'>Text</h3>
                            <h3 class="text-capitalize mb-3">Subject:Bangla</h3>
                        </div>
                        <div class="row mx-1">
                            <div class="col-3">
                                <h3 class="text-muted">Your Score: <?= $right_answer; ?>/<?= $totalquetion; ?></h3>
                            </div>
                            <div class="col-3">
                                <h3 class="text-muted">Not Answer: <?= $not_answered; ?></h3>
                            </div>
                            <div class="col-3">
                                <h3 class="text-muted">Date:22-10-21</h3>
                            </div>
                            <div class="col-3">
                                <h3 class="text-muted">Total Marks:  
                                    <?php
                                    if ($nagetive_mark) {
                                        $wrong_ans = $totalquetion - $right_answer;
                                        $negative_percent =  $nagetive_marks['negative_mark'] * 0.01;
                                        echo $right_answer - ($wrong_ans * $negative_percent);
                                    } else {
                                        echo $right_answer;
                                    }
                                    ?>
                                </h3>
                            </div>
                        </div>  
                        
                    </div>
                    
                   
                    <div>
                        <?= $preview_answer; ?>
                    </div>
                  

                </div>
            </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>