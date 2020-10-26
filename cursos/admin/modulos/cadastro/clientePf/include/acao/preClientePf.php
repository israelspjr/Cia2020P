<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$PreClientePf = new PreClientePf();
$GerenteTem = new GerenteTem();
$Gerente = new Gerente();

$idPreClientePf2 = $_REQUEST['id'];

$idPreClientePf = $_REQUEST['idPreClientePf'];
$nome = $_REQUEST['nomeExibicao'];
$email = $_REQUEST['email'];
//$idFuncionario = $_REQUEST['idFuncionario'];
$idClientePj = $_REQUEST['clientePj_idClientePj'];


if($_POST['acao'] == 'deletar'){
	
	$PreClientePf->setIdPreClientePf($idPreClientePf2);
	$PreClientePf->deletePreClientepf();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	

	$PreClientePf->setNome($nome);
	$PreClientePf->setEmail($email);
	$PreClientePf->setJaRealizado(0);
	
	$valorGerenteTem = $GerenteTem->selectGerenteTem(" WHERE clientePj_idClientePj = ".$idClientePj." AND dataExclusao is NULL");
	$idGerente = $valorGerenteTem[0]['gerente_idGerente'];
	
	$valorGerente = $Gerente->selectGerente(" WHERE idGerente = ".$idGerente);
	$idFuncionario = $valorGerente[0]['funcionario_idFuncionario'];
	
	$PreClientePf->setFuncionarioIdFuncionario($idFuncionario);
	$PreClientePf->setClientePjIdClientePj($idClientePj);
	
	if (($idPreClientePf != '') || ($idPreClientePf > 0)) {
		
	$PreClientePf->updatePreClientePf();	
	$arrayRetorno['mensagem'] = MSG_CADATU;
		
	} else {
		
	$PreClientePf->addPreClientePf();
	$arrayRetorno['mensagem'] = MSG_CADNEW;
		
	}
	
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
	
?>
