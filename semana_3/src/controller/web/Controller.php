<?php
namespace Daoo\Aula03\controller\web;

use Daoo\Aula03\view\View;

class Controller{

	protected View $view;

	public function __construct()
	{
		header("Content-Type:text/html;charset=utf-8'");
		$this->view = new View();
	}

	// protected function validatePostRequest(array $fields):bool{
	// 	foreach($fields as $field)
	// 		if(!isset($_POST[$field])){
	// 			return false;
	// 		}
	// 	return true;
	// }

}