<?php
   

    $id = $_POST['id'];
   
    $result = $common->select("`subject_add`","`batch_id`='$id' ORDER BY 'id' DESC");

?>
<option>Choose Your Option</option>
<?php
    while($raw = mysqli_fetch_array($result)){

?>
<option value="<?=$raw['id'];?>"><?=$raw['subject_name'];?></option>
<?php }?>

<?php
    $id = $_GET['bid'];
    $result = $common->select("`add_exam`","`batch_id`='i")
?>
    