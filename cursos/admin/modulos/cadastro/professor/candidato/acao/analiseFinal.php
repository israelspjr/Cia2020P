<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

	$professor_idProfessor = $_REQUEST['professor_idProfessor'];
	$idPSP = $_REQUEST['idPSP'];	
		
	$analiseFinal = $_POST['analiseFinal'] ? $_POST['analiseFinal'] : 0;
	$comportamental = $_POST['comportamental'];
	$pedagogico = $_POST['pedagogico'];
	$linguistico = $_POST['linguistico'];
	$finalT = $_POST['final'];
	$dataNivel = $_POST['dataNivel'];
	$idNivel = $_POST['idNivelLinguistico'];
	$geral = $_REQUEST['geral'];
	
	$ProcessoSeletivoProfessor->setIdProcessoSeletivoProfessor($idPSP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("analiseFinal", $analiseFinal);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("comportamental", $comportamental);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pedagogico", $pedagogico);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("linguistico", $linguistico);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("finalT", $finalT);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("dataNivel", $dataNivel);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("idNivel", $idNivel);
	
	$arrayRetorno['mensagem'] = MSG_CADATU;	
		
		if ($geral != 1) {
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['pagina'] = CAMINHO_CAD."professor/candidato/index.php?id=".$professor_idProfessor;
		} 
		
	echo json_encode($arrayRetorno);
			

?>