<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();
//$CalendarioProva = new CalendarioProva();
$arrayRetorno = array();

require_once "filtrosR.php";

$status = $_POST['status'];

if ($status == 1) {
	$arrayRetorno['excel'] = $Relatorio->relatorioProvaAplicadas($where, $tipo, $excel, $status, $where2, "", "", $campos, $camposNome);
} elseif ($status == 2) {
	$arrayRetorno['excel'] = $Relatorio->relatorioProvaAgendadas($where, $tipo, $excel, $status, $where2, 1, $campos, $camposNome, 2);
} else {
	$arrayRetorno['excel'] = $Relatorio->relatorioProvaAplicadas($where, $tipo, $excel, $status, $where2, "", "", $campos, $camposNome);
	
	$arrayRetorno['excel'] = $Relatorio->relatorioProvaAgendadas($where, $tipo, $excel, $status, $where2, 1, $campos, $camposNome, 2);
}
	

echo json_encode($arrayRetorno);

?>