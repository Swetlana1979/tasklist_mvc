<?php
//
// Базовый контроллер сайта.
//
//include_once('C_Controller.php');
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
		//include_once('./m/startup.php');
	    //startup();
		header('Content-type: text/html; charset=utf-8');
	}
	//
	// Генерация базового шаблонаы
	//	
	public function render(){
		$vars = array('title' => $this->title, 'content' => $this->content);	
		$page = $this->Template('v/sabl.php', $vars);				
		echo $page;
	}
	public function start(){
		session_start();
	}
}
