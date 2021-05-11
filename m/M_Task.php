<?php
class M_Task
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (синглтон)
	//
	public static function Instance(){
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
	// Приведение даты из БД к нужному формату
	//
	public function reverse_date($date){
		$mass=explode('-',$date);
		$mass=array_reverse($mass);
		$date=implode('.',$mass);
		return $date;
	}
	// 
	// Вывод задач пользователя
	// $arr - массив задач
	//
	public function output($arr){
		$array=array();
		for($i=0; $i<count($arr); $i++){
			$status=$arr[$i]['3'];
			$read_stat=($status=='готово')? "NO READY":"READY";
			$color=($status=='готово')?'green':'red';
			$created_at=$arr[$i]['2'];
			$dateTime=explode(" ", $created_at);
			$time=$dateTime[1];
			$date=$this->reverse_date($dateTime[0]);
			$created_at=$date." ".$time;
				$str="<tr><form class='' name='task_form".$i."' action='index.php?act=delete_ready' method='post'><td>".
				$arr[$i]['0']."</td><td>".$arr[$i]['1']."</td><td>".$created_at."</td><td class=''>".$status."</td><td><div class='".$color." stat'></div>
				</td></tr><tr><td>
				<input type = 'submit' name ='sub' class ='sub' value ='".$read_stat."'></td><td>
				<input type = 'hidden' id='stat' name ='stat' size = '10' width = '10' value='".$status."'></td><td>
				<input type = 'submit' name ='sub' class ='sub' value = 'DELETE'></td><td>
				<input type = 'hidden' name ='num' value = '".$arr[$i]['0']."'></td>
				</form></tr>";
				$array[]=$str;				
			}
		return $array;
	}
	
  //
  // Список всех задач пользователя
  // $login - логин пользователя
  // $task - массив задач пользователя
  //
	public function task_all($login){
		
		$query = "SELECT users.login, tasks.id, tasks.description, tasks.created_at,tasks.status FROM `users`,`tasks` 
		WHERE tasks.user_id=users.id AND users.login= ?"; 
		$result = $this->msql->select($query,$login);
		$res=array();
		if($result){
			foreach($result as $key => $value){
				$status="готово";
				if($value['status'] == 0){
					$status="не готово";
				}
				$res[] = array($value['id'],$value['description'],$value['created_at'],$status);
			}
					
		}
		$task = $this->output($res);
		return $task;
	}
	
   //
   // Добавить новое задание
   // $user_id - id пользователя
   // $description - описание задачи
   //
    public function add_desc($user_id,$description){
	    $created_at = date("Y-m-d H:i:s");
		$sql = "INSERT INTO tasks(user_id, description, created_at, status)VALUES(?,?,?, 0)"; 
		$this->msql->insert_task($sql, $user_id,$description, $created_at);	
	 }
	 
	 //
	 // Изменить статус всех задач
	 // $user_id -id пользователя
	 //
	 public function ready_all($user_id){
	    $sql = "UPDATE tasks SET status = 1 WHERE user_id=?";
		$this->msql->ready_all($sql, $user_id);
		return true;
    } 
	
	//
	// Удалить все задачи
	// $user_id -id пользователя
	//
	public function delete_all($user_id){
	    $sql = "DELETE FROM tasks WHERE user_id=?";
		$this->msql->delete_all($sql, $user_id);
		return true;
    } 
	//
	// Изменить статус задачи
	// $num - статус задачи
	// $id_task - номер задачи
	// $user_id - номер пользователя
	//
	public function ready_task($num,$id_task,$user_id){
	   $sql = "UPDATE tasks SET status = ? WHERE user_id=? AND id=?";
	   $this->msql->ready_task($sql,$num,$id_task,$user_id);
	   return true;
	}
	
   //
   // Удалить задачу
   //
   public function delete_task($user_id, $id_task){
		$sql = "DELETE FROM tasks WHERE user_id=? AND id=?";
		$this->msql->delete_task($sql, $user_id, $id_task);
		return true;
	}
	
} 

 
