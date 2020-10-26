<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OpcaoAtividadeExtraClientePf.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtra.class.php");

$OpcaoAtividadeExtraClientePf = new OpcaoAtividadeExtraClientePf();		
$AtividadeExtra = new AtividadeExtra();
	
$arrayRetorno = array();
$idClientePf = $_REQUEST['id'];	

//DELETE TODAS OPÇOES ANTES DE INSERIR NOVAMENTE
$OpcaoAtividadeExtraClientePf->deleteopcaoAtividadeExtraClientePf(" clientePf_idClientePf = ".$idClientePf);

$valoresAtividadeextra = $AtividadeExtra->selectAtividadeextra(" WHERE inativo = 0 ");
for ($row = 0; $row < count($valoresAtividadeextra, 0); $row++){

	$idField = $valoresAtividadeextra[$row]['idAtividadeExtra'];		
	$field = $_POST["check_Atividadeextra_".$idField];
    $fieldobs = $_POST["obs_Atividadeextra_".$idField];

	// INSERE AS OPÇOES MARCADAS		
	if($field==1){
		$OpcaoAtividadeExtraClientePf->setAtividadeExtraIdAtividadeExtra($idField);
		$OpcaoAtividadeExtraClientePf->setClientePfIdClientePf($idClientePf);
		$OpcaoAtividadeExtraClientePf->setObs($fieldobs);						
		$OpcaoAtividadeExtraClientePf->addopcaoAtividadeExtraClientePf();		
	}
}

$arrayRetorno['mensagem'] = MSG_CADNEW;
$arrayRetorno['pagina'] = CAMINHO_CAD."clientePf/include/form/opcaoAtividadeExtraClientePf.php?id=".$idClientePf;
$arrayRetorno['ondeAtualizar'] = "#div_lista_opcaoAtividadeExtraClientePf";

echo json_encode($arrayRetorno);	
?>
