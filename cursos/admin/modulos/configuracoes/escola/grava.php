<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Escola = new Escola();
	
$idEscola = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
			
	$Escola->setIdEscola($idEscola);	
	$Escola->updateFieldEscola("excluido", "1");	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
		
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$Escola->setIdEscola($idEscola);
	$Escola->setNome($nome);
	$Escola->setInativo($inativo);
		
	if($idEscola != "" && $idEscola > 0 ){
		$Escola->updateEscola();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idEscola = $Escola->addEscola();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
	
}

echo json_encode($arrayRetorno);
?>