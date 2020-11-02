<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Relatorio.class.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioPagConsolidado($where, true, $idProfessor, $mes, $ano, $mesF, $anoF,  $idTipoBaixaPagamento );

echo json_encode($arrayRetorno);
?>