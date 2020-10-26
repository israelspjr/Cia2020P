<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicional.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalValorSimuladoPlanoAcao.class.php");

$ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
$ProdutoAdicional = new ProdutoAdicional();

$idProdutoAdicionalValorSimuladoPlanoAcao = $_REQUEST['id'];

$arrayRetorno = array();

$ProdutoAdicionalValorSimuladoPlanoAcao->setIdProdutoAdicionalValorSimuladoPlanoAcao($idProdutoAdicionalValorSimuladoPlanoAcao);

if($_REQUEST['acao'] == 'deletar'){
			
	$ProdutoAdicionalValorSimuladoPlanoAcao->deleteProdutoAdicionalValorSimuladoPlanoAcao();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";

}else{

	$ProdutoAdicionalValorSimuladoPlanoAcao->setProdutoAdicionalIdProdutoAdicional($_POST['idProdutoAdicional']);
	$ProdutoAdicionalValorSimuladoPlanoAcao->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($_POST['idValorSimuladoPlanoAcao']);
	
	if($idProdutoAdicionalValorSimuladoPlanoAcao != "" && $idProdutoAdicionalValorSimuladoPlanoAcao > 0 ){
		
		$ProdutoAdicionalValorSimuladoPlanoAcao->updateProdutoAdicionalValorSimuladoPlanoAcao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
				
	}else{
		
		$idProdutoAdicionalValorSimuladoPlanoAcao = $ProdutoAdicionalValorSimuladoPlanoAcao->addProdutoAdicionalValorSimuladoPlanoAcao();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
	
}

echo json_encode($arrayRetorno);

?>