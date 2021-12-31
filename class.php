<?php
    require_once 'init.php';
    $all = new All();
    $exam = new Exam();
    $common = new Common();
?>
<?php
  if(isset($_GET['cls'])){
    $batch_id = $_GET['cls'];
    $sub = $common->select("`subject_add`", "`batch_id`='$batch_id'");
  }
?>

<DOCTYPE html>
  <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    </head>
    <body>
      <div class="container">
        <img src="image/04.jpg" class="rounded mx-auto d-block"  width="75%">

        <ul class="nav nav-pills mb-3 mt-5" id="pills-tab" role="tablist">
          <?php
            if($sub){
              $sl = '1';
              while($raw = mysqli_fetch_assoc($sub)){
              ?>
              <li class="nav-item" role="presentation">
                <button class="nav-link<?= $sl == 1 ? ' active' : ''; ?>" id="pills-s<?= $sl; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-s<?= $sl; ?>" type="button" role="tab" aria-controls="pills-s<?= $sl; ?>" aria-selected="<?= $sl == 1 ? 'true' : 'false'; ?>"><?=$raw['subject_name'];?></button>
              </li>
              <?php
              $sl++;
              }
            }
          ?>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <?php
            $sub = $common->select("`subject_add`", "`batch_id` = '$batch_id'");
            if($sub){
              $csl = '1';
              while($raw = mysqli_fetch_assoc($sub)){
              ?>
              <div class="tab-pane fade<?= $csl == 1 ? ' show active' : ''; ?>" id="pills-s<?= $csl; ?>" role="tabpanel" aria-labelledby="pills-s<?= $csl; ?>-tab">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-hover mt-3">
                      <tr class="table-info">
                        <th class="">অধ্যায়</th>
                        <th class="">টপিক</th>
                        <th class="">ক্লাস</th>
                        <th class="">নোট</th>
                      </tr>
                      <?php
                      $tid = $raw['id'];
                      $topics = $common->select("`class_add`","`subject_id`='$tid' ORDER BY `chapter` ASC");
                          if($topics){
                            while($rows = mysqli_fetch_assoc($topics)){
                      ?>
                      <tr>
                        <td>
                          <?=$rows['chapter'];?>
                        </td>
                        <td>
                        <?=$rows['topic'];?>
                        </td>
                        <td>
                          <a href="">
                            <img src="image/lecture.png" height="30px;">
                          </a>
                        </td>
                        <td>
                          <a href="">
                            <img src="image/note.png" height="30px;">
                          </a>
                        </td>
                      </tr>
                      <?php
                      }
                    } else {
                    ?>
                    <tr>
                      <td class="text-center" colspan="4">
                        No topic available.
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table class="table table-hover mt-3">
                      <tr class="table-info">
                        <th class="">Serial</th>
                        <th class="">Exam Name</th>
                        <th class="">Exam Link</th>
                      </tr>
                      <?php
                      $serial = 1;
                      $subject_id = $raw['id'];
                      $all_exam = $common->select("`add_exam`", "`batch_id` = '$batch_id' && `subject_id` = '$subject_id' ORDER BY `id` DESC");
                      if($all_exam) {
                        while($all_exams = mysqli_fetch_assoc($all_exam)) {
                          $exam_id = $all_exams['id'];
                          $exam_publish_info = $common->select("`publish_exam`", "`exam_id` = '$exam_id'");
                      ?>
                      <tr>
                        <td>
                          <?= $serial; ?>
                        </td>
                        <td>
                          <?= $all_exams['examname']; ?>
                        </td>
                        <td>
                          <?php
                          if($exam_publish_info && $all_exams['status'] == '1') {
                          ?>
                          <a href="start-exam.php?xmid=<?= $all_exams['id']; ?>" class="btn btn-outline-primary btn-sm">
                            Exam Link
                          </a>
                          <?php
                          } else {
                            echo '<span class="badge badge-pill bg-info">Coming soon</span>';
                          }
                          ?>
                          
                        </td>
                      </tr>
                      <?php
                      $serial++;
                      }
                    } else {
                    ?>
                    <tr>
                      <td class="text-center" colspan="3">
                        No exam available.
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </table>
                  </div>
                </div>
              </div>
              <?php
              $csl++;
              }
            }
            ?>
        </div>
      </div>
      
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"   crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>