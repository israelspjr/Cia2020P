<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$idVivenciaProfessor = $_REQUEST['id'];	

$VivenciaProfessor = new VivenciaProfessor();		
$VivenciaProfessor->setidVivenciaProfessor($idVivenciaProfessor);

if($_POST['acao'] == 'deletar'){
	
	$VivenciaProfessor->deleteVivenciaProfessor();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$VivenciaProfessor->setPaisIdPais($_POST['pais_idPais']);
	$VivenciaProfessor->setProfessorIdProfessor($_POST['professor_idProfessor']);
	$VivenciaProfessor->setObs($_POST['obs']);
	$VivenciaProfessor->setDataRetorno(Uteis::gravarData($_POST['dataRetorno']));
	$VivenciaProfessor->setDataPartida(Uteis::gravarData($_POST['dataPartida']));
	$VivenciaProfessor->setAtividade($_POST['atividade']);
	
	if($idVivenciaProfessor != "" && $idVivenciaProfessor > 0 ){
		$VivenciaProfessor->updateVivenciaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idVivenciaProfessor = $VivenciaProfessor->addVivenciaProfessor();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
