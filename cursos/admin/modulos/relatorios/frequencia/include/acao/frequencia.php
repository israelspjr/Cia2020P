<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "../acao/filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioFrequencia($where, $tipo, true,$FME, $frequencia, $tipoR, $dInicial, $dFinal, $alunoN,"", $freqReal,"", "", $d1, $d2);

echo json_encode($arrayRetorno);
?>