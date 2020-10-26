<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Representante.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$Representante = new Representante();

$arrayRetorno = array();

if($_REQUEST['acao']=="funcionario"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Funcionario.class.php");
	$Funcionario = new Funcionario();
	
	$and = " AND idFuncionario NOT IN ( ";
	$and .= " SELECT funcionario_idFuncionario FROM representante ";
	$and .= " WHERE funcionario_idFuncionario IS NOT NULL AND funcionario_idFuncionario <> '' )";

	echo $Funcionario->selectFuncionarioSelect($idFuncionario, "required", $and);
	echo "<span style=\"display:none\">Campo obrigatório</span>";
	
}elseif($_REQUEST['acao']=="professor"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Professor.class.php");	
	$Professor = new Professor();
	
	$and = " AND idProfessor NOT IN ( ";
	$and .= " SELECT professor_idProfessor FROM representante ";
	$and .= " WHERE professor_idProfessor IS NOT NULL AND professor_idProfessor <> '' )";
	
	echo $Professor->selectProfessorSelect("required", $idProfessor, $and);
	echo "<span style=\"display:none\">Campo obrigatório</span>";
	
}elseif($_REQUEST['acao']=="clientePf"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ClientePf.class.php");
	$ClientePf = new ClientePf();
	
	$and = " AND idClientePf NOT IN ( ";
	$and .= " SELECT clientePf_idClientePf FROM representante ";
	$and .= " WHERE clientePf_idClientePf IS NOT NULL AND clientePf_idClientePf <> '' )";
	
	echo $ClientePf->selectClientePfSelect("required", $idClientePf, $and);	
	echo "<span style=\"display:none\">Campo obrigatório</span>";

//if($_POST['acao']=="deletar"){
//		
//	//$arrayRetorno['fecharNivel'] = true;	
//	$idRepresentante = $_REQUEST['id'];
//	$Representante->setIdRepresentante($idRepresentante);
//	$Representante->deleteRepresentante();
//	$arrayRetorno['mensagem'] = "Representante deletado com sucesso";
	
}else{
	
	$idRepresentante = $_REQUEST['id'];
	$idClientePF = $_REQUEST['idClientePf'];
	$idProfessor = $_REQUEST['idProfessor'];
	$idFuncionario = $_REQUEST['idFuncionario'];
		
	$Representante->setIdRepresentante($idRepresentante);
	$Representante->setProfessorIdProfessor($idProfessor);
	$Representante->setClientePfIdClientePf($idClientePF);
	$Representante->setFuncionarioIdFuncionario($idFuncionario);
	$Representante->setFuncionarioIdFuncionarioQuemCadastrou($_SESSION['idFuncionario_SS']);

	$Representante->setInativo($_POST['inativo']);
	$Representante->setObs($_POST['obs']);

	//$_->setDataCadastro(date('Y-m-d H:m:s'));
	
	if($idRepresentante != "" && $idRepresentante > 0 ){
		$Representante->updateRepresentante();
		$arrayRetorno['mensagem'] = MSG_CADATU;		
	}else{
		$idRepresentante = $Representante->addRepresentante();
		$arrayRetorno['mensagem'] = "Representante cadastrado com sucesso";
	}
	
	$arrayRetorno['pagina'] = CAMINHO_CAD."representante/cadastro.php?id=".$idRepresentante;
	$arrayRetorno['atualizarNivelAtual'] = true;
	
	echo json_encode($arrayRetorno);
	
}
?>