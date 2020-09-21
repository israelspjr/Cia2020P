<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$tipo = $_POST['tipoRel'];
$where = " WHERE 1";
$idGrupo = implode(",",$_REQUEST['idGrupo']);
if($idGrupo!="-" && $idGrupo!="") $where .= " AND G.idGrupo IN (".$idGrupo.")";
	
if($tipo=="item"){
$itemProva = implode(",",$_REQUEST['idItenProva']);
if($itemProva) $where .= " AND IP.idItenProva IN (".$itemProva.")";
}

$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
//   $where .= " AND GER.gerente_idGerente in(".$idGerentes.")"; 
}

        $where .= " AND GPJ.clientePj_idClientePj =".$_SESSION['idClientePj_SS'];//. $_POST['clientePj_idClientePj'];	

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

if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
	$where .= " AND ( COALESCE(C.dataAplicacao, C.dataPrevistaNova, C.dataPrevistaInicial) ) >= '".$ano_ini."-".$mes_ini."-01'";
	
	$dataFim = date("Y-m-t", strtotime($ano_fim."-".$mes_fim."-01"));
	
	$where .= " AND ( COALESCE(C.dataAplicacao, C.dataPrevistaNova, C.dataPrevistaInicial) ) <= '".$dataFim."' ";
	
}
$status = $_POST['status'];

$sogrupo = (isset($_POST['sogrupo']))? 1 : 0;

$where .= " AND G.inativo = 0 AND CPF.inativo =0 AND ((IG.dataSaida is null) OR (IG.dataSaida >= '".$ano_ini."-".$mes_ini."-01'))";

