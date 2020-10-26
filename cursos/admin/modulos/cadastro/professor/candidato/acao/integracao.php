<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

	$professor_idProfessor = $_REQUEST['professor_idProfessor'];
	$idPSP = $_REQUEST['idPSP'];	
		
	$integracao = $_POST['integracao'] ? $_POST['integracao'] : 0;
	
	$ProcessoSeletivoProfessor->setIdProcessoSeletivoProfessor($idPSP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("integracao", $integracao);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("dataIntegracao", $_POST['dataAssinatura']);
		
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['pagina'] = CAMINHO_CAD."professor/candidato/index.php?id=".$professor_idProfessor;
	
	echo json_encode($arrayRetorno);
			

?>