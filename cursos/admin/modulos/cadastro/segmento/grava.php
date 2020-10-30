<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idSegmento = $_REQUEST['id'];	
	
	$Segmento = new Segmento();		
	$Segmento->setIdSegmento($idSegmento);
	
	if($_POST['acao'] == 'deletar'){
		
//		$valorSegmento = $Segmento->selectSegmento(" WHERE idSegmento = ".$idSegmento);
		$Segmento->deleteSegmento();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{			

		$Segmento->setValor($_POST['descricao']);	
		$Segmento->setInativo($_POST['inativo']);
		$Segmento->setSistema($_POST['sistema']);
		$Segmento->setBc($_POST['bc']);
		
		
		if($idSegmento != "" && $idSegmento > 0 ){
			$Segmento->updateSegmento();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idSegmento = $Segmento->addSegmento();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>