<?php

namespace Daoo\Aula03\model;

use Exception;

class Tags extends Model implements iDAO {
    private $id, $title;
    
    public function __construct($title = '') {
        try {
            parent::__construct();
        } catch (Exception $error) {
            throw $error;
        }

        $this->table = 'tags';
        $this->primary = 'id';
        $this->title = $title;
        $this->mapColumns($this);
    }

    public function read($id = null){
        try{
            if(isset($id)){
                return $this->selectById($id);
            }
            return $this->select();
        } catch (\Exception $error){
            error_log("ERRO: " . print_r($error, TRUE));
            throw new Exception($error->getMessage());
        }
    }

    public function create(){
        try {
            $sql = "INSERT INTO $this->table ($this->columns) "
                . "VALUES ($this->params)";

            error_log(print_r([
                "colunas"=>$this->columns,
                "param"=>$this->params,
                "valores"=>$this->values,
                "SQL"=>$sql
            ],true));

            $prepStmt = $this->conn->prepare($sql);
            $result = $prepStmt->execute($this->values);
            
            if(!$result || $prepStmt->rowCount() != 1)
                throw new Exception("Erro ao inserir tag!!");

            $this->id = $this->conn->lastInsertId();
            $this->dumpQuery($prepStmt);
            return true;
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            $prepStmt ?? $this->dumpQuery($prepStmt);
            return false;
        }
    }

    public function update(){
       try {
            $this->values[':id'] = $this->id;
            $sql = "UPDATE $this->table SET $this->updated
                  WHERE $this->primary = :id";
            $prepStmt = $this->conn->prepare($sql);
           
            if ($prepStmt->execute($this->values)) {
                $this->dumpQuery($prepStmt);
                return $prepStmt->rowCount() > 0;
            }
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            $this->dumpQuery($prepStmt);
            return false;
        } 
    }

    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE $this->primary = :id";
        $prepStmt = $this->conn->prepare($sql);
        if ($prepStmt->execute([':id' => $id]))
            return $prepStmt->rowCount() > 0;
        else return false;
    }

    public function filter($arrayFilter){
        try {
            if (!sizeof($arrayFilter))
                throw new \Exception("Filtros vazios!");
            $this->setFilters($arrayFilter);
            $sql = "SELECT * FROM $this->table WHERE $this->filters";
            $prepStmt = $this->conn->prepare($sql);
            if (!$prepStmt->execute($this->values))
                return false;
            $this->dumpQuery($prepStmt);
            return $prepStmt->fetchAll(self::FETCH);
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            if(isset($prepStmt))
                $this->dumpQuery($prepStmt);
            throw new \Exception($error->getMessage());
        }
    }

    public function getColumns(): array {
        $columns = [
            "title" => $this->title
        ];
        if($this->id) $columns['id'] = $this->id;
        return $columns;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
        if ($name != 'id') $this->mapColumns($this);
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        $this->mapColumns($this);
    }

    public function getId() {
        return $this->id;
    }

}
