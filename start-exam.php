<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
   if(isset($_GET['xmid'])){
        $xmid = $_GET['xmid'];
        $sub = $common->select("`add_exam`","`id`='9'");
    
        $raw = mysqli_fetch_assoc($sub);
    
        $cmn = $common->select("`questions`","`exam_id`=9");
    
        $qu = mysqli_fetch_assoc($cmn);
   
    } 

?>
<?php
   

?>
<?php
   
   

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
      <div class="container" style = "margin-top:96px;">
          <div class="main mx-auto mb-1 bg-light rounded shadow-sm p-3 mb-5 " style= "width:700px;">
            <form>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                            <h3 class="text-muted" style = "font-family: Georgia, serif;">Exam Name:</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                        <h3 class="text-muted" style = "font-family: Georgia, serif;">Subject Name:</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                        <h3 class="text-muted" style = "font-family: Georgia, serif;">Total Quetion:</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                        <h3 class="text-muted" style = "font-family: Georgia, serif;">Duration:</h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1 mx-2">
                           
                            <a href="singleexam-blank.php?q=<?=$qu['serial']?>">
                            <button class = "btn btn-success">Start Test ...</button>
                            </a>
                           
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