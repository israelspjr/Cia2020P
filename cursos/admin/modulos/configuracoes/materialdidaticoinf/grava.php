<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidaticoINF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$MaterialDidaticoINF = new MaterialDidaticoINF();
	

$idMaterialDidaticoINF = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$MaterialDidaticoINF->setIdMaterialDidaticoINF($idMaterialDidaticoINF);	
	$MaterialDidaticoINF->updateFieldMaterialDidaticoINF("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$relacionamentoINF_idRelacionamentoINF = $_POST['idRelacionamentoINF'];
	$materialDidatico_idMaterialDidatico = $_POST['idMaterialDidatico'];
	$unidadeInicial = $_POST['unidadeInicial'];
	$unidadeFinal = $_POST['unidadeFinal'];
	
	$obs = $_POST['obs'];
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$MaterialDidaticoINF->setIdMaterialDidaticoINF($idMaterialDidaticoINF);
	$MaterialDidaticoINF->setRelacionamentoINFIdRelacionamentoINF($relacionamentoINF_idRelacionamentoINF);
	$MaterialDidaticoINF->setMaterialDidaticoIdMaterialDidatico($materialDidatico_idMaterialDidatico);
	$MaterialDidaticoINF->setUnidadeInicial($unidadeInicial);
	$MaterialDidaticoINF->setUnidadeFinal($unidadeFinal);
	$MaterialDidaticoINF->setInativo($inativo);
	$MaterialDidaticoINF->setObs($obs);
	
	
	
	if($idMaterialDidaticoINF != "" && $idMaterialDidaticoINF > 0 ){
		$MaterialDidaticoINF->updateMaterialDidaticoINF();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idMaterialDidaticoINF = $MaterialDidaticoINF->addMaterialDidaticoINF();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>