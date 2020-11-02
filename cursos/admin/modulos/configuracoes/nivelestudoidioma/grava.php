<?php
//pagina conteudo a pagina de gravação
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$NivelEstudoIdioma = new NivelEstudoIdioma();

$idNivelEstudoIdioma = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$NivelEstudoIdioma->setIdNivelEstudoIdioma($idNivelEstudoIdioma);	
	$NivelEstudoIdioma->updateFieldNivelEstudoIdioma("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nivel_IdNivel = $_POST['IdNivelEstudo'];
	$idioma_idIdioma = $_POST['idIdioma'];

	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	$provaOral = ( $_POST['provaOral'] == "1" ? 1 : 0);
	$provaOn = ( $_POST['provaOn'] == "1" ? 1 : 0);
	
	$NivelEstudoIdioma->setIdNivelEstudoIdioma($idNivelEstudoIdioma);
	$NivelEstudoIdioma->setNivelIdNivel($nivel_IdNivel);
	$NivelEstudoIdioma->setIdiomaIdIdioma($idioma_idIdioma);
	$NivelEstudoIdioma->setInativo($inativo);
	$NivelEstudoIdioma->setProvaOral($provaOral);
	$NivelEstudoIdioma->setProvaOn($provaOn);

	if($idNivelEstudoIdioma != "" && $idNivelEstudoIdioma > 0 ){
		$NivelEstudoIdioma->updateNivelEstudoIdioma();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idNivelEstudoIdioma = $NivelEstudoIdioma->addNivelEstudoIdioma();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>