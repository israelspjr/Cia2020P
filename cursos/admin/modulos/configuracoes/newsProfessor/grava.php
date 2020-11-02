<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$NewsProfessor = new NewsProfessor();
	

$idNewsProfessor = $_REQUEST['id'];
$arrayRetorno = array();
if($_POST['acao']=="deletar"){
	
	$NewsProfessor->setIdNewsProfessor($idNewsProfessor);
	$NewsProfessor->deleteNewsProfessor();
	
		
//	$AtividadeExtra->setIdAtividadeExtra($idAtividadeExtra);	
//	$AtividadeExtra->updateFieldAtividadeExtra("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro deletado com sucesso.<br />";
		
}else{
	
//	$idTipoAtividadeExtra = $_POST['idTipoAtividadeExtra'];
	$news = $_POST['texto'];
//	$portal = 1; //$_POST['portal'];
	$grupo = ($_POST['grupo'] == "1" ? 1 : 0);
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	$popup = ( $_POST['popup'] == "1" ? 1 : 0);
	$portal = $_POST['portal'];
	
	$NewsProfessor->setIdNewsProfessor($idNewsProfessor);
//	$AtividadeExtra->setTipoAtividadeExtraIdTipoAtividadeExtra($idTipoAtividadeExtra);
	$NewsProfessor->setNews($news);
    $NewsProfessor->setPortal($portal);
	$NewsProfessor->setInativo($inativo);
	$NewsProfessor->setPopup($popup);
	
	
	$NewsProfessor->setGrupo($grupo);
	
	if($idNewsProfessor != "" && $idNewsProfessor > 0 ){
		$NewsProfessor->updateNewsProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idNewsProfessor = $NewsProfessor->addNewsProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>