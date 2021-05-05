<?php
//
// Конттроллер страницы чтения.
//
//echo $_GET['act'];
class C_Task extends C_Base
{
	public $name = 'go';//$_SESSION['session_login'];
	public $user_id = '1';//$_SESSION['session_id'];
	//
	// Конструктор.
	//
	function __construct()
	{		
		//parent::__construct();
		$this->mTask = M_Task::Instance();;
	}
	
	
	//Список пользователей
	public function action_index() {
		
		$this->title .= '::Task list';
		$mTask = M_Task::Instance();
		$name=$this->name;
		$task = $mTask->task_all($name);
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
			
			$mTask = M_Task::Instance();
			$mTask->add_desc($user_id, $description);
			header("Location:index.php?act=index");
			//$this->content = $this->Template('./v/index.php', array('array'=>$array, 'error' => $error ));
          
	}

	public function action_ready_all(){
		$user_id=$this->user_id;
		$mTask = M_Task::Instance();
		$mTask->ready_all($user_id);
		header("Location:index.php?act=index");
	}
	
    
	public function action_delete_all(){
			$user_id = $this->user_id;
			$mTask = M_Task::Instance();
			$mTask->delete_all($user_id);
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
		$mTask = M_Task::Instance();
		$mTask->ready_task($num,$id_task,$user_id);
		header("Location:index.php?act=index");
	}
	
	public function action_delete(){
		$id_task=htmlspecialchars($_POST["num"]);
		$user_id=$this->user_id;
		$mTask = M_Task::Instance();
		$mTask->delete_task($id_task,$user_id);
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
	
	
