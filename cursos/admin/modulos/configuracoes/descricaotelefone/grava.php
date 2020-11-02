<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DescricaoTelefone.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$DescricaoTelefone = new DescricaoTelefone();
	

$idDescricaoTelefone = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$DescricaoTelefone->setIdDescricaoTelefone($idDescricaoTelefone);	
	$DescricaoTelefone->updateFieldDescricaoTelefone("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$DescricaoTelefone->setIdDescricaoTelefone($idDescricaoTelefone);
	$DescricaoTelefone->setNome($nome);
	$DescricaoTelefone->setInativo($inativo);
	
	
	
	if($idDescricaoTelefone != "" && $idDescricaoTelefone > 0 ){
		$DescricaoTelefone->updateDescricaoTelefone();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idDescricaoTelefone = $DescricaoTelefone->addDescricaoTelefone();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>