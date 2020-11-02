<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FocoCurso.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$FocoCurso = new FocoCurso();
	

$idFocoCurso = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$FocoCurso->setIdFocoCurso($idFocoCurso);	
	$FocoCurso->updateFieldFocoCurso("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$foco = $_POST['foco'];
	$obs = $_POST['obs'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$FocoCurso->setIdFocoCurso($idFocoCurso);
	$FocoCurso->setFoco($foco);
	$FocoCurso->setObs($obs);
	$FocoCurso->setInativo($inativo);
	
	
	
	if($idFocoCurso != "" && $idFocoCurso > 0 ){
		$FocoCurso->updateFocoCurso();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idFocoCurso = $FocoCurso->addFocoCurso();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>