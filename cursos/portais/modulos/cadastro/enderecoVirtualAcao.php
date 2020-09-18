<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$arrayRetorno = array();
$idEnderecoVirtual = $_REQUEST['id'];	

$EnderecoVirtual = new EnderecoVirtual();		
$EnderecoVirtual->setidEnderecoVirtual($idEnderecoVirtual);

if($_POST['acao'] == 'deletar'){
	
	$EnderecoVirtual->deleteEnderecoVirtual();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$EnderecoVirtual->setContatoAdicionalIdContatoAdicional($_POST['contatoAdicional_IdContatoAdicional']);
	$EnderecoVirtual->setClientePfIdClientePf($_POST['clientePf_idClientePf']);
	$EnderecoVirtual->setFuncionarioIdFuncionario($_POST['funcionario_idFuncionario']);
	$EnderecoVirtual->setProfessorIdProfessor($_POST['professor_idProfessor']);
	$EnderecoVirtual->settipoEnderecoVirtual_idTipoEnderecoVirtual($_POST['idTipo']);
	$EnderecoVirtual->setValor($_POST['valor']);
	$EnderecoVirtual->setEprinc($_POST['principal']);
	
	
	if($idEnderecoVirtual != "" && $idEnderecoVirtual > 0 ){
		$EnderecoVirtual->updateEnderecoVirtual();
		$arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";			
	}else{
		$idEnderecoVirtual = $EnderecoVirtual->addEnderecoVirtual();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
