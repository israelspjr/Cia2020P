<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idCampanhaEmail = $_REQUEST['id'];	
	
	$CampanhaEmail = new CampanhaEmail();	
	$CampanhaLista = new CampanhaLista();	
	$CampanhaEmail->setIdCampanhaEmail($idCampanhaEmail);
	
	if($_POST['acao'] == 'deletar'){
		
//		$valorCampanhaEmail = $CampanhaEmail->selectCampanhaEmail(" WHERE idCampanhaEmail = ".$idCampanhaEmail);
		$CampanhaEmail->deleteCampanhaEmail();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{	
	$segmento = $_POST['segmento_idSegmento'];	
//	Uteis::pr($segmento);	

		$CampanhaEmail->setTitulo($_POST['titulo']);
		$CampanhaEmail->setTexto($_POST['valorTexto']);
		$CampanhaEmail->setDataEnvio(Uteis::gravarData($_POST['dataEnvio']));
		$CampanhaEmail->setHoraEnvio($_POST['horaEnvio']);
		$CampanhaEmail->setInativo($_POST['inativo']);
		$CampanhaEmail->setAssunto($_POST['assunto']);
		$CampanhaEmail->setNomeEnvio($_POST['nomeEnvio']);
		$CampanhaEmail->setEmailEnvio($_POST['emailEnvio']);				
		$CampanhaEmail->setClientePjIdClientePj($_POST['clientePj_idClientePj']);	
    	$CampanhaEmail->setClientePfIdClientePf($_POST['idClientePf']);		
		
		if($idCampanhaEmail != "" && $idCampanhaEmail > 0 ){
			$CampanhaEmail->updateCampanhaEmail();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idCampanhaEmail = $CampanhaEmail->addCampanhaEmail();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}	
		if ($segmento >0) {
			
			$CampanhaLista->deleteCampanhaListaOR(" OR campanha_idCampanha = ".$idCampanhaEmail);
				
		foreach($segmento as $valor) {
		$CampanhaLista->setCampanhaIdCampanha($idCampanhaEmail);
		$CampanhaLista->setListaIdLista($valor);
		$CampanhaLista->setInativo(0);
		$CampanhaLista->addCampanhaLista();	
			
			}
		}
		
	//	$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>