<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$PlanoAcao = new PlanoAcao();
$OpcaoDia = new OpcaoDia();
$IntegrantePlanoAcao = new IntegrantePlanoAcao();	
$SubvencaoCursoPlanoAcao = new SubvencaoCursoPlanoAcao();
$SubvencaoMaterialPlanoAcao = new SubvencaoMaterialPlanoAcao();			
$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();		
$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();	
$PlanoAcaoRegras = new PlanoAcaoRegras();
$IntegranteProposta = new IntegranteProposta();
$ValorSimuladoProposta = new ValorSimuladoProposta();
$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();
$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();
$NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();
$ProdutoAdicionalItemValorSimuladoProposta = new ProdutoAdicionalItemValorSimuladoProposta();
$ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcaoRegras = new PlanoAcaoRegras();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$AulaDataFixa = new AulaDataFixa();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$ValorHoraGrupo = new ValorHoraGrupo();
$FechamentoGrupo = new FechamentoGrupo();
$FechamentoGrupoItenMotivoFechamento = new FechamentoGrupoItenMotivoFechamento();
$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
$CalendarioProva = new CalendarioProva();
$FolhaFrequencia = new FolhaFrequencia();
$DiaAulaFF = new DiaAulaFF();


$arrayRetorno = array();

$idPlanoAcao = $_REQUEST['idPlanoAcao'];
$idStatus = $_REQUEST['idStatus'];
$IdNivelEstudo = $_REQUEST['IdNivelEstudo'];

$mes = date('m');
$ano = date('Y');

//$PlanoAcao->setIdPlanoAcao($idPlanoAcao);

	$PlanoAcao->setPropostaIdProposta($_POST['proposta_idProposta']);
	$PlanoAcao->setGrupoIdGrupo($_POST['grupo_idGrupo']);		
	$PlanoAcao->setFocoCursoIdFocoCurso($_POST['idFocoCursoIdioma']);
	$PlanoAcao->setNivelEstudoIdNivelEstudo($IdNivelEstudo);
	$PlanoAcao->setKitMaterialIdKitMaterial($_POST['idKitMaterial']);
	$PlanoAcao->setExpectativaInicioIdExpectativaInicio($_POST['idExpectativaInicio']);
	$PlanoAcao->setDataExpectativaInicio( Uteis::gravarData($_POST['dataExpectativaInicio']));
	$PlanoAcao->setHorasPrograma( Uteis::gravarHoras($_POST['horasPrograma_1']) );
	$PlanoAcao->setAbordagemCurso($_POST['abordagemCurso_base']);
	$PlanoAcao->setStatusAprovacaoIdStatusAprovacao("1");	
//	$PlanoAcao->setDataAprovacao("'" . date('Y-m-d') . "'");			
	$PlanoAcao->setMesReferenciaMudanca($mes);
	$PlanoAcao->setAnoReferenciaMudanca($ano);
	$PlanoAcao->setPaMudanca(1);
	$PlanoAcao->setTipoContrato($_POST['tipoContrato']);
	$PlanoAcao->setTipoCurso($_POST['tipoCurso']);	
	$PlanoAcao->setTipoAval($_POST['tipoAval']);	
	$PlanoAcao->setTipoMaterial($_POST['tipoMaterial']);			
	

