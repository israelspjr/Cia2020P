<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenProva.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ItenProva = new ItenProva();
	

$idItenProva = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ItenProva->setIdItenProva($idItenProva);	
	$ItenProva->updateFieldItenProva("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$prova_idProva = $_POST['idProva'];
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ItenProva->setIdItenProva($idItenProva);
	$ItenProva->setProvaIdProva($prova_idProva);
	$ItenProva->setNome($nome);
	$ItenProva->setInativo($inativo);
	
	
	
	if($idItenProva != "" && $idItenProva > 0 ){
		$ItenProva->updateItenProva();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idItenProva = $ItenProva->addItenProva();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>