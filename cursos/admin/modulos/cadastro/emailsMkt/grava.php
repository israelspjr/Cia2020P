<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idEmailsMkt = $_REQUEST['id'];	
	
	$EmailsMkt = new EmailsMkt();		
	$EmailsMkt->setIdEmailsMkt($idEmailsMkt);
	
	if($_POST['acao'] == 'deletar'){
		
//		$valorEmailsMkt = $EmailsMkt->selectEmailsMkt(" WHERE idEmailsMkt = ".$idEmailsMkt);
		$EmailsMkt->deleteEmailsMkt();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{			

		$EmailsMkt->setNome($_POST['descricao']);
		$EmailsMkt->setValor($_POST['valor']);
		$EmailsMkt->setClientePjIdClientePj($_POST['clientePj_idClientePj']);	
		$EmailsMkt->setInativo($_POST['inativo']);	
		$EmailsMkt->setSegmentoIdSegmento($_POST['segmento_idSegmento']);		
//		$EmailsMkt->setObs($_POST['obs']);
			
		
		if($idEmailsMkt != "" && $idEmailsMkt > 0 ){
			$EmailsMkt->updateEmailsMkt();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idEmailsMkt = $EmailsMkt->addEmailsMkt();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>