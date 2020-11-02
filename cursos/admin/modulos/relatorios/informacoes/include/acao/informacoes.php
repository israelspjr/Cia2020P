<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioInformacoes($where, "", true);

echo json_encode($arrayRetorno);
?>