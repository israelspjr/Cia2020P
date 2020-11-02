<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PsaRegular.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$PsaRegular = new PsaRegular();
	

$idPsaRegular = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$PsaRegular->setIdPsa($idPsaRegular);	
	$PsaRegular->updateFieldPsaRegular("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['idTipoNota'];
	$titulo = $_POST['titulo'];
	$pergunta = $_POST['pergunta'];
	$obs = $_POST['obs'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$PsaRegular->setIdPsa($idPsaRegular);
	$PsaRegular->setTipo($tipo);
	$PsaRegular->setTitulo($titulo);
	$PsaRegular->setPergunta($pergunta);
	$PsaRegular->setObs($obs);
	$PsaRegular->setInativo($inativo);
	
	
	
	if($idPsaRegular != "" && $idPsaRegular > 0 ){
		$PsaRegular->updatePsaRegular();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idPsaRegular = $PsaRegular->addPsaRegular();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>