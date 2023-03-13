<?php

namespace classes;

use classes\Paciente as PacienteData;

    Class IMC {

        public function calc (PacienteData $paciente){
            return $paciente->calcIMC();
        }

        public function classifica (PacienteData $paciente){
            if ($paciente->imc < 18.5){
                echo "\nPaciente abaixo do peso.\n";
            } elseif ($paciente->imc >= 18.5 && $paciente->imc <= 24.9) {
                echo "\nPaciente saudável.\n";
            } elseif ($paciente->imc >= 25.0 && $paciente->imc <= 29.9) {
                echo "\nPaciente com sobrepeso.\n";
            } elseif ($paciente->imc >= 30.0) {
                echo "\nPaciente com obesidade.\n";
            }
        }



    }
?>