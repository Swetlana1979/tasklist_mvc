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
	
 	public function login($login){
		$sql="SELECT * FROM users WHERE login = ?";
		$row=$this->msql->Login($sql,$login);
		//print_r($row);
		return $row;
	}
	
	public function Register($login, $password,$created_at){
		$sql="INSERT INTO users(login, password,created_at)VALUES(?,?,?)"; 
		$row=$this->msql->Register($sql,$login, $password,$created_at);
		
	}
	
	public function Reverse_date($date){
		$mass=explode('-',$date);
		$mass=array_reverse($mass);
		$date=implode('.',$mass);
		return $date;
	}
	
	public function Output($arr){
		$array=array();
		for($i=0; $i<count($arr); $i++){
			$status=$arr[$i]['3'];
			$read_stat=($status=='готово')? "NO READY":"READY";
			$created_at=$arr[$i]['2'];
			$dateTime=explode(" ", $created_at);
			$time=$dateTime[1];
			$date=$this->Reverse_date($dateTime[0]);
			$created_at=$date." ".$time;
				$str="<tr><form class=blok name='task_form".$i."' action='index.php?act=delete_ready' method='post'><td>".
				$arr[$i]['0']."</td><td>".$arr[$i]['1']."</td><td>".$created_at."</td><td>".$arr[$i]['3'].
				"</td></tr><tr><td>
				<input type='submit' name='sub' class='sub' value='".$read_stat."'></td><td>
				<input type='hidden' id='stat' name='stat' size='10' width='10' color='red' value='".$status."'></td><td>
				<input type='submit' name='sub' class='sub' value='DELETE'></td><td>
				<input type='hidden' name='num' value='".$arr[$i]['0']."'></td>
				</form></tr>";
				$array[]=$str;				
			}
		return $array;
	}
  //
  // Список всех задач пользователя
  //
	public function task_all($name){
		$query = "SELECT users.login, tasks.id, tasks.description, tasks.created_at,tasks.status FROM `users`,`tasks` 
		WHERE tasks.user_id=users.id AND users.login= ?"; 
		$result=$this->msql->Select($query,$name);
		$res=array();
		if($result){
			foreach($result as $key=>$value){
				$status="готово";
				if($value['status']==0){
					$status="не готово";
				}
				$res[]=array($value['id'],$value['description'],$value['created_at'],$status);
			}
					
		}
		$task=$this->Output($res);
		return $task;
		
	}
   //
   // Добавить новое задание
   //
    public function add_desc($user_id,$description){
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
   
   public function delete_task($user_id, $id_task){
		//$id_task=htmlspecialchars($_POST["num"]);
		$sql="DELETE FROM tasks WHERE user_id=? AND id=?";
		$this->msql->Delete_task($sql, $user_id, $id_task);
		return true;
	}
	
} 

 
