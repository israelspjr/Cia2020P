<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtros.php";
//echo $where;
	
//$arrayRetorno['excel'] = $Relatorio->relatorioClientePf($where, $campos, $camposNome, true, $idGrupo, $idIdioma);
$arrayRetorno['excel'] = $Relatorio->relatorioClientePf($where, $campos, $camposNome, true, $idGrupo, $idIdioma,$comgrupo,$dataInicio, $dataFim);

echo json_encode($arrayRetorno);
?>