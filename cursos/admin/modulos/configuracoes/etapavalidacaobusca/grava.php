<?php
//pagina conteudo a pagina de gravação

include_once ($_SERVER['DOCUMENT_ROOT']."/sistema/config/admin.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/sistema/config/class/EtapaValidacaoBusca.class.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/sistema/config/class/Uteis.class.php");

$EtapaValidacaoBusca = new EtapaValidacaoBusca();
	

$idEtapaValidacaoBusca = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$EtapaValidacaoBusca->setIdEtapaValidacaoBusca($idEtapaValidacaoBusca);	
	$EtapaValidacaoBusca->updateFieldEtapaValidacaoBusca("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$etapa = $_POST['etapa'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$EtapaValidacaoBusca->setIdEtapaValidacaoBusca($idEtapaValidacaoBusca);
	$EtapaValidacaoBusca->setEtapa($etapa);
	$EtapaValidacaoBusca->setInativo($inativo);
	
	
	
	if($idEtapaValidacaoBusca != "" && $idEtapaValidacaoBusca > 0 ){
		$EtapaValidacaoBusca->updateEtapaValidacaoBusca();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idEtapaValidacaoBusca = $EtapaValidacaoBusca->addEtapaValidacaoBusca();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivelAtual'] = true;
}

echo json_encode($arrayRetorno);
?>