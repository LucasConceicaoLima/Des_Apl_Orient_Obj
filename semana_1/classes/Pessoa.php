<?php

namespace classes;

    Class Pessoa {
        public $nome, $idade, $altura, $peso;

        public function __construct($nome, $idade=null, $altura, $peso){
            $this->nome = $nome;
            $this->idade = $idade;
            $this->altura = $altura;
            $this->peso = $peso;
        }

        public function __destruct(){
            echo "\n$this->nome foi destruído.\n";
        }

        public function setAltura(float $altura){
            $this->altura = $altura;
        }
    
        public function setPeso(float $peso){
            $this->peso = $peso;
        }

    }
?>