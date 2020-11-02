<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idHabilidades = $_REQUEST['id'];
	$idProfessor = $_REQUEST['idProfessor'];	
	
	$Habilidades = new Habilidades();	
	$HabilidadesProfessor = new HabilidadesProfessor();	
	$Habilidades->setIdHabilidades($idHabilidades);
	
	if($_POST['acao'] == 'deletar'){
		
		$valorHabilidades = $Habilidades->selectHabilidades(" WHERE idHabilidades = ".$idHabilidades);
		$Habilidades->deleteHabilidades();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{			

		$Habilidades->setDescricao($_POST['descricao']);
		$Habilidades->setInativo($_POST['inativo']);
		$Habilidades->setHabilidadeIdHabilidade($_REQUEST['habilidade_idHabilidade']);	
		$Habilidades->setPergunta($_REQUEST['pergunta']);
		$Habilidades->setTipo($_REQUEST['tipo']);			
		
		if($idHabilidades != "" && $idHabilidades > 0 ){
			$Habilidades->updateHabilidades();
			$arrayRetorno['mensagem'] = MSG_CADATU;	
		}else{
			$idHabilidades = $Habilidades->addHabilidades();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}	
		
		if ($idProfessor > 0) {
		$HabilidadesProfessor->setIdHabilidade($idHabilidades);
		$HabilidadesProfessor->setIdProfessor($idProfessor);
		$HabilidadesProfessor->setObs("");						
		$HabilidadesProfessor->addHabilidadesProfessor();	
		
		$arrayRetorno['pagina'] = CAMINHO_CAD."professor/include/form/opcaoHabilidadesProfessor.php?id=".$idProfessor;
		$arrayRetorno['ondeAtualizar'] = "#div_lista_opcaoHabilidadesProfessor";	
		
		} else {
		$arrayRetorno['fecharNivel'] = true;		
		}
	}
			
	echo json_encode($arrayRetorno);
?>