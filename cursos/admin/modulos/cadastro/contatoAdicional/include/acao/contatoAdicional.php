<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ContatoAdicional = new ContatoAdicional();

$arrayRetorno = array();

$idContatoAdicional = $_REQUEST['id'];

$ContatoAdicional->setIdContatoAdicional($idContatoAdicional);

if($_POST['acao']=="deletar"){
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
	$ContatoAdicional->setIdContatoAdicional($idContatoAdicional);
	$ContatoAdicional->deleteContatoAdicional();
	
}else{

	$idClientePF = $_REQUEST['clientePf_idClientePf'];
	$idClientePJ = $_REQUEST['clientePj_idClientePj'];
	$idProfessor = $_REQUEST['professor_idProfessor'];
	$idFuncionario = $_REQUEST['funcionario_idFuncionario'];
  $idProposta = $_REQUEST['proposta_idProposta'];

	$ContatoAdicional->setClientePfIdClientePf($idClientePF);
	$ContatoAdicional->setClientePjIdClientePj($idClientePJ);
	$ContatoAdicional->setFuncionarioIdFuncionario($idFuncionario);
	$ContatoAdicional->setProfessorIdProfessor($idProfessor);
  $ContatoAdicional->setPropostaIdProposta($idProposta);
	$ContatoAdicional->setNome($_POST['nome']);
	$ContatoAdicional->setContatoCobranca($_POST['contatoCobranca']);
	$ContatoAdicional->setContatoRH($_POST['contatoRH']);
  $ContatoAdicional->setContatoOutro($_POST['contatoOutro']);
  $ContatoAdicional->setContatoObs($_POST['contatoObs']);	
	$ContatoAdicional->setObs($_POST['obs']);
		
	if( $idContatoAdicional ){
		
		$ContatoAdicional->updateContatoAdicional();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		
		$idContatoAdicional = $ContatoAdicional->addContatoAdicional();
		
		$arrayRetorno['mensagem'] = MSG_CADNEW;		
		$arrayRetorno['atualizarNivelAtual'] = true;
		$arrayRetorno['pagina'] = CAMINHO_CAD."contatoAdicional/include/form/contatoAdicional.php?id=".$idContatoAdicional;
	
	}
		
	//$arrayRetorno['fecharNivel'] = true;
	
}

echo json_encode($arrayRetorno);

?>