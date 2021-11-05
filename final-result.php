<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
    if(isset($_GET['xmid'])){
        $id = $_GET['xmid'];
        $query = $common->select("`add_exam`","`id`='$id'");
        $exam = mysqli_fetch_assoc($query);

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
                    <div class="main bg-white" style="margin-top: 30px;">
                        <div class="examheader text-center mt-2">
                            <h3 class= ''style="margin-top:-23px;"><?=$exam['examname'];?></h3>
                            <h3>Subject:Phy</h3>
                        </div>
                        <div class="row mx-1">
                            <div class="col-4">
                                <h3 class="text-muted">Your Score:<?=$exam['tquetion'];?>/
								<?php
									if(isset($_SESSION['score'])){
										echo $_SESSION['score'];
										unset($_SESSION['score']);
									}
								?>
								</h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Wrong Score:</h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Date:<?=$exam['exmdate'];?></h3>
                            </div>
                        </div>  
                        
                    </div>
                
                </div>
            </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>