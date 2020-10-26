<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OpcaoAtividadeExtraProfessorClientePf.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtraProfessor.class.php");

$OpcaoAtividadeExtraProfessorClientePf = new OpcaoAtividadeExtraProfessorClientePf();		
$AtividadeExtraProfessor = new AtividadeExtraProfessor();
	
$arrayRetorno = array(); 
$idClientePf = $_REQUEST['id'];	

//DELETE TODAS OPÇOES ANTES DE INSERIR NOVAMENTE
$OpcaoAtividadeExtraProfessorClientePf->deleteOpcaoatividadeextraprofessorclientepf(" clientePf_idClientePf = ".$idClientePf);
//
$valoresAtividadeextraprofessor = $AtividadeExtraProfessor->selectAtividadeextraprofessor(" WHERE inativo = 0 ");
for ($row = 0; $row < count($valoresAtividadeextraprofessor, 0); $row++){
	$idField = $valoresAtividadeextraprofessor[$row]['idAtividadeExtraProfessor'];		
	$field = $_POST["check_Atividadeextraprofessor_".$idField];
    $fieldObs = $_POST["obs_Atividadeextraprofessor_".$idField];
	// INSERE AS OPÇOES MARCADAS		
	if($field==1){
		$OpcaoAtividadeExtraProfessorClientePf->setAtividadeExtraProfessorIdAtividadeExtraProfessor($idField);
		$OpcaoAtividadeExtraProfessorClientePf->setClientePfIdClientePf($idClientePf);
	    $OpcaoAtividadeExtraProfessorClientePf->setObs($fieldObs);				
		$OpcaoAtividadeExtraProfessorClientePf->addOpcaoatividadeextraprofessorclientepf();		
	}
}

$arrayRetorno['mensagem'] = MSG_CADNEW;
$arrayRetorno['pagina'] = CAMINHO_CAD."clientePf/include/form/opcaoAtividadeExtraProfessorClientePf.php?id=".$idClientePf;
$arrayRetorno['ondeAtualizar'] = "#div_preferenciadeprofessor_clientepf";

echo json_encode($arrayRetorno);	
?>
