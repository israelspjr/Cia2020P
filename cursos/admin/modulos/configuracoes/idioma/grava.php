<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Idioma = new Idioma();
	

$idIdioma = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$Idioma->setIdIdioma($idIdioma);	
	$Idioma->updateFieldIdioma("excluido", "1");		
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$idioma = $_POST['idioma'];
	$icon = $_POST['icon'];
	$linkTeste = $_POST['linkTeste'];
	
	$disponivelAula = $_POST['disponivelAula'];
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$Idioma->setIdIdioma($idIdioma);
	$Idioma->setIdioma($idioma);
	$Idioma->setIcon($icon);
	$Idioma->setInativo($inativo);
	$Idioma->setDisponivelAula($disponivelAula);
	$Idioma->setLinkTeste($linkTeste);
	
	
	
	if($idIdioma != "" && $idIdioma > 0 ){
		$Idioma->updateIdioma();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idIdioma = $Idioma->addIdioma();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>