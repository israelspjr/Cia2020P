<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapasProcessoSeletivoProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProcessoSeletivoProfessorComEtapas.class.php");

$arrayRetorno = array();
$idProcessoSeletivoProfessorComEtapas = $_REQUEST['id'];	

	
$EtapasProcessoSeletivoProfessor = new EtapasProcessoSeletivoProfessor();	
$ProcessoSeletivoProfessorComEtapas = new ProcessoSeletivoProfessorComEtapas();	
	
$ProcessoSeletivoProfessorComEtapas->setIdProcessoSeletivoProfessorComEtapas($idProcessoSeletivoProfessorComEtapas);

if($_POST['acao'] == 'deletar'){
	
	$ProcessoSeletivoProfessorComEtapas->deleteProcessoSeletivoProfessorComEtapas();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	

	$ProcessoSeletivoProfessorComEtapas->setProcessoSeletivoProfessorIdProcessoSeletivoProfessor($_POST['processoSeletivoProfessor_idProcessoSeletivoProfessor']);
	$ProcessoSeletivoProfessorComEtapas->setEtapasProcessoSeletivoProfIdEtapasProcessoSeletivoProf($_POST['idEtapasProcessoSeletivoProfessor']);	
	$ProcessoSeletivoProfessorComEtapas->setStatus($_POST['status']);	
	$ProcessoSeletivoProfessorComEtapas->setObs($_POST['obs']);	
	$ProcessoSeletivoProfessorComEtapas->setDataReferencia( Uteis::gravarData($_POST['dataReferencia']) );
	
	if($idProcessoSeletivoProfessorComEtapas != "" && $idProcessoSeletivoProfessorComEtapas > 0 ){
		$ProcessoSeletivoProfessorComEtapas->updateProcessoSeletivoProfessorComEtapas();	
		$arrayRetorno['mensagem'] = MSG_CADATU;				
	}else{		
		$idProcessoSeletivoProfessorComEtapas = $ProcessoSeletivoProfessorComEtapas->addProcessoSeletivoProfessorComEtapas();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
		
	$arrayRetorno['fecharNivel'] = true;
	
}
echo json_encode($arrayRetorno);
	
?>
