<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Gestor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$Gestor = new Gestor();

$arrayRetorno = array();


if($_POST['acao']=="funcionario"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Funcionario.class.php");
	$Funcionario = new Funcionario();
	
	$and = " AND idFuncionario NOT IN ( ";
	$and .= " SELECT funcionario_idFuncionario FROM gestor ";
	$and .= " WHERE funcionario_idFuncionario IS NOT NULL AND funcionario_idFuncionario <> '' )";

	echo $Funcionario->selectFuncionarioSelect($idFuncionario, "required", $and);
	echo "<span style=\"display:none\">Campo obrigatório</span>";
	
}elseif($_POST['acao']=="professor"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Professor.class.php");	
	$Professor = new Professor();
	
	$and = " AND idProfessor NOT IN ( ";
	$and .= " SELECT professor_idProfessor FROM gestor ";
	$and .= " WHERE professor_idProfessor IS NOT NULL AND professor_idProfessor <> '' )";
	
	echo $Professor->selectProfessorSelect("required", $idProfessor, $and);
	echo "<span style=\"display:none\">Campo obrigatório</span>";
	
}elseif($_POST['acao']=="clientePf"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ClientePf.class.php");
	$ClientePf = new ClientePf();
	
	$and = " AND idClientePf NOT IN ( ";
	$and .= " SELECT clientePf_idClientePf FROM gestor ";
	$and .= " WHERE clientePf_idClientePf IS NOT NULL AND clientePf_idClientePf <> '' )";
	
	echo $ClientePf->selectClientePfSelect("required", $idClientePf, $and);	
	echo "<span style=\"display:none\">Campo obrigatório</span>";
	
}else{
	
	$idGestor = $_REQUEST['id'];
	$idClientePF = $_REQUEST['idClientePf'];
	$idProfessor = $_REQUEST['idProfessor'];
	$idFuncionario = $_REQUEST['idFuncionario'];
	
	$Gestor->setIdGestor($idGestor);
	$Gestor->setProfessorIdProfessor($idProfessor);
	$Gestor->setClientePfIdClientePf($idClientePF);
	$Gestor->setFuncionarioIdFuncionario($idFuncionario);
	$Gestor->setFuncionarioIdFuncionarioQuemCadastrou($_SESSION['idFuncionario_SS']);

	$Gestor->setInativo($_POST['inativo']);
	$Gestor->setObs($_POST['obs']);

	//$_->setDataCadastro(date('Y-m-d H:m:s'));
	
	if($idGestor != "" && $idGestor > 0 ){
		$Gestor->updateGestor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idGestor = $Gestor->addGestor();
		$arrayRetorno['mensagem'] = "Gestor cadastrado com sucesso";		
	}
	$arrayRetorno['fecharNivel'] = true;
	echo json_encode($arrayRetorno);
	
}

?>