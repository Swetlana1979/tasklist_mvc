<?php
//
// Помощник работы с БД
//
class M_MSQL
{
	private static $instance;
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_MSQL();
		
		return self::$instance;
	}
	
	private function __construct()
	{
		include_once('startup.php');
	    
	}
	
	//
	// Выборка строк
	// $query    	- полный текст SQL запроса
	// результат	- массив выбранных объектов
	//
	public function Select($query,$name){
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$stmt = mysqli_prepare($con,$query);
		mysqli_stmt_bind_param($stmt, "s", $name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		if (!$result)
		    die();
		$res=array();
		if($result){
			foreach($result as $key=>$value){
				$status="готово";
				if($value['status']==0){
					$status="не готово";
				}
				$res[]=array($value['id'],$value['description'],$value['created_at'],$status);
			}
			return $res;			
		}
	}
	
	//
	// Вставка строки в task
	
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// результат	- идентификатор новой строки
	//
	public function Insert_task($sql, $user_id, $description, $created_at){			
			
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$stmt = mysqli_prepare($con, $sql); 
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $description, $created_at);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
	}
	
	//
	// Изменение строк
	
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// $where		- условие (часть SQL запроса)
	// результат	- число измененных строк
	//	
	public function Ready_all($sql, $user_id)
	{
			$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		mysqli_stmt_execute($stmt);
			
		mysqli_stmt_close($stmt);
	}
	
	//
	// Удаление строк
	// $table 		- имя таблицы
	// $where		- условие (часть SQL запроса)	
	// результат	- число удаленных строк
	//		
	public function Delete_all($sql,$user_id)
	{
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	public function Ready_task($sql,$num,$id_task,$user_id){
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "iii", $num,$user_id, $id_task);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
	}
}