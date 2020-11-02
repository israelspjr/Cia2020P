<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoQualidadeComunicacao.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();
	

$idTipoQualidadeComunicacao = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoQualidadeComunicacao->setIdTipoQualidadeComunicacao($idTipoQualidadeComunicacao);	
	$TipoQualidadeComunicacao->updateFieldTipoQualidadeComunicacao("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$idioma_idIdioma = $_POST['idIdioma'];
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoQualidadeComunicacao->setIdTipoQualidadeComunicacao($idTipoQualidadeComunicacao);
	$TipoQualidadeComunicacao->setIdiomaIdIdioma($idioma_idIdioma);
	$TipoQualidadeComunicacao->setNome($nome);
	$TipoQualidadeComunicacao->setInativo($inativo);

	
	
	if($idTipoQualidadeComunicacao != "" && $idTipoQualidadeComunicacao > 0 ){
		$TipoQualidadeComunicacao->updateTipoQualidadeComunicacao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoQualidadeComunicacao = $TipoQualidadeComunicacao->addTipoQualidadeComunicacao();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>