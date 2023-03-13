<?php

namespace classes\traits;

    Trait IMC {
        protected $imc;

        public function calcIMC(){
            if(is_numeric($this->peso) && is_numeric($this->altura)){
                $this->imc = ($this->peso/($this->altura*$this->altura));
            } else {
                echo "\nValors inválidos.\n";
            }
        }

        public function classifica(){
            if ($this->imc<18.5){
                echo "Abaixo do peso.\n";
            } elseif ($this->imc >= 18.5 && $this->imc < 25){
                echo "Saudável.\n";
            } elseif ($this->imc >= 25 && $this->imc < 30){
                echo "Sobrepeso.\n";
            } elseif ($this->imc >= 30){
                echo "Obeso.\n";
            }
        }

        public function isNormal(){
            if (($this->idade>=19 && $this->idade<=24 && $this->imc>=19 && $this->imc <=24) || 
                ($this->idade>24 && $this->idade<=34 && $this->imc>=20 && $this->imc <=25) ||
                ($this->idade>34 && $this->idade<=44 && $this->imc>=21 && $this->imc <=26) ||
                ($this->idade>44 && $this->idade<=54 && $this->imc>=22 && $this->imc <=27) ||
                ($this->idade>54 && $this->idade<=64 && $this->imc>=23 && $this->imc <=28) ||
                ($this->idade>64 && $this->imc>=24 && $this->imc <=29)
                ){
                    return true;
                } else {
                    echo "IMC inadequado.\n";
                }
            }
        }

?>