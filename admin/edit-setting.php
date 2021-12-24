<?php include('inc/header.php'); ?>
<?php
    if(isset($_GET['es'])){
        $id = $_GET['es'];
       $query = $common->select("`publish_exam`","`id`='$id'");
       $exam = mysqli_fetch_assoc($query);

    }
  ?>
  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editsetting'])) {
        $publish = $all->EditSetting($_POST,$id);
    }
  ?>

<body>
    <!-- -------------------------------------------------------------- -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- -------------------------------------------------------------- -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#1e88e5" stroke-width="2"></path>
          <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#1e88e5" stroke-width="2"></path>
          <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
          <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#1e88e5"></path>
          <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    
    <div id="main-wrapper">
      
        <?php include('inc/topbar.php'); ?>
       
        <?php include('inc/left-sidebar.php'); ?>
        
        <div class="page-wrapper">
          
            <div class="container-fluid">
                <form action="" method="post">
                    <div class="card w-100">
                        
                        
                            <div class="card-body border-top">
                                <h4 class="card-title">Basic Settings</h4>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="inputcom" class="control-label col-form-label">Exam Name</label>
                                            <input type="text" class="form-control" name="exam_name" value="<?=$exam['exam_name'];?>">
                                            <input type="hidden" class="form-control" id="inputcom" name="exam_id" value="<?=$exam['exam_id'];?>">
                                            <input type="hidden" class="form-control" id="inputcom" name="link" value="student-login.php?exmid=<?=$exam['id'];?>">
                                        </div>
                                    </div>
                                
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="control-label col-form-label">Introduction</label>
                                            <textarea class="form-control ck_editor" name="intro" >
                                                <?=$exam['intro'];?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        
                            <div class="card-body border-top">
                                <h4 class="card-title">Color Scheema</h4>
                                
                                <div class="row">
                                    <div class="col-3">
                                        <div class="mb-3">
                                            
                                            <input type="radio" id="inputcom" name="color" value="blue" <?php echo ($exam['color']== 'blue') ?  "checked" : "" ;  ?>>
                                            Blue
                                        </div>
                                    </div>
                                
                                    <div class="col-3">
                                        <div class="mb-3">
                                        
                                            <input type="radio"id="inputcom" name="color" value="red" <?php echo ($exam['color']== 'red') ?  "checked" : "" ;  ?>>
                                            Red
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                        
                                            <input type="radio"id="inputcom" name="color" value="green" <?php echo ($exam['color']== 'green') ?  "checked" : "" ;  ?>>
                                            Green
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                        
                                            <input type="radio" id="inputcom" name="color" value="white" <?php echo ($exam['color']== 'white') ?  "checked" : "" ;  ?>>
                                            White
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border-top">
                                <h4 class="card-title">Quetion Setting</h4>
                                <h5 class="card-title">Pagination</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1">
                                            
                                            <input type="radio" id="all" name="pg" value="allQuetion" <?php echo ($exam['pagination']== 'allQuetion') ?  "checked" : "" ;  ?>>
                                            Show <strong>All</strong> Quetion on one Page
                                        </div>
                                    </div>
                                
                                    <div class="col-12">
                                        <div class="mb-3">
                                        
                                            <input type="radio"id="one" name="pg" value="oneQuetion"  <?php echo ($exam['pagination']== 'oneQuetion') ?  "checked" : "" ;  ?>>
                                            Show <strong>One</strong> Quetion Per Page
                                        </div>
                                    </div>
                            </div>
                            <div class="pagi mx-2" style="<?= $exam['pagination']== 'oneQuetion' ? '' : 'display:none;'; ?>">
                                <h4 class="card-title"><strong>Navigation Setting</strong></h4>
                                <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1">
                                                
                                                <input type="radio" id="inputcom" name="nav" value="jump around"  <?php echo ($exam['navigation']== 'jump around') ?  "checked" : "" ;  ?>>
                                                Allow The Student to jump around of different Quetion in the test
                                            </div>
                                        </div>
                                    
                                        <div class="col-12">
                                            <div class="mb-3">
                                            
                                                <input type="radio"id="inputcom" name="nav" value="jump after answering"  <?php echo ($exam['navigation']== 'jump after answering') ?  "checked" : "" ;?>>
                                                Only Allow the student to move forward after answering a question.
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="card-title">After Each Quetion is Answered:</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1">
                                                
                                                <input type="checkbox" id="inputcom" name="after_answer[]" value="Indicate the correct answer"<?php
                                                $after = $exam['after_answer'];
                                                if(is_numeric(strpos($after,'Indicate the correct answer'))) {
                                                echo " checked";
                                                }
                                                ?>>
                                                Indicate the correct answer 
                                            </div>
                                        </div>
                                    
                                        <div class="col-12">
                                            <div class="mb-1">
                                            
                                                <input type="checkbox"id="inputcom" name="after_answer[]" value="Dispaly the correct answer"<?php
                                                $after = $exam['after_answer'];
                                                if(is_numeric(strpos($after,'Dispaly the correct answer'))) {
                                                echo " checked";
                                                }
                                                ?>>
                                                Dispaly the correct answer
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                            
                                                <input type="checkbox"id="inputcom" name="after_answer[]" value="Show The Explation"<?php
                                                $after = $exam['after_answer'];
                                                if(is_numeric(strpos($after,'Show The Explation'))) {
                                                echo " checked";
                                                }
                                                ?>>
                                                Show The Explation
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <h5 class="card-title"><strong>Other Setting </strong></h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1">
                                            
                                            <input type="checkbox"id="inputcom"  name="other[]" value="randomize" <?php
                                                $after = $exam['other'];
                                                if(is_numeric(strpos($after,'randomize'))) {
                                                echo " checked";
                                                }
                                                ?>>
                                                Randomize the other of the quetion duering the test.
                                        </div>
                                    </div>
                                
                                    <div class="col-12">
                                        <div class="mb-1">
                                        
                                        <input type="checkbox"id="inputcom" name="other[]" value="blank" <?php
                                                $after = $exam['other'];
                                                if(is_numeric(strpos($after,'blank'))) {
                                                echo " checked";
                                                }
                                                ?>>
                                                Allow Student to submit blank/emty page
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                        
                                        <input type="checkbox"id="mark" name="other[]" value="negative marking" <?php
                                                $after = $exam['other'];
                                                if(is_numeric(strpos($after,'negative marking'))) {
                                                echo " checked";
                                                }
                                                ?>>
                                                Penalize incorrect answer(Negative marking)
                                        </div>
                                    </div>
                                    <div class="marking mx-2" style="
                                        <?php
                                        $negative = $exam['other'];
                                        if(is_numeric(strpos($after,'negative marking'))) { ?>
                                       
                                        <?php } else { ?>
                                        
                                        display:none;
                                        <?php }?>
                                        ">
                                        <span>Penalty</span> <span><input type="text" name="negative_mark" value="<?=$exam['negative_mark'];?>" style="width:60px;"></span> <span>%</span>
                                        <p class="mt-2">(As a percentage Each quetion of value)</p>
                                    </div>
                            </div>


                            
                            </div>
                        
                    </div>
                    
                    <div class="card w-100">
                        <div class="card-body border-top">
                            <h2><strong>Review Setting</strong></h2>
                            <p>This setting control what happen after the text</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label col-form-label">Concloson text</label>
                                        <textarea class="form-control ck_editor" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        
                                        <input type="checkbox"id="inputcom" name="color">
                                            Show a custom message if the student pass or fail
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <strong>At the end of text,display user:</strong>    
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <input type="checkbox"id="inputcom" name="color">
                                            Score
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <input type="checkbox"id="inputcom" name="color">
                                            Text OutLine[?]
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card w-100">
                        <div class="card-body border-top">
                            <h2><strong>Access Control</strong></h2>
                            <div class="row">
                                <div class="col-6">
                                    <h4>Who Can Text Your Text</h4>
                                    <div class="mb-2 bg-light"style="padding:10px;">
                                        <input type="radio"id="inputcom" name="access" value="anyone" <?php echo ($exam['access']== 'anyone') ?  "checked" : "" ;  ?> >
                                            Anyone
                                    </div>
                                    <div class="mb-2 bg-light"style="padding:10px;">
                                        <input type="radio"id="inputcom" name="access" value="passcode" <?php echo ($exam['access']== 'passcode') ?  "checked" : "" ;  ?> >
                                            Anyone who enters a passcode of my choosing
                                    </div>
                                    <div class="mb-2 bg-light"style="padding:10px;">
                                        <input type="radio"id="inputcom" name="access" value="uniq identifier" <?php echo ($exam['access']== 'uniq identifier') ?  "checked" : "" ;  ?> >
                                        Anyone who enters a uniq identifier
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h4>How much time to test have to compeleted the test?</h4>
                                    <p>The timer start the moment and continues even if they close out of test</p>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <input type="radio"id="inputcom" name="time" value="unlimited" <?php echo ($exam['howtime']== 'unlimited') ?  "checked" : "" ;  ?> >
                                            Unlimited
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="radio"id="inputcom" name="time" value="limited" <?php echo ($exam['howtime']== 'limited') ?  "checked" : "" ;  ?> >
                                            <span><input type="text" name="minute" value="<?=$exam['totaltime'];?>" style="width: 64px;"></span> <span>minutes</span>
                                        </div>
                                    </div>
                                    <h4>How many time someone can take test?</h4>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <input type="radio"id="inputcom" name="can_take_test" value="unlimited" <?php echo ($exam['can_take_test']== 'unlimited') ?  "checked" : "" ;  ?> >
                                            Unlimited
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="radio"id="inputcom" name="can_take_test"value="limited" <?php echo ($exam['can_take_test']== 'limited') ?  "checked" : "" ;  ?>>
                                            <span><input type="text" name="take_time" style="width: 64px;"></span> <span>times</span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        
                        </div>

                    </div>

                    <div class="card w-100">
                        <div class="card-body border-top">
                            <h2><strong>Notification</strong></h2>
                            <h4>Do you want to receive an email whenever someone finishe the test</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <input type="radio"id="inputcom" name="noti" >
                                        Use My Acaunt to Control This
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                    <input type="radio"id="inputcom" name="noti" >
                                        yes
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                    <input type="radio"id="inputcom" name="noti" >
                                        no
                                    </div>
                                </div>
                            
                            </div>

                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" name="editsetting">Save</button>
                    </div>
                </form>

            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End Container fluid  -->
            <!-- -------------------------------------------------------------- -->
            <!-- -------------------------------------------------------------- -->
            <!-- footer -->
            <!-- -------------------------------------------------------------- -->
            <?php include('inc/footer.php'); ?>
            <!-- -------------------------------------------------------------- -->
            <!-- End footer -->
            <!-- -------------------------------------------------------------- -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End Wrapper -->
    <div class="chat-windows"></div>
    <!-- -------------------------------------------------------------- -->
    <!-- All Jquery -->
    <!-- -------------------------------------------------------------- -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/app.init.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
   <script src="dist/js/feather.min.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <!--This page plugins -->
    <script src="dist/js/pages/contact/contact.js"></script>
    <script src="assets/libs/ckeditor/ckeditor.js"></script>
    <script src="assets/libs/ckeditor/samples/js/sample.js"></script>
    <script>
        $(document).ready(function(){
            $("#one").click(function(){
               $(".pagi").slideDown();
            });

            $("#all").click(function(){
               $(".pagi").slideUp();
            });

            $("#mark").click(function(){
               $(".marking").slideToggle();
            });

        });
    </script>
</body>

</html>