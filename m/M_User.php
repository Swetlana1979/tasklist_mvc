<?php
class M_User
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (синглтон)
	//
	public static function instance(){
		if (self::$instance == null)
			self::$instance = new M_User();
		return self::$instance;
	}
	
	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = M_MSQL::instance();
	}
	
	public function login($login){
		$sql="SELECT * FROM users WHERE login = ?";
		$row=$this->msql->login($sql,$login);
		return $row;
	}
	
	//
	// Авторизация
	// $login - имя пользователя
	// $password - пароль
	// $created_at - время создания
	// $row - данные зарегистрированного пользователя
	//
	public function register($login, $password, $created_at, $hash){
		$sql="INSERT INTO users(login, password, created_at, hash)VALUES(?,?,?,?)"; 
		$row=$this->msql->register($sql,$login, $password, $created_at, $hash);
		
	}
}
?>