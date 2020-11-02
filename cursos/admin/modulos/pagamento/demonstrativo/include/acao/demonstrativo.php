<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$DemonstrativoPagamento = new DemonstrativoPagamento();
$CreditoDebitoGrupo = new CreditoDebitoGrupo();
$ProfessorTipoImposto = new ProfessorTipoImposto();

$DemonstrativoPagamentoAulas = new DemonstrativoPagamentoAulas();
$DemonstrativoPagamentoCredDeb = new DemonstrativoPagamentoCredDeb();
$DemonstrativoPagamentoImposto = new DemonstrativoPagamentoImposto();

$DadosBancarios = new DadosBancarios();
$DescontoGeral = new DescontoGeral();

$arrayRetorno = array();

$idDemonstrativoPagamento = $_REQUEST['id'];
$id = $_REQUEST['id'];

$idProfessor = $_REQUEST['idProfessor'];
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$valorTotalLiquido = $_REQUEST['valorTotalLiquido'];
$valorTotalBruto = $_REQUEST['valorTotalBruto'];
$inss = $_REQUEST['INSS'];
$ir = $_REQUEST['IR'];
$iss = $_REQUEST['ISS'];
$valorTotalLiquido = 0;

//AULAS
$rsDemonstrativoPagamentoC = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano, true);
//Uteis::pr($rsDemonstrativoPagamentoC);

$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano, true);
//Uteis::pr($rsDemonstrativoPagamento);
$valorTotalAulas = 0;
foreach ($rsDemonstrativoPagamentoC as $valorDemonstrativoPagamento) {

//$HoraRealizadaF = $rsDemonstrativoPagamento[0]['horaRealizada'];
$horasRealizadasF += $valorDemonstrativoPagamento['horaRealizada'];
$valorTotalAulas  += $valorDemonstrativoPagamento['total'];

}

//Impostos

$dataInicioAtual = $ano."-".$mes."-01";
$dataFimAtual = date("Y-m-t", strtotime($dataInicioAtual));

$sql = "SELECT SQL_CACHE ti.sigla nome, ti.idTipoImpostoProfessor, pi.idProfessorTipoImposto, pi.dataInicio, pi.DataFim FROM tipoImpostoProfessor ti LEFT JOIN professorTipoImposto pi ON ti.idTipoImpostoProfessor = pi.TipoImpostoProfessor_idTipoImpostoProfessor WHERE ti.inativo = 0 
AND (pi.dataInicio is null or pi.dataInicio <= '".$dataInicioAtual."')
AND (pi.dataFim is null or pi.dataFim >= '".$dataFimAtual."') 
AND pi.professor_idProfessor = " . $idProfessor . "
ORDER BY ti.nome ";
//	echo $sql;

$calcularImpostos = Uteis::executarQuery($sql);

if ($calcularImpostos) {

$where = " WHERE P.professor_idProfessor= " . $idProfessor;
$rsProfessorTipoImpostoC = $ProfessorTipoImposto -> selectProfessorTipoImpostoTr_demonstrativo($where, $valorTotalAulas, $ano, $mes);

//Uteis::pr($rsProfessorTipoImpostoC);

$TotalImposto = 0;
foreach ($rsProfessorTipoImpostoC as $valorProfessorTipoImposto) {
$TotalImposto += $valorProfessorTipoImposto['total'];

	
}
}

$DemonstrativoPagamento -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
$DemonstrativoPagamento -> setProfessorIdProfessor($idProfessor);
$DemonstrativoPagamento -> setMes($mes);
$DemonstrativoPagamento -> setAno($ano);

//CREDITO
$valorTotalCredito = 0;
$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $idProfessor . " AND tipo = 1 ";
$rsCredito = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);
if( $rsCredito ){
	foreach ($rsCredito as $valorCredito) {
		$valorTotalCredito += $valorCredito['valor'];
	}
}

//DEBITOS
$valorTotalDebito = 0;
$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $idProfessor . " AND tipo = 2 ";
$rsDebito = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);
if( $rsDebito ){
	foreach ($rsDebito as $valorDebito) {
		$valorTotalDebito += $valorDebito['valor'];
	}
}

//Debitos 2 DOC
$valorDoc = 0;
$mostrarDoc = 0;
$where = " WHERE professor_idProfessor = ".$idProfessor;
$rsDoc = $DadosBancarios->selectDadosBancarios($where);
$dataPesquisa = date("Y-m-t", strtotime($ano."-".$mes."-01"));
$rs = $DescontoGeral->selectDescontoGeral(" WHERE descricao = 'DOC' AND date(dataCadastro) < '".$dataPesquisa."'");

//$rs = $DescontoGeral->selectDescontoGeral(" WHERE descricao = 'DOC'");
//$valorDoc = $rs[0]['valor'];
if ($rsDoc) {
	
	if ($rsDoc[0]['cobrarDoc'] == 1) {
		
		if ($rs[0]['valor'] > 1) {
			
	$valorDoc = $rs[0]['valor'];
//	$valorTotalDebito += $valorDoc;
	$mostrarDoc = 1;	
		}
		
		if ($valorTotalAulas == 0) {
		$valorDoc = 0;
		$mostrarDoc = 2;
		} else {
			$valorTotalDebito += $valorDoc;
		}
		
	}
	
}

