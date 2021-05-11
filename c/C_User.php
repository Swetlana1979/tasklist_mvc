<?php
	//
// Конттроллер страницы чтения.
//

class C_User extends C_Base{
	
	public $name;
	public $user_id;
	//
	// Конструктор.
	//
	function __construct()
	{		
		parent::__construct();
		$this->mUser = M_User::Instance();
	}
	
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
			$mUser = M_User::Instance();
			$row=$mUser->login($login);
			if(!empty($row)){
				$dblogin = $row[1];
				$dbpassword = $row[2];
				$user_id = $row[0];
				if($login == $dblogin && $password == $dbpassword){
					$_SESSION['session_login'] = $login;
					$_SESSION['session_id'] = $user_id;
					header("Location:index.php");
				} else {
					echo  "Invalid username or password!";
				}				
			} else {
				$created_at = date("Y-m-d H:i:s");
				$mUser->register($login, $password,$created_at);
				header("Location:index.php?act=index&&login=$login&&password=$password");
			} 
		}
		
	}
}
?>