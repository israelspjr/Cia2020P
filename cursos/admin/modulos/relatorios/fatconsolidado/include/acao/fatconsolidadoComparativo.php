<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtrosC.php";

$arrayRetorno['excel'] = $Relatorio->relatorioFatConsolidado($where, $caminhoAtualizar, $ondeAtualizar,"",true);
$arrayRetorno['excel'] = $Relatorio->relatorioFatConsolidado($where1, $caminhoAtualizar, $ondeAtualizar,"", true, 1);

echo json_encode($arrayRetorno);
?>

