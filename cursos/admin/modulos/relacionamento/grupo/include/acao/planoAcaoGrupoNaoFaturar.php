<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();
	
$arrayRetorno = array();

$idPlanoAcaoGrupoNaoFaturar = $_REQUEST['id'];
$PlanoAcaoGrupoNaoFaturar->setIdPlanoAcaoGrupoNaoFaturar($idPlanoAcaoGrupoNaoFaturar);

if($_POST['acao']=="deletar"){
	
	$PlanoAcaoGrupoNaoFaturar->updateFieldPlanoAcaoGrupoNaoFaturar("dataExcluido", date('Y-m-d H:i:s'));	
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;
		
}else{
	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];

	$PlanoAcaoGrupoNaoFaturar->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoNaoFaturar->setData(Uteis::gravarData($_REQUEST['data']));	
	
	if($idPlanoAcaoGrupoNaoFaturar){
		
		$PlanoAcaoGrupoNaoFaturar->updatePlanoAcaoGrupoNaoFaturar();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		
		$idPlanoAcaoGrupoNaoFaturar = $PlanoAcaoGrupoNaoFaturar->addPlanoAcaoGrupoNaoFaturar();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;				
		
	}
	
	$arrayRetorno['fecharNivel'] = true;
	
}

echo json_encode($arrayRetorno);