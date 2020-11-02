<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Relatorio.class.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "../acao/filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioPagamento($where, true, $impostos, $idProfessor, $mes, $ano,  $idTipoBaixaPagamento, $aulas, $mesF, $anoF, $credDeb );

echo json_encode($arrayRetorno);
?>