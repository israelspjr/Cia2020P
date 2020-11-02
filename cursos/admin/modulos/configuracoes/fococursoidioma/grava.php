<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FocoCursoIdioma.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$FocoCursoIdioma = new FocoCursoIdioma();
	

$idFocoCursoIdioma = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$FocoCursoIdioma->setIdFocoCursoIdioma($idFocoCursoIdioma);	
	$FocoCursoIdioma->updateFieldFocoCursoIdioma("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$focoCurso_idFocoCurso = $_POST['idFocoCurso'];
	$idioma_idIdioma = $_POST['idIdioma'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$FocoCursoIdioma->setIdFocoCursoIdioma($idFocoCursoIdioma);
	$FocoCursoIdioma->setFocoCursoIdFocoCurso($focoCurso_idFocoCurso);
	$FocoCursoIdioma->setIdiomaIdIdioma($idioma_idIdioma);
	$FocoCursoIdioma->setInativo($inativo);
	
	
	
	if($idFocoCursoIdioma != "" && $idFocoCursoIdioma > 0 ){
		$FocoCursoIdioma->updateFocoCursoIdioma();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idFocoCursoIdioma = $FocoCursoIdioma->addFocoCursoIdioma();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>