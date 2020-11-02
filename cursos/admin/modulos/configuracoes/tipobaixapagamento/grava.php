<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoBaixaPagamento.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoBaixaPagamento = new TipoBaixaPagamento();
	

$idTipoBaixaPagamento = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoBaixaPagamento->setIdTipoBaixaPagamento($idTipoBaixaPagamento);	
	$TipoBaixaPagamento->updateFieldTipoBaixaPagamento("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoBaixaPagamento->setIdTipoBaixaPagamento($idTipoBaixaPagamento);
	$TipoBaixaPagamento->setNome($nome);
	$TipoBaixaPagamento->setInativo($inativo);
	
	
	
	if($idTipoBaixaPagamento != "" && $idTipoBaixaPagamento > 0 ){
		$TipoBaixaPagamento->updateTipoBaixaPagamento();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoBaixaPagamento = $TipoBaixaPagamento->addTipoBaixaPagamento();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>