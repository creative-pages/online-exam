<?php
    require_once '../init.php';
    Session::StudentSignIn();
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
   $userid = Session::get('profileid');
 ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $payreq=$all->PaymentRequest($_POST,$userid);

    }

?>
<!DOCTYPE html>
  <html>
    <head>
    <link rel="stylesheet" href="dist/css/icons/css/fontawesome-all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    </head>
    <body>
        <div class="container " style="margin-top:100px;">
            <div class="login mx-auto shadow-sm p-3 mb-5 bg-body rounded" style="width:40%" >
            <?php
                   
                ?>
                <h5 class="text-center"><strong>Enter Your ID:</strong></h5>
                
                <form action = "" method="post">
                    <div class="input-group mb-3 mt-3">
                    
                        <input type="text" class="form-control" placeholder="Enter Your Payment Number" name="pnumber" aria-label="id" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3 mt-3">
                    
                        <input type="text" class="form-control" placeholder="Enter Transaction ID" name="tid" aria-label="id" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <select class="form-control form-select" name="method">
                            <option selected>Select Payment Method</option>
                            <option value="bkash">Bkash</option>
                            <option value="nogod">Nogod</option>
                            <option value="roket">Roket</option>
                            <option value="upay">Upay</option>
                            <option value="other">Other</option>
                        </select>
                        
                    </div>
                     <button type="submit" class="btn btn-info" name="submit">Submit</button>
                    
                </form>

            </div>

        </div>
        


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/js/fontawesome.js" integrity="sha512-KztwlgEJQSMSzA/TATxZbuZRRu582Aj8eWU5+y+JjkM8bPqemIT+LI9rqKBFCTO3yL4IcB+aS3DShs7WayqMEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>

</html> 