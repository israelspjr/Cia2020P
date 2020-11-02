<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenQualidadeComunicacao.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ItenQualidadeComunicacao = new ItenQualidadeComunicacao();
	

$idItenQualidadeComunicacao = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ItenQualidadeComunicacao->setIdItenQualidadeComunicacao($idItenQualidadeComunicacao);	
	$ItenQualidadeComunicacao->updateFieldItenQualidadeComunicacao("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipoQualidadeComunicacao_idTipoQualidadeComunicacao = $_POST['idTipoQualidadeComunicacao'];
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ItenQualidadeComunicacao->setIdItenQualidadeComunicacao($idItenQualidadeComunicacao);
	$ItenQualidadeComunicacao->setTipoQualidadeComunicacaoIdTipoQualidadeComunicacao($tipoQualidadeComunicacao_idTipoQualidadeComunicacao);
	$ItenQualidadeComunicacao->setNome($nome);
	$ItenQualidadeComunicacao->setInativo($inativo);
	
	
	
	if($idItenQualidadeComunicacao != "" && $idItenQualidadeComunicacao > 0 ){
		$ItenQualidadeComunicacao->updateItenQualidadeComunicacao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idItenQualidadeComunicacao = $ItenQualidadeComunicacao->addItenQualidadeComunicacao();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>