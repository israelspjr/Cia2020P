<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idTelefone = $_REQUEST['id'];	
	
	$Telefone = new Telefone();		
	$Telefone->setIdTelefone($idTelefone);
	
	if($_POST['acao'] == 'deletar'){
		
		$valorTelefone = $Telefone->selectTelefone(" WHERE idTelefone = ".$idTelefone);
		$Telefone->deleteTelefone();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{			

		$Telefone->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
		$Telefone->setClientePfIdClientePf($_POST['clientePf_idClientePf']);
		$Telefone->setFuncionarioIdFuncionario($_POST['funcionario_idFuncionario']);
		$Telefone->setProfessorIdProfessor($_POST['professor_idProfessor']);
		$Telefone->setContatoAdicionalIdContatoAdicional($_POST['ContatoAdicional_idContatoAdicional']);
		
		$Telefone->setDdd($_POST['ddd']);	
		$Telefone->setNumero($_POST['numero']);	
		$Telefone->setDescricaoTelefoneIdDescricaoTelefone($_POST['idDescricaoTelefone']);	
		$Telefone->setOperadoraCelularIdOperadoraCelular($_POST['idOperadoraCelular']);		
		$Telefone->setObs($_POST['obs']);
			
		
		if($idTelefone != "" && $idTelefone > 0 ){
			$Telefone->updateTelefone();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idTelefone = $Telefone->addTelefone();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>