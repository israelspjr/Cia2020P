<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioAcompanhamento($where, "", true,$mes_ini, $ano_ini, $mes_fim, $ano_fim,1, $unicoAluno,$trazerfrequencia);

echo json_encode($arrayRetorno);
?>