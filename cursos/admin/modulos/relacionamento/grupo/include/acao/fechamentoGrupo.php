<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FechamentoGrupo = new FechamentoGrupo();
$FechamentoGrupoItenMotivoFechamento = new FechamentoGrupoItenMotivoFechamento();
$PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();

$arrayRetorno = array();

$idFechamentoGrupo = $_REQUEST['id'];
$FechamentoGrupo->setIdFechamentoGrupo($idFechamentoGrupo);

$valorId = $FechamentoGrupo->selectFechamentoGrupo("WHERE idFechamentoGrupo = ".$idFechamentoGrupo);
$idPlanoAcaoGrupo = $valorId[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
//echo $idPlanoAcaoGrupo;

$rs = $PlanoAcaoGrupoNaoFaturar->selectPlanoAcaoGrupoNaoFaturar("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." And dataExcluido is null");
//echo $rs[0]['idPlanoAcaoGrupoNaoFaturar'];
$idPlanoAcaoGrupoNaoFaturar = $rs[0]['idPlanoAcaoGrupoNaoFaturar'];
$PlanoAcaoGrupoNaoFaturar->setIdPlanoAcaoGrupoNaoFaturar($idPlanoAcaoGrupoNaoFaturar);

if($_POST['acao']=="deletar"){
	$FechamentoGrupo->deleteFechamentoGrupo();
	$PlanoAcaoGrupoNaoFaturar->updateFieldPlanoAcaoGrupoNaoFaturar("dataExcluido", date('Y-m-d H:i:s'));
	$arrayRetorno['mensagem'] = MSG_CADDEL;
}else{
	
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

	$FechamentoGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
	$FechamentoGrupo->setDataFechamento(Uteis::gravarData($_POST['dataCadastro']));
	$FechamentoGrupo->setObs($_POST['obs']);
	$FechamentoGrupo->setTipo($_POST['tipo']);
	
	//Não faturar a partir de: 
//	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];

	$PlanoAcaoGrupoNaoFaturar->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoNaoFaturar->setData(Uteis::gravarData($_REQUEST['dataCadastro']));	
		
	if($idFechamentoGrupo){
	
		$FechamentoGrupo->updateFechamentoGrupo();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$FechamentoGrupoItenMotivoFechamento->deleteFechamentoGrupoItenMotivoFechamento(" OR (fechamentoGrupo_idFechamentoGrupo = $idFechamentoGrupo)");
			
	}else{
		$idFechamentoGrupo = $FechamentoGrupo->addFechamentoGrupo();
        $PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
        $arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	if($idPlanoAcaoGrupoNaoFaturar){
		
		$PlanoAcaoGrupoNaoFaturar->updatePlanoAcaoGrupoNaoFaturar();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		// aquii
		$idPlanoAcaoGrupoNaoFaturar = $PlanoAcaoGrupoNaoFaturar->addPlanoAcaoGrupoNaoFaturar();

        $data = explode("/", $_POST['dataCadastro']);

        $statusCobranca = array(1=>2,2=>6,3=>1);

        $PlanoAcaoGrupoStatusCobranca->setPlanoAcaoGrupoIdPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
        $PlanoAcaoGrupoStatusCobranca->setStatusCobrancaIdStatusCobranca($statusCobranca[$_POST['tipo']]);
        $PlanoAcaoGrupoStatusCobranca->setMes($data[1]);
        $PlanoAcaoGrupoStatusCobranca->setAno($data[2]);
        $idm = $PlanoAcaoGrupoStatusCobranca->addPlanoAcaoGrupoStatusCobranca();

		$arrayRetorno['mensagem'] = MSG_CADNEW;
		
	}

	#planoAcaoGrupoStatusCobranca
		
	if($idFechamentoGrupo && $_POST['check_itenMotivoFechamento']){
		foreach($_POST['check_itenMotivoFechamento'] as $iten){
			$FechamentoGrupoItenMotivoFechamento->setFechamentoGrupoIdFechamentoGrupo($idFechamentoGrupo);
			$FechamentoGrupoItenMotivoFechamento->setItenMotivoFechamentoIdItenMotivoFechamento($iten);
			$FechamentoGrupoItenMotivoFechamento->addFechamentoGrupoItenMotivoFechamento();
		}
	}

   // $arrayRetorno['ondeAtualizar'] = "#div_fechamentoGrupo";
	$arrayRetorno['fecharNivel'] = true;
	
}

echo json_encode($arrayRetorno);