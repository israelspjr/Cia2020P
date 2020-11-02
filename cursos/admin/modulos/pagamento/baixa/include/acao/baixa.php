<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DemonstrativoPagamento.class.php");


$DemonstrativoPagamento = new DemonstrativoPagamento();

$arrayRetorno = array();

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$emAberto = $_REQUEST['emAberto'];

$idDemonstrativoPagamento = $_REQUEST['idDemonstrativoPagamento'];
$idTipoBaixaPagamento = $_REQUEST['idTipoBaixaPagamento'];

$DemonstrativoPagamento->setIdDemonstrativoPagamento($idDemonstrativoPagamento);

$DemonstrativoPagamento->updateFieldDemonstrativoPagamento("tipoPagamento_idTipoPagamento", "$idTipoBaixaPagamento");
$DemonstrativoPagamento->updateFieldDemonstrativoPagamento("dataBaixa", date('Y-m-d H:i:s'));

if($idTipoBaixaPagamento!="") {
$arrayRetorno['mensagem'] = "Baixa do pagamento efetuada com sucesso.";
}  else {
$arrayRetorno['mensagem'] = "Reverção da Baixa do pagamento efetuada com sucesso.";    
$DemonstrativoPagamento->updateFieldDemonstrativoPagamento("dataBaixa", date(' '));
}
$arrayRetorno['ondeAtualizar'] = "#lista_baixa";
$arrayRetorno['pagina'] = CAMINHO_PAG."baixa/include/resourceHTML/baixa.php?mes=".$mes."&ano=".$ano."&emAberto=".$emAberto;

echo json_encode($arrayRetorno);

?>