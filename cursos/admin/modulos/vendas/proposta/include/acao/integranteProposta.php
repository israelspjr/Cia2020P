<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IntegranteProposta.class.php");


$IntegranteProposta = new IntegranteProposta();

$idIntegranteProposta= $_REQUEST['id'];

if($_REQUEST['acao'] == 'deletar'){
	$IntegranteProposta->setIdIntegranteProposta($idIntegranteProposta);
	$IntegranteProposta->deleteIntegranteProposta();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
}else{

	$IntegranteProposta->setIdIntegranteProposta($idIntegranteProposta);
	$IntegranteProposta->setClientePfIdClientePf($_POST['idClientePf']);
	$IntegranteProposta->setPropostaIdProposta($_POST['proposta_idProposta']);
	$IntegranteProposta->setStatusAprovacaoIdStatusAprovacao($_POST['statusAprovacaoIdStatusAprovacao']);
	
	
	if($idIntegranteProposta!= "" && $idIntegranteProposta> 0 ){
		$IntegranteProposta->updateIntegranteProposta();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;
		
	}else{
		$idIntegranteProposta = $IntegranteProposta->addIntegranteProposta();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
		
		$link = "p=".Uteis::base64_url_encode($_POST['proposta_idProposta'])."&b=".Uteis::base64_url_encode($idIntegranteProposta)."&d=".md5(date('YmdHis'));
		
		$IntegranteProposta->setIdIntegranteProposta($idIntegranteProposta);
		$IntegranteProposta->updateFieldIntegranteProposta('linkVisualizacao', $link);
		
	}				
}

echo json_encode($arrayRetorno);

?>