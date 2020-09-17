<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$CalendarioProva = new CalendarioProva();
$idCalendarioProva = $_REQUEST['id'];
$x = $_REQUEST['x'];

$where = " WHERE idCalendarioProva = ".$idCalendarioProva;

$valorProva = $CalendarioProva->selectCalendarioProva($where);

if ($x == $valorProva[0]['codLiberacao']) {
	echo 1; 
} else {
	echo "<strong><font color=\"red\">Não foi possível acessar a prova, confirme o código</font></strong>";	
}
?>
