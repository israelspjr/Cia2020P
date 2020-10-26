<?php
//A pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Ocorrencia = new Ocorrencia();

$idOcorrencia = $_POST['id'];
$idClientePf = $_REQUEST['idClientePf'];

$arrayRetorno = array();

if ($_REQUEST['acao'] == 'deletar') {
	
//	$Ocorrencia->setIdOcorrencia($id);
	$Ocorrencia->deleteOcorrencia($idOcorrencia);
	$arrayRetorno['mensagem'] = MSG_CADDEL;	
	
} else {

    $obs = $_POST['obs2'];
	$dataRetorno = Uteis::gravarData($_POST['dataRetorno1']);
	$status = $_POST['status'];
	
	$Ocorrencia->setClientePf_idClientePf($idClientePf);
	$Ocorrencia->setObservacao($obs);
	$Ocorrencia->setDataRetorno($dataRetorno);
	$Ocorrencia->setStatus($status);
	$Ocorrencia->setFuncionarioIdFuncionario($_REQUEST['idFuncionario']);
	$Ocorrencia->setOutro($_REQUEST['outro']);

	if($idOcorrencia != "" && $idOcorrencia > 0 ){
		$Ocorrencia->setIdOcorrencia($idOcorrencia);
		$Ocorrencia->updateOcorrencia();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	
		$arrayRetorno['fecharNivel'] = true;
	}else{
		$Ocorrencia->addOcorrencia();
		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
	}
	$arrayRetorno['atualizarNivel'] = true;

}


echo json_encode($arrayRetorno);
?>