if($idStatus==3){
		
	$PlanoAcao->updateFieldPlanoAcao("statusAprovacao_idStatusAprovacao", $idStatus);
	
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['mensagem'] = "Plano de ação reprovado com sucesso.";
	
}elseif($idStatus==2){
/*	
	//INTEGRANTE PA	
	$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;
	$temIntegrantePlanoAcao = $IntegrantePlanoAcao->selectIntegrantePlanoAcao($where);
	
	if( $temIntegrantePlanoAcao ){
		
		//SUBVENCAO CURSO			
		for($row=0; $row < count($temIntegrantePlanoAcao,0); $row++){
			
			$idIntegrantePlanoAcao = $temIntegrantePlanoAcao[$row]['idIntegrantePlanoAcao'];
						
			$where = " WHERE integrantePlanoAcao_idIntegrantePlanoAcao = ".$idIntegrantePlanoAcao;
			$temSubvencaoCursoPlanoAcao = $SubvencaoCursoPlanoAcao->selectSubvencaoCursoPlanoAcao($where);
			
			if( $temSubvencaoCursoPlanoAcao ){
	
				//SUBVENCAO MATERIAL				
				$where = " WHERE integrantePlanoAcao_idIntegrantePlanoAcao = ".$idIntegrantePlanoAcao;
				$temSubvencaoMaterialPlanoAcao = $SubvencaoMaterialPlanoAcao->selectSubvencaoMaterialPlanoAcao($where);
				
				if( !$temSubvencaoMaterialPlanoAcao ) $arrayRetorno['mensagem'] = "Favor definir subvenção de material para todos integrantes.";		
	
			}else{				
				$arrayRetorno['mensagem'] = "Favor definir subvenção de curso para todos integrantes.";			
			}	
		}
	}else{			
		$arrayRetorno['mensagem'] = "Favor inserir integrantes no plano de ação.";			
	}
		
	//VERIFICA VALORES SIMULADOS
	$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;
	$temValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao($where);
	
	if( $temValorSimuladoPlanoAcao ){		
		
		for($row=0; $row < count($temValorSimuladoPlanoAcao); $row++){	
		
			$idValorSimuladoPlanoAcao = $temValorSimuladoPlanoAcao[$row]['idValorSimuladoPlanoAcao'];
			$tipo = $temValorSimuladoPlanoAcao[$row]['tipo'];
			$freq = $temValorSimuladoPlanoAcao[$row]['frequenciaSemanalAula'];	
			$horasTotais = $temValorSimuladoPlanoAcao[$row]['horasPorAula'];
			if($temValorSimuladoPlanoAcao[$row]['horaNaoGeraFf']) $horasTotais -= $temValorSimuladoPlanoAcao[$row]['horaNaoGeraFf'];	
			
			//VERIFICA SIMULAÇÃO DE DIAS E HORARIOS								
			$where = " WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao;
			$temOpcaoDia = $OpcaoDia->selectOpcaoDia($where);	
			
			if( $temOpcaoDia ){	
													
				$where = " WHERE escolhido = 1 AND valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao;
				$temOpcaoDia = $OpcaoDia->selectOpcaoDia($where);				
				
				if( !$temOpcaoDia ){	
					//echo $where;exit;		
					$arrayRetorno['mensagem'] = "Favor escolher uma opção de dias e horários para cada valor simulado.";			
				}else{					
					//VERIFICA AS OPÇOES DE DIAS
					$valorOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao->selectOpcaoDiaPlanoAcao(" WHERE opcaoDia_idOpcao = ".$temOpcaoDia[0]['idOpcao']);
					
					if($tipo == "R"){			
						if(count($valorOpcaoDiaPlanoAcao) != $freq) $arrayRetorno['mensagem'] = "Existem opçoes de frequência que nao batem com o total de dias simulados.";			
					}elseif($tipo == "T" || $tipo == "E"){
						$totalVal = 0;
						foreach($valorOpcaoDiaPlanoAcao as $val) $totalVal += ($val['horaFim'] - $val['horaInicio']);
						if($totalVal > $horasTotais)  $arrayRetorno['mensagem'] = "Existem mais horas simuladas (".Uteis::exibirHoras($totalVal).") do que a carga horaria do programa (".Uteis::exibirHoras($horasTotais).").";			
					}
				}
					
			}else{
				$arrayRetorno['mensagem'] = "Favor simular dias e horários para os valores inseridos.";				
			}
		}
	}else{		
		$arrayRetorno['mensagem'] = "Favor inserir um valor simulado.";		
	}
	
	$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;
	$temPlanoAcaoRegras = $PlanoAcaoRegras->selectPlanoAcaoRegras($where);
	
	if( !$temPlanoAcaoRegras ){		
		$arrayRetorno['mensagem'] = "Favor definir regras do plano de ação.";		
	}
		
	if( $arrayRetorno['mensagem']==""){
	*/	
//		$PlanoAcao->updateFieldPlanoAcao("statusAprovacao_idStatusAprovacao", "2");	
//		$PlanoAcao->updateFieldPlanoAcao("dataAprovacao", date('Y-m-d H:i:s') );	
		
		
		$idProposta = $PlanoAcao->getIdProposta($idPlanoAcao);
		
		$idPlanoAcao_Ant = $idPlanoAcao;
		// Criando Plano de Ação
	//	$idPlanoAcao = $PlanoAcao->addPlanoAcao();
		
		//Adicionando Valores Simulados	
		$idPlanoAcao = $PlanoAcao->addPlanoAcao();		
		
			//INSERE REGRAS
			
		$rsPlanoAcaoRegras = $PlanoAcaoRegras->selectPlanoAcaoRegras(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao_Ant);

		for ($row = 0; $row < count($rsPlanoAcaoRegras,0); $row++){
			$PlanoAcaoRegras->setPlanoAcaoIdPlanoAcao($idPlanoAcao);	
			$PlanoAcaoRegras->setRegrasIdRegras($rsPlanoAcaoRegras[$row]['regras_idRegras']);	
			
			$PlanoAcaoRegras->addPlanoAcaoRegras();	
		}
		// Cria novo PlanoAcaoGrupo e desativa o anterior
	
		$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($_POST['grupo_idGrupo']);
		$PlanoAcaoGrupo->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
		$PlanoAcaoGrupo->setGrupoIdGrupo($_POST['grupo_idGrupo']);
		$PlanoAcaoGrupo->setDataInicioEstagio(Uteis::gravarData($_POST['dataExpectativaInicio']));
		$PlanoAcaoGrupo->setDataPrevisaoTerminoEstagio(Uteis::gravarData($_POST['dataTermino']));
		$PlanoAcaoGrupo->setInativo(0);
		$PlanoAcaoGrupo->setNivelEstudoIdNivelEstudo($IdNivelEstudo);
		$novoIdPlanoAcaoGrupo = $PlanoAcaoGrupo->addPlanoAcaoGrupo();
		
		
		// Verifica se tem FF no mês e atualiza o PlanodeAçãoGrupo.
		$valorIdPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_total($_POST['grupo_idGrupo']);
		for ($x=0;$x<count($valorIdPlanoAcaoGrupo);$x++) {
					$idPlanoAcaoGrupo2Tmp[] = $valorIdPlanoAcaoGrupo[$x]['idPlanoAcaoGrupo'];
					$idPlanoAcaoGrupo2 = implode(",",$idPlanoAcaoGrupo2Tmp);
				}
	//	echo $idPlanoAcaoGrupo2;		
		$valorFF = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$idPlanoAcaoGrupo2.") AND dataReferencia = '".$ano."-".$mes."-01'");
		if ($valorFF) {
		$FolhaFrequencia->setIdFolhaFrequencia($valorFF[0]['idFolhaFrequencia']);	
		$FolhaFrequencia->updateFieldFolhaFrequencia("planoAcaoGrupo_idPlanoAcaoGrupo",$novoIdPlanoAcaoGrupo);
		}
