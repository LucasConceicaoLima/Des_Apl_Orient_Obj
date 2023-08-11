<?php 

namespace classes\logs;

use classes\Pessoa;
use classes\Medico;

class Relatorio {

	private $listaPessoas = [];

	public function add(Pessoa $pessoa)
	{
		$this->listaPessoas[]=$pessoa;
	}
	
	public function log(Pessoa $pessoa)
	{
		echo "\nlog: ".$pessoa;
	}

	public function imprime(){
		echo "\n### RELATORIO ###\n";
		foreach ($this->listaPessoas as $pessoa){
			$this->log($pessoa);
			if($pessoa instanceof Medico){
				$pessoa->mostrarSalario();
				$pessoa->mostrarTempoContrato();
			}
		} 
		echo "\n#############\n";
	}
}

?>