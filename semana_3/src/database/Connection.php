<?php

namespace Daoo\Aula03\database;

use Daoo\Aula03\controller\App;
use Exception;
use PDO;
use stdClass;

class Connection
{
    private static $instance;
    private static $db;

    public static function getConnection(): PDO
    {
        if(!isset(self::$instance)) {
            if(!isset($_ENV["APP_DB_HOST"])) {
                App::loadEnvs();
            }
            $db = new stdClass();
            $db->host = $_ENV['APP_DB_HOST'];
            $db->drive = $_ENV['APP_DB_DRIVE'];
            $db->name = $_ENV['APP_DB_NAME'];
            $db->port = $_ENV['APP_DB_PORT'] ?? '';
            $db->user = $_ENV['APP_DB_USER'];
            $db->pass = $_ENV['APP_DB_PASS'];
            $db->charset = isset($_ENV['APP_DB_CHARSET'])? $_ENV['APP_DB_CHARSET'] : null;
            self::$db = $db;

            if(!$db) {
                throw new Exception("Erro ao ler arquivo de configuração!");
            }

            switch($db->drive) {
                case 'mysql':
                    $dsn = "mysql:host=$db->host;"
                        . "dbname=$db->name;"
                        . "charset=$db->charset";
                    $port = $db->port ?? 3306;
                    $dsn .= ";port=$port";
                    break;
                case 'pgsql':
                    $dsn = "pgsql:host=$db->host;"
                        . "dbname=$db->name;";
                    $port = $db->port ?? 5432;
                    $dsn .= ";port=$port";
                    break;
                default: throw new Exception("Driver $db->drive não suportado!");
            }

            try {
                self::$instance = new PDO($dsn, $db->user, $db->pass);
            }catch(\PDOException $error) {
                error_log(
                    "CONNECTION: ".print_r([
                        $error->getMessage(),
                        $error->getTraceAsString()
                    ], true)
                );
               throw new Exception($error->getMessage());
            }
        }
        return self::$instance;
    }

    public static function getDrive(): string
    {
        return self::$db->drive;
    }
}
