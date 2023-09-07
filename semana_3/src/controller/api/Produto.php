<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\Produto as ProdutoModel;
use Exception;

class Produto extends Controller
{

	private ProdutoModel $model;

	public function __construct()
	{
		try{
			$this->model = new ProdutoModel();
			$this->setHeader(200,'');
		}catch(Exception $error){
			$this->setHeader(500,"Erro ao conectar ao banco!");
			json_encode(["error"=>$error->getMessage()]);
		}	
	}

	public function index()
	{
		echo json_encode($this->model->read());
	}

	public function show($id)
	{
		$produto = $this->model->read($id);
		if ($produto) {
			$response = ['produto' => $produto];
		} else {
			$response = ['Erro' => "Produto não encontrado"];
			header('HTTP/1.0 404 Not Found');
		}
		echo json_encode($response);
	}

	public function store()
	{
		try {
			$this->validateProdutoRequest();

			$this->model = new ProdutoModel(
				$_POST['nome'],
				$_POST['descricao'],
				$_POST['quantidade'],
				$_POST['preco']
			);

			$this->model->importado = isset($_POST['importado']);


			if(isset($_POST['descontos'])){
				error_log("POST PROD-DESC\n".print_r($_POST,TRUE));
				if(!$this->model->insertProdWithDesc($_POST['descontos'])){
					$msg = 'Erro ao cadastrar produto!';
					$this->setHeader(500,$msg);
					throw new \Exception($msg);
				}
				echo json_encode([
					"success" => "Produto com desconto criado com sucesso!",
					"data" => $this->model->getColumns()
				]);
			}else if ($this->model->create()){
				echo json_encode([
					"success" => "Produto criado com sucesso!",
					"data" => $this->model->getColumns()
				]);
			}else {
				$msg = 'Erro ao cadastrar produto!';
				$this->setHeader(500,$msg);
   		 		throw new \Exception($msg);
			}
		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage(),
				"trace"=> $error->getTrace()
			]);
		}
	}

	public function update()
	{
		try {
			if(!$this->validatePostRequest(['id']))
				throw new Exception("Informe o ID do Produto!!");
			
			$this->validateProdutoRequest();

			$this->model = new ProdutoModel(
				$_POST['nome'],
				$_POST['descricao'],
				$_POST['quantidade'],
				$_POST['preco']
			);
			$this->model->id = $_POST["id"];
			$this->model->importado = isset($_POST['importado']);

			// error_log(print_r($this->model,TRUE));
			// throw new \Exception('LOG');

			if ($this->model->update())
				echo json_encode([
					"success" => "Produto atualizado com sucesso!",
					"data" => $this->model->getColumns()
				]);
			else throw new \Exception("Erro ao atualizar produto!");
		} catch (\Exception $error) {
			$this->setHeader(500,'Erro interno do servidor!!!!');
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}

	public function remove()
	{
		try {
			if (!isset($_POST["id"])){
				$this->setHeader(400,'Bad Request.');
				throw new \Exception('Erro: id obrigatorio!');
			}
			$id = $_POST["id"];
			if ($this->model->delete($id)) {
				$response = ["message:" => "Produto id:$id removido com sucesso!"];
			} else {
				$this->setHeader(500,'Internal Error.');
				throw new Exception("Erro ao remover Produto!");
			}
			echo json_encode($response);
		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
	}


	public function filter() : void {
		
		if(!isset($_POST))
		   echo json_encode(["error" => "enviar os filtros"]);
		$reulsts = $this->model->filter($_POST);
		echo json_encode($reulsts);
	}

	private function validateProdutoRequest()
	{
		$fields = [
			'nome',
			'descricao',
			'quantidade',
			'preco'
		];
		if (!$this->validatePostRequest($fields))
			throw new \Exception('Erro: campos imcompletos!');
	}
}