//echo $valorDoc;

$credDeb = $valorTotalCredito - $valorTotalDebito;
 $valorTotalAulas; // += $credDeb;

//CARREGA TOTAIS
$valorTotalBruto = $valorTotalAulas + $credDeb - $TotalImposto;

//if ($horasRealizadasF > 0) {
$DemonstrativoPagamento -> setTotal($valorTotalBruto);
//} else { 
//$DemonstrativoPagamento -> setTotal($credDeb);
//}

$idDemonstrativoPagamento = $DemonstrativoPagamento -> addDemonstrativoPagamento();


//Uteis::pr($rsDemonstrativoPagamento);
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
//	$valorTotalAulas += $valorDemonstrativoPagamento['total'];
}


$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $idProfessor."";
$rsCreditoDebitoGrupo = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);

//Uteis::pr($rsCreditoDebitoGrupo);
foreach ($rsCreditoDebitoGrupo as $valorCreditoDebitoGrupo) {

	$DemonstrativoPagamentoCredDeb -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
	$DemonstrativoPagamentoCredDeb -> setTipo($valorCreditoDebitoGrupo['tipo']);
	$DemonstrativoPagamentoCredDeb -> setValor($valorCreditoDebitoGrupo['valor']);
	
	$obs = $valorCreditoDebitoGrupo['obs'];
	
	if ($valorCreditoDebitoGrupo['premiacao'] == 1) {
		$obs .= " (Premiação)";	
	}
	
	$DemonstrativoPagamentoCredDeb -> setObs($obs);

	$DemonstrativoPagamentoCredDeb -> addDemonstrativoPagamentoCredDeb();

}

// Cobrança DOC
if ($mostrarDoc == 1) {

	$DemonstrativoPagamentoCredDeb -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
	$DemonstrativoPagamentoCredDeb -> setTipo(2);
	$DemonstrativoPagamentoCredDeb -> setValor($valorDoc);
	$DemonstrativoPagamentoCredDeb -> setObs("Tarifa22 Doc");

	$DemonstrativoPagamentoCredDeb -> addDemonstrativoPagamentoCredDeb();

	
}


//IMPOSTO

if ($calcularImpostos) {

if ($horasRealizadasF  > 0) {
$where = " WHERE P.professor_idProfessor= " . $idProfessor;

if ($id > 1) {

	/*
	$rs = $DemonstrativoPagamentoImposto->selectDemonstrativoPagamentoImposto(" WHERE demonstrativoPagamento_idDemonstrativoPagamento  =".$id); 
//	Uteis::pr($rs);
	foreach ($rs as $valor) {
		if ($valor['tipoImpostoProfessor_idTipoImpostoProfessor'] == 1) {
		$inssA += $valor['valor'];
		}
		
		if ($valor['tipoImpostoProfessor_idTipoImpostoProfessor'] == 2) {
		$irA += $valor['valor'];
		}
		
		if ($valor['tipoImpostoProfessor_idTipoImpostoProfessor'] == 3) {
		$issA += $valor['valor'];
		}
	
	}

$inss = Uteis::gravarMoeda($inss) -$inssA;
$ir = Uteis::gravarMoeda($ir) -$irA;
$iss = Uteis::gravarMoeda($iss) - $issA;
*/
} 

$rsProfessorTipoImposto = $ProfessorTipoImposto -> selectProfessorTipoImpostoTr_demonstrativo($where, $valorTotalAulas, $ano, $mes);

//Uteis::pr($rsProfessorTipoImposto);

foreach ($rsProfessorTipoImposto as $valorProfessorTipoImposto) {

	$DemonstrativoPagamentoImposto -> setDemonstrativoPagamentoIdDemonstrativoPagamento($idDemonstrativoPagamento);
	$DemonstrativoPagamentoImposto -> setTipoImpostoProfessorIdTipoImpostoProfessor($valorProfessorTipoImposto['idTipoImpostoProfessor']);

//	if ($valorProfessorTipoImposto['idTipoImpostoProfessor'] == 1) {
//		$DemonstrativoPagamentoImposto -> setValor($inss);
		$DemonstrativoPagamentoImposto -> setValor($valorProfessorTipoImposto['total']);

/*	} elseif ($valorProfessorTipoImposto['idTipoImpostoProfessor'] == 2) {
		$DemonstrativoPagamentoImposto -> setValor($ir);

	} elseif ($valorProfessorTipoImposto['idTipoImpostoProfessor'] == 3) {
		$DemonstrativoPagamentoImposto -> setValor($iss);
	}
*/
	$DemonstrativoPagamentoImposto -> addDemonstrativoPagamentoImposto();

		}
	}
}

$arrayRetorno['mensagem'] = MSG_CADNEW;

$arrayRetorno['atualizarNivelAtual'] = true;
$arrayRetorno['pagina'] = CAMINHO_PAG . "demonstrativo/include/form/demonstrativo.php?idProfessor=$idProfessor&mes=$mes&ano=$ano";

echo json_encode($arrayRetorno);
?>