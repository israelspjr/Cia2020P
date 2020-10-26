<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

	$professor_idProfessor = $_REQUEST['professor_idProfessor'];
	$idPSP = $_REQUEST['idPSP'];
	$geral = $_REQUEST['geral'];
		
	$analiseFinal = $_POST['analiseP'] ? $_POST['analiseP'] : 0;
	$dataP = $_POST['dataP'];
	$avaliador = $_POST['avaliadorP'];
	$pp1 = $_POST['pp1'];
	$pp2 = $_POST['pp2'];
	$pp3 = $_POST['pp3'];
	$pp4 = $_POST['pp4'];
	$pp5 = $_POST['pp5'];
	$pp6 = $_POST['pp6'];
	$pp7 = $_POST['pp7'];
	$pp8 = $_POST['pp8'];
	$pp9 = $_POST['pp9'];
	$pp10 = $_POST['pp10'];
	$pp11 = $_POST['pp11'];
	$pp12 = $_POST['pp12'];
	$pp13 = $_POST['pp13'];
	$pp14 = $_POST['pp14'];
	
	$ProcessoSeletivoProfessor->setIdProcessoSeletivoProfessor($idPSP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("analiseP", $analiseFinal);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("avaliadorP", $avaliador);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("dataP", $dataP);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp1", $pp1);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp2", $pp2);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp3", $pp3);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp4", $pp4);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp5", $pp5);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp6", $pp6);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp7", $pp7);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp8", $pp8);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp9", $pp9);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp10", $pp10);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp11", $pp11);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp12", $pp12);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp13", $pp13);
	$ProcessoSeletivoProfessor->updateFieldProcessoSeletivoProfessor("pp14", $pp14);
	
	$arrayRetorno['mensagem'] = MSG_CADATU;
		
		if ($geral != 1) {
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['pagina'] = CAMINHO_CAD."professor/candidato/index.php?id=".$professor_idProfessor;
		}
		
	echo json_encode($arrayRetorno);
			

?>