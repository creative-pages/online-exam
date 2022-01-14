<?php
    require_once 'init.php';
    Session::StudentSignIn();
    $all = new All();
    $exam = new Exam();
    $common = new Common();
    date_default_timezone_set('Asia/Dhaka');
    $cur_date = date('d-m-y');
?>
?>
<?php
    if(isset($_GET['vi'])){
        $id = $_GET['vi'];
        $query = $common->select("`add_exam`","`id`='$id'");
        $exam = mysqli_fetch_assoc($query);
        $subject_id = $exam['subject_id'];
        $subject_info = $common->select("`subject_add`","`id` = '$subject_id'");
        $subject_info = mysqli_fetch_assoc($subject_info);
        $exam_id = $_GET['vi'];
        $publish_setting = $common->select("`publish_exam`", "`exam_id` = '$exam_id'");
        if ($publish_setting) {
            $publish_settings = mysqli_fetch_assoc($publish_setting);
            $display_question = $publish_settings['display_question'];
            if (strpos($publish_settings['other'], 'blank')) {
                $other = '';
                $other_message = "";
            } else {
                $other = ' required=""';
                $other_message = "All questions are required! You can't leave any question*";
            }
        }

    }

    // exam start time storing in session
    if (!isset($_SESSION['start_exam_time'])) {
        $_SESSION['start_exam_time'] = date("Y-m-d h:i:s");
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
    </style>
    <body>
            <div class="container-fluid">
                <div class="quetion" style="width: 700px;margin:0px auto;">
                    <div class="main bg-white py-3">
                       <div class="examheader text-center mt-1">
                            <p class="text-success m-0"><strong>Wellocme <?=Session::get('name');?></strong></p>
                            <h3 class='text-capitalize'>Exam Name: <?= $exam['examname']; ?></h3>
                            <h3>Subject: <?= $subject_info['subject_name']; ?></h3>
                            <?php
                            if($publish_settings['howtime'] == "limited") {
                            ?>
                            <h5 class="mb-1 mt-3">You started your exam at <?= date("h:i a"); ?></h5>
                            <h5 class="mb-3" id="timer">
                                Your Left Time is : <strong id="minutes">-</strong> minutes and <strong id="seconds">-</strong> seconds.
                            </h5>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="row mx-1">
                            <div class="col-4">
                                <h3 class="text-muted">Time:<?php 
                                if($publish_settings['howtime'] == "limited"){
                                $publish_settings['totaltime'];
                            ?> Minutes
                             <?php } else {?> Unlimited <?php }?></h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Quetion: <?= $display_question; ?></h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Date: <?=$cur_date?></h3>
                            </div>
                        </div>
                        <p class="px-3 mb-0 text-danger"><?= $other_message; ?></p>
                    </div>
       
                <form id="autoSubmit" class="bg-white" action="final.php" method="post">
                    <input type="hidden" name="totalquetion" value="<?=$display_question;?>"/>
                    <input type="hidden" name="exam_id" value="<?= $exam_id; ?>"/>
                    <?php
                    $randomize = $publish_settings ['other'];
                    if(is_numeric(strpos($randomize,'randomize'))){
                        $select = $common->select("`questions`","`exam_id` = '$id' ORDER BY RAND() LIMIT $display_question");
                    }else{
                        $select = $common->select("`questions`","`exam_id` = '$id' ORDER BY `id` ASC LIMIT $display_question"); 
                    }
                    if($select){
                      $i = 1;
                       while($viewquetion = mysqli_fetch_assoc($select)){
                   ?>
                    <div class="exam bg-white px-3 py-2 border">
                        <div class="row mx-n3">
                            <div class="col-12 d-flex mb-2" style="font-size: 18px;">
                                <input type="hidden" name="serial<?= $i; ?>" value="<?= $viewquetion['id']; ?>"/>
                                <span><b><?= $i; ?>. &nbsp;</b></span>
                                <div><?= $viewquetion['question']; ?></div>
                            </div>
                            <div class="col-12 d-flex mb-2">
                                <input type="radio" name="ans<?= $i; ?>" value="option_one"<?= $other; ?> style="margin-top: 4px; margin-right: 8px;" />
                                <?= $viewquetion['option_one']; ?>
                            </div>
                            <div class="col-12 d-flex mb-2">
                                <input type="radio" name="ans<?= $i; ?>" value="option_two"<?= $other; ?> style="margin-top: 4px; margin-right: 8px;" />
                                <?= $viewquetion['option_two']; ?>
                            </div>
                            <div class="col-12 d-flex mb-2">
                                <input type="radio" name="ans<?= $i; ?>" value="option_three"<?= $other; ?> style="margin-top: 4px; margin-right: 8px;" />
                                <?= $viewquetion['option_three']; ?>
                            </div>
                            <div class="col-12 d-flex mb-2">
                                <input type="radio" name="ans<?= $i; ?>" value="option_four"<?= $other; ?> style="margin-top: 4px; margin-right: 8px;" />
                                <?= $viewquetion['option_four']; ?>
                            </div>
                        </div>
                    </div>
                       
                    <?php 
                    $i++;
                      }
                    }
                    ?>
                    <p class="text-center">
                        <button type="submit" class="btn btn-success my-3" name="save">Submit</button>
                    </p>
                </form>
                </div>
            </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php
        if($publish_settings['howtime'] == "limited") {
    ?>
    <script>
        var time = <?= $exam['duration']; ?> * 60,
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
          
          if( timeleft == 0) clearInterval(timer);
        }
        timer = setInterval(countdown, 200);
        window.onload = function() { 
            window.setTimeout("autoFormSubmit()", <?= $exam['duration']; ?> * 1000 * 60);
        };
        function autoFormSubmit() {
            document.getElementById("autoSubmit").submit();
        }
    </script>
    <?php
    }
    ?>
    </body>
</html>