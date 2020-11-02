<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$AliquotaTipoImpostoProfessor = new AliquotaTipoImpostoProfessor();

$idAliquotaTipoImpostoProfessor = $_REQUEST['id'];

$arrayRetorno = array();

if ($_POST['acao'] == "deletar") {

	$AliquotaTipoImpostoProfessor -> setIdAliquotaTipoImpostoProfessor($idAliquotaTipoImpostoProfessor);
	$AliquotaTipoImpostoProfessor -> updateFieldAliquotaTipoImpostoProfessor("excluido", "1");

	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";

} else {

	$tipoImpostoProfessor_idTipoImpostoProfessor = $_POST['idTipoImpostoProfessor'];
	$de = $_POST['de'];
	$ate = $_POST['ate'];
	$porcentagem = $_POST['porcentagem'];
	$parcelaDedutiva = $_POST['parcelaDedutiva'];
    $valorMaximo = $_POST['teto']; 
	$inativo = ($_POST['inativo'] == "1" ? 1 : 0);

	$AliquotaTipoImpostoProfessor -> setIdAliquotaTipoImpostoProfessor($idAliquotaTipoImpostoProfessor);
	$AliquotaTipoImpostoProfessor -> setTipoImpostoProfessorIdTipoImpostoProfessor($tipoImpostoProfessor_idTipoImpostoProfessor);
	$AliquotaTipoImpostoProfessor -> setDe($de);
	$AliquotaTipoImpostoProfessor -> setAte($ate);
	$AliquotaTipoImpostoProfessor -> setPorcentagem($porcentagem);
	$AliquotaTipoImpostoProfessor -> setParcelaDedutiva($parcelaDedutiva);
    $AliquotaTipoImpostoProfessor -> setValorMaximo($valorMaximo);
	$AliquotaTipoImpostoProfessor -> setInativo($inativo);

	if ($idAliquotaTipoImpostoProfessor != "" && $idAliquotaTipoImpostoProfessor > 0) {
		$AliquotaTipoImpostoProfessor -> updateAliquotaTipoImpostoProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	} else {
		$idAliquotaTipoImpostoProfessor = $AliquotaTipoImpostoProfessor -> addAliquotaTipoImpostoProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}

	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>