<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\Postagem as PostagemModel;
use Exception;

class Postagem extends Controller{
    private PostagemModel $model;

    public function __construct(){
        try{
            $this->model = new PostagemModel();
            $this->setHeader(200,'');
        }catch(Exception $error){
            $this->setHeader(500,"Erro ao conectar ao banco!");
            json_encode(["error"=>$error->getMessage()]);
        }
    }

    public function index(){
        echo json_encode($this->model->read());
    }

    public function show($id){
        $postagem = $this->model->read($id);
        if ($user) {
            $response = ['postagem' => $postagem];
        } else {
            $response = ['Erro' => "Postagem não encontrada."];
			header('HTTP/1.0 404 Not Found');
        }
        echo json_encode($response);
    }

    public function store(){
        try {
            $this->validatePostagemRequest();
            $this->model = new PostagemModel(
                $_POST['titulo'],
                $_POST['conteudo'],
                $_POST['data_postagem']
            );

            if($this->model->create()){
                echo json_encode([
                    "sucess" => "Postagem inserida com sucesso!",
                    "data" => $this->model->getColumns()
                ]);
            } else {
                $msg = 'Erro ao inserir postagem!';
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

    public function update(){
        try{
            if(!$this->validatePostRequest(['id'])){
                throw new Exception("Informe o ID da postagem!");
            }

            $this->validatePostagemRequest();

            $this->model = new UserModel(
                $_POST['titulo'],
                $_POST['conteudo'],
                $_POST['data_postagem']
            );
            $this->model->id = $_POST["id"];

            if($this->model->update()){
                echo json_encode([
                    "sucess" => "Postagem atualizada com sucesso!",
                    "data" => $this->model->getColumns()
                ]);
            } else {
                throw new \Exception("Erro ao atualizar user!");
            }
        } catch (\Exception $error) {
			$this->setHeader(500,'Erro interno do servidor!!!!');
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
    }

    public function remove(){
        try {
			if (!isset($_POST["id"])){
				$this->setHeader(400,'Bad Request.');
				throw new \Exception('Erro: id obrigatorio!');
			}
			$id = $_POST["id"];
			if ($this->model->delete($id)) {
				$response = ["message:" => "Postagem id:$id removida com sucesso!"];
			} else {
				$this->setHeader(500,'Internal Error.');
				throw new Exception("Erro ao remover Postagem!");
			}
			echo json_encode($response);
		} catch (\Exception $error) {
			echo json_encode([
				"error" => $error->getMessage()
			]);
		}
    }

    public function filter() : void {
        if(!isset($_POST)){
            echo json_encode(["error" => "enviar os filtros"]);
        }
		$results = $this->model->filter($_POST);
		echo json_encode($results);
    }

    public function validatePostagemRequest(){
        $fields = [
            'titulo',
            'conteudo',
            'data_postagem'
        ];
        if (!$this->validatePostRequest($fields)){
            throw new \Exception('Erro: campos incompletos!');
        }
    }
}