<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultadoINF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$MedicaoResultadoINF = new MedicaoResultadoINF();
	

$idMedicaoResultadoINF = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$MedicaoResultadoINF->setIdMedicaoResultadoINF($idMedicaoResultadoINF);	
	$MedicaoResultadoINF->updateFieldMedicaoResultadoINF("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$relacionamentoINF_idRelacionamentoINF = $_POST['idRelacionamentoINF'];
	$medicaoResultado_idMedicaoResultado = $_POST['idMedicaoResultado'];
	$qtd = $_POST['qtd'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$MedicaoResultadoINF->setIdMedicaoResultadoINF($idMedicaoResultadoINF);
	$MedicaoResultadoINF->setRelacionamentoINFIdRelacionamentoINF($relacionamentoINF_idRelacionamentoINF);
	$MedicaoResultadoINF->setMedicaoResultadoIdMedicaoResultado($medicaoResultado_idMedicaoResultado);
	$MedicaoResultadoINF->setQtd($qtd);
	$MedicaoResultadoINF->setInativo($inativo);
	
	
	
	if($idMedicaoResultadoINF != "" && $idMedicaoResultadoINF > 0 ){
		$MedicaoResultadoINF->updateMedicaoResultadoINF();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idMedicaoResultadoINF = $MedicaoResultadoINF->addMedicaoResultadoINF();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>