<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoCarreirraIdiomaProfessor = new PlanoCarreirraIdiomaProfessor();

$idPlanoCarreirraIdiomaProfessor = $_REQUEST['id'];

$arrayRetorno = array();
$PlanoCarreirraIdiomaProfessor -> setIdPlanoCarreirraIdiomaProfessor($idPlanoCarreirraIdiomaProfessor);

$PlanoCarreirraIdiomaProfessor -> setIdiomaProfessorIdIdiomaProfessor($_POST['idiomaProfessor_idIdiomaProfessor']);
$PlanoCarreirraIdiomaProfessor -> setAnoIni($_POST['anoIni']);
$PlanoCarreirraIdiomaProfessor -> setMesIni($_POST['mesIni']);
$PlanoCarreirraIdiomaProfessor -> setPlanoCarreirraIdPlanoCarreira($_POST['idPlanoCarreira']);

if ($idPlanoCarreirraIdiomaProfessor > 0) {
	
$rs = $PlanoCarreirraIdiomaProfessor -> updatePlanoCarreirraIdiomaProfessor();	
	

	$arrayRetorno['mensagem'] = "Cadastro Atualizado com sucesso.";
	$arrayRetorno['fecharNivel'] = true;

} else {
	
$idPlanoCarreirraIdiomaProfessor = $PlanoCarreirraIdiomaProfessor -> addPlanoCarreirraIdiomaProfessor();

if( is_numeric($idPlanoCarreirraIdiomaProfessor) ){
	$arrayRetorno['mensagem'] = "Cadastro efetuado com sucesso.";
	$arrayRetorno['fecharNivel'] = true;	
}else{
	$arrayRetorno['mensagem'] = $idPlanoCarreirraIdiomaProfessor;	
}
}
	
echo json_encode($arrayRetorno);
?>