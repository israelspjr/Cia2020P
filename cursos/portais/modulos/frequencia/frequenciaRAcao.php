<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtrosR.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioFrequencia($where, $tipo, true,$FME, $frequencia, $tipoR);

echo json_encode($arrayRetorno);
?>