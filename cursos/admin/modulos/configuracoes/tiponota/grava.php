<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoNota.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoNota = new TipoNota();
	

$idTipoNota = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoNota->setIdTipoNota($idTipoNota);	
	$TipoNota->updateFieldTipoNota("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	$descritiva = $_POST["descritiva"];
	
	$TipoNota->setIdTipoNota($idTipoNota);
	$TipoNota->setNome($nome);
	$TipoNota->setDescricao($descricao);
	$TipoNota->setInativo($inativo);
	$TipoNota->setDescritiva($descritiva);
	
	
	
	if($idTipoNota != "" && $idTipoNota > 0 ){
		$TipoNota->updateTipoNota();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoNota = $TipoNota->addTipoNota();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>