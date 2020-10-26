<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

	$professor_idProfessor = $_REQUEST['professor_idProfessor'];
	$idPSP = $_REQUEST['idPSP'];
	$geral = $_REQUEST['geral'];	
		
	$analiseFinal = $_POST['analiseC'] ? $_POST['analiseC'] : 0;
	$dataC = $_POST['dataC'];
	$avaliador = $_POST['avaliadorC'];
	$dataNivel = $_POST['dataC'];
	$perfilG = $_POST['perfilG'];
	$pc2 = $_POST['pc2'];
	$pc3 = $_POST['pc3'];
	$pc4 = $_POST['pc4'];
	$pc5 = $_POST['pc5'];
	$pc6 = $_POST['pc6'];
	$pc7 = $_POST['pc7'];
	$pc8 = $_POST['pc8'];
	$pc9 = $_POST['pc9'];
	$pc10 = $_POST['pc10'];
	$pc11 = $_POST['pc11'];
	$pc12 = $_POST['pc12'];
	$pc13 = $_POST['pc13'];
	$pc14 = $_POST['pc14'];
	$pc15 = $_POST['pc15'];
	$pc16 = $_POST['pc16'];
	$pc17 = $_POST['pc17'];
	$pc18 = $_POST['pc18'];
	$pc19 = $_POST['pc19'];
	
	$ProcessoSeletivoProfessor->setIdProcessoSeletivoProfessor($idPSP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("analiseC", $analiseFinal);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("avaliadorC", $avaliador);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("dataC", $dataC);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("perfilG", $perfilG);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc2", $pc2);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc3", $pc3);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc4", $pc4);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc5", $pc5);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc6", $pc6);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc7", $pc7);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc8", $pc8);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc9", $pc9);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc10", $pc10);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc11", $pc11);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc12", $pc12);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc13", $pc13);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc14", $pc14);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc15", $pc15);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc16", $pc16);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc17", $pc17);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc18", $pc18);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pc19", $pc19);
	
	$arrayRetorno['mensagem'] = MSG_CADATU;
	
	if ($geral != 1) {
		$arrayRetorno['fecharNivel'] = true;
		$arrayRetorno['pagina'] = CAMINHO_CAD."professor/candidato/index.php?id=".$professor_idProfessor;
	} 
	
	echo json_encode($arrayRetorno);
			

?>