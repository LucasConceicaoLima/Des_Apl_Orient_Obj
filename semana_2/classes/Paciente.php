<?php

namespace classes;

    Class Paciente extends Pessoa {

        public function __construct($nome, $idade, $altura, $peso){
            parent::__construct($nome, $idade, $altura, $peso);
        }

        public function showIMC(){
            echo "\nIMC de $this->nome: " . number_format($this->imc, 1) . "\n";
        }

        public function setPeso($peso){
            $this->$peso = $peso;
            $this->calcIMC();
        }

        public function setAltura($altura){
            $this->$altura = $altura;
            $this->calcIMC();
        }

        public function __set($name, $value){
            if($name=='imc'){
                if(is_array($value)){ //testa se tem os 2 valores
                    if($value[0]>$value[1]){
                        $this->imc = $value[0]/($value[1]*$value[1]);
                    } else {
                        echo "\nValores inseridos incorretamente.\n";
                    } 
                } else {
                    echo "\nValores inválidos.\n";
                }
            } else {
                $this->$name = $value;
            }
            
        }

        public function __get($name){
            return $this->$name;
        }

        public function __toString(){
            return parent::__toString() . "IMC: ". number_format($this->imc, 1). "\n"; 
        }
    }

?>