<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$ProvaOnQuestoes = new ProvaOnQuestoes();
	
	$idProva = $_REQUEST['idProva'];
	$idQuestao = $_REQUEST['idQuestao'];
	
	$ProvaOnQuestoes->setId($idProva);
	
	if($_POST['acao'] == 'deletar'){
		
		$ProvaOnQuestoes->setId($_POST['id']);
		
	//	$valorQuestao = $Questao->selectQuestao(" WHERE idQuestao = ".$idQuestao);
	//	$ProvaOnQuestoes->deleteProvaOnQuestoes();
		$ProvaOnQuestoes->updateFieldProvaOnQuestoes("excluido", 1);
		$arrayRetorno['mensagem'] = MSG_CADDEL;
				
	} else {
		
	  //$ProvaOnQuestoes->deleteProvaOnQuestoes();
		
//	$idNivel = $_POST['IdNivelEstudo'];
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	$excluido = ( $_POST['excluido'] == "1" ? 1 : 0);	
	
//	Uteis::pr($idQuestao);

// For each questoes
	//	$Questao->setDescricao($_POST['descricao']);
	
		
	
	foreach ($idQuestao as $valor) { 
	
		$ProvaOnQuestoes->setProvasOnIdProvaOn($idProva);
		$ProvaOnQuestoes->setQuestaoIdQuestao($valor);
		$ProvaOnQuestoes->setInativo($inativo);
		$ProvaOnQuestoes->setExcluido($excluid);
		
	/*	if($idQuestaoProvaOn != "" && $idQuestaoProvaOn > 0 ){
			$ProvaOnQuestoes->updateProvaOnQuestoes();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{*/
			$idProvaonQuestao = $ProvaOnQuestoes->addProvaOnQuestoes();		
			
		}

		$arrayRetorno['mensagem'] = MSG_CADNEW;	
		$arrayRetorno['fecharNivel'] = true;
	
			
	}
			
	echo json_encode($arrayRetorno);
?>