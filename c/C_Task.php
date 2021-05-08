<?php
//
// Конттроллер страницы чтения.
//

class C_Task extends C_Base
{
	public $name;
	public $user_id;
	//
	// Конструктор.
	//
	function __construct()
	{		
		parent::__construct();
		//$this->mTask = M_Task::Instance();
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
			$mTask = M_Task::Instance();
			$row=$mTask->login($login);
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
				$mTask->register($login, $password,$created_at);
				header("Location:index.php?act=index&&login=$login&&password=$password");
			} 
		}
		
	}
	
	//
	//Список пользователей
	//
	public function action_index() {
		
		$mTask = M_Task::Instance();
		$login = $_SESSION['session_login'];
		$task = $mTask->task_all($login);
		//буферизация данных, отправка в шаблон
		$this->content = $this->Template('./v/index.php', array('task' => $task));		
	}
	
	//
	// Добавить задачу
	//
	public function action_add(){
		
		if(!empty($_POST['description'])){
			$description=htmlspecialchars($_POST["description"]);
			$user_id=$_SESSION['session_id'];
			
		}
		$mTask = M_Task::Instance();
		$mTask->add_desc($user_id, $description);
		header("Location:index.php?act=index");
	}
	//
	// Изменить статус всех задач
	//

	public function action_ready_all(){
		$user_id=$_SESSION['session_id'];
		$mTask = M_Task::Instance();
		$mTask->ready_all($user_id);
		header("Location:index.php?act=index");
	}
	
    //
	// Удалить все задачи
	//
	public function action_delete_all(){
		$user_id = $_SESSION['session_id'];
		$mTask = M_Task::Instance();
		$mTask->delete_all($user_id);
		header("Location:index.php?act=index");
	}
	
	//
	// Изменить статус задачи(готово/не готово)
	//
	public function action_ready(){
		$id_task=htmlspecialchars($_POST["num"]);
		$stat=htmlspecialchars($_POST["stat"]);
		$user_id=$_SESSION['session_id'];
		if($stat =='не готово'){
			$num=1;
		} else{
			$num=0;
		} 
		$mTask = M_Task::Instance();
		$mTask->ready_task($num,$id_task,$user_id);
		header("Location:index.php?act=index");
	}
	//
	// Удалить задачу
	//
	public function action_delete(){
		$id_task=htmlspecialchars($_POST["num"]);
		$user_id=$_SESSION['session_id'];
		$mTask = M_Task::Instance();
		$mTask->delete_task($user_id, $id_task);
		header("Location:index.php?act=index");
	}
	
	//
    // Опеделить нужную функцию
    //
    public function action_delete_ready(){
		$submit=$_POST['sub'];
		if($submit=='READY ALL'){
			$this->action_ready_all();
		} else if($submit=='REMOVE ALL'){
			$this->action_delete_all();
		} else if(($submit=='READY')||($submit=='NO READY')){
			$this->action_ready();
		} else if($submit=='DELETE'){
			$this->action_delete();
		} else{
			echo "Произошла ошибка";
		}
	}
}
	
	
