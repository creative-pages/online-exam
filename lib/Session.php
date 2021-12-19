<?php
class Session{
	 public static function init(){
	 //	session_start();
	 }
	 
	 public static function set($key, $val){
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key){
	 	if (isset($_SESSION[$key])) {
	 		return $_SESSION[$key];
	 	} else {
	 		return false;
	 	}
	 }

	
     public static function checkAdminSession(){
	 	//self::init();
	 	if (self::get("adminLogin") == false) {
	 		self::destroy();
	 		header("Location:index.php");
	 	}
	 }
	  public static function checkAdminLogin(){
	 	//self::init();
	 	if (self::get("adminLogin") == true) {
	 		header("Location:dashboard.php");
	 	}
	 }
	  public static function checkSession(){
	 	
	 	if (self::get("login") == false) {
	 		self::destroy();
	 		header("Location:login.php");
	 	}
	 }
	    public static function checkLogin(){
	 	
	 	if (self::get("login") == true) {
	 		header("Location:dashboard.php");
	 	}
	 }

	 public static function StudentSignIn(){
	 	
		if (self::get("SignIn") == false) {
			self::destroy();
			header("Location:signin.php");
		}
	}

	public static function CheckStudentSignIn(){
	 	
		if (self::get("SignIn") == true) {
			self::destroy();
			header("Location:student-profile.php");
		}
	}

	 public static function destroy(){
		// self::init();
	 	session_destroy();
	 	
	 }
}

?>