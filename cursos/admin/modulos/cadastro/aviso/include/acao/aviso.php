<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Aviso = new Aviso();

$arrayRetorno = array();

$idAviso = $_REQUEST['idAviso'];

if($_POST['acao']=="deletar"){
	//    
}else{
  
	$Aviso->setIdAviso($idAviso);
	
	//QUEM ENVIA A MSG
	$Aviso->setFuncionarioIdFuncionarioEnviou($_POST['idFuncionario_enviou']);
	
	//QUEM RECEBE A MSG
	$Aviso->setClientePfIdClientePf($_POST['idClientePf']);
	$Aviso->setClientePjIdClientePj($_POST['idClientePj']);
	$Aviso->setProfessorIdProfessor($_POST['idProfessor']);
	$Aviso->setFuncionarioIdFuncionario($_POST['idFuncionario']);
	
	//DADOS
	$Aviso->setTituloAviso($_POST['titulo']);
	$Aviso->setAviso($_POST['aviso']);
		
	$Aviso->addAviso();
	
	$arrayRetorno['mensagem'] = "Aviso enviado com sucesso";
	$arrayRetorno['fecharNivel'] = true;
    
}

echo json_encode($arrayRetorno);

?>