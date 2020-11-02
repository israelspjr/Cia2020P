<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//MONTA CAMPO
$where = "WHERE 1";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];


$gerente = implode(",",$_POST['idGerente']);
if ($gerente != "-") {
	if ($gerente != '') {
		$where .= " AND GT.gerente_idGerente in ( ".$gerente.") AND GT.dataExclusao is null";
	}
}
	
$empresa = $_POST['clientePj_idClientePj'];
if ($empresa != "-") {
	if ($empresa != '') {
		$where .= " AND GCP.clientePj_idClientePj = ".$empresa;
	}
}

$idGrupo = $_POST['grupo_idGrupo']; 
if ($idGrupo != "-" ) {
	if ($idGrupo != '') {
		$where .= " AND G.idGrupo in (".$idGrupo.") ";
	}
	
}
$tipo = $_POST['reposicao'];


$data1 = Uteis::gravarData($_POST['dataReferencia']);
$data2 = Uteis::gravarData($_POST['dataReferencia2']);

if ($tipo == 1) {
	$where .= " AND (ADT.dataAula between '".$data1."' AND '".$data2."')";
} else {
	$where .= " AND (AGP.dataFim between '".$data1."' AND '".$data2."')";
}

$motivo = $_POST['motivo'];
if ($motivo != "")
	if ($motivo != "-")
		$where .= " AND AGP.motivo = ".$motivo;
		
$subMotivo1 = $_REQUEST['subMotivo'];

$subMotivo2 = $_REQUEST['subMotivo2'];

if ($subMotivo1 != '') {
	$motivoOK = $subMotivo1;	
}

if ($subMotivo2 != '') {
	$motivoOK = $subMotivo2;		
}

if ($motivoOK != '') {
	
	$where .= " AND AGP.subMotivo = ".$motivoOK;	 
}
	
//echo $where;	
