<?php
    require_once '../../init.php';
  
    $exam = new Exam();
    $common = new Common();

    $id = $_POST['id'];
   
    $result = $common->select("`subject_add`","`batch_id`='$id' ORDER BY 'id' DESC");

?>
<option>Choose Your Option</option>
<?php
    while($raw = mysqli_fetch_array($result)){

?>
<option value="<?=$raw['id'];?>"><?=$raw['subject_name'];?></option>
<?php }?>
    