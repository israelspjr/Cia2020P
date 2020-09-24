<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$arrayRetorno = array();
$idExperienciaProfissional = $_REQUEST['id'];	

$ExperienciaProfissional = new ExperienciaProfissional();		
$ExperienciaProfissional->setIdExperienciaProfissional($idExperienciaProfissional);

if($_POST['acao'] == 'deletar'){
	
	$ExperienciaProfissional->deleteExperienciaProfissional();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$ExperienciaProfissional->setProfessorIdProfessor($_POST['professor_idProfessor']);
	$ExperienciaProfissional->setEmpresa($_POST['empresa']);
	$ExperienciaProfissional->setFuncao($_POST['funcao']);
	$ExperienciaProfissional->setObs($_POST['obs']);

	
	if($idExperienciaProfissional != "" && $idExperienciaProfissional > 0 ){
		$ExperienciaProfissional->updateExperienciaProfissional();
		$arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";			
	}else{
		$idExperienciaProfissional = $ExperienciaProfissional->addExperienciaProfissional();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
//	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
