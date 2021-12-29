<?php
	$filepath = realpath(dirname(__FILE__));
    include_once ($filepath . '/../init.php');
	
class Admin
{
	private $db;
	private $fm;
	public function __construct()
	{
	$this->db= new Database;
	$this->fm= new Format;
	}
    public function getadmindata($data){

		$username = $this->fm->validation($data['username']);
		$password = $this->fm->validation($data['password']);
		$username = mysqli_real_escape_string($this->db->link,$username);
		//$password    = mysqli_real_escape_string($this->db->link,MD5($password));
		
		$query="SELECT * FROM tbl_admin WHERE username= '$username' AND password= '$password'";
		
		$result =$this->db->select($query);	
     
       	
		if ($result != false) {
			$value =  $result->fetch_assoc();
			Session::set("adminLogin",true);
			Session::set("username", $value['username']);
			
			Session::set("id", $value['id']);
			echo "<script> window.location.assign('dashboard.php'); </script>";
			//header("Location:admin-dashboard.php");
			} else {
			 $msg = "<span style='color:red'>Email And Password Does Not Match</span>";
       return $msg;
			}
		
	}
	public function privacyPolicy()
	{
			$query ="SELECT * FROM  privacy_tbl";
		  $result = $this->db->select($query);	
		  return $result;
	}
	public function Updateprivacy($data)
	{
		$privacy = $this->fm->validation($data['privacy']);
		 $query = "UPDATE privacy_tbl
      SET
      privacy        = '$privacy'
    
      WHERE id    = '1'
                ";
       $update_privacy = $this->db->update($query);
       if ($update_privacy) {
         $msg="<div class='alert alert-success alert-dismissible fade show'>
         <strong>Success!</strong> Update Succesfully
       <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
        return $msg;
        } 
	}
}
?>