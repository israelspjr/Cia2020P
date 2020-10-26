<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

	$professor_idProfessor = $_REQUEST['professor_idProfessor'];
	$idPSP = $_REQUEST['idPSP'];
	$geral = $_REQUEST['geral'];	
		
	$analiseFinal = $_POST['analiseFinal'] ? $_POST['analiseFinal'] : 0;
	$avaliador = $_POST['avaliadorOral'];
	$dataNivel = $_POST['dataNivel'];
	$idNivel = $_POST['idNivelLinguistico'];
	$idSotaque = $_POST['idSotaqueIdiomaProfessor'];
	$vpgV = $_POST['valor_V'];
	$vpgP = $_POST['valor_P'];
	$vpgG = $_POST['valor_G'];
	
		
	$ProcessoSeletivoProfessor->setIdProcessoSeletivoProfessor($idPSP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("oralFinal", $analiseFinal);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("avaliador", $avaliador);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("idSotaque", $idSotaque);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("vpgV", $vpgV);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("vpgP", $vpgP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("vpgG", $vpgG);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("dataNivel", $dataNivel);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("idNivel", $idNivel);
	
	$arrayRetorno['mensagem'] = MSG_CADATU;
		
		if ($geral != 1) {
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['pagina'] = CAMINHO_CAD."professor/candidato/index.php?id=".$professor_idProfessor;
		}
		
	echo json_encode($arrayRetorno);
			

?>