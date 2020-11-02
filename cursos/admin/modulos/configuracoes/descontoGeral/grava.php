<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DescontoGeral.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$DescontoGeral = new DescontoGeral();
	

$idDescontoGeral = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$DescontoGeral->setIdDescontoGeral($idDescontoGeral);	
	$DescontoGeral->deleteDescontoGeral(); //("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro Deletado!!";
		
}else{
	
	$nome = $_POST['nome'];
	$valorDesconto = Uteis::gravarMoeda($_POST['valorDesconto']);
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$DescontoGeral->setIdDescontoGeral($idDescontoGeral);
	$DescontoGeral->setDescricao($nome);
	$DescontoGeral->setInativo($inativo);
	$DescontoGeral->setValor($valorDesconto);
	
	
	
	
	if($idDescontoGeral != "" && $idDescontoGeral > 0 ){
		$DescontoGeral->updateDescontoGeral();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idDescontoGeral = $DescontoGeral->addDescontoGeral();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>