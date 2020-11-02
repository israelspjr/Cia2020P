<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TipoImpostoProfessor = new TipoImpostoProfessor();

$idTipoImpostoProfessor = $_REQUEST['id'];

$arrayRetorno = array();

if ($_POST['acao'] == "deletar") {

	$TipoImpostoProfessor -> setIdTipoImpostoProfessor($idTipoImpostoProfessor);
	$TipoImpostoProfessor -> updateFieldTipoImpostoProfessor("excluido", "1");

	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";

} else {

	$nome = $_POST['nome'];
	$sigla = $_POST['sigla'];	
	$inativo = ($_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoImpostoProfessor -> setIdTipoImpostoProfessor($idTipoImpostoProfessor);
	$TipoImpostoProfessor -> setNome($nome);
	$TipoImpostoProfessor -> setSigla($sigla);
	$TipoImpostoProfessor -> setTipoImpostoProfessorIdTipoImpostoProfessor($_POST['idTipoImpostoProfessor']);
	$TipoImpostoProfessor -> setInativo($inativo);

	if ($idTipoImpostoProfessor != "" && $idTipoImpostoProfessor > 0) {
		$TipoImpostoProfessor -> updateTipoImpostoProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	} else {
		$idTipoImpostoProfessor = $TipoImpostoProfessor -> addTipoImpostoProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
	
}

echo json_encode($arrayRetorno);
?>