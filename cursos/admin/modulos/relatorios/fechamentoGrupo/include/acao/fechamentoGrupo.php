<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

$arrayRetorno = array();

require_once "filtros.php";
	
$arrayRetorno['excel'] = $RelatorioNovo->relatorioFechamentoGrupo($where, "", true, $campos, $camposNome);

echo json_encode($arrayRetorno);
?>