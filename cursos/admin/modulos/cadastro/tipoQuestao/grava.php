<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idTipoQuestao = $_REQUEST['id'];	
	
	$TipoQuestao = new TipoQuestao();		
	$TipoQuestao->setIdTipoQuestao($idTipoQuestao);
	
	if($_POST['acao'] == 'deletar'){
		
	//	$valorTipoQuestao = $TipoQuestao->selectTipoQuestao(" WHERE idTipoQuestao = ".$idTipoQuestao);
		$TipoQuestao->deleteTipoQuestao();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{			

		$TipoQuestao->setDescricao($_POST['descricao']);	
		$TipoQuestao->setInativo($_POST['inativo']);	

		
		if($idTipoQuestao != "" && $idTipoQuestao > 0 ){
			$TipoQuestao->updateTipoQuestao();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idTipoQuestao = $TipoQuestao->addTipoQuestao();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>