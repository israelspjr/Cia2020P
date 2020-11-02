<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtros.php";

$status = $_POST['status'];

$excel = true;

if ($status == 1) {
	$arrayRetorno['excel'] = $Relatorio->relatorioProvaAplicadas($where, $tipo, $excel, $status, $where2, "", "", $campos, $camposNome);
} elseif ($status == 2) {
	$arrayRetorno['excel'] = $Relatorio->relatorioProvaAgendadas($where, $tipo, $excel, $status, $where2, 1, $campos, $camposNome, 2);
} else {
	$arrayRetorno['excel'] = $Relatorio->relatorioProvaAplicadas($where, $tipo, $excel, $status, $where2, "", "", $campos, $camposNome);
	$arrayRetorno['excel'] .= "<p>&nbsp;</p>";
	$arrayRetorno['excel'] .= $Relatorio->relatorioProvaAgendadas($where, $tipo, $excel, $status, $where2, 1, $campos, $camposNome, 2);
}
	
echo json_encode($arrayRetorno);
?>