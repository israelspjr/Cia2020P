<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MeioLocomocaoProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MeioLocomocao.class.php");
		
$arrayRetorno = array();

$idProfessor = $_REQUEST['id'];	

$MeioLocomocaoProfessor = new MeioLocomocaoProfessor();		
$MeioLocomocao = new MeioLocomocao();

//DELETE TODAS OPÇOES ANTES DE INSERIR NOVAMENTE
$MeioLocomocaoProfessor->deleteMeioLocomocaoProfessor(" professor_idProfessor = ".$idProfessor);

$valoresMeioLocomocao = $MeioLocomocao->selectMeioLocomocao(" WHERE inativo = 0 ");

for ($row = 0; $row < count($valoresMeioLocomocao,0); $row++){
	$idField = $valoresMeioLocomocao[$row]['idMeioLocomocao'];		
	$field = $_POST["check_MeioLocomocao_".$idField];
		
	//INSERE AS OPÇOES MARCADAS		
	if($field==1){
		$MeioLocomocaoProfessor->setMeioLocomocaoIdMeioLocomocao($idField);
		$MeioLocomocaoProfessor->setProfessorIdProfessor($idProfessor);						
		$MeioLocomocaoProfessor->addMeioLocomocaoProfessor();		
	}
}


$arrayRetorno['mensagem'] = MSG_CADNEW;
$arrayRetorno['pagina'] = CAMINHO_CAD."professor/include/form/meioLocomocaoProfessor.php?id=".$idProfessor;
$arrayRetorno['ondeAtualizar'] = "#div_lista_meioLocomocaoProfessor";

echo json_encode($arrayRetorno);	
?>
