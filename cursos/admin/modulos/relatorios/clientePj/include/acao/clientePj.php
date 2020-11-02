<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

$arrayRetorno = array();

require_once "../acao/filtros.php";
	
$arrayRetorno['excel'] = $RelatorioNovo->relatorioClientePj($where, $campos, $camposNome, true);

echo json_encode($arrayRetorno);
?>