//		Uteis::pr($valorFF);
		
		
		// Cria Caléndario de prova
		
		$CalendarioProva->setPlanoAcaoGrupoIdPlanoAcaoGrupo($novoIdPlanoAcaoGrupo);
		$CalendarioProva->setProvaIdProva(3);
		
		//Debitando 15 dias
		if ($_POST['dataTermino'] == '') {
			$dataAtual = date('Y-m-d');
		$dataProva =  date('Y-m-d', strtotime('+180 days', strtotime($dataAtual)));
		} else {
		$dataProva = Uteis::gravarData($_POST['dataTermino']);
		}
		
		
		$dataProva2 = date('d/m/Y', strtotime('-15 days', strtotime($dataProva)));
		
		$CalendarioProva->setDataPrevistaInicial(Uteis::gravarData($dataProva2));
		$CalendarioProva->addCalendarioProva();
		
			
		// Insere Dias de Aula Permanente
		$rsAula = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND (dataFim is null OR dataFim > '".$ano."-".$mes."-01')");
		
		for ($row = 0; $row< count($rsAula,0);$row++) {
		$AulaPermanenteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($novoIdPlanoAcaoGrupo);
		$AulaPermanenteGrupo->setexibirDiaSemana($rsAula[$row]['diaSemana']);	
		$AulaPermanenteGrupo->setHoraInicio($rsAula[$row]['horaInicio']);
		$AulaPermanenteGrupo->setHoraFim($rsAula[$row]['horaFim']);
		$AulaPermanenteGrupo->setObs($rsAula[$row]['obs']);
		$AulaPermanenteGrupo->setDataInicio($rsAula[$row]['dataInicio']);
		$AulaPermanenteGrupo->setDataFim($rsAula[$row]['dataFim']);
		$AulaPermanenteGrupo->setLocalAulaIdLocalAula($rsAula[$row]['localAula_idLocalAula']);
		$AulaPermanenteGrupo->setEnderecoIdEndereco($rsAula[$row]['endereco_idEndereco']);
		$AulaPermanenteGrupo->setInativo($rsAula[$row]['inativo']);
		$idAula = $AulaPermanenteGrupo->addAulaPermanenteGrupo();	
		
		// Verifica se a aula foi preenchida e preenche no novo estágio
		
		$rsAulaP = $DiaAulaFF->selectDiaAulaFF(" WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$rsAula[$row]['idAulaPermanenteGrupo']. " AND dataAula >= '".$ano."-".$mes."-01' "); // AND ((horaRealizada IS NOT NULL) OR (ocorrenciaFF_idOcorrencia IS NOT NULL))");
		foreach($rsAulaP as $valorP) {
			$DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($valorP['folhaFrequencia_idFolhaFrequencia']);
			$DiaAulaFF->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAula);
		//	$DiaAulaFF->setAulaDataFixaIdAulaDataFixa
			$DiaAulaFF->setDataAula($valorP['dataAula']);
			$DiaAulaFF->setHoraRealizada($valorP['horaRealizada']);
			$DiaAulaFF->setOcorrenciaFFIdOcorrenciaFF($valorP['ocorrenciaFF_idOcorrenciaFF']);
			$DiaAulaFF->setReposicao($valorP['reposicao']);
			$DiaAulaFF->setBanco($valorP['banco']);
			$DiaAulaFF->setAulaInexistente($valorP['aulaInexistente']);
			$DiaAulaFF->addDiaAulaFF();
		}
	//	Uteis::pr($novoIdAula);  
		
		//Vincula Professor
		$rsProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor(" WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$rsAula[$row]['idAulaPermanenteGrupo']);
		
		for ($row2 = 0;$row2<count($rsProfessor,0);$row2++) {
		
		$AulaGrupoProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAula);
		$AulaGrupoProfessor->setProfessorIdProfessor($rsProfessor[$row2]['professor_idProfessor']);
		$AulaGrupoProfessor->setDataInicio($rsProfessor[$row2]['dataInicio']);
		$AulaGrupoProfessor->setDataFim($rsProfessor[$row2]['dataFim']);
		$AulaGrupoProfessor->setTipoAulaGrupoProfessorIdTipoAulaGrupoProfessor($rsProfessor[$row2]['tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor']);
		$AulaGrupoProfessor->addAulaGrupoProfessor();
		}
		
		

		}
		
		// Insere dias de Aula Fixa
		$rsAula = $AulaDataFixa->selectAulaDataFixa(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND (dataFim is null OR dataFim > '".$ano."-".$mes."-01')");
		
		for ($row = 0; $row < count($rsAula,0);$row++) {
		$AulaDataFixa->setPlanoAcaoGrupoIdPlanoAcaoGrupo($novoIdPlanoAcaoGrupo);
		$AulaDataFixa->setDataAula($rsAula[$row]['dataAula']);
		$AulaDataFixa->setHoraInicio($rsAula[$row]['horaInicio']);
		$AulaDataFixa->setHoraFim($rsAula[$row]['horaFim']);
		$AulaDataFixa->setObs($rsAula[$row]['obs']);
		$AulaDataFixa->setLocalAulaIdLocalAula($rsAula[$row]['localAula_idLocalAula']);
		$AulaDataFixa->setEnderecoIdEndereco($rsAula[$row]['endereco_idEndereco']);
		$AulaDataFixa->setExcluido(0);
		$idAula = $AulaDataFixa->addAulaDataFixa();
		
		//Vincula Professor
		$rsProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor(" WHERE aulaDataFixa_idAulaDataFixa = ".$rsAula[$row]['idAulaDataFixa']);
		
		for ($row2 = 0;$row2<count($rsProfessor,0);$row2++) {
		
		$AulaGrupoProfessor->setAulaDataFixaIdAulaDataFixa($idAula);
		$AulaGrupoProfessor->setProfessorIdProfessor($rsProfessor[$row2]['professor_idProfessor']);
		$AulaGrupoProfessor->setDataInicio($rsProfessor[$row2]['dataInicio']);
		$AulaGrupoProfessor->setDataFim($rsProfessor[$row2]['dataFim']);
		$AulaGrupoProfessor->setTipoAulaGrupoProfessorIdTipoAulaGrupoProfessor($rsProfessor[$row2]['tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor']);
		$AulaGrupoProfessor->addAulaGrupoProfessor();
		
		// Verifica se a aula foi preenchida e preenche no novo estágio
		
		$rsAulaA = $DiaAulaFF->selectDiaAulaFF(" WHERE aulaDataFixa_idAulaDataFixa = ".$rsAula[$row]['idAulaDataFixa']. " AND dataAula >= '".$ano."-".$mes."-01' "); // AND ((horaRealizada IS NOT NULL) OR (ocorrenciaFF_idOcorrencia IS NOT NULL))");
		foreach($rsAulaA as $valorA) {
			$DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($valorA['folhaFrequencia_idFolhaFrequencia']);
		//	$DiaAulaFF->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAula);
			$DiaAulaFF->setAulaDataFixaIdAulaDataFixa($idAula);
			$DiaAulaFF->setDataAula($valorA['dataAula']);
			$DiaAulaFF->setHoraRealizada($valorA['horaRealizada']);
			$DiaAulaFF->setOcorrenciaFFIdOcorrenciaFF($valorA['ocorrenciaFF_idOcorrenciaFF']);
			$DiaAulaFF->setReposicao($valorA['reposicao']);
			$DiaAulaFF->setBanco($valorA['banco']);
			$DiaAulaFF->setAulaInexistente($valorA['aulaInexistente']);
			$DiaAulaFF->addDiaAulaFF();
		}
		}
		
		
			
		}
		
		//Valor Hora Grupo
		$rsValor = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo. ""); // AND (dataFim is null or dataFim > '".$ano."-".$mes."-01')");
		
		for ($row = 0; $row <count($rsValor,0);$row++) {
		$ValorHoraGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($novoIdPlanoAcaoGrupo);
		$ValorHoraGrupo->setModalidadeIdModalidade($rsValor[$row]['modalidade_idModalidade']);
		$ValorHoraGrupo->setValorHora($rsValor[$row]['valorHora']);
		$ValorHoraGrupo->setCargaHorariaFixaMensal($rsValor[$row]['cargaHorariaFixaMensal']);
		$ValorHoraGrupo->setValorDescontoHora($rsValor[$row]['valorDescontoHora']);
		$ValorHoraGrupo->setValidadeDesconto($rsValor[$row]['validadeDesconto']);
		$ValorHoraGrupo->setPrevisaoReajuste($rsValor[$row]['previsaoReajuste']);
		$ValorHoraGrupo->setDataInicio($rsValor[$row]['dataInicio']);
		$ValorHoraGrupo->setDataFim($rsValor[$row]['dataFim']);
		$ValorHoraGrupo->addValorHoraGrupo();		
			
		}
		
		//Fechamento Grupo
		
		$rsFecha = $FechamentoGrupo->selectFechamentoGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
		
		$rsFechaObs = $rsFecha[0]['obs'];
		if ($rsFechaObs != '') {
		$rsFechaData = $rsFecha[0]['dataFechamento'];
		$rsFechaTipo = $rsFecha[0]['tipo'];
		
		$rsFechaMotivo = $FechamentoGrupoItenMotivoFechamento->selectFechamentoGrupoItenMotivoFechamento( " WHERE fechamentoGrupo_idFechamentoGrupo = ".$rsFecha[0]['idFechamentoGrupo']);
		
		$itemFechaMotivo = $rsFechaMotivo[0]['itenMotivoFechamento_idItenMotivoFechamento'];
		
		$FechamentoGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($novoIdPlanoAcaoGrupo);
		$FechamentoGrupo->setObs($rsFechaObs);
		$FechamentoGrupo->setDataFechamento($rsFechaData);	
		$FechamentoGrupo->setTipo($rsFechaTipo);		
		$novoIdFechamentoGrupo = $FechamentoGrupo->addFechamentoGrupo();
		
		$FechamentoGrupoItenMotivoFechamento->setFechamentoGrupoIdFechamentoGrupo($novoIdFechamentoGrupo);
		$FechamentoGrupoItenMotivoFechamento->setItenMotivoFechamentoIdItenMotivoFechamento($itemFechaMotivo);
		$FechamentoGrupoItenMotivoFechamento->addFechamentoGrupoItenMotivoFechamento();		
	
		}
		
			$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo ." AND dataSaida Is null";
