<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Modalidade.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$Modalidade = new Modalidade();
	

$idModalidade = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$Modalidade->setIdModalidade($idModalidade);	
	$Modalidade->updateFieldModalidade("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$Modalidade->setIdModalidade($idModalidade);
	$Modalidade->setNome($nome);
	$Modalidade->setInativo($inativo);
	
	
	
	if($idModalidade != "" && $idModalidade > 0 ){
		$Modalidade->updateModalidade();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idModalidade = $Modalidade->addModalidade();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>