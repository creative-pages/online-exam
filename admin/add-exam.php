<?php include('inc/header.php'); ?>
<?php
    if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['save'])) {
        $addexam = $exam->AddExam($_POST);
    }

    if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['edit_main_exam'])) {
        $addexam = $exam->EditExam($_POST);
    }
    if(isset($_GET['editxm'])){
        $id =$_GET['editxm'];
        $exambyid = $exam->ExamById($id);
        $value = $exambyid->fetch_assoc();
    }
    if(isset($_GET['dltque'])){
        $dltid = $_GET['dltque'];
        $dltXmQue = $exam->DltXmQue($dltid);
    }

?>

<body>
   
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
       
        <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4">
                        Add Exam
                    </h4>
                    <form class="ps-3 pe-3 text-start" action="#"method="post">
                        <div class="mb-3">
                            <label for="username">Exam Name</label>
                            <input class="form-control" type="text" id="examname"
                                required="" placeholder="Enter Exam Name" name="examname">
                        </div>

                        <div class="mb-3">
                            <label for="username">Select Batch</label>
                                <select class="form-control"name= "batch" id="batch"  required="">
                                    <option value="">Select a batch</option>
                                    <?php
                                        $query = $common->select("`add_branch` ORDER BY `id` DESC");
                                        if($query){
                                            while($row = mysqli_fetch_assoc($query)){
                                         
                                    ?>
                                    <option value="<?=$row['id']?>"><?=$row['branch_name']?></option>
                                    <?php }} ?>
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="username">Select Subject</label>
                            <select class="form-select" id="subject" name="subject" required="">
                                <option>Choose Your Option</option>
                            </select>
                        </div>
                       
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary"name="save" type="submit">Save
                           </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
     <!-- /.End Modal -->
        <div class="page-wrapper">
            
            <div class="container-fluid">
                <div class="d-flex justify-content-between border-bottom title-part-padding px-0 mb-3 align-items-center">
                       
                        <div>
                            <a href="javascript:void(0)" class="btn btn-success"data-bs-toggle="modal"
                                data-bs-target="#signup-modal">Add New Exam</a>
                        </div>
                        <div class= "">
                            <select class="form-select" required="" name="chapter" id="exam_batch">
                                <option value="all">All Batch</option>
                                <?php 
                                $query = $common->select("`add_branch` ORDER BY id DESC");
                                if($query){
                                    while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <option value = "<?=$row['id']?>"><?=$row['branch_name']?></option>
                                <?php }} ?>
                            </select>
                        </div>
                        <?php
                            if(isset($dltque)){
                               echo $dltque;
                            }
                        ?>
                      </div>
                    
                    <div class="row" id = "allbatch">
                    <?php
                            $allxm = $exam->AllExamList();
                            if($allxm){
                                while($value = $allxm->fetch_assoc()) {
                                    $batch_id = $value['batch_id'];
                                    $subject_id = $value['subject_id'];
                                    $subject_info = $common->select("`subject_add`", "`id` = '$subject_id'");
                                    $subject_infos = mysqli_fetch_assoc($subject_info);
                                    $batch_info = $common->select("`add_branch`", "`id` = '$batch_id'");
                                    $batch_infos = mysqli_fetch_assoc($batch_info);
                            ?>
                             <div class="col-md-4 col-xl-2 d-flex align-items-stretch">
                                <div class="card w-100">
                                    <div class="card-header bg-primary">
                                        <h4 class="mb-0 text-white">
                                            <?= $value['examname'];?>
                                            <?php
                                                $idexm = $value['id'];
                                                $pub = $common->select("`publish_exam`","`exam_id` = '$idexm'");
                                                if($pub) {
                                                ?>
                                                <span class="badge bg-success float-end">Published</span>
                                                <?php
                                                } else {
                                                ?>
                                                <span class="badge bg-warning float-end">Unpublished</span>
                                                <?php
                                                }
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title text-success  py-1"style="border-bottom:1px dotted #EEF5F9;">Batch: <?= $batch_infos['branch_name'];?></h3>
                                        <h3 class="card-title text-muted py-1"style="border-bottom:1px dotted #EEF5F9;">Subject: <?= $subject_infos['subject_name'];?></h3>
                                        <h3 class="card-title text-muted py-1"style="border-bottom:1px dotted #EEF5F9;">Total Quetion: <?= $value['tquetion'];?></h3>
                                        
                                        <button type="button" class="btn btn-primary" onClick="examEdit(<?= $value['id']; ?>)">Edit</button>
                                        <?php
                                        if($value['status'] == '0') {
                                        ?>
                                        <a  href="add-quetion.php" class="btn btn-success">Add Question</a>
                                        <?php
                                        } else {
                                        ?>
                                        <a  href="edit-quetion.php?editque=<?= $value['id'];?>" class="btn btn-success">Quetion Edit</a>
                                        <?php
                                        }
                                        ?>

                                        <!-- <a onclick ="return confirm('Do you Want to sure to delete?');" href="?dltque=<?= $value['id'];?>" class="btn btn-danger">Delete</a> -->
                                        <?php
                                         
                                        if($pub){
                                            $result = mysqli_fetch_assoc($pub);
                                        ?>
                                         <a href="edit-setting.php?es=<?=$result['id'];?>" class="btn btn-info my-1"><i class="fa fa-cog" aria-hidden="true"></i>
                                            </a>
                                         <?php } else { ?> 
                                            <a href="setting.php?setting=<?=$value['id'];?>" class="btn btn-info my-1"><i class="fa fa-cog" aria-hidden="true"></i>
                                            </a>
                                            <?php } ?>   
                                        <a href="view-quetion.php?view=<?= $value['id'];?>" class="btn btn-info my-1"><i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        <a href="result.php?exam_id=<?= $value['id']; ?>" class="btn btn-info my-1">
                                            Result
                                        </a>
                                    </div>
                                </div>
                           </div>
                       <?php
                            }
                        }
                       
                        ?>
                        
                    </div>
            </div>
            
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
    <!-- exam-edit modal -------------------------------------------------------------- -->
    
    
    <div id="examedit-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4">
                        Exam Edit
                    </h4>
                    <form class="ps-3 pe-3 text-start" action="" method="post">
                        <input type="hidden" name="exam_hidden_id" id="exam_hidden_id">
                        <div class="mb-3">
                            <label for="edit_examname">Exam Name</label>
                            <input class="form-control" type="text" id="edit_examname" placeholder="Enter exam name" required="" name="examname">
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" name="edit_main_exam" type="submit">Save
                           </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
     <!-- /.End Modal -->
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
    <!-- This Page JS -->
    <script src="assets/extra-libs/prism/prism.js"></script>
    <script src="material/src/assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <script src="material/src/assets/extra-libs/toastr/toastr-init.js"></script>

    <script>
        function examEdit(id) {
            $.ajax({
                url:'ajax/exam-process.php',
                type:'POST',
                data:{
                    id: id,
                    exam_detail: 'exam_detail'
                },
                cache:false,
                success:function(result){
                    var response = JSON.parse(result);
                    $('#exam_hidden_id').val(response.id);
                    $('#edit_examname').val(response.examname);
                    $('#examedit-modal').modal('show');
                }
            })
        }
    </script>
      <script>
        $(document).ready(function(){
            $('#batch').on('change',function(){
                var id = this.value;
                $.ajax({
                    url:'ajax/subject.php',
                    type:'POST',
                    data:{
                        id:id
                    },
                    cache:false,
                    success:function(result){
                        $('#subject').html(result);
                    }
                })

            });

            $('#exam_batch').on('change',function(){
                var id = this.value;
                $.ajax({
                    url:'ajax/batch_exam.php',
                    data:{
                        type:'GET',
                        bid:id
                    },
                    cache:false,
                    success:function(result){
                        $('#allbatch').html(result);
                    }
                })

            });


        });
    </script>
</body>

</html>