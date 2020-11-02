<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "../acao/filtros.php";
	
$arrayRetorno['texto'] = $Relatorio->relatorioPagamento($where, true, $impostos, $idProfessor, $mes, $ano,  $idTipoBaixaPagamento, $aulas );

echo json_encode($arrayRetorno);
?>