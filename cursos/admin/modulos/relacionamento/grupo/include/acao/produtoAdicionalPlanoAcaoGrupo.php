<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalPlanoAcaoGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ProdutoAdicionalPlanoAcaoGrupo = new ProdutoAdicionalPlanoAcaoGrupo();
	

$idProdutoAdicionalPlanoAcaoGrupo = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	$dataSaida = Uteis::gravarData($_POST['dataSaida']);
	
	$valor = $ProdutoAdicionalPlanoAcaoGrupo->selectProdutoAdicionalPlanoAcaoGrupo(" WHERE idProdutoAdicionalPlanoAcaoGrupo = ".$idProdutoAdicionalPlanoAcaoGrupo);
	$dataInicio = $valor[0]['dataInicio'];
	
	if($dataSaida <= $dataInicio ){
		$arrayRetorno['mensagem'] = "Data do desvinculo deve ser maior que ".Uteis::exibirData($dataInicio);		
	}else{		
		$ProdutoAdicionalPlanoAcaoGrupo->setIdProdutoAdicionalPlanoAcaoGrupo($idProdutoAdicionalPlanoAcaoGrupo);
		$ProdutoAdicionalPlanoAcaoGrupo->updateFieldProdutoAdicionalPlanoAcaoGrupo("dataSaida", ($dataSaida));	
		
		$arrayRetorno['mensagem'] = "Produto adicional desvinculado com sucesso.";
		$arrayRetorno['fecharNivel'] = true;	
	}
		
}else{
	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	$idProdutoAdicional = $_POST['idProdutoAdicional'];	
	$dataEntrada = Uteis::gravarData($_POST['dataEntrada']);
	
	$ProdutoAdicionalPlanoAcaoGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$ProdutoAdicionalPlanoAcaoGrupo->setProdutoAdicionalIdProdutoAdicional($idProdutoAdicional);
	$ProdutoAdicionalPlanoAcaoGrupo->setDataInicio($dataEntrada);
	
	
	if($idProdutoAdicionalPlanoAcaoGrupo != "" && $idProdutoAdicionalPlanoAcaoGrupo > 0 ){
		//$ProdutoAdicionalPlanoAcaoGrupo->updateProdutoAdicionalPlanoAcaoGrupo();
		//$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$ProdutoAdicionalPlanoAcaoGrupo->addProdutoAdicionalPlanoAcaoGrupo();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>