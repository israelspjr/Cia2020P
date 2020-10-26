<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OpcaoAtividadeExtraProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtraProfessor.class.php");

$OpcaoAtividadeExtraProfessor = new OpcaoAtividadeExtraProfessor();	
$AtividadeExtraProfessor = new AtividadeExtraProfessor();

$arrayRetorno = array();
$idProfessor = $_REQUEST['id'];	

//DELETE TODAS OPÇOES ANTES DE INSERIR NOVAMENTE
$OpcaoAtividadeExtraProfessor->deleteOpcaoAtividadeExtraProfessor(" professor_idProfessor = ".$idProfessor);

$valoresAtividadeextraprofessor = $AtividadeExtraProfessor->selectAtividadeextraprofessor(" WHERE inativo = 0 ");

for ($row = 0; $row < count($valoresAtividadeextraprofessor, 0); $row++){
	$idField = $valoresAtividadeextraprofessor[$row]['idAtividadeExtraProfessor'];		
	$field = $_POST["check_Atividadeextraprofessor_".$idField];

	// INSERE AS OPÇOES MARCADAS		
	if($field==1){
		$OpcaoAtividadeExtraProfessor->setAtividadeExtraProfessorIdAtividadeExtraProfessor($idField);
		$OpcaoAtividadeExtraProfessor->setProfessorIdProfessor($idProfessor);						
		$OpcaoAtividadeExtraProfessor->addOpcaoAtividadeExtraProfessor();		
	}
}

$arrayRetorno['mensagem'] = MSG_CADNEW;
$arrayRetorno['pagina'] = CAMINHO_CAD."professor/include/form/opcaoAtividadeExtraProfessor.php?id=".$idProfessor;
$arrayRetorno['ondeAtualizar'] = "#div_lista_opcaoAtividadeExtraProfessor";

echo json_encode($arrayRetorno);	
?>
