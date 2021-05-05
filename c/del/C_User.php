<?php
//
// Конттроллер страницы чтения.
//
//echo $_GET['act'];
class C_User extends C_Base
{
	public $name = 'go';//$_SESSION['session_login'];
	public $user_id = '1';//$_SESSION['session_id'];
	//
	// Конструктор.
	//
	function __construct()
	{		
		//parent::__construct();
		$this->mUser = M_User::Instance();;
	}
	
	
	//Список пользователей
	public function action_index() {
		
		$this->title .= '::Task list';
		$mUser = M_User::Instance();
		$name=$this->name;
		$task = $mUser->task_all($name);
		//буферизация данных, отправка в шаблон
		$this->content = $this->Template('./v/index.php', array('task' => $task,'table'=>$table));	
	}
	
	public function action_add(){
		//if(isset($_POST["add_desc"])){
			if(!empty($_POST['description'])){
				//$created_at=date("Y-m-d H:i:s");
				$description=htmlspecialchars($_POST["description"]);
				$user_id=$this->user_id;
				
			}
			
			$mUser = M_User::Instance();
			$mUser->add_desc($user_id, $description);
			header("Location:index.php?act=index");
			//$this->content = $this->Template('./v/index.php', array('array'=>$array, 'error' => $error ));
          
	}

	public function action_ready_all(){
		$user_id=$this->user_id;
		$mUser = M_User::Instance();
		$mUser->ready_all($user_id);
		header("Location:index.php?act=index");
	}
	
    
	public function action_delete_all(){
			$user_id = $this->user_id;
			$mUser = M_User::Instance();
			$mUser->delete_all($user_id);
			header("Location:index.php?act=index");
				         
	}
	public function action_ready(){
		$id_task=htmlspecialchars($_POST["num"]);
		$stat=htmlspecialchars($_POST["stat"]);
		$user_id=$this->user_id;
		if($stat =='не готово'){
			$num=1;
		} else{
			$num=0;
		} 
		$mUser = M_User::Instance();
		$mUser->ready_task($num,$id_task,$user_id);
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
		} else{
			echo'Произошла ошибка';
		}
	}
}
	
	
