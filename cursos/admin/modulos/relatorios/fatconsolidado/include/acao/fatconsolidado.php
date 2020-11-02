<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";

$arrayRetorno['excel']  = $Relatorio->relatorioFatConsolidado($where, $caminhoAtualizar, $ondeAtualizar, "", true);

echo json_encode($arrayRetorno);
?>
