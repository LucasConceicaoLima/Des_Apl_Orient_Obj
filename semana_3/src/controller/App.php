<?php
namespace Daoo\Aula03\controller;

use Dotenv\Dotenv;
use Exception;

class App{
	public static function init() :void {
		self::loadEnvs();
		error_log("DIR:\n".__DIR__."\n");
		include_once(__DIR__."/../config/routes.php");
		Route::routes($routes);
	}
	
	public static function loadEnvs(): void{
		$dotenv = Dotenv::createImmutable(__DIR__."/../../");
		$dotenv->load();
		if(!count($_ENV))
			throw new Exception("Erro ao carregar variáveis de ambiente!");
		error_log("\nENV Criado: ".count($_ENV)." vars");
		error_log("ENV:\n".print_r($_ENV,TRUE));
	}
}