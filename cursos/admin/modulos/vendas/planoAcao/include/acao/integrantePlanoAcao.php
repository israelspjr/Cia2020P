<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IntegrantePlanoAcao = new IntegrantePlanoAcao();

$idIntegrantePlanoAcao = $_REQUEST['id'];
$IntegrantePlanoAcao->setIdIntegrantePlanoAcao($idIntegrantePlanoAcao);

$arrayRetorno = array();

if($_REQUEST['acao'] == 'deletar'){

	$IntegrantePlanoAcao->setIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
	$IntegrantePlanoAcao->deleteIntegrantePlanoAcao();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{
	if ($_POST['idClientePf'] == 'novo') {
	$idCliente = 0;	
	} else {
	$idCliente = $_POST['idClientePf'];	 
	}

	$IntegrantePlanoAcao->setPlanoAcaoIdPlanoAcao($_POST['planoAcao_idPlanoAcao']);
	$IntegrantePlanoAcao->setClientePfIdClientePf($idCliente);	
	$IntegrantePlanoAcao->setStatusAprovacaoIdStatusAprovacao($_POST['statusAprovacaoIdStatusAprovacao']);
	$IntegrantePlanoAcao->setObsDiagnosticoNivel($_POST['obsDiagnosticoNivel']);
	$IntegrantePlanoAcao->setNivelIdNivel($_POST['IdNivelEstudo']);
	$IntegrantePlanoAcao->setProfessorIdProfessor($_POST['idProfessor']);
	
	if($idIntegrantePlanoAcao != "" && $idIntegrantePlanoAcao > 0 ){
		
		$IntegrantePlanoAcao->updateIntegrantePlanoAcao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
				
	}else{
		$arrayRetorno['mensagem'] = MSG_CADNEW;

		$idIntegrantePlanoAcao = $IntegrantePlanoAcao->addIntegrantePlanoAcao();
		
		$link = "p=".Uteis::base64_url_encode($_POST['planoAcao_idPlanoAcao'])."&b=".Uteis::base64_url_encode($idIntegrantePlanoAcao)."&d=".md5(date('YmdHis'));
		
    	$IntegrantePlanoAcao->setIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
		$IntegrantePlanoAcao->updateFieldIntegrantePlanoAcao('linkVisualizacao', $link);
		
	}
		
	$arrayRetorno['atualizarNivelAtual'] = true;		
	$arrayRetorno['pagina'] = CAMINHO_VENDAS."planoAcao/include/form/integrante.php?id=".$idIntegrantePlanoAcao."&idPlanoAcao=".$_POST['planoAcao_idPlanoAcao'];
	
}

echo json_encode($arrayRetorno);

?>