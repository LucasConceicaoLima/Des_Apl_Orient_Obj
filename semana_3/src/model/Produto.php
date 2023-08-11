<?php

//namespace Daoo\Aula03\model;
namespace PHP\Des_Apl_Orient_Obj\semana_3\src\model;

use Exception;

class Produto extends ORM implements iDAO
{
    private $id, $nome, $descricao,
        $quantidadeEstoque, $preco, $importado;

    public function __construct(
        $nome = '',
        $descricao = '',
        $quantidade = 0,
        $preco = 0,
        $importado = false
    ) {
        parent::__construct();

        $this->table = 'produtos';
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->quantidadeEstoque = $quantidade;
        $this->preco = $preco;
        $this->importado = $importado;
        $this->mapColumns($this);
    }

    public function read($id = null)
    {
        try {
            if ($id) {
                return $this->selectById($id);
            }
            return $this->select([]);
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            throw new Exception($error->getMessage());
            // return false;
        }
    }

    public function create()
    {
        try {
            $sql = "INSERT INTO $this->table ($this->columns) "
                . "VALUES ($this->params)";

            // error_log("ERRO: " . print_r($sql, TRUE));        
            // throw new Exception($sql);

            $prepStmt = $this->conn->prepare($sql);
            $result = $prepStmt->execute($this->values);
            $this->dumpQuery($prepStmt);
            return ($result && $prepStmt->rowCount() == 1);
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            if (isset($prepStmt))
                $this->dumpQuery($prepStmt);

            return false;
        }
    }

    public function update()
    {
        try {
            $this->values[':id'] = $this->id;
            $sql = "UPDATE $this->table SET $this->updated  WHERE id_prod = :id";
            $prepStmt = $this->conn->prepare($sql);
            $prepStmt->bindValue(':importado', $this->importado);
            if ($prepStmt->execute($this->values)) {
                $this->dumpQuery($prepStmt);
                return $prepStmt->rowCount() > 0;
            }
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id_prod = :id";
        $prepStmt = $this->conn->prepare($sql);
        if ($prepStmt->execute([':id' => $id]))
            return $prepStmt->rowCount() > 0;
        else return false;
    }

    public function filter($arrayFilter)
    {
        try {
            if (!sizeof($arrayFilter)) die("Filtros vazios!");
            $this->setFilters($arrayFilter);
            $sql = "SELECT * FROM produtos WHERE $this->filters";
            $preparedStatement = $this->conn->prepare($sql);
            if ($preparedStatement->execute($this->values))
                return $preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
            return false;
        } catch (\Exception $error) {
            error_log("ERRO: " . print_r($error, TRUE));
            if(isset($preparedStatement))
                $this->dumpQuery($preparedStatement);
            throw new \Exception($error->getMessage());
        }
    }

    public function getColumns(): array
    {
        return  [
            "nome" => $this->nome,
            "descricao" => $this->descricao,
            "qtd_estoque" => $this->quantidadeEstoque,
            "preco" => $this->preco,
            "importado" => $this->importado
        ];
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


    public function insertProdWithDesc($array_ids_desc)
    {
        //implementar transação
    }
}
