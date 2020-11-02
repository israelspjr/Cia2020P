<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProvaOn = new ProvaOn();
	

$idProva = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ProvaOn->setIdProvaOn($idProva);	
	$ProvaOn->updateFieldProvaOn("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	$ordem = $_POST['ordem'];
	$obs = $_POST['obs'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ProvaOn->setIdProvaOn($idProva);
	$ProvaOn->setNome($nome);
	$ProvaOn->setOrdem($ordem);
	$ProvaOn->setObs($obs);
	$ProvaOn->setInativo($inativo);
	$ProvaOn->setIdiomaIdIdioma($_POST['idIdioma']);
	$ProvaOn->setExcluido(0);
	$ProvaOn->setFocoCursoIdFocoCurso($_POST['idFocoCurso']);
	$ProvaOn->setNivelEstudoIdNivelEstudo($_POST['IdNivelEstudo']);
	$ProvaOn->setKitMaterialIdKitMaterial($_POST['idKitMaterial']);
	
	
	if($idProva != "" && $idProva > 0 ){
		$ProvaOn->updateProvaOn();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idProva = $ProvaOn->addProvaOn();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
		$arrayRetorno['atualizarNivelAtual'] = true;
  		$arrayRetorno['pagina'] = CAMINHO_REL."provas/formulario.php?id=".$idProva;
  	
	//$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>