<?php
    require_once 'init.php';
    Session::StudentSignIn();
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
   $exam_id = Session::get('exmid');
   $sub = $common->select("`add_exam`","`id`='$exam_id'");
   
   $raw = mysqli_fetch_assoc($sub);
   $subject_id = $raw['subject_id'];
   // subject info
   $subject_info = $common->select("`subject_add`", "`id` = '$subject_id'");
   $subject_infos = mysqli_fetch_assoc($subject_info);
   $publish_setting = $common->select("`publish_exam`", "`exam_id` = '$exam_id'");
    if ($publish_setting) {
        $publish_settings = mysqli_fetch_assoc($publish_setting);
        $display_question = $publish_settings['display_question'];
        if (strpos($publish_settings['other'], 'blank')) {
            $other = '';
        } else {
            $other = ' required=""';
        }
    }


    if(isset($_GET['q'])){
        $sid = $_GET['q'];
        $serial = $common->select("`questions`","`exam_id` = '$exam_id' && `serial` = '$sid'");
        $result = mysqli_fetch_assoc($serial);

        // for reloading problem solve
        if (isset($_SESSION['reload_session_result'])) {
            $reload_sid = $sid - 1;

            if (array_key_exists($result['id'], $_SESSION['reload_session_result'])) {
                $already_answered = 'ok';
            }
        }
        // for reloading problem solve
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $_SESSION['remain_time'] = ($_POST['input_min'] * 60) + $_POST['input_sec'];
        $process = $exam->ExamProcess($_POST,$exam_id);
    }

    // exam start time storing in session
    if ($_GET['q'] == '1' && !isset($_SESSION['start_exam_time'])) {
        $_SESSION['start_exam_time'] = date("Y-m-d h:i:s");
    }

?>

