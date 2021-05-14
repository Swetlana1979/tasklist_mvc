<?php
//
// Базовый контроллер сайта.
//
//
abstract class C_Base extends C_Controller{
	
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы
	//
	// Конструктор.
	//
	function __construct() {
		
	}
	
	protected function before() {
		
		$this->title = 'Название сайта';
		$this->content = '';
	}
	
	public function start(){
		
		session_start();
	}
	//
	// Генерация базового шаблонаы
	//	
	public function render() {
		
		$vars = array('title' => $this->title, 'content' => $this->content);	
		$page = $this->template('v/sabl.php', $vars);				
		echo $page;
	}
	
	//
	// Данные пользователя
	//
	public function data($var) {
		
		if($var=='login') {
			return $this->login = $_SESSION['session_login'];
		} else if($var=='user_id'){
			return $this->user_id = $_SESSION['session_id'];
		} else {
			echo 'Ошибка при получении данных';
		}		
	}
	
	
}
