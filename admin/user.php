<?php include('inc/header.php'); ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['add'])){
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $contack = $_POST['contack'];
        $password = $_POST['password'];
        $per = $_POST['per'];
        $equery = $common->select("`users`","`email`='$email'");
        $cquery = $common->select("`users`","`contack`='$contack'");
        if($equery != false) {
            $email_error = "<div class='alert alert-warning mb-0 py-2'>Email Already Exists!</div>";
        } elseif($cquery != false) {
            $contact_error = "<div class='alert alert-warning mb-0 py-2'>Student Contact Already Exists!</div>";
        } else {
            $success =$common->insert("`users`(`name`,`email`,`contack`,`per`,`password`)","('$name', '$email', '$contack','$per','$password')");
            if($success){
                $msg = "<div class='alert alert-success mb-0 py-2'>Data Insert Successfully!</div>";
            }
            else{
                $msg = "<div class='alert alert-warning mb-0 py-2'>Data Insert not Successfully!</div>";
            }
        }
    }
    //update section
    if($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['edit'])){
        $user_id  = $_POST['user_id'];
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $contack = $_POST['contack'];
        $password = $_POST['password'];
        $per = $_POST['per'];
        $update_result = $common->update("`users`", "`name` = '$name',`email` = '$email',`contack` = '$contack',`password` = '$password',`per` = '$per'", "`id` = '$user_id'");
        if($update_result){
            $updatemsg = "<div class='alert alert-success mb-0 py-2'>Data Update Successfully!</div>";
        }
    }

    if(isset($_GET['dltuser'])){
        $user_id = $_GET['dltuser'];
        $deleteuser = $common->delete("`users`", "`id` = '$user_id'");
        if($deleteuser){
            $deleteweek = $common->delete("`weekly_status`", "`user_id` = '$user_id'");
            if($deleteweek){
                $deletepay = $common->delete("`payments`", "`user_id` = '$user_id'");
                if($deletepay){
                    $dltmsg = "<div class='alert alert-warning mb-0 py-2'>Data Delete Successfully!</div>";
                }
            }
        }
    }
	
    if(isset($_GET['unpublish_id'])){
        $unpublish_id = $_GET['unpublish_id'];
        $common->update("`add_branch`", "`status` = 'unpublished'", "`id` = '$unpublish_id'");
      	header("Location: https://mediexamdoctest.com/admin/add-branch.php");
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
                <div class="widget-content searchable-container list">
                    <div class="card card-body">
                        <div class="row">
                                <div class="col-md-4 col-xl-2">
                                    <form>
                                        <input type="text" class="form-control product-search" id="input-search" placeholder="Search...">
                                    </form>
                                </div>
                                <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                                        <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info">
                                         Add New User</a>
                                </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Add New User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action=""method="post">
                                    <div class="modal-body">
                                        <div class="add-contact-box">
                                            <div class="add-contact-content">
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="text" id="c-location" class="form-control" placeholder="Enter User Name"name="name" required="" id="name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="email" id="c-location" class="form-control" placeholder="Enter User email"name="email" required="">
                                                            <?= isset($email_error) ? $email_error : '';?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="text" id="c-location" class="form-control" placeholder="Enter User Contack "name="contack" pattern=".{11,11}" required title="Please Input Only 11 digit" required="">
                                                            <?= isset($contact_error) ? $contact_error : '';?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="text" id="c-location" class="form-control" placeholder="Enter User Password "name="password" required="">
                                                            <?= isset($contact_error) ? $contact_error : '';?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="number" id="c-location" class="form-control" placeholder="Enter User percentage "name="per" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p id="username"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btn-add" class="btn btn-success rounded-pill px-4" name="add">Add</button>
                                        <button id="btn-edit" class="btn btn-success rounded-pill px-4">Save</button>
                                    </div>
                               </form> 
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                    <h5 class="modal-title">Add New User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action=""method="post">
                                    <div class="modal-body">
                                        <div class="add-contact-box">
                                            <div class="add-contact-content">
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                        <input type="hidden" class="form-control" name="user_id" required="" id="user_id">
                                                            <input type="text" class="form-control" name="name" required="" id="name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="email"  class="form-control" name="email" id="email" required="">
                                                            <?= isset($email_error) ? $email_error : '';?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="text" class="form-control" name="contack" pattern=".{11,11}" required title="Please Input Only 11 digit"id="contack" required="">
                                                            <?= isset($contact_error) ? $contact_error : '';?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="text" class="form-control" name="password" id="password" required="">
                                                            <?= isset($contact_error) ? $contact_error : '';?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3 contact-location">
                                                            <input type="number" class="form-control" name="per" id="per" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btn-add" class="btn btn-success rounded-pill px-4" name="edit">Edit</button>
                                    </div>
                               </form> 
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                      <?= isset($msg) ? $msg : ''; ?>
                      <?= isset($updatemsg) ? $updatemsg : ''; ?>
                      <?= isset($dltmsg) ? $dltmsg : ''; ?>
                        <div class="table-responsive">
                            <table class="table search-table v-middle">
                                <thead class="header-item">
                                    <th>Sl No</th>
                                    <th>User Name</th>
                                    <th>Action</th>
                                    <th>User ID</th>
                                  	<th>User Password</th>
                                    <th>User Email</th>
                                    <th>User Contack</th>
                                    <th>Join Date</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $result = $common->select("`users` ORDER BY `id` DESC");
                                        if($result){
                                            $i=1;
                                            while($value = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr class="search-items">
                                        <td>
                                            <span class="usr-email-addr"><?=$i;?></span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?=$value['name'];?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-btn">
                                                <button type="button" class="btn btn-primary btn-sm mb-1" onClick="UserEdit(<?= $value['id']; ?>)">Edit
                                                </button>
                                              	  <a href="payment.php?user=<?=$value['id'];?>" class="btn btn-warning btn-sm mb-1">
                                                      Payment
                                                  </a>
                                              	 
                                              	  <a onclick="return confirm('Are you sure to delete?')" href="?dltuser=<?=$value['id'];?>" class="btn btn-danger btn-sm">
                                                        <i data-feather="trash-2" class="feather-sm fill-white"></i>
                                                        Delete
                                                    </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?=$value['id'];?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                                <?=$value['password'];?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="usr-ph-no">
                                            <?=$value['email'];?>
                                            </span>
                                        </td>
                                      	<td>
                                            <span class="usr-ph-no">
                                            <?=$value['contack'];?>
                                            </span>
                                        </td>
                                        
                                        <td>
                                            <span class="usr-ph-no">
                                                <?=$fm->formatDate($value['created_on']);?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                        }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------- -->
                <!-- End PAge Content -->
                <!-- -------------------------------------------------------------- -->
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
<script>
function get_username()
{
 var name=$("#name").val();
 if(name!="")
 {
  $.ajax
  ({
   type:'post',
   url:'password.php',
   data:{
    get_username:name
   },
   success:function(response) 
   {
    $("#username").css({"display":"block"});
   }
  });
 }
}
</script>
<script>
    function UserEdit(id) {
        $.ajax({
            url:'https://foklorit.com/upwork/admin/ajax/user-edit.php',
            type:'POST',
            data:{
                id: id,
                user_detail: 'user_detail'
            },
            cache:false,
            success:function(result){
                var response = JSON.parse(result);
                $('#user_id').val(response.id);
                $('#name').val(response.name);
                $('#email').val(response.email);
                $('#contack').val(response.contack);
                $('#password').val(response.password);
                $('#per').val(response.per);
                $('#editmodal').modal('show');
            }
        })
    }
</script>
</body>

</html>