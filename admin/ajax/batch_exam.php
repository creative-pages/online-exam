<?php
    require_once '../../init.php';
    $exam = new Exam();
    $common = new Common();
?>
<div class="row">
<?php
 $id = $_GET['bid'];
 if($id != 'all' && is_numeric($id)) {
    $query = $common->select("`add_exam`","`batch_id` = '$id' ORDER BY `id` DESC");
 } elseif($id == 'all') {
    $query = $common->select("`add_exam` ORDER BY `id` DESC");
 }
 
 if($query){
     while($value = mysqli_fetch_assoc($query)){
         $subject_id = $value['subject_id'];
         $subject_info = $common->select("`subject_add`", "`id` = '$subject_id'");
         $subject_infos = mysqli_fetch_assoc($subject_info);
    ?>
     <div class="col-md-4 col-xl-2 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white"><?= $value['examname'];?></h4></div>
            <div class="card-body">
                <h3 class="card-title text-muted py-1"style="border-bottom:1px dotted #EEF5F9;">Subject: <?= $subject_infos['subject_name'];?></h3>
                <h3 class="card-title text-muted py-1"style="border-bottom:1px dotted #EEF5F9;">Duration: <?= $value['duration'];?> Minute</h3>
                <h3 class="card-title text-muted py-1"style="border-bottom:1px dotted #EEF5F9;">Total Quetion: <?= $value['tquetion'];?></h3>
                <h3 class="card-title text-muted py-1"style="border-bottom:1px dotted #EEF5F9;">Exam Date: <?= $value['exmdate'];?></h3>
                
                <button type="button" class="btn btn-primary" onClick="examEdit(<?= $value['id']; ?>)">Edit</button>
                <a  href="edit-quetion.php?editque=<?= $value['id'];?>" class="btn btn-success">Quetion Edit</a>
                <!-- <a onclick ="return confirm('Do you Want to sure to delete?');" href="?dltque=<?= $value['id'];?>" class="btn btn-danger">Delete</a> -->
                <?php
                 $idexm = $value['id'];
                 $pub = $common->select("`publish_exam`","`exam_id` = '$idexm'");
                 
                 if($pub ){
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
} else {
echo "Not found";
}?>
            
        

