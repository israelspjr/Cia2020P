<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultado.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$MedicaoResultado = new MedicaoResultado();
	

$idMedicaoResultado = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$MedicaoResultado->setIdMedicaoResultado($idMedicaoResultado);	
	$MedicaoResultado->updateFieldMedicaoResultado("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$medicao = $_POST['medicao'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$MedicaoResultado->setIdMedicaoResultado($idMedicaoResultado);
	$MedicaoResultado->setMedicao($medicao);
	$MedicaoResultado->setInativo($inativo);
	
	
	
	if($idMedicaoResultado != "" && $idMedicaoResultado > 0 ){
		$MedicaoResultado->updateMedicaoResultado();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idMedicaoResultado = $MedicaoResultado->addMedicaoResultado();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>