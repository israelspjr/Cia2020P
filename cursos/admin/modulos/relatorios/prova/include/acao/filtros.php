<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ItenProva = new ItenProva();

$tipo = $_POST['tipoRel'];
$where = " WHERE 1";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$idGrupo = $_REQUEST['grupo_idGrupo'];
if($idGrupo!="-" && $idGrupo!="") $where .= " AND G.idGrupo IN (".$idGrupo.")";
	
if($tipo=="item"){
	$itemProva = implode(",", $_REQUEST['idItenProva']);
	
if (!empty($itemProva)) {


$itens = explode (",", $itemProva);

$where .= " AND ( IP.nome like 1 ";

foreach($itens as $valor) {

	
	$where .= " OR IP.nome like '".$ItenProva->getNome($valor)."'";
}

$where .= ")";

	}
}

$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
   $where .= " AND GER.gerente_idGerente in(".$idGerentes.") AND GER.dataexclusao is null"; 
}

if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") 
        $where .= " AND GPJ.clientePj_idClientePj = ".$_POST['clientePj_idClientePj'];	
		
if($_POST['professor_idProfessor']!="" && $_POST['professor_idProfessor']!="-") 
        $where .= " AND ICP.professor_idProfessor = ".$_POST['professor_idProfessor'];		
		

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$semPeri = (isset($_POST['semPeri']))? 1 : 0;

if ($idPlanoAcaoGrupo > 0) {
	
	$where .= " AND PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;	
}else {
	
	if ($semPeri == 0) {

if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
	$where .= " AND ( COALESCE(C.dataAplicacao, C.dataPrevistaNova, C.dataPrevistaInicial) ) >= '".$ano_ini."-".$mes_ini."-01'";
	
	$dataFim = date("Y-m-t", strtotime($ano_fim."-".$mes_fim."-01"));
	
	$where .= " AND ( COALESCE(C.dataAplicacao, C.dataPrevistaNova, C.dataPrevistaInicial) ) <= '".$dataFim."' ";
		}
	}
}

$status = $_POST['status'];

$pror = (isset($_POST['pror']))? 1 : 0;
if ($pror == 1) {
$where .= " AND C.dataPrevistaNova IS NOT NULL";
}

$statusG = $_POST['statusG'];

if ($statusG == 0) {
	$where .= " AND G.inativo = 0 AND CPF.inativo =0";
	
} elseif ($statusG == 1)  {
	$where .= " AND G.inativo = 1";	
}

 $hwere .= " AND ((IG.dataSaida is null) OR (IG.dataSaida >= '".$ano_ini."-".$mes_ini."-01'))";

//echo $where;