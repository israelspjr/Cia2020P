<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();

$obs = $_REQUEST['obs'];
$acao = $_REQUEST['acao'];

		
if($_REQUEST['acao']=="deletar"){		
  
  $DemonstrativoCobranca = new DemonstrativoCobranca();
  $PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
      
	$idDemonstrativoCobranca = $_REQUEST['id']; //echo "//$idDemonstrativoCobranca";exit;
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$ano = $_REQUEST['ano'];
	$mes = $_REQUEST['mes'];	
	
	//EXCLUI DEMOSTRATIVO
	$DemonstrativoCobranca->setIdDemonstrativoCobranca($idDemonstrativoCobranca);
	$DemonstrativoCobranca->deleteDemonstrativoCobranca();
	
	//EXCLUI STATUS FATURADO DA COBRANÇA
	$PlanoAcaoGrupoStatusCobranca->deletePlanoAcaoGrupoStatusCobranca(" OR ( planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND mes = ".$mes." AND ano = ".$ano.")");
	
	$arrayRetorno['mensagem'] = " Demostrativo excluido com sucesso.";
	
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] = CAMINHO_COBRANCA."demonstrativo/include/form/demonstrativo.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&mes=".$mes."&ano=".$ano;

	
} if($_REQUEST['acao']=="gravaObs"){
	$DemonstrativoCobranca = new DemonstrativoCobranca();
	
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$ano = $_REQUEST['ano'];
	$mes = $_REQUEST['mes'];
	
	$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND mes = ".$mes." AND ano = ".$ano;
	
    $rsDemonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca($where);
//	Uteis::pr($rsDemonstrativo); 
	$idDemonstrativoCobranca = $_REQUEST['idDemonstrativoCobranca'];
	if ($idDemonstrativoCobranca == '') {
		$idDemonstrativoCobranca = $rsDemonstrativo[0]['idDemonstrativoCobranca'];		
	}
	$DemonstrativoCobranca->setIdDemonstrativoCobranca($idDemonstrativoCobranca);
	$DemonstrativoCobranca->updateFieldDemonstrativoCobranca("obs",$obs);
	
	$arrayRetorno['mensagem'] = "Observação atualizada com sucesso.";
    $arrayRetorno['fecharNivel'] = true;
	

}else{
  
    $DemonstrativoCobranca = new DemonstrativoCobranca();
    $PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	$DemonstrativoCobrancaIntegranteGrupo = new DemonstrativoCobrancaIntegranteGrupo();
	$SubCursoDemonstrativoCobrancaIntegranteGrupo = new SubCursoDemonstrativoCobrancaIntegranteGrupo();
	$SubMaterialDemonstrativoCobrancaIntegranteGrupo = new SubMaterialDemonstrativoCobrancaIntegranteGrupo();
	$DemonstrativoCobrancaDias = new DemonstrativoCobrancaDias();
	$DemonstrativoCobrancaProfessor = new DemonstrativoCobrancaProfessor();
	$DemonstrativoCobrancaValorHora = new DemonstrativoCobrancaValorHora();
	$DemonstrativoCobrancaAjudaCusto = new DemonstrativoCobrancaAjudaCusto();
	$IntegranteGrupo = new IntegranteGrupo();
	$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
	$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();
	$AulaGrupoProfessor = new AulaGrupoProfessor();
	$ValorHoraGrupo = new ValorHoraGrupo();
	$FolhaFrequencia = new FolhaFrequencia();
	$EncomendaMaterialGrupo = new EncomendaMaterialGrupo();
	$EncomendaMaterialPagamentoParcela = new EncomendaMaterialPagamentoParcela();	
	$PlanoAcaoGrupoAjudaCusto = new PlanoAcaoGrupoAjudaCusto();
	$IntegranteGrupo = new IntegranteGrupo();
    $TextoEmailPadrao = new TextoEmailPadrao();
    $PlanoAcaoGrupo = new PlanoAcaoGrupo();
  
	//CARREGA VARS
	$idDemonstrativoCobranca = $_POST['idDemonstrativoCobranca'];	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	$idClientePj = $_POST['idClientePj'];
	$ano = $_POST['ano'];
	$mes = $_POST['mes'];	
	$dataReferencia = "$ano-$mes-01";
	$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
	$totalCurso = $_POST['totalCurso'];
	$totalMaterial = $_POST['totalMaterial'];
	$totalCredito = $_POST['totalCredito'];
	$totalDebito = $_POST['totalDebito'];
	$totalHoras = $_POST['totalHoras'];
//	$obs = $_POST['obs'];
//	echo $obs;
    $dataVencimento = Uteis::gravarData($_POST['dataVencimento']);
	
	//FALTA MARCAR PARCELAS DO MATERIAL COMO PAGAS	
	$rsEncomendaMaterialGrupo = $EncomendaMaterialGrupo->selectEncomendaMaterialGrupo_parcela($idPlanoAcaoGrupo, $dataReferencia);
	if($rsEncomendaMaterialGrupo){
		foreach($rsEncomendaMaterialGrupo as $valorEncomendaMaterialGrupo){
		
			$idEncomendaMaterialPagamentoParcela = $valorEncomendaMaterialGrupo['idEncomendaMaterialPagamentoParcela'];
			
			$EncomendaMaterialPagamentoParcela->setIdEncomendaMaterialPagamentoParcela($idEncomendaMaterialPagamentoParcela);
			$EncomendaMaterialPagamentoParcela->updateFieldEncomendaMaterialPagamentoParcela("quitada", "1");
		}
	}
	
	//INSERE DEMONSTRATIVO
	$DemonstrativoCobranca->setIdDemonstrativoCobranca($idDemonstrativoCobranca);
	$DemonstrativoCobranca->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$DemonstrativoCobranca->setClientePjIdClientePj($idClientePj);
	$DemonstrativoCobranca->setMes($mes);
	$DemonstrativoCobranca->setAno($ano);	
	$DemonstrativoCobranca->setValCurso($totalCurso);
	$DemonstrativoCobranca->setValMaterial($totalMaterial);
	$DemonstrativoCobranca->setValCredito($totalCredito);
	$DemonstrativoCobranca->setValDebito($totalDebito);
	$DemonstrativoCobranca->setTotalHoras($totalHoras);
    $DemonstrativoCobranca->setDatavencimento($dataVencimento);
	$DemonstrativoCobranca->setObs($obs);

	$idDemonstrativoCobranca = $DemonstrativoCobranca->addDemonstrativoCobranca();

	//INSERE INREGRANTES	
//	$paraQuem = array();	
	$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupo_Demonstrativo($idPlanoAcaoGrupo, $dataReferencia);
	if($rsIntegranteGrupo){
		foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
			
	      $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
			
      $nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
      $emailsAluno = $IntegranteGrupo->getEmail($idIntegranteGrupo);
      foreach ($emailsAluno as $email) $paraQuem = array("nome" => $nomeAluno, "email" => $email);
      
			$cursoEmpresa = $_POST['totalCurso_Empresa_'.$idIntegranteGrupo];
			$materialEmpresa = $_POST['totalMaterial_Empresa_'.$idIntegranteGrupo];		
			$cursoAluno = $_POST['totalCurso_Aluno_'.$idIntegranteGrupo];
			$materialAluno = $_POST['totalMaterial_Aluno_'.$idIntegranteGrupo];
			$creditoEmpresa = $_POST['totalEmpresa_credito_'.$idIntegranteGrupo];
			$debitoEmpresa = $_POST['totalEmpresa_debito_'.$idIntegranteGrupo];
			$creditoAluno = $_POST['totalAluno_credito_'.$idIntegranteGrupo];
			$debitoAluno = $_POST['totalAlunos_debito_'.$idIntegranteGrupo];				
	
			$DemonstrativoCobrancaIntegranteGrupo->setDemonstrativoCobrancaIdDemonstrativoCobranca($idDemonstrativoCobranca);
			$DemonstrativoCobrancaIntegranteGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
			$DemonstrativoCobrancaIntegranteGrupo->setCursoEmpresa($cursoEmpresa);
			$DemonstrativoCobrancaIntegranteGrupo->setMaterialEmpresa($materialEmpresa);
			$DemonstrativoCobrancaIntegranteGrupo->setCursoAluno($cursoAluno);
			$DemonstrativoCobrancaIntegranteGrupo->setMaterialAluno($materialAluno);
			$DemonstrativoCobrancaIntegranteGrupo->setCreditoEmpresa($creditoEmpresa);
			$DemonstrativoCobrancaIntegranteGrupo->setDebitoEmpresa($debitoEmpresa);
			$DemonstrativoCobrancaIntegranteGrupo->setCreditoAluno($creditoAluno);
			$DemonstrativoCobrancaIntegranteGrupo->setDebitoAluno($debitoAluno);
						
			$idDemonstrativoCobrancaIntegranteGrupo = $DemonstrativoCobrancaIntegranteGrupo->addDemonstrativoCobrancaIntegranteGrupo();
	
			//INSERE SUB MATERIAL
			$rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo_periodo($idIntegranteGrupo, $dataReferencia);
			if($rsSubvencaoMaterialGrupo){
				foreach($rsSubvencaoMaterialGrupo as $valorSubvencaoMaterialGrupo){				
					
					$dataInicio = $valorSubvencaoMaterialGrupo['dataInicio'];							
					$dataFim = $valorSubvencaoMaterialGrupo['dataFim'];	
					$dataInicio = ($dataInicio && $dataInicio < $dataReferencia) ? $dataReferencia : $dataInicio;		
					$dataFim = ($dataFim && $dataFim > $dataReferenciaFinal) ? $dataReferenciaFinal : $dataFim;				
					$subvencao = $valorSubvencaoMaterialGrupo['subvencao'];
					$teto = $valorSubvencaoMaterialGrupo['teto'];	
					$quemPaga = $valorSubvencaoMaterialGrupo['quemPaga'];	
																			
					$SubMaterialDemonstrativoCobrancaIntegranteGrupo->setDemonstrativoCobrancaIntegranteGrupoId($idDemonstrativoCobrancaIntegranteGrupo);
					$SubMaterialDemonstrativoCobrancaIntegranteGrupo->setDataInicio($dataInicio);
					$SubMaterialDemonstrativoCobrancaIntegranteGrupo->setDataFim($dataFim);
					$SubMaterialDemonstrativoCobrancaIntegranteGrupo->setPercentual($subvencao);
					$SubMaterialDemonstrativoCobrancaIntegranteGrupo->setTeto($teto);
					$SubMaterialDemonstrativoCobrancaIntegranteGrupo->setQuemPaga($quemPaga);
					
					$SubMaterialDemonstrativoCobrancaIntegranteGrupo->addSubMaterialDemonstrativoCobrancaIntegranteGrupo();
				}
			}
			
			//INSERE SUB CURSO
			$rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo_periodo($idIntegranteGrupo, $dataReferencia);
			if($rsSubvencaoCursoGrupo){
				foreach($rsSubvencaoCursoGrupo as $valorSubvencaoCursoGrupo){				
					
					$dataInicio = $valorSubvencaoCursoGrupo['dataInicio'];	
					$dataFim = $valorSubvencaoCursoGrupo['dataFim'];	
					$dataInicio = ($dataInicio && $dataInicio < $dataReferencia) ? $dataReferencia : $dataInicio;		
					$dataFim = ($dataFim && $dataFim > $dataReferenciaFinal) ? $dataReferenciaFinal : $dataFim;	
					$subvencao = $valorSubvencaoCursoGrupo['subvencao'];
					$teto = $valorSubvencaoCursoGrupo['teto'];	
					$quemPaga = $valorSubvencaoCursoGrupo['quemPaga'];	
							
					$SubCursoDemonstrativoCobrancaIntegranteGrupo->setDemonstrativoCobrancaIntegranteGrupoId($idDemonstrativoCobrancaIntegranteGrupo);
					$SubCursoDemonstrativoCobrancaIntegranteGrupo->setDataInicio($dataInicio);
					$SubCursoDemonstrativoCobrancaIntegranteGrupo->setDataFim($dataFim);
					$SubCursoDemonstrativoCobrancaIntegranteGrupo->setPercentual($subvencao);
					$SubCursoDemonstrativoCobrancaIntegranteGrupo->setTeto($teto);
					$SubCursoDemonstrativoCobrancaIntegranteGrupo->setQuemPaga($quemPaga);
					
					$SubCursoDemonstrativoCobrancaIntegranteGrupo->addSubCursoDemonstrativoCobrancaIntegranteGrupo();
				}
			}
		}
	}

	//INSERE PROFS	
	$rsProfessores = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo, $dataReferencia);
	foreach($rsProfessores as $idProfessor){	
		
		$DemonstrativoCobrancaProfessor->setDemonstrativoCobrancaIdDemonstrativoCobranca($idDemonstrativoCobranca);
		$DemonstrativoCobrancaProfessor->setProfessorIdProfessor($idProfessor);
				
		$DemonstrativoCobrancaProfessor->addDemonstrativoCobrancaProfessor();
	}
	
	//INSERE VAL HORA
	$rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);
	foreach($rsValorHoraGrupo as $valorValorHoraGrupo){

		$valorHora = $valorValorHoraGrupo['valorHora'];						
		$valorDescontoHora = $valorValorHoraGrupo['valorDescontoHora'];
		$validadeDesconto = $valorValorHoraGrupo['validadeDesconto'];
		$dataInicio = $valorValorHoraGrupo['dataInicio'];
		$dataFim = $valorValorHoraGrupo['dataFim'];
		$dataInicio = ($dataInicio && $dataInicio < $dataReferencia) ? $dataReferencia : $dataInicio;		
		$dataFim = ($dataFim && $dataFim > $dataReferenciaFinal) ? $dataReferenciaFinal : $dataFim;	
		
		$DemonstrativoCobrancaValorHora->setDemonstrativoCobrancaIdDemonstrativoCobranca($idDemonstrativoCobranca);
		$DemonstrativoCobrancaValorHora->setValor($valorHora);
		$DemonstrativoCobrancaValorHora->setValorDesconto($valorDescontoHora);		
		$DemonstrativoCobrancaValorHora->setValidadeDesconto($validadeDesconto);
		$DemonstrativoCobrancaValorHora->setDataInicio($dataInicio);
		$DemonstrativoCobrancaValorHora->setDataFim($dataFim);
				
		$DemonstrativoCobrancaValorHora->addDemonstrativoCobrancaValorHora();
	}
	
	//INSERE AJUDA DE CUSTO
	$where = " AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo 
	AND CAST('$ano-$mes-01' AS DATE) >= CAST(CONCAT(anoIni, '-', mesIni, '-01') AS DATE)
	AND ( 
		CAST('$ano-$mes-01' AS DATE) <= CAST(CONCAT(anoFim,'-', mesFim, '-01') AS DATE) 
		OR 
		(anoFim IS NULL AND mesFim IS NULL)
	) AND cobrarAluno = 1 ";	
	$rsPlanoAcaoGrupoAjudaCusto = $PlanoAcaoGrupoAjudaCusto->selectPlanoAcaoGrupoAjudaCusto($where);	
	if($rsPlanoAcaoGrupoAjudaCusto ){							              	
		foreach($rsPlanoAcaoGrupoAjudaCusto as $valorAjudaCusto){
				$DemonstrativoCobrancaAjudaCusto->setDemonstrativoCobrancaIdDemonstrativoCobranca($idDemonstrativoCobranca);
				$DemonstrativoCobrancaAjudaCusto->setValor($valorAjudaCusto['valor']);
				$DemonstrativoCobrancaAjudaCusto->setPorDia($valorAjudaCusto['porDia']);
				$DemonstrativoCobrancaAjudaCusto->setDescricao($valorAjudaCusto['descricao']);
				
				$DemonstrativoCobrancaAjudaCusto->addDemonstrativoCobrancaAjudaCusto();
		}
	}	
	
	//INSERE DIAS
	$rsTotalFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $ano, $mes);
	$rsTotalFF = array_merge($rsTotalFF['permanente'], $rsTotalFF['fixa']);
	$DiaAulaFF = new DiaAulaFF();
	foreach($rsTotalFF as $valorFF){
		
		$horas = $valorFF['horasTotal'];
		$dia = date('d', strtotime($valorFF['dataAtual']));		
		$dataAula = $valorFF['dataAtual'];
		$temAI = $DiaAulaFF->selectDiaAulaFF(" WHERE banco = 0 AND aulaInexistente = 1 AND dataAula = '$dataAula' AND folhaFrequencia_idFolhaFrequencia IN(
                    SELECT idFolhaFrequencia FROM folhaFrequencia 
                    WHERE  planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND MONTH(dataReferencia) = $mes AND YEAR(dataReferencia) = $ano
                )");                
       if( $temAI ) continue;
                
                
		$DemonstrativoCobrancaDias->setDemonstrativoCobrancaIdDemonstrativoCobranca($idDemonstrativoCobranca);
		$DemonstrativoCobrancaDias->setDia($dia);
		$DemonstrativoCobrancaDias->setHoras($horas);
	
		$DemonstrativoCobrancaDias->addDemonstrativoCobrancaDias();
	}
	
	//INSERE STATUS FATURADO
	$PlanoAcaoGrupoStatusCobranca->setStatusCobrancaIdStatusCobranca("5");
	$PlanoAcaoGrupoStatusCobranca->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoStatusCobranca->setMes($mes);
	$PlanoAcaoGrupoStatusCobranca->setAno($ano);				
	$idPlanoAcaoGrupoStatusCobranca = $PlanoAcaoGrupoStatusCobranca->addPlanoAcaoGrupoStatusCobranca();
	
	
	$arrayRetorno['mensagem'] = "Demonstrativo gravado com sucesso.";
    $arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
