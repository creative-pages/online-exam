
   <?php
  
class User
{
	private $db;
	private $fm;
	public function __construct()
	{
	$this->db= new Database;
	$this->fm= new Format;
	}

	

	public function insertuser($data)
	{
    $name         = $this->fm->validation($data['name']);
		$email        = $this->fm->validation($data['email']);
    $password     = $this->fm->validation($data['password']);
    $repass       = $this->fm->validation($data['repass']);
    $phone        = $this->fm->validation($data['phone']);
    $address      = $this->fm->validation($data['address']);
   
    $village      = $this->fm->validation($data['village']);
    $distric      = $this->fm->validation($data['distric']);
   
    $thana        = $this->fm->validation($data['thana']);  

     $name         = mysqli_real_escape_string($this->db->link,$name);
     $email        = mysqli_real_escape_string($this->db->link,$email);
     $password     = mysqli_real_escape_string($this->db->link,md5($password));
     $repass       = mysqli_real_escape_string($this->db->link,md5($repass));
     $phone        = mysqli_real_escape_string($this->db->link,$phone);
     $address      = mysqli_real_escape_string($this->db->link,$address);
     
     $village      = mysqli_real_escape_string($this->db->link,$village);
     $distric     = mysqli_real_escape_string($this->db->link,$distric);
     
     $thana        = mysqli_real_escape_string($this->db->link,$thana);

      if ($name == ''||$password == ''||$repass == ''||$phone =='') {
      	$msg="<div class='alert alert-warning alert-dismissible fade show'>
             <strong>Warning!</strong> Field Must not be emty 
             <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
   	return $msg;
      }else if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
        $msg="<div class='alert alert-warning alert-dismissible fade show'>
             <strong>Warning!</strong>Invalid Email
             <button type='button' class='close' data-dismiss='alert'>&times;</button> </div>";
	 	return $msg;
      }
      elseif($password!=$repass){
        $msg="<div class='alert alert-warning alert-dismissible fade show'>
        <strong>Warning!</strong>Password doesnot match.
        <button type='button' class='close' data-dismiss='alert'>&times;</button> </div>";
      return $msg;
      }
      else if(strlen($password)<6){
       $msg="<div class='alert alert-warning alert-dismissible fade show'>
        <strong>Warning!</strong>Password too short
        <button type='button' class='close' data-dismiss='alert'>&times;</button> </div>";
      return $msg;
      }
      else if(strlen($phone)>11 ){
        $msg="<div class='alert alert-warning alert-dismissible fade show'>
        <strong>Warning!</strong>Please enter correct phone number....
        <button type='button' class='close' data-dismiss='alert'>&times;</button> </div>";
      return $msg;
      }
    
