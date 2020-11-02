<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoCarreirra.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$PlanoCarreirra = new PlanoCarreirra();
	

$idPlanoCarreirra = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$PlanoCarreirra->setIdPlanoCarreira($idPlanoCarreirra);	
	$PlanoCarreirra->updateFieldPlanoCarreirra("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$plano = Uteis::gravarMoeda($_POST['plano']);
	
	$descricao = $_POST['descricao'];
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$PlanoCarreirra->setIdPlanoCarreira($idPlanoCarreirra);
  $PlanoCarreirra->setDescricao($descricao);
	$PlanoCarreirra->setPlano($plano);
	$PlanoCarreirra->setInativo($inativo);
	
	
	
	if($idPlanoCarreirra != "" && $idPlanoCarreirra > 0 ){
		$PlanoCarreirra->updatePlanoCarreirra();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idPlanoCarreirra = $PlanoCarreirra->addPlanoCarreirra();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>