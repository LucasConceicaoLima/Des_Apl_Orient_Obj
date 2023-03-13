<?php 

namespace classes;

class Atleta extends Pessoa{

    use traits\IMC;

    private $peso, $altura;

    public function __construct($nome, $altura, $peso, $idade=null){
        $this->nome = $nome;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->idade = $idade;
        $this->calcIMC();
    }

    public function __toString(){
        return "\n== Dados da pessoa ==\n" 
        . "Nome: $this->nome\n" 
        . ($this->idade? "Idade: $this->idade\n":"") 
        . "Altura: $this->altura\n" 
        . "Peso: $this->peso\n"
        . "IMC: " . number_format($this->imc, 1) . "\n";
    }

    public function setAltura($altura){
		$this->altura = $altura;
		$this->calcImc();
	}

	public function setPeso($peso){
		$this->peso = $peso;
		$this->calcImc();
	}

    public function getAltura(){
		return $this->altura;
	}

	public function getPeso(){
		return $this->peso;
	}

	public function __set($name,$value){
        $this->$name = $value;
	}

    }
?>