        else{
   
      	$checkquery= "SELECT * FROM tbl_user WHERE email ='$email'";
      	$chkresult = $this->db->select($checkquery);
      	if ($chkresult != false) {
      	 $msg="<div class='alert alert-warning alert-dismissible fade show'>
             <strong>Warning!</strong> Email Already Taken.
             <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
	 	return $msg;
      	 } 
      	 else{
        $query  = "INSERT INTO tbl_user(name,email,password,repass,phone,address,village,distric,thana) VALUES('$name','$email','$password','$repass','$phone','$address','$village','$distric','$thana')";
      $insert_row = $this->db->insert($query);
      if ($insert_row) {
       $msg =  "<div class='alert alert-success alert-dismissible fade show'>
             <strong>Success!</strong> Registration Succesfully.You can login here
             <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
                Session::set("msg",$msg);
             echo "<script> window.location.assign('login.php'); </script>";
      }else{
      	$msg =  "<span class='error'>Registration Not Succesfully</span>!!";
       return $msg;
      	 }	
      }
      }
	}
	public function Userlogin($data){

	  $phone = $this->fm->validation($data['phone']);
    $password = $this->fm->validation($data['password']);
    $phone = mysqli_real_escape_string($this->db->link,$phone);
    $password = mysqli_real_escape_string($this->db->link,MD5($password));
     if ($phone == ''||$password == '') {
      	$msg="<div class='alert alert-warning alert-dismissible fade show'>
             <strong>Warning!</strong> Field Must not be emty 
             <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    return $msg;
      
      }else{
      	$query="SELECT * FROM tbl_user WHERE phone= '$phone' AND password= '$password'";
      	$result =$this->db->select($query);
      	if ($result != false) {
              $value =  $result->fetch_assoc();
             if ($value['status']==2) {
                $msg="<div class='alert alert-error alert-dismissible fade show'>
                <strong>Error!</strong>Your Acaunt is Disabled Now..
                <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
                return $msg;
              }
              else{
        		//	Session::init();
              Session::set("login",true);
              Session::set("id",$value['id']);
              Session::set("phone",$value['phone']);
              Session::set("email",$value['email']);
              Session::set("name",$value['name']);
		     echo "<script> window.location.assign('index.php'); </script>";
        //header("Location:dashboard.php");
              }
      }else{
      	$msg="<div class='alert alert-warning alert-dismissible fade show'>
             <strong>Warning!</strong> Phone AND Password Does not match 
             <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    return $msg;
      
      }
}

}
 public function ViewProfile($id){
  $query="SELECT * FROM tbl_user WHERE id = '$id'";
  $result =$this->db->select($query);
  return $result;
 }
 public function UserUpdate($data,$id){
  $name         = $this->fm->validation($data['name']);
  $email        = $this->fm->validation($data['email']);
  
  $phone        = $this->fm->validation($data['phone']);
  $address      = $this->fm->validation($data['address']);
  
  $village      = $this->fm->validation($data['village']);
  $distric     = $this->fm->validation($data['distric']);
 
  $thana        = $this->fm->validation($data['thana']);  

   $name         = mysqli_real_escape_string($this->db->link,$name);
   $email        = mysqli_real_escape_string($this->db->link,$email);
  
   $phone        = mysqli_real_escape_string($this->db->link,$phone);
   $address      = mysqli_real_escape_string($this->db->link,$address);
   
   $village      = mysqli_real_escape_string($this->db->link,$village);
   $distric     = mysqli_real_escape_string($this->db->link,$distric);
   
   $thana        = mysqli_real_escape_string($this->db->link,$thana);
   $query= "UPDATE tbl_user
   SET
   name= '$name',
   email= '$email',
   phone= '$phone',
   address= '$address',
  
   village= '$village',
   distric= '$distric'
   WHERE id= '$id'
"; 
$updated_row= $this->db->update($query);
if ($updated_row) {
  $msg =  "<div class='alert alert-info alert-dismissible fade show'>
             <strong>Success!</strong> User UPDATE Success
             <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
       return $msg;
}
else{
 $msg="<span class='error'>Not UPDATE</span>";
 return $msg;
}
 }

 public function AllUser(){
  $query="SELECT * FROM tbl_user";
  $result =$this->db->select($query);
  return $result;

 }

 public function ActiveUser($id){
      $query= "UPDATE tbl_user
      SET
      status= '0'
      
      WHERE id= '$id'
    "; 
    $updated_row= $this->db->update($query);
    if ($updated_row) {
    $msg =  "<div class='alert alert-info alert-dismissible fade show'>
                <strong>Success!</strong>User Active Succesfully...
                <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
          return $msg;
    }
    else{
    $msg="<span class='error'>Not UPDATE</span>";
    return $msg;
    }
    }

    public function DisibleUser($id){
      $query= "UPDATE tbl_user
      SET
      status= '2'
      
      WHERE id= '$id'
    "; 
    $updated_row= $this->db->update($query);
    if ($updated_row) {
    $msg =  "<div class='alert alert-info alert-dismissible fade show'>
                <strong>Success!</strong>User Active Succesfully...
                <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
          return $msg;
    }
    else{
    $msg="<span class='error'>Not UPDATE</span>";
    return $msg;
    }
    }
       public function Tuser(){
       $query="SELECT * FROM tbl_user";
        $result =$this->db->select($query);
      if($result!=NULL){
          $row = $result->num_rows;
          return $row;
      }
  }
  
   public function TOrder(){
       $query="SELECT * FROM odr_tbl";
        $result =$this->db->select($query);
      if($result!=NULL){
        $row = $result->num_rows;
         return $row;
      }
  }
  
  public function AllOrder(){
 
   $query = "SELECT odr_tbl.*,tbl_user.name
            FROM odr_tbl
            INNER JOIN tbl_user
            ON odr_tbl.user_id= tbl_user.id
            
            ORDER BY odr_tbl.date DESC";
            $result= $this->db->select($query);
            return $result;
    $result= $this->db->select($query);
    return $result;

 }
 
 public function Delivery($id){
      $query= "UPDATE odr_tbl
      SET
      status= '1'
      
      WHERE id= '$id'
    "; 
     $updated_row= $this->db->update($query);
    if ($updated_row) {
    $msg =  "<div class='alert alert-info alert-dismissible fade show'>
                <strong>Success!</strong>Delivery Succesfully...
                <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
          return $msg;
    }
}
public function PasswordChange($data,$id){
  $cpass = $this->fm->validation($data['cpass']);
  $npass = $this->fm->validation($data['npass']);
  $conpass = $this->fm->validation($data['conpass']);
  //$cpass = mysqli_real_escape_string($this->db->link,MD5($cpass));
  //$npass = mysqli_real_escape_string($this->db->link,MD5($npass));
 // $conpass = mysqli_real_escape_string($this->db->link,MD5($conpass));
  if($cpass ==''|| $npass ==''|| $conpass =='' ){
    $msg ="<div class='alert alert-warning alert-dismissible fade show'>
    <strong>Error!</strong>field Must Not Be Emty...
    <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
  return $msg;
  }
  else if($npass!=$conpass){
    $msg ="<div class='alert alert-warning alert-dismissible fade show'>
    <strong>Error!</strong>Password doesnot match...
    <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
  return $msg;
  }
  $cpass = mysqli_real_escape_string($this->db->link,MD5($cpass));
  $query="SELECT * FROM tbl_user WHERE password= '$cpass' AND id= '$id'";
  $result =$this->db->select($query);
  if($result==false){
    $msg ="<div class='alert alert-warning alert-dismissible fade show'>
    <strong>Error!</strong>Old Password Doesnot exit...
    <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
  return $msg;
  }else{
     $npass = mysqli_real_escape_string($this->db->link,MD5($npass));
     $conpass = mysqli_real_escape_string($this->db->link,MD5($conpass));
     $query= "UPDATE tbl_user
     SET
     password= '$npass',
     repass= '$conpass'
     WHERE id= '$id'
   "; 
   $updated_row= $this->db->update($query);
   if ($updated_row) {
   $msg =  "<div class='alert alert-info alert-dismissible fade show'>
               <strong>Success!</strong>Password Change Succesfully...
               <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
         return $msg;
   }

  }

}
public function ResetPass($data){
  $email = $this->fm->validation($data['email']);
 
  $email = mysqli_real_escape_string($this->db->link,$email);
  if($email==""){
    $msg ="<div class='alert alert-warning alert-dismissible fade show'>
    <strong>Error!</strong> Field Must Not be empty...
    <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
  return $msg;
  }
  $query="SELECT * FROM tbl_user WHERE email='$email'";
  $result =$this->db->select($query);
  if($result ==false){
    $msg ="<div class='alert alert-warning alert-dismissible fade show'>
    <strong>Error!</strong> Email Doesnot exit...
    <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
  return $msg;
  }else{
    $code = '123456789qazwsxedcrfvtgbyhnujmikolp';
    $code = str_shuffle($code);
    $code = substr($code,0, 10);

  $alamat = "http://localhost/mri/reset.php?code=$code";
  $to = $email;
  $judul = "passwrod reset";
  $isi = "this is automatic email, dont repply. For reset your password please click this link ".$alamat;
  $headers = "From: 20xraffle@12.com" . "\r\n";
  mail($to,$judul,$isi,$headers);
  }
}
public function TotalMembers(){
  $query="SELECT * FROM tbl_user";
  $result =$this->db->select($query);
  if($result!=NULL){
   $total  = $result->num_rows;
      
  }else{
    $total=0;
  }
  return $total;
}
public function TotalProduct(){
  $query="SELECT * FROM product_tbl ";
  $result =$this->db->select($query);
  if($result!=NULL){
   $total  = $result->num_rows;
      
  }else{
    $total=0;
  }
  return $total;
}
public function DeleteO($id)
{
  $query="DELETE FROM odr_tbl WHERE id='$id'";
  $result =$this->db->delete($query);
  if ($result) {
    $msg =  "<div class='alert alert-info alert-dismissible fade show'>
               <strong>Success!</strong>Succesfully Deleted...
               <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
         return $msg;
  }
}
public function UserbyId($ido)
{
    $query="SELECT * FROM tbl_user  WHERE id='$ido'";
        $result =$this->db->select($query);
     
          return $result;
}
public function DeleteUser($id)
{
   $query="DELETE FROM tbl_user WHERE id='$id'";
  $result =$this->db->delete($query);
  if ($result) {
    $msg =  "<div class='alert alert-info alert-dismissible fade show'>
               <strong>Success!</strong>Succesfully Deleted...
               <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
         return $msg;
  }
}
}	

?>

     
   
         
       