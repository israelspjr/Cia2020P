<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$DemonstrativoPagamento = new DemonstrativoPagamento();
$OutrosServicos = new OutrosServicos();
$ProfessorTipoImposto = new ProfessorTipoImposto();

//$DemonstrativoPagamentoAulas = new DemonstrativoPagamentoAulas();
$DemonstrativoPagamentoCredDeb = new DemonstrativoPagamentoCredDeb();
$DemonstrativoPagamentoOutrosServicos = new DemonstrativoPagamentoOutrosServicos();
$DemonstrativoPagamentoImposto = new DemonstrativoPagamentoImposto();

$arrayRetorno = array();

$idDemonstrativoPagamento = $_REQUEST['id'];

$idProfessor = $_REQUEST['idProfessor'];
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$valorTotalLiquido = $_REQUEST['valorTotalLiquido'];
$valorTotalBruto = $_REQUEST['valorTotalBruto'];
$valorDesconto = $_REQUEST['valorDebito'];
$semImpsotos = $_REQUEST['semImpostos'];


$DemonstrativoPagamento -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
$DemonstrativoPagamento -> setProfessorIdProfessor($idProfessor);
$DemonstrativoPagamento -> setMes($mes);
$DemonstrativoPagamento -> setAno($ano);
$DemonstrativoPagamento -> setTotal($valorTotalLiquido);
$DemonstrativoPagamento -> setTipoDemo(2);

$idDemonstrativoPagamento = $DemonstrativoPagamento -> addDemonstrativoPagamento();

//Outros Serviços
$where = " WHERE tipo <> 7 AND mes = '" . $mes . "' AND ano= '" . $ano . "' AND professor_idProfessor = " . $idProfessor;
$rsDemonstrativoPagamentoOutrosServicos = $OutrosServicos -> selectOutrosServicosTr_total($where);
foreach ($rsDemonstrativoPagamentoOutrosServicos as $valorDemonstrativoPagamentoOutrosServico) {

$DemonstrativoPagamentoOutrosServicos -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
$DemonstrativoPagamentoOutrosServicos -> setTipo($valorDemonstrativoPagamentoOutrosServico['tipo']);
$DemonstrativoPagamentoOutrosServicos -> setValor($valorDemonstrativoPagamentoOutrosServico['valor']);
$DemonstrativoPagamentoOutrosServicos -> setObs($valorDemonstrativoPagamentoOutrosServico['obs']);

$idDemonstrativoPagamentoOutrosServicos = $DemonstrativoPagamentoOutrosServicos -> addDemonstrativoPagamentoOutrosServicos();
}

/*$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano);
foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
	//print_r($valorDemonstrativoPagamento);exit;
	$DemonstrativoPagamentoAulas -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
	$DemonstrativoPagamentoAulas -> setPlanoAcaoGrupoIdPlanoAcaoGrupo($valorDemonstrativoPagamento['idPlanoAcaoGrupo']);
	$DemonstrativoPagamentoAulas -> setValor($valorDemonstrativoPagamento['valorHora']);
	$DemonstrativoPagamentoAulas -> setHoras($valorDemonstrativoPagamento['horaRealizada']);
	$DemonstrativoPagamentoAulas -> setDias($valorDemonstrativoPagamento['diasAula']);

	$totalAjudaCusto = ($valorDemonstrativoPagamento['ajudaCustoDia'] * $valorDemonstrativoPagamento['diasAula']) + ($valorDemonstrativoPagamento['ajudaCustoHora'] * ($valorDemonstrativoPagamento['horaRealizada'] / 60));
	$DemonstrativoPagamentoAulas -> setAjudaCusto($totalAjudaCusto);

	$DemonstrativoPagamentoAulas -> addDemonstrativoPagamentoAulas();
}

//CREDITO DEBITOS
$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $idProfessor;
$rsCreditoDebitoGrupo = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);
foreach ($rsCreditoDebitoGrupo as $valorCreditoDebitoGrupo) {

	$DemonstrativoPagamentoCredDeb -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
	$DemonstrativoPagamentoCredDeb -> setTipo($valorCreditoDebitoGrupo['tipo']);
	$DemonstrativoPagamentoCredDeb -> setValor($valorCreditoDebitoGrupo['valor']);
	$DemonstrativoPagamentoCredDeb -> setObs($valorCreditoDebitoGrupo['obs']);

	$DemonstrativoPagamentoCredDeb -> addDemonstrativoPagamentoCredDeb();

}
*/

if ($mes < 10) {
			$mes = "0".$mes;
		}

//IMPOSTO
$where = " WHERE P.professor_idProfessor= " . $idProfessor;
$rsProfessorTipoImposto = $ProfessorTipoImposto -> selectProfessorTipoImpostoTr_demonstrativo($where, ($valorTotalBruto - $semImpsotos), $ano, $mes);

//Uteis::pr($rsProfessorTipoImposto);

foreach ($rsProfessorTipoImposto as $valorProfessorTipoImposto) {

	$DemonstrativoPagamentoImposto -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
	$DemonstrativoPagamentoImposto -> setTipoImpostoProfessorIdTipoImpostoProfessor($valorProfessorTipoImposto['idTipoImpostoProfessor']);
	//echo $valorProfessorTipoImposto['total'];exit;
	$DemonstrativoPagamentoImposto -> setValor($valorProfessorTipoImposto['total']);
	$DemonstrativoPagamentoImposto -> addDemonstrativoPagamentoImposto();

}



$where = " WHERE tipo = 7 AND mes = '" . $mes . "' AND ano= '" . $ano . "' AND professor_idProfessor = " . $idProfessor;
$rsDemonstrativoPagamentoOutrosServicosDebito = $OutrosServicos -> selectOutrosServicosTr_total($where);
foreach ($rsDemonstrativoPagamentoOutrosServicosDebito as $valorDemonstrativoPagamentoOutrosServicoDebito) {

$DemonstrativoPagamentoCredDeb->setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
$DemonstrativoPagamentoCredDeb->setTipo(2);
$DemonstrativoPagamentoCredDeb->setValor($valorDemonstrativoPagamentoOutrosServicoDebito['valor']);
$DemonstrativoPagamentoCredDeb->setObs($valorDemonstrativoPagamentoOutrosServicoDebito['obs']);
$DemonstrativoPagamentoCredDeb->addDemonstrativoPagamentoCredDeb();

}


$arrayRetorno['mensagem'] = MSG_CADNEW;

$arrayRetorno['atualizarNivelAtual'] = true;
$arrayRetorno['pagina'] = CAMINHO_PAG . "demonstrativo/consultoria/include/form/demonstrativo.php?idProfessor=$idProfessor&mes=$mes&ano=$ano";

echo json_encode($arrayRetorno);
?>