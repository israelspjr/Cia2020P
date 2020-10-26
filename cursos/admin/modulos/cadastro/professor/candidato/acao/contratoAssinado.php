<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

	$professor_idProfessor = $_REQUEST['professor_idProfessor'];
	$idPSP = $_REQUEST['idPSP'];	
		
	$contratoAssinado = $_POST['contratoAssinado'] ? $_POST['contratoAssinado'] : 0;
		
	$ProcessoSeletivoProfessor->setIdProcessoSeletivoProfessor($idPSP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("contratoAssinado", $contratoAssinado);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("dataContrato", $_POST['dataAssinatura']);
		
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['pagina'] = CAMINHO_CAD."professor/candidato/index.php?id=".$professor_idProfessor;
	
	echo json_encode($arrayRetorno);
			

?>