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
		
		$query="SELECT * FROM admins WHERE users= '$username' AND password= '$password'";
		
		$result =$this->db->select($query);	
     
       	
		if ($result != false) {
			$value =  $result->fetch_assoc();
			Session::set("adminLogin",true);
			Session::set("username", $value['users']);
			
			Session::set("id", $value['id']);
			echo "<script> window.location.assign('dashboard.php'); </script>";
			//header("Location:admin-dashboard.php");
			} else {
			 $msg = "<span style='color:red'>Email And Password Does Not Match</span>";
       		return $msg;
			}
		
	}
	public function StudentSignIn($data){
		$id = $this->fm->validation($data['id']);
		$password = $this->fm->validation($data['password']);
		$id = mysqli_real_escape_string($this->db->link,$id);
		//$password    = mysqli_real_escape_string($this->db->link,MD5($password));
		
		$query = "SELECT * FROM users  WHERE id = '$id' AND password = '$password'";
		$result =$this->db->select($query); 
	 
		if ($result != false) {
		$value = $result->fetch_assoc();
		Session::set("SignIn", true);
		Session::set("name", $value['nname']);
		Session::set("profileid", $value['id']);
		echo "<script> window.location.assign('student/batch.php'); </script>";
		} else {
			return "<div class='alert alert-warning'>Email And Password Does Not Match</div>";
		}
	}
}
?>