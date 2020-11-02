<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OcorrenciaFF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$OcorrenciaFF = new OcorrenciaFF();
	

$idOcorrenciaFF = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$OcorrenciaFF->setIdOcorrenciaFF($idOcorrenciaFF);	
	$OcorrenciaFF->updateFieldOcorrenciaFF("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$sigla = $_POST['sigla'];
	$decricaoSigla = $_POST['decricaoSigla'];
	$obs = $_POST['obs'];
	$inativa = $_POST['inativa'];
	$pagarProfessor = $_POST['pagarProfessor'];
	$reporAula = $_POST['reporAula'];
	$professorVe = $_POST['professorVe'];
	$adminVe = $_POST['adminVe'];
    $expira = $_POST['expira'];
	$pagarReposicao = $_POST['pagarReposicao'];
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$OcorrenciaFF->setIdOcorrenciaFF($idOcorrenciaFF);
	$OcorrenciaFF->setSigla($sigla);
	$OcorrenciaFF->setDecricaoSigla($decricaoSigla);
	$OcorrenciaFF->setObs($obs);
	$OcorrenciaFF->setInativa($inativa);
	$OcorrenciaFF->setPagarProfessor($pagarProfessor);
	$OcorrenciaFF->setReporAula($reporAula);
	$OcorrenciaFF->setProfessorVe($professorVe);
	$OcorrenciaFF->setAdminVe($adminVe);
    $OcorrenciaFF->setExpira($expira);
	$OcorrenciaFF->setPagarReposicao($pagarReposicao);
    
	
	
	if($idOcorrenciaFF != "" && $idOcorrenciaFF > 0 ){
		$OcorrenciaFF->updateOcorrenciaFF();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idOcorrenciaFF = $OcorrenciaFF->addOcorrenciaFF();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>