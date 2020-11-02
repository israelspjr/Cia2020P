<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$RelatorioNovo = new RelatorioNovo();

$arrayRetorno = array();

require_once "filtros.php";

$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

$arrayRetorno['excel'] =  $html. $RelatorioNovo->relatorioAulasAssistidas($where, true, $campos, $camposNome);


echo json_encode($arrayRetorno);


?>