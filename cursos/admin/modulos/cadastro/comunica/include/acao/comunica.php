<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idArquivos = $_REQUEST['id'];	
	
	$Comunica = new Comunica();		
	$Comunica->setIdArquivos($idArquivos);
	
	if($_POST['acao'] == 'deletar'){
		
//		$valorArquivos = $Comunica->selectHabilidades(" WHERE idHabilidades = ".$idHabilidades);
		$Comunica->deleteArquivos();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	}else{			

	//	$Habilidades->setIdHabilidades($idHabilidades);
		$Comunica->setNomeArquivo($_POST['descricao']);
		$Comunica->setInativo($_POST['inativo']);	
		$Comunica->setLink($_POST['link']);
		$Comunica->setBc($_POST['bc']);
		$Comunica->setIdiomaIdIdioma($_POST['idIdioma']);
		$Comunica->setCategoriaIdCategoria($_POST['segmento_idSegmento']);	

			
		
		if($idArquivos != "" && $idArquivos > 0 ){
			$Comunica->updateArquivos();
			$arrayRetorno['mensagem'] = MSG_CADATU;	
//			$arrayRetorno['campoAtualizar'][0]="#idItemCalendarioProva".$idItenProva."_".$idIntegranteGrupo;		
		}else{
			$idArquivos = $Comunica->addArquivos();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}				
		$arrayRetorno['fecharNivel'] = true;		
	}
			
	echo json_encode($arrayRetorno);
?>