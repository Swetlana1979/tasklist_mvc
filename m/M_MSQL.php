<?php
//
// Помощник работы с БД
//
class M_MSQL
{
	private static $instance;
	
	public static function Instance(){
		if (self::$instance == null)
			self::$instance = new M_MSQL();
		return self::$instance;
	}
	//
	// Конструктор
	//
	private function __construct(){
		
	}
	
	//
	// Соединение с БД
	//
	public function con(){
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (!$con) {
			printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
			exit;
		}
		return $con;
	}
	
	//
	// Авторизация пользователя
	//
	public function login($sql,$login){
		$con=$this->con();
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
	
	//
	// Регистрация пользователя
	//
	public function register($sql,$login, $password, $created_at){
		$con=$this->con();
		$stmt = mysqli_prepare($con, $sql); 
		mysqli_stmt_bind_param($stmt, "sss", $login, $password, $created_at);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	//
	// Выборка задач пользователя
	//
	public function select($query,$login){
		
		$con=$this->con();
		$stmt = mysqli_prepare($con,$query);
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		if (!$result)
		    die();
		return $result;
	}
	
	//
	// Добавление задачи
	//
	public function insert_task($sql, $user_id, $description, $created_at){			
		$con=$this->con();
		$stmt = mysqli_prepare($con, $sql); 
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $description, $created_at);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
	}
	
	//
	// Изменение строк
	//	
	public function ready_all($sql, $user_id){
		$con=$this->con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
	//
	// Удалить все задачи
	//		
	public function delete_all($sql,$user_id){
		$con=$this->con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
	//
	// Изменить статус задачи
	//
	public function ready_task($sql,$num,$id_task,$user_id){
		$con=$this->con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "iii", $num,$user_id, $id_task);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
	}
	//
	// Удалить задачу
	//
	
	public function delete_task($sql,$user_id, $id_task){
		$con=$this->con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "ii", $user_id, $id_task);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
}
