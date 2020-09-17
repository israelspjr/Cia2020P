<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioFrequencia($where, $tipo, true, $FME, $frequencia, $tipoR, $d1, $d2, $alunoN,$rh,$freqReal, 1);

echo json_encode($arrayRetorno);
?>