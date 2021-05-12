<?php
//
// Базовый контроллер сайта.
//
//
abstract class C_Base extends C_Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы
	//
	// Конструктор.
	//
	function __construct()
	{		
	}
	protected function before()	{
		$this->title = 'Название сайта';
		$this->content = '';
		
		//include_once('C_Connect.php');
		//header('Content-type: text/html; charset=utf-8');
	}
	public function start(){
		session_start();
	}
	//
	// Генерация базового шаблонаы
	//	
	public function render(){
		$vars = array('title' => $this->title, 'content' => $this->content);	
		$page = $this->Template('v/sabl.php', $vars);				
		echo $page;
	}
	
	
}
