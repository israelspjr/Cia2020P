<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
error_reporting(E_ALL);
$FolhaPonto = new FolhaPonto();
$DiaFolhaPonto = new DiaFolhaPonto();

$arrayRetorno = array();

//	$idPlanoAcaoGrupo = $_REQUEST['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$idFuncionario = $_REQUEST['funcionario_idFuncionario'];
	$mes = $_REQUEST['mes'];
	$ano = $_REQUEST['ano'];
	
	$rs = $FolhaPonto->selectFolhaPonto(" WHERE funcionario_idFuncionario = $idFuncionario AND dataReferencia = '$ano-$mes-01' ");
			
	if( !$rs ){
		
		$FolhaPonto->setFuncionarioIdFuncionario($idFuncionario);	
		$FolhaPonto->setDataReferencia("$ano-$mes-01");
			
		$idFP = $FolhaPonto->addFolhaPonto();
		
		//Inserindo os dias na Folha de Ponto
		$dias = cal_days_in_month(CAL_GREGORIAN, $mes , $ano); 
		
		
		// Array com os dias da semana
		$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
		
		$DiaFolhaPonto->setFolhaPontoIdFolhaPonto($idFP);
			for ($x = 1;$x<=$dias;$x++) {
				$DiaFolhaPonto->setDia($x);
		
				// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
				$data = date($ano."-".$mes."-".$x);

				// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
				$diasemana_numero = date('w', strtotime($data));
				
				$DiaFolhaPonto->setDiaDaSemana($diasemana[$diasemana_numero]);
				$DiaFolhaPonto->addDiaFP();
			}
		
		$arrayRetorno['mensagem'] = "Nova folha de ponto gerada com sucesso";
		$arrayRetorno['fecharNivel'] = true;
			
	}else{
		
		$arrayRetorno['mensagem'] = "Esta folha de ponto já existe, escolha outro mês";
		
	}
		

echo json_encode($arrayRetorno);
?>