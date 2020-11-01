<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Questao = new Questao();
$NivelEstudoIdioma = new NivelEstudoIdioma();

//FILTROS
$idQuestao = $_REQUEST['idQuestao'];


$valorQuestao = $Questao->selectQuestao(" WHERE idQuestao = ".$idQuestao);

//Copiando Questão

		$Questao->setInativo(0);
		$Questao->setNivelEstudoIdNivelEstudo($valorQuestao[0]['nivelEstudo_idNivelEstudo']);
		$Questao->setTitulo("Cópia:".$valorQuestao[0]['titulo']);
		$Questao->setEnunciado($valorQuestao[0]['enunciado']);
		$Questao->setImagem('');
		$Questao->setAudio('');
		$Questao->setQuestaoIdQuestao($valorQuestao[0]['questao_IdQuestao']);
		$Questao->setTipoQuestaoIdTipoQuestao($valorQuestao[0]['tipoQuestao_idTipoQuestao']);
		$Questao->setIdiomaIdIdioma($valorQuestao[0]['idioma_idIdioma']);
		$Questao->setCategoria($valorQuestao[0]['categoria']);
		$Questao->setSubCategoria($valorQuestao[0]['subCategoria']);
		$Questao->setTempo($valorQuestao[0]['tempo']);
		$Questao->setIdFocoCurso($valorQuestao[0]['idFocoCurso']);
		$Questao->setIdKitMaterial($valorQuestao[0]['idKitMaterial']);
		
		$idQuestaoN = $Questao->addQuestao();
		
		$arrayRetorno['mensagem'] = "Questão copiada com sucesso!";
		
	//	$arrayRetorno['atualizarNivelAtual'] = true;
  		$arrayRetorno['pagina'] = CAMINHO_CAD."questoes/formulario.php?id=".$idQuestaoN;
		$arrayRetorno['id'] = $idQuestaoN;
		
		echo json_encode($arrayRetorno);


//Uteis::pr($valorQuestao);



?>

