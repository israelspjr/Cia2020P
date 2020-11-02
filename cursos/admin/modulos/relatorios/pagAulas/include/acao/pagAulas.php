<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";


$arrayRetorno = array();

$rel = $Relatorio->relatorioPagAulas($where, $mes, $ano, "", "", $idProfessor, true);

if ($compara == 1) {
$rel1 =	$Relatorio->relatorioPagAulas($where, $mes1, $ano1, "", "", $idProfessor, true);
	
}

$arrayRetorno['excel']  = $rel . $rel1;

echo json_encode($arrayRetorno);

?>
