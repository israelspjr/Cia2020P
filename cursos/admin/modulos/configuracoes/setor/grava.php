<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FuncionarioSetor.class.php");

$FuncionarioSetor = new FuncionarioSetor();

$arrayRetorno = array();

$idFuncionarioSetor = $_REQUEST['id'];
$FuncionarioSetor->setIdFuncionarioSetor($idFuncionarioSetor);

if($_POST['acao']=="deletar"){
	
	$FuncionarioSetor->setIdFuncionarioSetor($idFuncionarioSetor);
	$FuncionarioSetor->deleteFuncionarioSetor();

	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{

	$FuncionarioSetor->setFuncionarioIdFuncionario($_POST['idFuncionario']);
	$FuncionarioSetor->setSetorIdSetor($_POST['idSetor']);
	
	if( $idFuncionarioSetor != "" && $idFuncionarioSetor > 0 ){
		$FuncionarioSetor->updateFuncionarioSetor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idFuncionarioSetor = $FuncionarioSetor->addFuncionarioSetor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;		
	}
	
	$arrayRetorno['fecharNivel'] = true;
		
}

echo json_encode($arrayRetorno);

?>