<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

 //FILTROS
$where = "WHERE 1 ";

$tipo = $_POST['tipo'];

$valorGerente =  implode(",",$_POST['idGerente']); 
if ($valorGerente != '-') {
	$idGerente2 = $valorGerente;
}



$dataCadastro = $_POST['dataCadastro'];
$dataCadastro2 = $_POST['dataCadastro2'];
if($dataCadastro && $dataCadastro2) {
	$mes1 = Uteis::gravarData($dataCadastro);
	$mes2 = Uteis::gravarData($dataCadastro2);
	
	$where .= " AND MONTH(P.dataNascimento) BETWEEN MONTH('".$mes1."') AND MONTH('".$mes2."' )";
	
}


//require_once "index.php";
//echo $where;
	
$arrayRetorno['excel'] = $Relatorio->relatorioAniversariantesTr($where, $tipo, $iGerente2, true);

echo json_encode($arrayRetorno);
?>