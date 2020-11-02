<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "../acao/filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioAcompanhamento($where, "", true,$mes_ini, $ano_ini, $mes_fim, $ano_fim);

echo json_encode($arrayRetorno);
?>