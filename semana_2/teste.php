<?php 
include "autoload.namespaces.php";

use classes\Atleta;
use classes\Medico;
use classes\logs\Relatorio;


$atleta = new Atleta("Luizito Soares", 1.75,75,35);
$medico = new Medico("Paulo Paixão", 3321, "Fisiologista", "8.750,00", 10);

$relatorio = new Relatorio;
$relatorio->add($atleta);
$relatorio->add($medico);
$relatorio->imprime();

?>