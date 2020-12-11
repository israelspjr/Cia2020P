<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Proposta.class.php");

$arrayRetorno = array();
$idProposta = $_REQUEST['id'];	

$Proposta = new Proposta();		
$Proposta->setIdProposta($idProposta);

if($_POST['acao'] == 'deletar'){
	
	$Proposta->updateFieldProposta('dataExclusao', date('Y-m-d H:i:s'));	
	$arrayRetorno['mensagem'] = "Proposta arquivada com sucesso. <br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
	
}else{	
	
	
	$Proposta->setClientePjIdClientePj($_POST['clientePj_idClientePj']);	
	$Proposta->setIdiomaIdIdioma($_POST['idIdioma']);
	$Proposta->setComoConheceuIdComoConheceu($_POST['idComoConheceu']);	
	//echo "//";exit;
	$Proposta->setTipoContatoIdTipoContato($_POST['idTipoContatoProposta']);
	$Proposta->setGestorIdGestor($_POST['idGestor']);
	$Proposta->setStatusAprovacaoIdStatusAprovacao($_POST['statusAprovacaoIdStatusAprovacao']);
	$Proposta->setObs($_POST['obs']);
		
	if($idProposta != "" && $idProposta > 0 ){
		$idProposta = $Proposta->updateProposta();	
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idProposta = $Proposta->addProposta();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['atualizarNivelAtual'] = true;
		$arrayRetorno['pagina'] = CAMINHO_VENDAS."proposta/cadastro.php?id=".$idProposta;
	}
	
}
echo json_encode($arrayRetorno);

?>