//			echo $where;
			
			$valorIntegranteProposta = $IntegranteGrupo->selectIntegranteGrupo($where);

			for ($row = 0; $row < count($valorIntegranteProposta,0); $row++){

				$IntegrantePlanoAcao->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
				$IntegrantePlanoAcao->setClientePfIdClientePf($valorIntegranteProposta[$row]['clientePf_idClientePf']);	
				$IntegrantePlanoAcao->setStatusAprovacaoIdStatusAprovacao(1);
				$IntegrantePlanoAcao->setNivelIdNivel( $IdNivelEstudo );
				$IntegrantePlanoAcao->setLinkVisualizacao();
				
				$IntegrantePlanoAcao->addIntegrantePlanoAcao();
				
		// Insere IntegranteGrupo
				$IntegranteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($novoIdPlanoAcaoGrupo);
				$IntegranteGrupo->setClientePfIdClientePf($valorIntegranteProposta[$row]['clientePf_idClientePf']);
				$IntegranteGrupo->setDataEntrada($valorIntegranteProposta[$row]['dataEntrada']);
				
				$novoIdIntegrante = $IntegranteGrupo->addIntegranteGrupo();	

		//Subvenção dos integrantes
				$subVencaoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE integranteGrupo_idIntegranteGrupo = ".$valorIntegranteProposta[$row]['idIntegranteGrupo']. " AND dataFim is null" );		
				
				if ($subVencaoGrupo > 0) {
				
				$SubvencaoCursoGrupo->setIntegranteGrupoIdIntegranteGrupo($novoIdIntegrante);
				$SubvencaoCursoGrupo->setSubvencao($subVencaoGrupo[0]['subvencao']);
				$SubvencaoCursoGrupo->setTeto($subVencaoGrupo[0]['teto']);
				$SubvencaoCursoGrupo->setQuemPaga($subVencaoGrupo[0]['quemPaga']);
				$SubvencaoCursoGrupo->setDataInicio($subVencaoGrupo[0]['dataInicio']);
				$SubvencaoCursoGrupo->addSubvencaoCursoGrupo();
				
				}
				
				
				
			
			}
				
			$idValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao_Ant);		
