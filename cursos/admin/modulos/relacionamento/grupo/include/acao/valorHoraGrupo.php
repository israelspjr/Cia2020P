<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ValorHoraGrupo = new ValorHoraGrupo();

$arrayRetorno = array();

$idValorHoraGrupo = $_REQUEST['id'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$naoPagarProfessor = ( $_POST['naoPagarProfessor'] == "1" ? 1 : 0);

$ValorHoraGrupo->setIdValorHoraGrupo($idValorHoraGrupo);

if($_POST['acao']=="deletar"){
	
	//$ValorHoraGrupo->deleteValorHoraGrupo();	
	//$arrayRetorno['mensagem'] = MSG_CADDEL;;
	
}else{
	
	if($idValorHoraGrupo){		
			
        $dataInicio = Uteis::gravarData($_POST['dataInicio']);
        $dataFim = Uteis::gravarData($_POST['dataFim']);
        $cargaHorariaFixaMensal = $_POST['cargaHorariaFixaMensal'] ? Uteis::gravarHoras($_POST['cargaHorariaFixaMensal']) : "";
        $valorDescontoHora = $_POST['valorDescontoHora'] ? Uteis::formatarMoeda($_POST['valorDescontoHora']) : "";
        $validadeDesconto = $_POST['validadeDesconto'] ? Uteis::gravarData($_POST['validadeDesconto']) : "";
        $previsaoReajuste = $_POST['previsaoReajuste'] ? Uteis::gravarData($_POST['previsaoReajuste']) : date("Y-m-d", strtotime("+1 year", strtotime($dataInicio)));
        $valorHora = Uteis::gravarMoeda($_POST['valorHora']);
       
        $ValorHoraGrupo->setIdValorHoraGrupo($idValorHoraGrupo);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("dataInicio", $dataInicio);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("dataFim", $dataFim);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("previsaoReajuste", $previsaoReajuste);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("modalidade_idModalidade", $_POST['idModalidade']);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("valorHora", $valorHora);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("cargaHorariaFixaMensal", $cargaHorariaFixaMensal);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("valorDescontoHora", $valorDescontoHora);
        $ValorHoraGrupo->updateFieldValorHoraGrupo("validadeDesconto", $validadeDesconto); 
        $ValorHoraGrupo->updateFieldValorHoraGrupo("modalidade_idModalidade", $_POST['idModalidade']);
		$ValorHoraGrupo->updateFieldValorHoraGrupo("naoPagarProfessor", $naoPagarProfessor);
		$ValorHoraGrupo->updateFieldValorHoraGrupo("valorHoraProfessor", $_POST['valorHoraProfessor']);
		

		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;			
		
	}else{
		
		$dataInicio = Uteis::gravarData($_POST['dataInicio']);
		$cargaHorariaFixaMensal = $_POST['cargaHorariaFixaMensal'] ? Uteis::gravarHoras($_POST['cargaHorariaFixaMensal']) : "";
		$valorDescontoHora = $_POST['valorDescontoHora'] ? Uteis::formatarMoeda($_POST['valorDescontoHora']) : "";
		$validadeDesconto = $_POST['validadeDesconto'] ? Uteis::gravarData($_POST['validadeDesconto']) : "";
		$previsaoReajuste = $_POST['previsaoReajuste'] ? Uteis::gravarData($_POST['previsaoReajuste']) : date("Y-m-d", strtotime("+1 year", strtotime($dataInicio)));
        $valorHora = Uteis::gravarMoeda($_POST['valorHora']);
		
		if( ($valorDescontoHora && !$validadeDesconto) || (!$valorDescontoHora && $validadeDesconto) ){
			$arrayRetorno['mensagem'] = "Preencha valor e validade do desconto.";	
		}else{
			
			$rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE (dataFim IS NULL OR dataFim = '') AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo");
			$dataInicio_ant = $rsValorHoraGrupo[0]['dataInicio'];
			$idValorHoraGrupo_ant = $rsValorHoraGrupo[0]['idValorHoraGrupo'];
			
			if($dataInicio <= $dataInicio_ant){
				$arrayRetorno['mensagem'] = "Data de início deve ser maior que ".Uteis::exibirData($dataInicio_ant);
			}elseif($previsaoReajuste <= $dataInicio){
				$arrayRetorno['mensagem'] = "Previsao de reajuste deve ser maior que ".Uteis::exibirData($dataInicio);
			}else{
				
				//exclui velho
				$dataFim = date("Y-m-d", strtotime("-1 day", strtotime($dataInicio)));
				$ValorHoraGrupo->setIdValorHoraGrupo($idValorHoraGrupo_ant);
				$ValorHoraGrupo->updateFieldValorHoraGrupo("dataFim", $dataFim);

				//add novo
				$ValorHoraGrupo->setIdValorHoraGrupo($idValorHoraGrupo);
				$ValorHoraGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
				$ValorHoraGrupo->setModalidadeIdModalidade($_POST['idModalidade']);
				$ValorHoraGrupo->setValorHora($valorHora);
				$ValorHoraGrupo->setCargaHorariaFixaMensal($cargaHorariaFixaMensal);
				$ValorHoraGrupo->setValorDescontoHora($valorDescontoHora);
				$ValorHoraGrupo->setValidadeDesconto($validadeDesconto);				
				$ValorHoraGrupo->setPrevisaoReajuste($previsaoReajuste);
				$ValorHoraGrupo->setDataInicio($dataInicio);
				$ValorHoraGrupo->setDataFim(Uteis::gravarData($_POST['dataFim']));
				$ValorHoraGrupo->setNaoPagarProfessor($naoPagarProfessor);
				$ValorHoraGrupo->setValorHoraProfessor($_POST['valorHoraProfessor']);
								
				$ValorHoraGrupo->addValorHoraGrupo();
				
				$arrayRetorno['mensagem'] = MSG_CADNEW;
				$arrayRetorno['fecharNivel'] = true;
			}
		}
	}
	
}

echo json_encode($arrayRetorno);

?>