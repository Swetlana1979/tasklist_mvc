<?php
	//
// Конттроллер страницы чтения.
//

class C_User extends C_Base{
	
	
	//
	// Конструктор.
	//
	function __construct()	{		
		
		parent::__construct();
		
	}
	
	//
	// Наследование
	//
	public function mUser() {
		
		return $this->mUser = M_User::Instance();
    }
	//
	// Разлогинивание
	//
	public function action_logout() {
		
		unset($_SESSION['session_login']);
		unset($_SESSION['session_id']);
		session_destroy();
		header("location:index.php?act=index");
		
	}
	
	//
	// Авторизация
	//
	public function action_login() {
		
		if((!empty($_POST['login'])&&(!empty($_POST['password'])))){
			$login = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			$mUser = $this->mUser();
			$row=$mUser->login($login);
			if(!empty($row)){
				$dblogin = $row[1];
				$dbpassword = $row[2];
				$hash = $row[4];
				$dbpass = password_verify($dbpassword, $hash);
				$user_id = $row[0];
				if($login == $dblogin && $dbpass){
					$_SESSION['session_login'] = $login;
					$_SESSION['session_id'] = $user_id;
					header("Location:index.php");
				} else {
					echo  "Invalid username or password!";
				}				
			} else {
				$created_at = date("Y-m-d H:i:s");
				$hash = password_hash($password, PASSWORD_BCRYPT);
				$mUser->register($login, $password, $created_at, $hash);
				header("Location:index.php?act=index&&login=$login&&password=$password");
			} 
		}
		
	}
}

?>