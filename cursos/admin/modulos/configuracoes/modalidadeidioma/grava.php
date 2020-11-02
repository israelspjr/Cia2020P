<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$ModalidadeIdioma = new ModalidadeIdioma();

$idModalidadeIdioma = $_REQUEST['id'];

$arrayRetorno = array();

if ($_POST['acao'] == "deletar") {

	$ModalidadeIdioma -> setIdModalidadeIdioma($idModalidadeIdioma);
	$ModalidadeIdioma -> updateFieldModalidadeIdioma("excluido", "1");

	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";

} else {

	$modalidade_idModalidade = $_POST['idModalidade'];
	$idioma_idIdioma = $_POST['idIdioma'];
	$valorHoraPadrao = $_POST['valorHoraPadrao'];

	$obs = $_POST['obs'];

	$inativo = ($_POST['inativo'] == "1" ? 1 : 0);

	$ModalidadeIdioma -> setIdModalidadeIdioma($idModalidadeIdioma);
	$ModalidadeIdioma -> setModalidadeIdModalidade($modalidade_idModalidade);
	$ModalidadeIdioma -> setIdiomaIdIdioma($idioma_idIdioma);
	$ModalidadeIdioma -> setValorHoraPadrao($valorHoraPadrao);
	$ModalidadeIdioma -> setInativo($inativo);
	$ModalidadeIdioma -> setObs($obs);

	if ($idModalidadeIdioma != "" && $idModalidadeIdioma > 0) {
		$ModalidadeIdioma -> updateModalidadeIdioma();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	} else {
		$idModalidadeIdioma = $ModalidadeIdioma -> addModalidadeIdioma();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>