<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$idProcessoSeletivoProfessor = $_REQUEST['id'];	
$idProfessor = $_REQUEST['idProfessor'];	

	
$Professor = new Professor();	
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
$ProcessoSeletivoProfessorComEtapas = new ProcessoSeletivoProfessorComEtapas();	
	
$ProcessoSeletivoProfessor->setidProcessoSeletivoProfessor($idProcessoSeletivoProfessor);

if($_REQUEST['acao'] == 'deletar'){
	
	$ProcessoSeletivoProfessorComEtapas->deleteProcessoSeletivoProfessorComEtapas("  processoSeletivoProfessor_idProcessoSeletivoProfessor = ".$idProcessoSeletivoProfessor);
	
	$ProcessoSeletivoProfessor->deleteProcessoSeletivoProfessor();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	

	$ProcessoSeletivoProfessor->setProfessorIdProfessor($_POST['professor_idProfessor']);
	$ProcessoSeletivoProfessor->setIdiomaIdIdioma($_POST['idIdioma']);
	$ProcessoSeletivoProfessor->setDataReferencia( Uteis::gravarData($_POST['dataReferencia']) );
	$ProcessoSeletivoProfessor->setObs($_POST['obs']);	
	$ProcessoSeletivoProfessor->setNotaTeste($_POST['notaTeste']);
	$ProcessoSeletivoProfessor->setNivelF($_POST['nivelF']);
	
	if($idProcessoSeletivoProfessor != "" && $idProcessoSeletivoProfessor > 0 ){
		$ProcessoSeletivoProfessor->updateProcessoSeletivoProfessor();	
		$arrayRetorno['mensagem'] = MSG_CADATU;				
	}else{		
		$idProcessoSeletivoProfessor = $ProcessoSeletivoProfessor->addProcessoSeletivoProfessor2();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] = CAMINHO_CAD."professor/include/form/processoSeletivoProfessor.php?id=".$idProcessoSeletivoProfessor;
}

echo json_encode($arrayRetorno);
	
?>
