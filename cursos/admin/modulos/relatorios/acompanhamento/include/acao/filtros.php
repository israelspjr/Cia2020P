<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$where = "WHERE 1 ";

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
/*if ($mes_ini < 10) {
	$mesIni = "0".$mes_ini;
}*/
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
/*if ($mes_fim < 10) {
	$mesFim = "0".$mes_fim;
}
*/
if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
/*	
	*/ if ($ano_ini > $ano_fim) { 
		echo "filtro inválido.<br>";
		echo "Ano inicial maior que ano final";
		exit;
	}
}

		
$idProfessor = implode(",",$_POST['idProfessor']);
if($idProfessor) $where .= " AND PR.idProfessor IN(".$idProfessor.")";	 

$idGrupo = $_REQUEST['grupo_idGrupo'];

if($idGrupo != "-") {
	$where .= " AND G.idGrupo IN (".$idGrupo.")";	
}
/*
$finalizadoParcial = $_POST['finalizadoParcial'];
if($finalizadoParcial!='') $where .= " AND A.finalizadoParcial = ".$finalizadoParcial;

$finalizadoGeral = $_POST['finalizadoGeral'];
if($finalizadoGeral!='') $where .= " AND A.finalizadoGeral = ".$finalizadoGeral;
*/
$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
   $where .= " AND GER.gerente_idGerente in(".$idGerentes.")"; 
}

if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") {
        $where .= " AND GPJ.clientePj_idClientePj = ".$_POST['clientePj_idClientePj'];	
$idClientePj = $_POST['clientePj_idClientePj'];
}
		
$status =  $_POST['statusG'];
if($status != "-"){
if( $status != '' ) $where .= " AND G.inativo = ".$status;
}	

$mostrarTudo = $_POST['mostrarTudo'];
if ($mostrarTudo == 0) {
$where .= " AND PAG.inativo = 0";
}

$idIntegranteGrupo = $_POST['idIntegranteGrupo'];
if ($idIntegranteGrupo != '') {
$where .= " AND IG.idIntegranteGrupo = ".$idIntegranteGrupo;
$unicoAluno = 1;	
}

$frequencia = $_POST['frequencia'];
if ($frequencia == 'on') {
	
$trazerfrequencia = 1;	
}
//echo $trazerfrequencia;

//echo "//".$where;
?>
