<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
    if(isset($_GET['vi'])){
        $id = $_GET['vi'];
        $query = $common->select("`add_exam`","`id`='$id'");
        $exam = mysqli_fetch_assoc($query);


        $exam_id = Session::get('exmid');
        $publish_setting = $common->select("`publish_exam`","`exam_id`='$exam_id' && `other` LIKE '%blank%'");
        if ($publish_setting) {
            $publish_settings = mysqli_fetch_assoc($publish_setting);
        }

    }

    // exam start time storing in session
    if (!isset($_SESSION['start_exam_time'])) {
        $_SESSION['start_exam_time'] = date("Y-m-d h:i:s");
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
        $totalquetion = $_POST['totalquetion'];
        for($i=1;$i<=$totalquetion;$i++){
            $serial    = $_POST['serial'.$i];
            $ans = $_POST['ans'.$i];

            if(!isset($_SESSION['score'])){
                $_SESSION['score'] = '0';   
            }
            $right = $exam->rightAns($serial,$id);
            if($right == $ans){
                $_SESSION['score']++;
            }
        }
       // print_r($_SESSION);
          header("Location: final.php");
       
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
    <body onload="starttime()">
            <div class="container-fluid">
                <div class="quetion" style="width: 700px;margin:0px auto;">
                    <div class="main bg-white">
                        <div class="examheader text-center mt-2">
                            <h3 class= ''style="margin-top:-23px;"><?=$exam['examname'];?></h3>
                            <h3>Subject:Phy</h3>
                            <h3 id ="starttime"></h3>
                            <div id="showtime" ></div>
                        </div>
                        <div class="row mx-1">
                            <div class="col-4">
                                <h3 class="text-muted">Time:<?=$exam['duration'];?> minutes</h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Quetion:<?=$exam['tquetion'];?></h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Date:<?=$exam['exmdate'];?></h3>
                            </div>
                        </div>  
                        
                    </div>
       
                <form action="final.php" method="post">
                    <input type="hidden" name="totalquetion" value="<?=$exam['tquetion'];?>"/>
                    <?php
                   $select = $common->select("`questions`","`exam_id` = '$id' ORDER BY `serial`+0");
                   if($select){
                      $i = 1;
                       while($viewquetion = mysqli_fetch_assoc($select)){
                   ?>
                  
                    <div class="exam bg-white mt-2">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="serial<?=$i;?>" value="<?=$viewquetion['id'];?>>"/>
                                    <h3><?=$viewquetion['serial'];?>: <?=$viewquetion['question'];?></h3>
                                </td>    
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="ans<?=$i;?>" value="option_one" <?= $publish_setting != NULL ? '' : 'required'; ?> />
                                    <?=$viewquetion['option_one'];?><br>
                                    
                                    <input type="radio" name="ans<?=$i;?>" value="option_two" <?= $publish_setting != NULL ? '' : 'required'; ?> />
                                    <?=$viewquetion['option_two'];?><br>
                                    <input type="radio" name="ans<?=$i;?>" value="option_three" <?= $publish_setting != NULL ? '' : 'required'; ?> />
                                    <?=$viewquetion['option_three'];?><br>
                                    <input type="radio" name="ans<?=$i;?>" value="option_four" <?= $publish_setting != NULL ? '' : 'required'; ?> />
                                    <?=$viewquetion['option_four'];?>
                                </td>
                            </tr>

                        </table>
                    </div>
                       
                    <?php 
                    $i++;
                }}?>
                    <button type="submit" class="btn btn-success my-3"name="save">Save</button>
                </form>
               
                </div>
            </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <?php
            $query = $common->select("`publish_exam`","`exam_id`='$exam_id'");
           
            $result = mysqli_fetch_assoc($query);
            $duration = $result['howtime'];

            if($duration == "limited"){
        ?>
        <script>

        var tim;
        
        var min = '<?=$result['totaltime'];?>';
        var sec = 00;
        var f = new Date();
        function starttime() {
            showtime();
            document.getElementById("starttime").innerHTML = "<h4>You started your Exam at " + f.getHours() + ":" + f.getMinutes()+"</h4>"; 
        }
        function showtime() {
            if (parseInt(sec) > 0) {
                sec = parseInt(sec) - 1;
                document.getElementById("showtime").innerHTML = "Your Left Time is :"+min+" Minutes :" + sec+" Seconds";
                tim = setTimeout("showtime()", 1000);
            }
            else {
                if (parseInt(sec) == 0) {
                    min = parseInt(min) - 1;
            document.getElementById("showtime").innerHTML = "Your Left Time is :"+min+" Minutes :" + sec+" Seconds";
                    if (parseInt(min) == 0) {
                        clearTimeout(tim);
            alert("Time Up");

                        window.location.href = "final.php";
                    }
                    else {
                        sec = 60;
                        document.getElementById("showtime").innerHTML = "Your Left Time is :" + min + " Minutes :" + sec + " Seconds";
                        tim = setTimeout("showtime()", 1000);
                    }
                }

            }
        }
        
  </script>
 <?php } ?>
           
        
    </body>
</html>