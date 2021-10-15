<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
   if(isset($_GET['cls'])){
    $subid = $_GET['cls'];
  
}
?>
<DOCTYPE html>
  <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    </head>
    <body>
      <div class="container">
        <img src="image/04.jpg" class="rounded mx-auto d-block"  width="75%">

        <div class="sub mt-3">
          <?php
            $sub = $common->select("`subject_add`","`batch_id`='$subid'");
            if($sub){
              while($raw = mysqli_fetch_assoc($sub)){
              
          ?>
          <button type="button" class="btn btn-outline-primary"><?=$raw['subject_name'];?></button>
         <?php }}?>
        </div>

        <table class="table table-hover mt-3">
          <tr class="table-info">
            <th class="">অধ্যায়</th>
            <th class="">টপিক</th>
            <th class="">ক্লাস</th>
            <th class="">পরীক্ষা</th>
            <th class="">নোট</th>
          </tr>
          <tr>
            <td>
              All
            </td>
            <td>
              All is good
            </td>
            <td>
              <a href="">
                <img src="image/lecture.png" height="30px;">
              </a>
            </td>
            <td>
              <a href="">
                <img src="image/exam.png" height="30px;">
              </a>
            </td>
            <td>
              <a href="">
                <img src="image/note.png" height="30px;">
              </a>
            </td>
          </tr>
          <tr>
            <td>
              All
            </td>
            <td>
              All is good
            </td>
            <td>
              <a href="">
                <img src="image/lecture.png" height="30px;">
              </a>
            </td>
            <td>
              <a href="">
                <img src="image/exam.png" height="30px;">
              </a>
            </td>
            <td>
              <a href="">
                <img src="image/note.png" height="30px;">
              </a>
            </td>
          </tr>
        </table>
      </div>
      
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>