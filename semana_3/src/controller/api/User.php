<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\User as UserModel;
use Exception;

class User extends Controller{
    private UserModel $model;

    public function __construct(){
        try{
            $this->model = new UserModel();
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
        $user = $this->model->read($id);
        if ($user) {
            $response = ['user' => $user];
        } else {
            $response = ['Erro' => "User não encontrado"];
			header('HTTP/1.0 404 Not Found');
        }
        echo json_encode($response);
    }

    public function store(){
        try {
            $this->validateUserRequest();
            $this->model = new UserModel(
                $_POST['nome'],
                $_POST['email'],
                $_POST['senha']
            );

            if($this->model->create()){
                echo json_encode([
                    "sucess" => "User inserido com sucesso!",
                    "data" => $this->model->getColumns()
                ]);
            } else {
                $msg = 'Erro ao inserir user!';
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
                throw new Exception("Informe o ID do User!");
            }

            $this->validateUserRequest();

            $this->model = new UserModel(
                $_POST['nome'],
                $_POST['email'],
                $_POST['senha']
            );
            $this->model->id = $_POST["id"];

            if($this->model->update()){
                echo json_encode([
                    "sucess" => "User atualizado com sucesso!",
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
				$response = ["message:" => "User id:$id removido com sucesso!"];
			} else {
				$this->setHeader(500,'Internal Error.');
				throw new Exception("Erro ao remover User!");
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

    public function validateUserRequest(){
        $fields = [
            'nome',
            'email',
            'senha'
        ];
        if (!$this->validatePostRequest($fields)){
            throw new \Exception('Erro: campos incompletos!');
        }
    }
}