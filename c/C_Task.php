<?php
//
// Конттроллер страницы чтения.
//

class C_Task extends C_Base
{
	
	//
	// Конструктор.
	//
	function __construct(){		
		
		parent::__construct();
		
	}
	
	//
	//Вывод список задач пользователя
	//
	public function action_index() {
		
		$task = $this->mTask()->task_all($this->data('login'));
		//буферизация данных, отправка в шаблон
		$this->content = $this->template('./v/index.php', array('task' => $task));		
	}
	
	//
	// Добавить задачу пользователю
	//
	public function action_add(){
		
		if(!empty($_POST['description'])){
			$description=htmlspecialchars($_POST["description"]);
			$user_id = $this->data('user_id');
		}
		$this->mTask()->add_desc($user_id, $description);
		header("Location:index.php?act=index");
	}
	//
	// Изменить статус всех задач пользователя
	//

	public function action_ready_all(){
		
		$user_id = $this->data('user_id');
		$this->mTask()->ready_all($user_id);
		header("Location:index.php?act=index");
	}
	
    //
	// Удалить все задачи пользователя
	//
	public function action_delete_all(){
		
		$user_id = $this->data('user_id');
		$this->mTask()->delete_all($user_id);
		header("Location:index.php?act=index");
	}
	
	//
	// Изменить статус задачи(готово/не готово)
	//
	public function action_ready(){
		
		$id_task = htmlspecialchars($_POST["num"]);
		$stat = htmlspecialchars($_POST["stat"]);
		$user_id = $this->data('user_id');
		if($stat =='не готово'){
			$num = 1;
		} else{
			$num = 0;
		} 
		$this->mTask()->ready_task($num,$id_task,$user_id);
		header("Location:index.php?act=index");
	}
	
	//
	// Удалить задачу
	//
	public function action_delete(){
		$id_task = htmlspecialchars($_POST["num"]);
		$user_id = $this->data('user_id');
		$this->mTask()->delete_task($user_id, $id_task);
		header("Location:index.php?act=index");
	}
	
	//
    // Опеделить нужную функцию
    //
    public function action_delete_ready(){
		$submit = $_POST['sub'];
		if($submit == 'READY ALL'){
			$this->action_ready_all();
		} else if($submit == 'REMOVE ALL'){
			$this->action_delete_all();
		} else if(($submit == 'READY')||($submit=='NO READY')){
			$this->action_ready();
		} else if($submit == 'DELETE'){
			$this->action_delete();
		} else{
			echo "Произошла ошибка";
		}
	}
}
	
	
