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

        public function isNormal2() {
            $ageRanges = [
                [19, 24],
                [25, 34],
                [35, 44],
                [45, 54],
                [55, 64],
                [65, PHP_INT_MAX], // Assuming 65+ age is considered the same range
            ];
            
            $imcRanges = [
                [19, 24],
                [20, 25],
                [21, 26],
                [22, 27],
                [23, 28],
                [24, 29],
            ];
            
            foreach ($ageRanges as $i => $ageRange) {
                [$minAge, $maxAge] = $ageRange;
                [$minImc, $maxImc] = $imcRanges[$i];
                
                if ($this->idade >= $minAge && $this->idade <= $maxAge && $this->imc >= $minImc && $this->imc <= $maxImc) {
                    return true;
                }
            }
            
            echo "IMC inadequado.\n";
            return false;
        }
        
    }
?>