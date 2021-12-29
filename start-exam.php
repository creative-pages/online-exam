<?php
    require_once 'init.php';
    Session::StudentSignIn();
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
   if(isset($_GET['xmid'])){
    $xmid = $_GET['xmid'];
    $sub = $common->select("`add_exam`","`id`='$xmid'");
 
    $raw = mysqli_fetch_assoc($sub);
    $batch_id = $raw['batch_id'];
    $subject_id = $raw['subject_id'];
    // subject information
    $subject_detail = $common->select("`subject_add`", "`id` = '$subject_id'");
    $subject_details = mysqli_fetch_assoc($subject_detail);
 
    $cmn = $common->select("`publish_exam`","`exam_id`='$xmid'");
    $result = mysqli_fetch_assoc($cmn);
    $pagination = $result['pagination'];
    $cmn = $common->select("`questions`","`exam_id`='$xmid' ORDER BY `serial` ASC");
    $qu = mysqli_fetch_assoc($cmn);

    unset($_SESSION["exam_sheet"]);
    unset($_SESSION["reload_session_result"]);
    unset($_SESSION["score"]);
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
        background:url(image/get-strat.webp) repeat fixed 0 0 #000;position: relative;
        }
    </style>
    <body>
      <div class="container" style = "margin-top:96px;">
          <div class="main mx-auto mb-1 bg-light rounded shadow-sm p-3 mb-5 " style= "width:700px;">
            <form>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                            <h3 class="text-muted" style = "font-family: Georgia, serif;">Exam Name: <?= $raw['examname']; ?></h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                        <h3 class="text-muted" style = "font-family: Georgia, serif;">Subject Name: <?= $subject_details['subject_name']; ?></h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                        <h3 class="text-muted" style = "font-family: Georgia, serif;">Total Quetion: <?= $raw['tquetion']; ?></h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                        <h3 class="text-muted" style = "font-family: Georgia, serif;">Duration: <?= $raw['duration']; ?> Minutes</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mt-2 px-2">
                            <?php if($pagination == "oneQuetion") {?>
                            <a class="btn btn-success" href="singleexam-blank.php?q=<?=$qu['serial']?>">
                                Start Test
                            </a>
                            <?php
                            } else {
                            ?>
                            <a class="btn btn-success" href="exam.php?vi=<?= $xmid; ?>">
                                Start Test
                            </a>
                            <?php
                            }
                            ?>
                            <a class="btn btn-secondary float-end" href="class.php?cls=<?= $batch_id; ?>">Go Back</a>
                        </div>
                    </div>
                </div>
            </form>
         <div>

      </div>

      
      
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>