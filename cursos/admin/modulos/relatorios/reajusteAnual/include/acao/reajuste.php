<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtros.php";
    
$arrayRetorno['excel'] = $Relatorio->relatorioReajuste($where, true, $campos, $camposNome);

echo json_encode($arrayRetorno);
?>