<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Aviso = new Aviso();

$arrayRetorno = array();

$Aviso->setIdAviso($idAviso);

if($_POST['acao']=="deletar"){
	
    
}else{
    
	$idAviso = $_REQUEST['idAviso'];
	
	//FROM
	$Aviso->setClientePfIdClientePfEnviou($_POST['idClientePf_enviou']);
	
	//TO	
	$Aviso->setProfessorIdProfessor($_POST['idProfessor']);
	$Aviso->setFuncionarioIdFuncionario($_POST['idFuncionario']);
	
	//DADOS
	$Aviso->setTituloAviso($_POST['titulo']);
	$Aviso->setAviso($_POST['aviso']);
		
	$Aviso->addAviso();
	
	$arrayRetorno['mensagem'] = "Aviso enviado com sucesso";
//	$arrayRetorno['fecharNivel'] = true;
    
}

echo json_encode($arrayRetorno);

?>