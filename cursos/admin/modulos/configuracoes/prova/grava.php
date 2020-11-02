<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Prova.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$Prova = new Prova();
	

$idProva = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$Prova->setIdProva($idProva);	
	$Prova->updateFieldProva("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	$ordem = $_POST['ordem'];
	$obs = $_POST['obs'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$Prova->setIdProva($idProva);
	$Prova->setNome($nome);
	$Prova->setOrdem($ordem);
	$Prova->setObs($obs);
	$Prova->setInativo($inativo);
	
	
	
	if($idProva != "" && $idProva > 0 ){
		$Prova->updateProva();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idProva = $Prova->addProva();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>