<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicional.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ProdutoAdicional = new ProdutoAdicional();
	

$idProdutoAdicional = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ProdutoAdicional->setIdProdutoAdicional($idProdutoAdicional);	
	$ProdutoAdicional->updateFieldProdutoAdicional("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	$valor = $_POST['valor'];
  	$descricao = $_POST['descricao'];
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	$vph = ( $_POST['vph'] == "1" ? 1 : 0);
	
	$ProdutoAdicional->setIdProdutoAdicional($idProdutoAdicional);
	$ProdutoAdicional->setNome($nome);
	$ProdutoAdicional->setValor($valor);
  	$ProdutoAdicional->setDescricao($descricao);
	$ProdutoAdicional->setInativo($inativo);
	$ProdutoAdicional->setPorHora($vph);
	
	
	
	if($idProdutoAdicional != "" && $idProdutoAdicional > 0 ){
		$ProdutoAdicional->updateProdutoAdicional();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idProdutoAdicional = $ProdutoAdicional->addProdutoAdicional();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>