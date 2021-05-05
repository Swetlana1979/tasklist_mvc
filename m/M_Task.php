<?php
class M_Task
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (синглтон)
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Task();
		
		return self::$instance;
	}
	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = M_MSQL::Instance();
	}
 	
	//
  // Список всех задач пользователя
  //
  public function task_all($name)
  {
	    // Запрос.
		
	    $query = "SELECT users.login, tasks.id, tasks.description, tasks.created_at,tasks.status FROM `users`,`tasks` 
	WHERE tasks.user_id=users.id AND users.login= ?"; 
	$result=$this->msql->Select($query,$name);
		
		return $result;
	}
   //
   // Добавить новое задание
   //
    public function add_desc($user_id,$description)
    {
	    $created_at=date("Y-m-d H:i:s");
		$sql = "INSERT INTO tasks(user_id, description, created_at, status)VALUES(?,?,?, 0)"; 
		$this->msql->Insert_task($sql, $user_id,$description, $created_at);	
	 }
	 //
	 // Изменить статус всех записей
	 public function ready_all($user_id){
	    $sql="UPDATE tasks SET status = 1 WHERE user_id=?";
		
		$this->msql->Ready_all($sql, $user_id);
		return true;
    } 
	
	//
// Удалить все записи
//
   public function delete_all($user_id){
	    $sql="DELETE FROM tasks WHERE user_id=?";
		$this->msql->Delete_all($sql, $user_id);
		return true;
    } 
  //
  // Изменить статус задачи
  //
   public function ready_task($num,$id_task,$user_id){
	   $sql="UPDATE tasks SET status = ? WHERE user_id=? AND id=?";
	   $this->msql->Ready_task($sql,$num,$id_task,$user_id);
	   return true;
   }


//
// Обработка данных
//
    
    //Переварачивание даты
	public function reverse_date($date)
	{
        $mass=explode('-',$date);
		$mass=array_reverse($mass);
		$date=implode('.',$mass);
		return $date;
	}
	
	
	
	
	
	
	
	
	
	
	
} 

 
