<?php

namespace Daoo\Aula03\controller\api;

use Daoo\Aula03\model\Tags as TagsModel;
use Exception;

class Tags extends Controller{
    private TagsModel $model;

    public function __construct(){
        try{
            $this->model = new TagsModel();
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
        $tag = $this->model->read($id);
        if ($tag) {
            $response = ['tag' => $tag];
        } else {
            $response = ['Erro' => "Tag não encontrada."];
            header('HTTP/1.0 404 Not Found');
        }
        echo json_encode($response);
    }

    public function store(){
        try {
            $this->validateTagRequest();
            $this->model = new TagsModel(
                $_POST['title']
            );

            if($this->model->create()){
                echo json_encode([
                    "success" => "Tag inserida com sucesso!",
                    "data" => $this->model->getColumns()
                ]);
            } else {
                $msg = 'Erro ao inserir tag!';
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
                throw new Exception("Informe o ID da tag!");
            }

            $this->validateTagRequest();

            $this->model = new TagsModel(
                $_POST['title']
            );
            $this->model->id = $_POST["id"];

            if($this->model->update()){
                echo json_encode([
                    "success" => "Tag atualizada com sucesso!",
                    "data" => $this->model->getColumns()
                ]);
            } else {
                throw new \Exception("Erro ao atualizar tag!");
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
                throw new \Exception('Erro: id obrigatório!');
            }
            $id = $_POST["id"];
            if ($this->model->delete($id)) {
                $response = ["message:" => "Tag id:$id removida com sucesso!"];
            } else {
                $this->setHeader(500,'Internal Error.');
                throw new Exception("Erro ao remover Tag!");
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

    public function validateTagRequest(){
        $fields = [
            'title'
        ];
        if (!$this->validatePostRequest($fields)){
            throw new \Exception('Erro: campos incompletos!');
        }
    }
}
