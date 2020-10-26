<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ExperienciaProfissionaldiomaProfessor.class.php");

$arrayRetorno = array();
$idExperienciaProfissionaldiomaProfessor = $_REQUEST['id'];	

$ExperienciaProfissionaldiomaProfessor = new ExperienciaProfissionaldiomaProfessor();		
$ExperienciaProfissionaldiomaProfessor->setIdExperienciaProfissionaldiomaProfessor($idExperienciaProfissionaldiomaProfessor);

if($_POST['acao'] == 'deletar'){
	
	$ExperienciaProfissionaldiomaProfessor->deleteExperienciaProfissionaldiomaProfessor();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$ExperienciaProfissionaldiomaProfessor->setIdiomaProfessorIdIdiomaProfessor($_POST['idiomaProfessor_idIdiomaProfessor']);
	$ExperienciaProfissionaldiomaProfessor->setEscolaIdEscola($_POST['idEscola']);
	$ExperienciaProfissionaldiomaProfessor->setNivel($_POST['nivel']);
	$ExperienciaProfissionaldiomaProfessor->setComentario($_POST['comentario']);

	
	if($idExperienciaProfissionaldiomaProfessor != "" && $idExperienciaProfissionaldiomaProfessor > 0 ){
		$ExperienciaProfissionaldiomaProfessor->updateExperienciaProfissionaldiomaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idExperienciaProfissionaldiomaProfessor = $ExperienciaProfissionaldiomaProfessor->addExperienciaProfissionaldiomaProfessor();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
