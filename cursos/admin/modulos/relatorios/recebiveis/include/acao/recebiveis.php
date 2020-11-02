<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "../acao/filtros.php";
	
$arrayRetorno['excel'] = $Relatorio->relatorioRecebiveis($where, "", true, $campos, $camposNome);

echo json_encode($arrayRetorno);
?>