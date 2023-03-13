<?php 

namespace classes\logs;

use classes\Paciente as PacienteData;

class Paciente {
	public static function log(PacienteData $paciente){
		echo "\nLog:\n";
		var_dump($paciente);
	}
}

?>