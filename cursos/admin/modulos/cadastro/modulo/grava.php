<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idModulo = $_REQUEST['id'];	
	
	$Modulo = new Modulo();		
	$Modulo->setIdModulo($idModulo);
	
	if($_POST['acao'] == 'deletar'){
		
	//	$valorModulo = $Modulo->selectModulo(" WHERE idModulo = ".$idModulo);
		$Modulo->deleteModulo();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{	
	
	$inativo = $_POST['inativo'] ? $_POST['inativo'] : 0;
	$admin = $_POST['admin'] ? $_POST['admin'] : 0;
	$aluno = $_POST['aluno'] ? $_POST['aluno'] : 0;
	$preAluno = $_POST['preAluno'] ? $_POST['preAluno'] : 0;
	$professor = $_POST['professor'] ? $_POST['professor'] : 0;
	$candidato = $_POST['candidato'] ? $_POST['candidato'] : 0;
		
//	echo $inativo;	

		$Modulo->setNome($_POST['descricao']);	
		$Modulo->setInativo($inativo);	
		$Modulo->setModuloIdModulo($_POST['idModulo']);
		$Modulo->setLink($_POST['link']);
		$Modulo->setOrdem($_POST['ordem']);
		$Modulo->setAdmin($_POST['admin']);
		$Modulo->setAluno($_POST['aluno']);
		$Modulo->setPreAluno($_POST['preAluno']);
		$Modulo->setProfessor($_POST['professor']);
		$Modulo->setCandidato($_POST['candidato']);
//		$Modulo->setOperadoraCelularIdOperadoraCelular($_POST['idOperadoraCelular']);		
//		$Modulo->setObs($_POST['obs']);
			
		
		if($idModulo != "" && $idModulo > 0 ){
			$Modulo->updateModulo();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idModulo = $Modulo->addModulo();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
//		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>