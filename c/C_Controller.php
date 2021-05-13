<?php
//
// Базовый класс контроллера.
//
abstract class C_Controller
{
	// Генерация внешнего шаблона
	protected abstract function render();
	
	// Функция отрабатывающая до основного метода
	protected abstract function before();
	
	public function request($action){
		if(!$action){
			echo 'Данная страница не найдена';
		}
		$this->start();
		$this->before();
		$this->$action();
		$this->render();
	}
	
	//
	// Генерация HTML шаблона в строку.
	//
	protected function template($fileName, $vars = array()){
		
		extract($vars);

		// Генерация HTML в строку.
		ob_start();
		include "$fileName";
		return ob_get_clean();	
	}
	
	// Если вызвали метод, которого нет - завершаем работу
	public function __call($name, $params){
        die('Данная страница не найдена');
	}
}
