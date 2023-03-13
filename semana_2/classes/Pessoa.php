<?php

namespace classes;

    Abstract Class Pessoa {
        public $nome, $idade;

        public function __destruct(){
            echo "\n$this->nome foi destruído.\n";
        }

        public function __set($name,$value){
            $this->$name=$value;
        }
        
        public function __get($name){
            return $this->$name;
        }

        public abstract function __toString();
    }
?>