<DOCTYPE html>
  <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    </head>
    <style>
        body{
        background:url(image/start.jpg) repeat fixed 0 0 #000;position: relative;
        }
    </style>
    <body>
      <div class="container">
          <div class="main mx-auto shadow-sm p-3 my-3 bg-light rounded" style= "width:800px; margin-top: 35;">
                <div class="exam_head my-1">
                    <div class="text-center">
                        <h4 class="text-muted text-capitalize"><strong><?=$raw['examname']?></strong></h4>
                        <h4 class="text-muted"><strong>Sub: <?= $subject_infos['subject_name']; ?></strong></h4>
                        <?php
                        if($publish_settings['howtime'] == "limited") {
                            if (!isset($_SESSION['exam_start_time'])) {
                                $_SESSION['exam_start_time'] = date("h:i a");
                            }
                        ?>
                        <h5 class="mb-1 mt-3">You started your exam at <?= $_SESSION['exam_start_time']; ?></h5>
                        <h5 class="mb-3" id="timer">
                            Your Left Time is : <strong id="minutes">-</strong> minutes and <strong id="seconds">-</strong> seconds.

                            <input class="input_min" form="single_exam_form" name="input_min" type="hidden">
                            <input class="input_sec" form="single_exam_form" name="input_sec" type="hidden">
                        </h5>
                        <?php
                        }
                        ?>
                    </div>
                    
                    <div class="row mx-1">
                        <div class="col-4">
                            <h4 class="text-muted">Time: <?=$raw['duration']?> Minutes</h4>
                        </div>
                        <div class="col-4">
                            <h4 class="text-muted">Quetion: <?= $display_question; ?></h4>
                        </div>
                        <div class="col-4">
                            <h4 class="text-muted"><?=$raw['exmdate']?></h4>
                        </div>
                    </div>
                
                </div>
                <hr>
                <div class="exam_body">
                    <div class="row">
                        <form action="" id="single_exam_form" method = "post">
                            <div class="col-12">
                                <div class="d-flex mb-2">
                                    <div><?= $result['serial']; ?>. &nbsp;</div>
                                    <?= $result['question']; ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mb-2">
                                    <input type="radio" id="ans1" name="ans" value="option_one"<?= $other; ?> <?php 
                                    if (isset($already_answered)) {
                                        if ($_SESSION['reload_session_result'][$result['id']] != 'option_one') {
                                            echo 'disabled';
                                        } else {
                                            echo 'checked';
                                        }
                                    }
                                    ?> style="margin-top: 4px; margin-right: 8px;" />
                                    <?= $result['option_one']; ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mb-2">
                                <input type="radio" id="ans2" name="ans" value="option_two"<?= $other; ?> <?php 
                                if (isset($already_answered)) {
                                    if ($_SESSION['reload_session_result'][$result['id']] != 'option_two') {
                                        echo 'disabled';
                                    } else {
                                        echo 'checked';
                                    }
                                }
                                ?> style="margin-top: 4px; margin-right: 8px;" />
                                    <?=$result['option_two']?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mb-2">
                                <input type="radio" id="ans3" name="ans" value="option_three"<?= $other; ?> <?php 
                                if (isset($already_answered)) {
                                    if ($_SESSION['reload_session_result'][$result['id']] != 'option_three') {
                                        echo 'disabled';
                                    } else {
                                        echo 'checked';
                                    }
                                }
                                ?> style="margin-top: 4px; margin-right: 8px;" />
                                    <?=$result['option_three']?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mb-2">
                                <input type="radio" id="ans4" name="ans"  value="option_four"<?= $other; ?> <?php 
                                if (isset($already_answered)) {
                                    if ($_SESSION['reload_session_result'][$result['id']] != 'option_four') {
                                        echo 'disabled';
                                    } else {
                                        echo 'checked';
                                    }
                                }
                                ?> style="margin-top: 4px; margin-right: 8px;" />
                                    <?=$result['option_four']?>
                                </div>  
                            </div>
                            <div id="result_check" class="mb-3">
                                <?php
                                if (isset($already_answered)) {
                                    if ($_SESSION['reload_session_result'][$result['id']] == $result['answer']) {
                                        echo '<img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg"> Right';
                                    } else {
                                        echo '<img width="25px" height="25px" src="admin/assets/images/iconfinder_wrong.jpg"> Wrong <br> <div class="d-flex mt-2"><img width="25px" height="25px" src="admin/assets/images/img/iconfinder_check.svg">&nbsp; ' . $result[$result['answer']] . '</div>';
                                    }
                                }
                                ?>
                            </div>

                            <div class="mt-1">
                                <input type = "submit" class="btn btn-success" name = "submit" value = "Next Quetion" />
                                <input type = "hidden" value = "<?php echo $sid ;?>" name = "serial" id = "serial"/>
                                <input type="hidden" value="<?= $result['id']; ?>" name="q_id"/>
                                <input type = "hidden" value = "<?php echo $exam_id  ;?>" name = "" id = "xmid"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

      </div>

      
      
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        <script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function (){
                $('[name="ans"]').click(function() {
                    var q_id = '<?= $result['id']; ?>';
                    var ans = $(this).val();
                     $.ajax({
                        type:"POST",
                        url:"admin/ajax/exam-process.php",
                        data:{q_id:q_id, ans:ans, single_page_result_check:'single_page_result_check'},
                        success:function(data){
                            $('#result_check').html(data);

                            $('[name="ans"]').attr("disabled", true);

                            if (ans == $('#ans1').val()) {
                                $('#ans1').removeAttr('disabled');
                            } else if(ans == $('#ans2').val()) {
                                $('#ans2').removeAttr('disabled');
                            } else if(ans == $('#ans3').val()) {
                                $('#ans3').removeAttr('disabled');
                            } else if(ans == $('#ans4').val()) {
                                $('#ans4').removeAttr('disabled');
                            }
                        }
                      
                    });
                });

            });
        </script>

    <?php
        if($publish_settings['howtime'] == "limited") {
            if (isset($_SESSION['remain_time'])) {
                $main_time = $_SESSION['remain_time'];
            } else {
                $main_time = $raw['duration'] * 60;
            }
    ?>
    <script>
        var time = <?= $main_time; ?>,
            start = Date.now(),
            mins = document.getElementById('minutes'),
            secs = document.getElementById('seconds'),
            timer;
        function countdown() {
          var timeleft = Math.max(0, time - (Date.now() - start) / 1000),
              m = Math.floor(timeleft / 60),
              s = Math.floor(timeleft % 60);
          
          mins.firstChild.nodeValue = m;
          secs.firstChild.nodeValue = s;
          $('.input_min').val(m);
          $('.input_sec').val(s);
          
          if( timeleft == 0) clearInterval(timer);
        }
        timer = setInterval(countdown, 200);
        window.onload = function() { 
            window.setTimeout("autoFormSubmit()", <?= $main_time; ?> * 1000);
        };
        function autoFormSubmit() {
            window.location.href = 'final-result.php?xmid=' + <?= $exam_id; ?>;
        }
    </script>
    <?php
    }
    ?>
    </body>
</html>