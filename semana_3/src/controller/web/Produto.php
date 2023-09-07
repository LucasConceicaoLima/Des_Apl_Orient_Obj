<?php

namespace Daoo\Aula03\controller\web;

use Daoo\Aula03\model\Produto as ProdutoModel;
use Exception;

class Produto extends Controller
{
	protected ProdutoModel $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = new ProdutoModel();
	}

	public function index()
	{
		$listProdutos = $this->model->read();
		error_log("RESULT:".count($listProdutos));
		$this->view->load('produtos/index',[
			'produtos'=>$listProdutos
		]);
	}

	public function show($id)
	{
		$produto = $this->model->read($id);
		error_log("CONTROLLER-show:\n".print_r($produto,true));
		if ($produto) {
			$response = ['produto' => $produto];
			$this->view->load('produtos/show',$response);
		} else {
			header('HTTP/1.0 404 Not Found');
		}
	}
}
