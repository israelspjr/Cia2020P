<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DemonstrativoPagamento = new DemonstrativoPagamento();

$arrayRetorno = array();
	
$idDemonstrativoPagamento = $_REQUEST['id'];

$rs = $DemonstrativoPagamento->selectDemonstrativoPagamento(" WHERE idDemonstrativoPagamento = $idDemonstrativoPagamento");
$idTipoPagamento = $rs[0]['tipoPagamento_idTipoPagamento'];
$dataBaixa = $rs[0]['dataBaixa'];

if($idTipoPagamento || $dataBaixa){
	$arrayRetorno['mensagem'] = " Não é possível excluir, pois ja foi dado baixa no pagamento.";
	echo json_encode($arrayRetorno);
	exit;
}

$rs2 = $DemonstrativoPagamento->selectDemonstrativoPagamento(" WHERE demonstrativoPagamento_idDemonstrativoPagamento = $idDemonstrativoPagamento");
if($rs2){
	$arrayRetorno['mensagem'] = " Não é possível excluir, pois existe um auxiliar deste demonstrativo.";
	echo json_encode($arrayRetorno);
	exit;
}

$DemonstrativoPagamento->setIdDemonstrativoPagamento($idDemonstrativoPagamento);
$DemonstrativoPagamento->deleteDemonstrativoPagamento();	
	
$arrayRetorno['mensagem'] = " Demostrativo excluido com sucesso.";

	
echo json_encode($arrayRetorno);

?>