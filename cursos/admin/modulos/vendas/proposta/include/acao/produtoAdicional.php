<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicional.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalItemValorSimuladoProposta.class.php");

$ProdutoAdicionalItemValorSimuladoProposta = new ProdutoAdicionalItemValorSimuladoProposta();
$ProdutoAdicional = new ProdutoAdicional();

$idProdutoAdicionalItemValorSimuladoProposta = $_REQUEST['id'];

if($_REQUEST['acao'] == 'deletar'){
	
	$ProdutoAdicionalItemValorSimuladoProposta->setIdProdutoAdicionalItemValorSimuladoProposta($idProdutoAdicionalItemValorSimuladoProposta);
	$ProdutoAdicionalItemValorSimuladoProposta->deleteProdutoAdicionalItemValorSimuladoProposta();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
	
}else{

	$ProdutoAdicionalItemValorSimuladoProposta->setIdProdutoAdicionalItemValorSimuladoProposta($idProdutoAdicionalItemValorSimuladoProposta);
	$ProdutoAdicionalItemValorSimuladoProposta->setProdutoAdicionalIdProdutoAdicional($_POST['idProdutoAdicional']);
	$ProdutoAdicionalItemValorSimuladoProposta->setItemValorSimuladoPropostaIdItemValorSimuladoProposta($_POST['idItemValorSimuladoProposta']);
	
	if($idProdutoAdicionalItemValorSimuladoProposta != "" && $idProdutoAdicionalItemValorSimuladoProposta > 0 ){
		
		$ProdutoAdicionalItemValorSimuladoProposta->updateProdutoAdicionalItemValorSimuladoProposta();
		$arrayRetorno['mensagem'] = MSG_CADATU;		
		
	}else{
		
		$idProdutoAdicionalItemValorSimuladoProposta = $ProdutoAdicionalItemValorSimuladoProposta->addProdutoAdicionalItemValorSimuladoProposta();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		
	}
	
	$arrayRetorno['fecharNivel'] = true;
			
}

echo json_encode($arrayRetorno);

?>