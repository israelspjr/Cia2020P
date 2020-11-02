<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProvaINF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ProvaINF = new ProvaINF();
	

$idProvaINF = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ProvaINF->setIdProvaINF($idProvaINF);	
	$ProvaINF->updateFieldProvaINF("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$prova_idProva = $_POST['idProva'];
	$relacionamentoINF_idRelacionamentoINF = $_POST['idRelacionamentoINF'];
	$unidade = $_POST['unidade'];
	$obs = $_POST['obs'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ProvaINF->setIdProvaINF($idProvaINF);
	$ProvaINF->setProvaIdProva($prova_idProva);
	$ProvaINF->setRelacionamentoINFIdRelacionamentoINF($relacionamentoINF_idRelacionamentoINF);
	$ProvaINF->setUnidade($unidade);
	$ProvaINF->setObs($obs);
	$ProvaINF->setInativo($inativo);
	
	
	
	if($idProvaINF != "" && $idProvaINF > 0 ){
		$ProvaINF->updateProvaINF();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idProvaINF = $ProvaINF->addProvaINF();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>