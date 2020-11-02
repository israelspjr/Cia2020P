<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

$arrayRetorno = array();

require_once "filtros.php";
	
$arrayRetorno['excel'] = $RelatorioNovo->relatorioPolitica($where, true);

echo json_encode($arrayRetorno);
?>