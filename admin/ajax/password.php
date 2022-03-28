<?php
    require_once '../../init.php';
    $common = new Common();
?>
<?php
if(isset($_POST['get_username']))
{
 $user_name=str_replace(' ', '', $_POST['get_username']);
 random_username($user_name);
 exit();
}

function random_username($user_name)
{
 $new_name = $user_name.mt_rand(0,10000);
 check_user_name($new_name,$user_name);
}

function check_user_name($new_name,$user_name)
{
    $common = new Common();
    $result = $common->select("`users`","`password`='$new_name");
 //$select = mysql_query("select * from users where username='$new_name'");

 if($result)
 {
  random_username($user_name);
 }
 else
 {
  echo $new_name;
 }
}
