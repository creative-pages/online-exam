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
                                <h3 class="text-muted">Wrong Score:
                                <?php
									if(isset($_SESSION['wrong'])){
										echo $_SESSION['wrong'];
										unset($_SESSION['wrong']);
									}
								?>
                                </h3>
                            </div>
                            <div class="col-4">
                                <h3 class="text-muted">Date:<?=$exam['exmdate'];?></h3>
                            </div>
                        </div>  
                        
                    </div>

                    <div class="bg-white p-3 mt-3">
                    <?php
                    $all_question = $common->select("`questions`", "`exam_id` = '$id' ORDER BY `serial` ASC");

                    while ($all_questions = mysqli_fetch_assoc($all_question)) {
                        if ($_SESSION['exam_sheet'][$all_questions['id']] != '') {
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
                        } else {
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
                        }
                    }
                    ?>
                    </div>
                
                </div>
            </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>