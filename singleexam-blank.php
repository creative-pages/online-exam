<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
   $exam = Session::get('exmid');
   $sub = $common->select("`add_exam`","`id`='$exam'");
   
   $raw = mysqli_fetch_assoc($sub);
?>

<DOCTYPE html>
  <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    </head>
    <body>
      <div class="container">
          <div class="main mx-auto mb-1" style= "width:800px;">
                <div class="exam_head my-1">
                    <div class="text-center">
                        <h4 class="text-muted"><strong><?=$raw['examname']?></strong></h4>
                        <h4 class="text-muted"><strong>Sub:<?=$raw['subjectname']?></strong></h4>
                    </div>
                    
                    <div class="row mx-1">
                        <div class="col-4">
                            <h4 class="text-muted">Time:<?=$raw['duration']?> minute</h4>
                        </div>
                        <div class="col-4">
                            <h4 class="text-muted">Quetion:<?=$raw['tquetion']?></h4>
                        </div>
                        <div class="col-4">
                            <h4 class="text-muted"><?=$raw['exmdate']?></h4>
                        </div>
                    </div>
                
                </div>
                <hr>
                <div class="exam_body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1  p-1 ">
                                <h3>hjjk helll</h3>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                               <input type="radio"id="inputcom" name="color">
                                    Show a custom message if the student pass or fail
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                               <input type="radio"id="inputcom" name="color">
                                    Show a custom message if the student pass or fail
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                               <input type="radio"id="inputcom" name="color">
                                    Show a custom message if the student pass or fail
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                               <input type="radio"id="inputcom" name="color">
                                    Show a custom message if the student pass or fail
                            </div>
                        </div>
                        <div class="mt-1">
                            <a class="btn btn-success" href="singleexam-blank.php?q=<?= $_GET['q'] + 1; ?>">
                                Next Quetion
                            </a>

                        </div>
                        
                            
                        
                    </div>
                </div>
            </div>

      </div>

      
      
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>