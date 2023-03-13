<?php 

include 'autoload.namespaces.php';

use classes\Paciente;
use classes\IMC;

$pa1 = new Paciente("Lucas", 25, 1.8, 91);
$pa2 = new Paciente("Livia", 21, 1.6, 41);
$pa3 = new Paciente("Lorenzo", 20, 1.8, 112);

$IMC = new IMC();


$IMC->calc($pa1);
$IMC->classifica($pa1);

$IMC->calc($pa2);
$IMC->classifica($pa2);

$IMC->calc($pa3);
$IMC->classifica($pa3);

?>