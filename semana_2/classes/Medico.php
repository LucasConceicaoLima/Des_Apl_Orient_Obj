<?php

namespace classes;


class Medico extends Pessoa implements iFuncionario{

	private $CRM, $especialidade, $salario, $contrato;

	public function __construct($nome, $crm, $especialidade, $salario, $contrato)
	{
		$this->nome = $nome;
		$this->crm = $crm;
		$this->especialidade = $especialidade;
		$this->salario = $salario;
		$this->contrato = $contrato;
	}

	public function getCRM(){
		return $this->CRM;
	}

	public function getSalario(){
		return $this->salario;
	}

	public function getContrato(){
		return $this->contrato;
	}

	public function mostrarSalario(){
		echo "Salário: R$ " . getSalario() . ".\n";
	}

	public function mostrarTempoContrato(){
		echo "Contrado de" . getContrato() . "anos.\n";
	}

	public function __toString()
	{
		$className = self::class;
		return 	"\n===Dados de $className ==="
			. "\nNome: $this->nome"
			. ($this->idade ? "\nIdade: $this->idade" : "")
			. "\nEspecialidade: $this->especialidade"
			. "\nCRM: $this->crm\n";
	}
}

?>