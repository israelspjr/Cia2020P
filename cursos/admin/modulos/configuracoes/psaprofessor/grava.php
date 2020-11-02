<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PsaProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$PsaProfessor = new PsaProfessor();
	

$idPsaProfessor = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$PsaProfessor->setIdPsaProfessor($idPsaProfessor);	
	$PsaProfessor->updateFieldPsaProfessor("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['idTipoNota'];
	$titulo = $_POST['titulo'];
	$pergunta = $_POST['pergunta'];
	$obs = $_POST['obs'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$PsaProfessor->setIdPsaProfessor($idPsaProfessor);
	$PsaProfessor->setTipo($tipo);
	$PsaProfessor->setTitulo($titulo);
	$PsaProfessor->setPergunta($pergunta);
	$PsaProfessor->setObs($obs);
	$PsaProfessor->setInativo($inativo);
	
	
	
	if($idPsaProfessor != "" && $idPsaProfessor > 0 ){
		$PsaProfessor->updatePsaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idPsaProfessor = $PsaProfessor->addPsaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>