//			$idValorSimuladoPlanoAcao = $idValorSimuladoPlanoAcao[0]['idValorSimuladoProposta'];
			
			if($idValorSimuladoPlanoAcao){
				
//				$valorItemValorSimuladoProposta = $ItemValorSimuladoProposta->selectItemValorSimuladoProposta(" WHERE valorSimuladoProposta_idValorSimuladoProposta = ".$idValorSimuladoProposta);
					
				for ($row = 0; $row < count($idValorSimuladoPlanoAcao,0); $row++){
					
					$ValorSimuladoPlanoAcao->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
							
					$ValorSimuladoPlanoAcao->setValorHora($idValorSimuladoPlanoAcao[$row]['valorHora']);	
					$ValorSimuladoPlanoAcao->setValorDescontoHora($idValorSimuladoPlanoAcao[$row]['valorDescontoHora']);	
					$ValorSimuladoPlanoAcao->setValidadeDesconto($idValorSimuladoPlanoAcao[$row]['validadeDesconto']);	
					$ValorSimuladoPlanoAcao->setHorasPorAula($idValorSimuladoPlanoAcao[$row]['horasPorAula']);	
					$ValorSimuladoPlanoAcao->setFrequenciaSemanalAula($idValorSimuladoPlanoAcao[$row]['frequenciaSemanalAula']);	
					$ValorSimuladoPlanoAcao->setCargaHorariaFixaMensal($idValorSimuladoPlanoAcao[$row]['cargaHorariaFixaMensal']);	
					$ValorSimuladoPlanoAcao->setHoraNaoGeraFf($idValorSimuladoPlanoAcao[$row]['horaNaoGeraFf']);	
					$ValorSimuladoPlanoAcao->setObs($idValorSimuladoPlanoAcao[$row]['obs']);	
					$ValorSimuladoPlanoAcao->setTipo($idValorSimuladoPlanoAcao[$row]['tipo']);	
					$ValorSimuladoPlanoAcao->setModalidadeIdModalidade($idValorSimuladoPlanoAcao[$row]['modalidade_idModalidade']);	
					
					$idValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->addValorSimuladoPlanoAcao();
					
					$where = " WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao[$row]['idValorSimuladoPlanoAcao'];
					$valorNaoFazAulaNestaPlanoAcao = $NaoFazAulaNestaSemanaPlanoAcao->selectNaoFazAulaNestaSemanaPlanoAcao($where);
							
					for ($row2 = 0; $row2 < count($valorNaoFazAulaNestaSemanaPlanoAcao,0); $row2++){						
						$NaoFazAulaNestaSemanaPlanoAcao->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao( $idValorSimuladoPlanoAcao );
						$NaoFazAulaNestaSemanaPlanoAcao->setSemana( $valorNaoFazAulaNestaSemanaPlanoAcao[$row2]['semana'] );
								
						$NaoFazAulaNestaSemanaPlanoAcao->addNaoFazAulaNestaSemanaPlanoAcao();
					}											
					
										
				$valorProdutoAdicionalItemValorSimuladoPlanoAcao = $ProdutoAdicionalValorSimuladoPlanoAcao->selectProdutoAdicionalValorSimuladoPlanoAcao(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao[$row]['idItemValorSimuladoPlanoAcao']);

					for ($row2 = 0; $row2 < count($valorProdutoAdicionalItemValorSimuladoPlanoAcao,0); $row2++){
		
						$ProdutoAdicionalValorSimuladoPlanoAcao->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao( $idValorSimuladoPlanoAcao );
						$ProdutoAdicionalValorSimuladoPlanoAcao->setProdutoAdicionalIdProdutoAdicional($valorProdutoAdicionalItemValorSimuladoPlanoAcao[$row2]['produtoAdicional_idProdutoAdicional']);	
						
						$ProdutoAdicionalValorSimuladoPlanoAcao->addProdutoAdicionalValorSimuladoPlanoAcao();		
					}
					
				}
				
			}
		//inativa o PlanoAcao de Ação Grupo anterior
		$PlanoAcaoGrupo->setIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
		$PlanoAcaoGrupo->updateFieldPlanoAcaoGrupo('inativo',1);
		
		
		
		$arrayRetorno['mensagem'] = "Mudança de estágio concluída com sucesso! <br /><small> Caso precise, o plano de ação ainda está aberto para edição..</small>";
		$arrayRetorno['fecharNivel'] = true;	
		
	}
	
//}

echo json_encode($arrayRetorno);

?>