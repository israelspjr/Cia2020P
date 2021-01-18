<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
//array_unshift($campos,"Grupos");
//array_unshift($camposNome,"Grupos");

$where = " WHERE 1";

$idNotasTipoNota = $_REQUEST['idNotasTipoNota'];
if ($idNotasTipoNota != '') {
	$where .= " AND status2 = ".$idNotasTipoNota;
}

$status = $_REQUEST['status'];
if ($status != '') {
	$where .= " AND status = ".$status;
}

$idGrupo = $_REQUEST['grupo_idGrupo'];
if ($idGrupo != '') {
	if ($idGrupo != '-') {
		$where .= " AND grupo_idGrupo = ".$idGrupo;	
	}
	
}

$dataReferencia = $_REQUEST['dataReferencia'];
$dataReferencia2 = $_REQUEST['dataReferencia2'];

if (($dataReferencia != '') && ($dataReferencia2 != '')) {
	$dataReferencia1a = date("Y-m-d", strtotime(str_replace('/', '-', $dataReferencia)));
	$dataReferencia2a = date("Y-m-d", strtotime(str_replace('/', '-', $dataReferencia2)));

	 $where .= " AND (dataAvaliada BETWEEN '".$dataReferencia1a."' AND '".$dataReferencia2a."' )";

}

$idProfessor = $_REQUEST['professor_idProfessor'];
if ($idProfessor != '') {
	if ($idProfessor != '-') {
		$where .= " AND professor_idProfessor = ".$idProfessor;	
	}
}


//echo $where;
?>

