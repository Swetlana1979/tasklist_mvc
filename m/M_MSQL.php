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
		//include_once('./c/startup.php');
			    
	}
	
	public function Con(){
		return $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}
	
	public function Login($sql,$login){
		$con=$this->Con();
		$stmt = mysqli_prepare($con,$sql); 
		if(!$stmt){
			echo 'не удалось получить данные';		  
		}
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		$numrows = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($numrows, MYSQLI_NUM);
		mysqli_stmt_close($stmt);
		return $row;
	}
	
	public function Register($sql,$login, $password, $created_at){
		$con=$this->Con();
		$stmt = mysqli_prepare($con, $sql); 
		mysqli_stmt_bind_param($stmt, "sss", $login, $password, $created_at);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	//
	// Выборка строк
	//
	public function Select($query,$name){
		$con=$this->Con();
		$stmt = mysqli_prepare($con,$query);
		mysqli_stmt_bind_param($stmt, "s", $name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		if (!$result)
		    die();
		return $result;
	}
	
	//
	// Вставка строки в task
	//
	public function Insert_task($sql, $user_id, $description, $created_at){			
			
		$con=$this->Con();
		$stmt = mysqli_prepare($con, $sql); 
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $description, $created_at);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
	}
	
	//
	// Изменение строк
	//	
	public function Ready_all($sql, $user_id)
	{
		$con=$this->Con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
	//
	//
	//		
	public function Delete_all($sql,$user_id)
	{
		$con=$this->Con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
	public function Ready_task($sql,$num,$id_task,$user_id){
		$con=$this->Con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "iii", $num,$user_id, $id_task);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
	}
	
	public function Delete_task($sql,$user_id, $id_task){
		$con=$this->Con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_task);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
}
