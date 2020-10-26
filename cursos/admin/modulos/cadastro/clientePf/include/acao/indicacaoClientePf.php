<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IndicacaoClientePf.class.php");

$arrayRetorno = array();
$IndicacaoClientePf = new IndicacaoClientePf();

$idIndicacaoclientepf = $_REQUEST['id'];

$idClientePf = $_GET['idClientePf'];

if($_POST['acao'] == 'deletar'){
	
	$IndicacaoClientePf->setIdIndicacaoClientePf($idIndicacaoclientepf);
	$IndicacaoClientePf->deleteIndicacaoclientepf();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$interno = ( $_POST['interno'] == "1" ? 1 : 0);
	$externo = ( $_POST['externo'] == "1" ? 1 : 0);
	$potencial = ( $_POST['potencial'] == "1" ? 1 : 0);
	$influencia = ( $_POST['influencia'] == "1" ? 1 : 0);

	
	$IndicacaoClientePf->setClientePfIdClientePf($idClientePf);	
	
	if($_POST['clientePfIdClientePfIndicado']){
		$IndicacaoClientePf->setClientePfIdClientePfIndicado(1);
	}
	
	if($_POST['clientePjIdClientePjIndicado']){
		$IndicacaoClientePf->setClientePjIdClientePjIndicado(1);
	}
	$IndicacaoClientePf->setObs($_REQUEST['obs']);
	$IndicacaoClientePf->setInterno($interno);
	$IndicacaoClientePf->setExterno($externo);
	$IndicacaoClientePf->setProdutoIdProduto($_REQUEST['produtoIdProduto']);
	$IndicacaoClientePf->setPotencial($potencial);
	$IndicacaoClientePf->setInfluencia($influencia);
	
	if($idIndicacaoclientepf > 0) {
		$idIndicacaoclientepf = $IndicacaoClientePf->updateIndicacaoclientepf();
	} else {
		$idIndicacaoclientepf = $IndicacaoClientePf->addIndicacaoclientepf();		
	}
	$arrayRetorno['mensagem'] = MSG_CADNEW;
	
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
	
?>
