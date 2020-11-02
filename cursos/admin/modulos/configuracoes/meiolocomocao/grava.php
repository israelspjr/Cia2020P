<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MeioLocomocao.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$MeioLocomocao = new MeioLocomocao();
	

$idMeioLocomocao = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$MeioLocomocao->setIdMeioLocomocao($idMeioLocomocao);	
	$MeioLocomocao->updateFieldMeioLocomocao("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$MeioLocomocao->setIdMeioLocomocao($idMeioLocomocao);
	$MeioLocomocao->setNome($nome);
	$MeioLocomocao->setInativo($inativo);
	
	
	
	if($idMeioLocomocao != "" && $idMeioLocomocao > 0 ){
		$MeioLocomocao->updateMeioLocomocao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idMeioLocomocao = $MeioLocomocao->addMeioLocomocao();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>