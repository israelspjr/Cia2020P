<?php
class RelatorioNovo extends Database {

  // constructor
  function __construct() {
    parent::__construct();
  }

  function __destruct() {
    parent::__destruct();
  }
  
  function relatorioRateio($where = "", $tipo, $excel = false, $mesIni, $mesFim, $campos, $camposNome) {

	$Grupo = new Grupo();
	$Idioma = new Idioma();
	$NivelEstudo = new NivelEstudo();
	$Professor = new Professor();
	$IntegranteGrupo = new IntegranteGrupo();
	$AulaPermanenteGrupo = new AulaPermanenteGrupo();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$PlanoAcao = new PlanoAcao();
	$ValorHoraGrupo = new ValorHoraGrupo();
	$Prova = new Prova();
	$FolhaFrequencia = new FolhaFrequencia();
	$ClientePf = new ClientePf();
	$ClientePj = new ClientePj();
	$DemonstrativoCobranca =  new DemonstrativoCobranca();
	$Relatorio = new Relatorio();
	$ClientePj = new ClientePj();
	$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
	$AcompanhamentoCurso = new AcompanhamentoCurso();
	$RelatorioDesempenho = new RelatorioDesempenho();
	$BancoHoras = new BancoHoras();
	$EnderecoVirtual = new EnderecoVirtual();
   
   $sql = "SELECT distinct(G.idGrupo), G.nome as grupo, PA.idPlanoAcao, GPJ.clientePj_idClientePj, PA.horasPrograma
   	FROM grupo as G
	INNER JOIN grupoClientePj as GPJ on G.idGrupo = GPJ.grupo_idGrupo
	INNER JOIN gerenteTem AS GER ON GPJ.clientePj_idClientePj = GER.clientePj_idClientePj AND dataExclusao IS NULL
	INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo AND PAG.inativo = 0
	INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao 
	 " .$where;
//	 echo $sql;
   $result = $this -> query($sql);
   
   $colunas = $camposNome;	
   $data = explode("-", $mesIni);
   $mes = (int)$data[1] ;
   $ano = $data[0];	

    if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
      while ($valor = mysqli_fetch_array($result)) {
	
        $idGrupo = $valor['idGrupo'];

    	$idIdioma = $Grupo->getIdIdioma($idGrupo);
		$nomeIdioma = $Idioma->getNome($idIdioma);
		$FME = $ClientePj->getFME($valor['clientePj_idClientePj']);
		$nomeGrupo = $valor['grupo'];
		$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($idGrupo);
		
		$horasPrograma = $valor['horasPrograma'];

// Saldo de Banco de horas
		$valorBH = $BancoHoras->bancoHorasTo($idGrupo, $idPlanoAcaoGrupo ); 

		$saldoBanco = Uteis::exibirHoras($valorBH['saldo'])." ".$valorBH['obs'];
		
		$valorVHG = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND ((dataFim is null) OR (dataFim > '".$mesFim."'))");
		$VHG = $valorVHG[0]['valorHora'];
		
		$cargaHorariaFixa = $valorVHG[0]['cargaHorariaFixaMensal'];
		
		$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
		
		$idPlanoAcao = $valor['idPlanoAcao'];
		
		$inicio = Uteis::exibirData($valorPlanoAcaoGrupo[0]['dataInicioEstagio']);
		$termino = Uteis::exibirData($valorPlanoAcaoGrupo[0]['dataPrevisaoTerminoEstagio']);
		
		//Material
		$pa = $PlanoAcao->selectPlanoAcao("WHERE idPlanoAcao=".$idPlanoAcao);
		$materialNome = "";
		if($pa[0]['kitMaterial_idKitMaterial']!="") {$KitMaterial = new KitMaterial(); }

 //INFS RECURsOS
        $temMaerial = false;
        $MaterialDidatico = new MaterialDidatico();
        $sql = "SELECT SQL_CACHE 
                distinct(MD.idMaterialDidatico), MD.editoraMaterialDidatico_idEditoraMaterialDidatico,                    MD.materialDidaticoTipo_idMaterialDidaticoTipo, 
                MD.idioma_idIdioma, MD.isbn, MD.valor, MD.opcional, 
                MD.dataCadastro, MD.obs, MD.inativo, MD.nome, MD.excluido 
                FROM materialDidatico AS MD
                INNER JOIN
                materialDidaticoINF AS MDINF ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico
                INNER JOIN
                relacionamentoINF AS R ON R.idRelacionamentoINF = MDINF.relacionamentoINF_idRelacionamentoINF
                INNER JOIN
                kitMaterialDidatico AS K2 ON idMaterialDidatico = K2.materialDidatico_idMaterialDidatico
                INNER JOIN
                planoAcao AS PA ON PA.kitMaterial_idKitMaterial = K2.kitMaterial_idKitMaterial
                AND PA.focoCurso_idFocoCurso = R.focoCurso_idFocoCurso
                AND PA.nivelEstudo_idNivelEstudo = R.nivelEstudo_idNivelEstudo
                INNER JOIN proposta AS P ON P.idProposta = PA.proposta_idProposta AND P.idioma_idIdioma = R.idioma_idIdioma
                WHERE K2.excluido = 0 AND PA.idPlanoAcao =$idPlanoAcao";
			
            $rsMaterial = Uteis::executarQuery($sql);
            if ($rsMaterial) {
                $temMaerial = true;
                foreach ($rsMaterial as $valor) {
                    $materialNome .= "<p>" . $MaterialDidatico -> montaMaterial($valor['idMaterialDidatico']) . "</p>";
                }

            }

            //MATERIAL AVULSO
            $rsMaterial = $MaterialDidatico -> selectMaterialDidatico(" WHERE idMaterialDidatico IN (
                SELECT materialDidatico_idMaterialDidatico FROM materialDidaticPlanoAcao AS M2 WHERE M2.planoAcao_idPlanoAcao = $idPlanoAcao
            )");
            if ($rsMaterial) {
                $temMaerial = true;
                foreach ($rsMaterial as $valor)
                    $materialNome .= "<p>" . $MaterialDidatico -> montaMaterial($valor['idMaterialDidatico'],false) . "</p>";
            }

            //MATERIAL MONTADO/PERSONALIZADO/APOSTILAS
            $MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();
            $rsMaterial = $MaterialMontadoPlanoAcao -> selectMaterialMontadoPlanoAcao(" WHERE planoAcao_idPlanoAcao = $idPlanoAcao");
            if ($rsMaterial) {
                $temMaerial = true;
                foreach ($rsMaterial as $valor)
                    $materialNome .= "<p>" . $valor['nome'] . " - R$ " . Uteis::formatarMoeda($valor['preco']) . "</p>";
                    $materialNome .= "<p>" . $valor['obs'] . "</p>";
            }

            if (!$temMaerial)
                $materialNome .= "<p>Não foi solicitado material.</p>";
				
		$idsPlanos = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
	
		 $valorPeriodo = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE mes = " . $mes . " AND ano = " . $ano);
 		 $idPeriodoAcompanhamentoCurso = $valorPeriodo[0]['idPeriodoAcompanhamentoCurso'];
		 
		 $rsAcomapanhamentoCurso = $AcompanhamentoCurso->selectAcompanhamentoCurso("WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ( " . $idsPlanos . ")  AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = " . $idPeriodoAcompanhamentoCurso . " AND (arquivado = 0 OR arquivado is null) ");
		 
         $idAcompanhamentoCurso = $rsAcomapanhamentoCurso[0]['idAcompanhamentoCurso'];
		 
		$idNivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo); 
		$nomeNivel = $NivelEstudo->getNome($idNivel); 	
		
		$sqlIntegrante = " WHERE FF.dataReferencia = '".$mesIni."' /*AND FF.dataReferencia <= '".$mesFim."' */ AND G.idGrupo = ".$idGrupo." AND (IG.dataSaida IS NULL OR IG.dataSaida >= '".$mesIni."')";		
		
		$valorGrupo = $Relatorio->relatorioFrequencia_mensal($sqlIntegrante);
		$valorGrupo2 = $Relatorio->relatorioFrequencia_mensal(" WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo, "", "", "", 0);
		$total = array();
		for ($x=0;$x<count($valorGrupo2);$x++) {
			$total[$valorGrupo2[$x]['idFolhaFrequencia']] = $valorGrupo2[$x]['horasRealizadasPeloGrupo'];
		}
		$x ="";
		foreach ($total as $valor3) {
			$totalAssistido += $valor3;	
		}
				
		if ($valorGrupo == '') {
			
			$mesAnt = date("Y-m-d", strtotime("-1 days", strtotime("-1 months", strtotime($mesIni))));
		
		$sqlIntegrante = " WHERE FF.dataReferencia >= '".$mesAnt."' /*AND FF.dataReferencia <= '".$mesFim."' */ AND G.idGrupo = ".$idGrupo." AND (IG.dataSaida IS NULL OR IG.dataSaida >= '".$mesIni."')";		
	//	echo $sqlIntegrante;	
		
		$valorGrupo = $Relatorio->relatorioFrequencia_mensal($sqlIntegrante);
			
		}
				
		$totalIntegrantes = count($valorGrupo);

		$cargaHorariaFixa2 = $valorGrupo[0]['horasProgramadas'];
		$NomeIntegrantes = "";
		$RegistroF = "";
		$Cc = "";
		$SubEmpresa = "";
		$frequenciaAluno = "";
		$cobrancaEmpresa = "";
		$cobrancaAlunos = "";
		$materialAluno = "";
		$totalAluno = "";
		$devolucao = "";
		$cobranca = "";
		$aceite = "";
		$funcao = "";
		$xx = 0;
		$totalDebitoAG = "";
		$totalCreditoAG = "";
		$desempenhoGeral = "";
		$totalGeralAluno = "";
		foreach($valorGrupo as $valorAluno) {
			
			$sql2 = "SELECT distinct(idAulaPermanenteGrupo) 
			FROM aulaGrupoProfessor AS AGP
			LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo AS PAG ON
			PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo
			WHERE PAG.idPlanoAcaoGrupo =" . $idPlanoAcaoGrupo ." AND AP.dataFim is null";
		$rs = $this -> query($sql2);	
		 if (mysqli_num_rows($rs) > 0) {
			while ($valors = mysqli_fetch_array($rs)) {
		$dia = $AulaPermanenteGrupo->montaDias($valors['idAulaPermanenteGrupo'])."<br>";
		$diaTmp = $AulaPermanenteGrupo->montaDias($valors['idAulaPermanenteGrupo'])."<br>";
		
		$valorProfessor = $AulaPermanenteGrupo->professorDoDia($valors['idAulaPermanenteGrupo']);
		$idProfessor = $valorProfessor[0]['professor_idProfessor'];
	
		if ($idProfessor >0) {
		$NomePro = $Professor->getNome($idProfessor)."<br>";
		}
		 	}

		 } else {
		$dia = $diaTmp;

		}
			
			if ($totalIntegrantes > 1) {
			} else {

			}
			$idClientePf = $valorAluno['idClientePf'];
			$idIntegranteGrupo = $valorAluno['idIntegranteGrupo'];
			
			$NomeIntegrantes = "<div>".$valorAluno['aluno']."</div>";
			$RegistroF = "<div>".$x.$ClientePf->getRf($idClientePf)."</div>";
			$Cc = "<div>".$x.$ClientePf->getCc($idClientePf)."</div>";
			$funcao = "<div>".$x.$ClientePf->getFuncao($idClientePf)."</div>";
			$aceite = "<div>".$x.Uteis::exibirData($ClientePf->getDataPolitica($idClientePf))."</div>";
			$email = $ClientePf->getEmail($idClientePf, 1);
			$SubEmpresa = "<div>";
			
			$IdSubEmpresa = $ClientePf->getSubEmpresa($idClientePf);
				
			if ( $IdSubEmpresa > 0 ) {
			$SubEmpresa = $x.$ClientePj->getNome($IdSubEmpresa);
			} else {
			$SubEmpresa = $x.$valorAluno['empresa'];
			}
			$SubEmpresa	.= "</div>";
			
		// Frequencia do Aluno	
			$AlunoFreq = $valorAluno['horaRealizadaAluno'];
			$EmpresaFreq = $valorAluno['horasRealizadasPeloGrupo'];
			$AlunoJust = $valorAluno['aulasJustificadas_aluno'];
			
				if ($AlunoJust > 0) {
					$AlunoFreq = $AlunoFreq + $AlunoJust;
				}

				if ($EmpresaFreq > 0 ) {
					$AlunoPer = ($AlunoFreq / $EmpresaFreq) * 100;
				} else {
					$AlunoPer = ($AlunoFreq / 1) * 100;
				}

				if ($AlunoPer > 100) {
					$AlunoPer = 100;	
	
				}
				
				if ($AlunoPer <  $FME ) {
				
				$frequenciaAluno .= "<div style=\"color:red;\">".$x. round($AlunoPer, 2)."%</div>";
					
				} else {
				
				$frequenciaAluno .= "<div>".$x. round($AlunoPer, 2)."%</div>";
				
				}
				
				//Trazendo todos os ids do IntegranteGrupo
				
			
				$valorInte = $IntegranteGrupo->selectIntegranteGrupo(" WHERE clientePf_idClientePf = ".$idClientePf. " AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$idsPlanos.")");
				
				// Média
				
				  $media1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = " . $idAcompanhamentoCurso . " AND integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mes, 1, 1, "", 1);
			
				//Valores de Cobrança
				$sql3 = "SELECT DCIG.demonstrativoCobranca_idDemonstrativoCobranca, DCIG.cursoEmpresa, DCIG.materialEmpresa, DCIG.creditoEmpresa, DCIG.debitoEmpresa, DCIG.cursoAluno, DCIG.materialAluno, DCIG.creditoAluno, DCIG.debitoAluno, DC.valCredito, DC.valDebito
				FROM demonstrativoCobrancaIntegranteGrupo AS DCIG
				INNER JOIN demonstrativoCobranca as DC on DC.idDemonstrativoCobranca = DCIG.demonstrativoCobranca_idDemonstrativoCobranca
				WHERE DC.planoAcaoGrupo_idPlanoAcaoGrupo = ".$valorAluno['idPlanoAcaoGrupo'] ." AND DC.mes = ".$valorAluno['mes'] . " AND DC.ano = ".$valorAluno['ano']." AND DCIG.integranteGrupo_idIntegranteGrupo =".$valorAluno['idIntegranteGrupo'];
    			$valorCobranca = Uteis::executarQuery($sql3);
				
				$cobrancaEmpresa = "<div>".round($valorCobranca[0]['cursoEmpresa'], 2)."</div>";
				
				$cobrancaAlunos = "<div>".round($valorCobranca[0]['cursoAluno'], 2)."</div>";
				
				$materialAluno = "<div>".round($valorCobranca[0]['materialAluno'], 2)."</div>";
				
				$SubTotalAluno = $valorCobranca[0]['cursoAluno'] + $valorCobrança[0]['materialAluno'];
				
				$totalAluno = "<div>".round($SubTotalAluno, 2)."</div>";
				
				$devolucao = "<div>".round($valorCobranca[0][''],2)."</div>";
				
				$cobranca = "<div>".round($valorCobranca[0][''], 1)."</div>";
				
				$totalCredito = $valorCobranca[0]['valCredito'];	
				$totalDebito = $valorCobranca[0]['valDebito'];
				
				if ($totalDebito != 0) {
					$totalDebitoA = $totalDebito / $totalIntegrantes;
					 
				}
				$totalDebitoAG = "<div>".round($totalDebitoA,2)."</div>";
				
				if ($totalCredito != 0) {
					$totalCreditoA = $totalCredito / $totalIntegrantes;
				}
				$totalCreditoAG = "<div>".round($totalCreditoA,2)."</div>";
				
				//Total Geral Aluno
				$totalGeralAluno = "<div>".round(($SubTotalAluno + $totalCreditoA - $totalDebitoA), 2)."</div>";
				
				if ($media1 < 7) {
				
				$desempenhoGeral = "<div style=\"color:red;\">".$x.$media1."</div>";
					
				} else {
				
				$desempenhoGeral = "<div>".$x.$media1."</div>";
				
				}
		
		//Fim Laço valorGrupo
		if ($NomeIntegrantes == '') {
			$RegistroF = "";
			$Cc = "";
			$funcao = "";
			$SubEmpresa = "";
			$aceite = "";
			
		$valorIntegrante = $IntegranteGrupo->selectIntegranteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND dataEntrada <= CURDATE() AND (dataSaida >= CURDATE() OR dataSaida IS NULL OR dataSaida = '')");
		
		foreach ($valorIntegrante as $valor2) {
			
			if (count($valorIntegrante) > 1) {

			} else {

			}
		
		$NomeIntegrantes = "<div>".$xx.$ClientePf->getNome($valor2['clientePf_idClientePf'])."</div>";
		$RegistroF = "<div>".$xx.$ClientePf->getRf($valor2['clientePf_idClientePf'])."</div>";
		$Cc = "<div>".$xx.$ClientePf->getCc($valor2['clientePf_idClientePf'])."</div>";
		$funcao = "<div>".$xx.$ClientePf->getFuncao($valor2['clientePf_idClientePf'])."</div>";
		$aceite = "<div>".$xx.Uteis::exibirData($ClientePf->getDataPolitica($valor2['clientePf_idClientePf']))."</div>";
		
		$email = $ClientePf->getEmail($idClientePf, 1);
		
		
		$SubEmpresa .= "<div>";
			
			$IdSubEmpresa = $ClientePf->getSubEmpresa($valor2['clientePf_idClientePf']);
			
			
			if ( $IdSubEmpresa > 0 ) {
			$SubEmpresa = $xx.$ClientePj->getNome($IdSubEmpresa);
			} else {
			$SubEmpresa = $xx.$valorAluno['empresa'];
			}
			$SubEmpresa	= "</div>";
			
			}
			
		}
		

		if ($campos) {
		
	    $html .= "<tr>";
		
		foreach ($campos as $campo) {
			
			if ($campo == "grupo") {
 			$html .= "<td>";
			if(!$excel) {
			$html .= "<img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$idPlanoAcaoGrupo."\",\"\" ,\"\" )'>";
			}
			$html .= $nomeGrupo."</td>";
			} elseif ($campo == "valorHora")
		$html .= "<td >" . $VHG . "</td>";	 
			elseif ($campo == "nivel")
		$html .= "<td >" . $nomeIdioma . "<br>". $nomeNivel. "</td>";	
			elseif ($campo == "horasMes") {
		$html .= "<td>";
		
			if ($cargaHorariaFixa != 0) {
		$html .= Uteis::exibirHoras($cargaHorariaFixa);
			} else {
		$html .= Uteis::exibirHoras($cargaHorariaFixa2);	
			}
		$html .= "</td>";		
		
			}
			elseif ($campo == "diasHoras") {
		$html .= "<td >" .$dia . "</td>";	
		$dia = "";
			} elseif ($campo == "professor") 
        $html .= "<td >".$NomePro . "</td>"; 
			elseif ($campo == "registroF")
		$html .= "<td >".$RegistroF."</td>";
			elseif ($campo == "aluno")
		$html .= "<td >" . $NomeIntegrantes . "</td>";
			elseif ($campo == "aceite")
		$html .= "<td >" .$aceite . "</td>";
			elseif ($campo == "email")
		$html .= "<td>".$email."</td>";	
			elseif ($campo == "nf")
		$html .= "<td >" . $SubEmpresa . "</td>";
			elseif ($campo == "frequencia")
		$html .= "<td >".$frequenciaAluno."</td>";
			elseif ($campo == "valorEmpresa")
		$html .= "<td >".$cobrancaEmpresa."</td>";
			elseif ($campo == "valorAluno")
		$html .= "<td >".$cobrancaAlunos."</td>";
			elseif ($campo == "transporte")
		$html .= "<td >".$totalCreditoAG."</td>";
			elseif ($campo == "material")
		$html .= "<td >".$materialAluno."</td>";
			elseif ($campo == "materialNome")
		$html .= "<td >".$materialNome."</td>";
			elseif ($campo == "totalAluno")
		$html .= "<td >".$totalAluno." </td>";
			elseif ($campo == "centroC")
		$html .= "<td >".$Cc."</td>";	
			elseif ($campo == "devolucao")
		$html .= "<td >".$devolucao."</td>";
			elseif ($campo == "cobranca")
		$html .= "<td >".$cobranca."</td>";
			elseif ($campo == "inicio")
		$html .= "<td >".$inicio."</td>";
			elseif ($campo == "fim")
		$html .= "<td >".$termino."</td>";
			elseif ($campo == "funcao")
		$html .= "<td >".$funcao."</td>";
			elseif ($campo == "abatimentos")
		$html .= "<td >".$totalDebitoAG."</td>";
			elseif ($campo == "desempenho")
		$html .= "<td >".$desempenhoGeral."</td>";
			elseif ($campo == "totalaluno")
		$html .= "<td >".$totalGeralAluno."</td>";
			elseif ($campo == "saldoBanco")
		$html .= "<td>".$saldoBanco."</td>";
		 	elseif ($campo == "totalModulo")
		$html .= "<td>".Uteis::exibirHoras($horasPrograma)."</td>";
			elseif ($campo == "totalAssistido")
		$html .= "<td>".Uteis::exibirHoras($totalAssistido)."</td>";
			
		}
        $html .= "</tr>";
      	}
	  }
	
      
		}
		$html .= "</tbody>";
    }

    $html_base = $Relatorio -> montaTb($colunas, $excel);

    return $html_base . $html;

  }
	
	
	 function relatorioReversaoPsa($where, $excel = false, $dataIni, $dataFim, $tipoR, $campos, $camposNome) {
	   
	   $ClientePf = new ClientePf();
	   $ClientePj = new ClientePj();
	   $TipoNota = new TipoNota(); 
	   $Professor = new Professor();
	   $NotasTipoNota = new NotasTipoNota();
	   $Grupo = new Grupo();
	   $Professor = new Professor();
	   $Relatorio = new Relatorio();
	  	   
	   $where1 .= $where." AND RPP.notasTipoNota_idNotasTipoNota in (5,6,7) ";
	   
	   // Notas baixas professores.
	   
	$sql .= " SELECT PIG.integranteGrupo_idIntegranteGrupo, IG.clientePf_idClientePf, IG.planoAcaoGrupo_idPlanoAcaoGrupo, PAG.grupo_idGrupo, GCP.clientePj_idClientePj, 	PIG.dataReferencia, RPP.psaIntegranteGrupo_idPsaIntegranteGrupo, RPP.obs, RPP.professor_idProfessor, RPP.notasTipoNota_idNotasTipoNota, PIG.desistirPsa FROM psaIntegranteGrupo AS PIG
INNER JOIN respostaPsaProfessor as RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo
INNER JOIN integranteGrupo as IG on  IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
INNER JOIN planoAcaoGrupo as PAG on PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = PAG.grupo_idGrupo
INNER JOIN grupo AS G on G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
LEFT JOIN gerenteTem as GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj
AND GT.dataExclusao is null ";

//echo $sql;
		
	$sql .= $where1;	

	// Notas baixas Regular
	
	$where2 .= $where." AND RPP.notasTipoNota_idNotasTipoNota in (5,6,7)"; 
	
	$sql2 .= " SELECT PIG.integranteGrupo_idIntegranteGrupo, IG.clientePf_idClientePf, IG.planoAcaoGrupo_idPlanoAcaoGrupo, PAG.grupo_idGrupo, GCP.clientePj_idClientePj, PIG.dataReferencia, RPP.psaIntegranteGrupo_idPsaIntegranteGrupo,  RPP.obs, PR.idPsa, PR.titulo, RPP.notasTipoNota_idNotasTipoNota, PIG.desistirPsa FROM compa184_oficial.psaIntegranteGrupo AS PIG
INNER JOIN respostaPsaRegular as RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo
INNER JOIN psaRegular as PR on PR.idPsa = RPP.psaRegular_idPsa
INNER JOIN integranteGrupo as IG on  IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
INNER JOIN planoAcaoGrupo as PAG on PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = PAG.grupo_idGrupo
INNER JOIN grupo AS G on G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
LEFT JOIN gerenteTem as GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj
AND GT.dataExclusao is null ";

	$sql2 .= $where2;	
	
//	echo $sql2;
	
	 $result = $this -> query($sql);
	 
	 $result2 = $this -> query($sql2);
		
		if (mysqli_num_rows($result) > 0) {
			
			while ($valor = mysqli_fetch_array($result)) {
				
			$onclick = " <img src=\"".CAMINHO_IMG ."\cad.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $valor['clientePf_idClientePf'] . "', '', '')\" >";
				if ($campos) {            		
					$html .= "<tr>";
						foreach ($campos as $campo) {
					if ($campo == 'data') {
					$html .= "<td>".Uteis::exibirData($valor['dataReferencia'])."</td>";
					} else if ($campo == 'aluno') {
					$html .= "<td>".$onclick.$ClientePf->getNome($valor['clientePf_idClientePf'])." <br> <img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['planoAcaoGrupo_idPlanoAcaoGrupo']."\",\"\" ,\"\" )'>".$Grupo->getNome($valor['grupo_idGrupo'])."</td>";
					} else if ($campo == 'aspecto') {
					$html .= "<td>Professor:".$Professor->getNome($valor['professor_idProfessor'])."<br><span style=\"color:red;\">".$NotasTipoNota->getNome($valor['notasTipoNota_idNotasTipoNota'])."</span></td>";
					} else if ($campo == 'revertida') {
			
			//Verificando se houve reversão Professor
					$sql3 = " SELECT PIG.integranteGrupo_idIntegranteGrupo, IG.clientePf_idClientePf, IG.planoAcaoGrupo_idPlanoAcaoGrupo, PAG.grupo_idGrupo, GCP.clientePj_idClientePj, 	PIG.dataReferencia, RPP.psaIntegranteGrupo_idPsaIntegranteGrupo, RPP.obs, RPP.professor_idProfessor, RPP.notasTipoNota_idNotasTipoNota FROM psaIntegranteGrupo AS PIG
INNER JOIN respostaPsaProfessor as RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo
INNER JOIN integranteGrupo as IG on  IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
INNER JOIN planoAcaoGrupo as PAG on PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = PAG.grupo_idGrupo
left JOIN gerenteTem as GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj
AND GT.dataExclusao is null WHERE  RPP.notasTipoNota_idNotasTipoNota IN (1, 2, 3, 4) AND GCP.clientePj_idClientePj =".$valor['clientePj_idClientePj']." AND IG.clientePf_idClientePf = ".$valor['clientePf_idClientePf']." AND date(PIG.dataReferencia) > '".$valor['dataReferencia']."' AND RPP.professor_idProfessor is not null limit 0,1";
	
		 			$result3 = $this -> query($sql3);
			
		if (mysqli_num_rows($result3) > 0) {
			$html3 = "";
			
			while ($valor3 = mysqli_fetch_array($result3)) {

			$html3 .= "<div>".Uteis::exibirData($valor3['dataReferencia'])." / Professor:".$Professor->getNome($valor3['professor_idProfessor'])." /<strong> ".$NotasTipoNota->getNome($valor3['notasTipoNota_idNotasTipoNota'])."</strong>";
			$html3 .= "<img src=\"/cursos/images/excluir.png\" title=\"Não usar essa reversão\" onclick=\"abrirNivelPagina(this, '/cursos/admin/modulos/relatorios/reversaoPsa/deleta_reversao.php?id=3593', '/cursos/admin/modulos/relatorios/reversaoPsa/', '');\" style=\"margin-right:1em;\">
			</div>";
			$desistir = "";
					}
			
				} else {
					
				$html3 = "";	
				if ($valor['desistirPsa'] == 1) {
				$u = "disabled=disabled checked=checked";	
				} else {
				$u = "";
				}
				$desistir = "<input type=\"checkbox\" $u onclick=\"desistir(".$valor['psaIntegranteGrupo_idPsaIntegranteGrupo'].",'_".$valor['professor_idProfessor']."')\"> Desistir";
				}
			
						
			$html .= "<td>".$html3."</td>";
					} else if ($campo == 'acao') {
			$html .= "<td>".$desistir."<div id=\"desistiu_".$valor['psaIntegranteGrupo_idPsaIntegranteGrupo']."_".$valor['professor_idProfessor']."\"></div></td>";
						}
					}
			$html .= "</tr>";
				}
			}
		}
		
		if (mysqli_num_rows($result2) > 0) {
			
			while ($valor2 = mysqli_fetch_array($result2)) {
				
			$onclick = " <img src=\"".CAMINHO_IMG ."\cad.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $valor2['clientePf_idClientePf'] . "', '', '')\" >";
			
			if ($campos) {
     		$html .= "<tr>";
				foreach ($campos as $campo) {
					if ($campo == 'data') {
			$html .= "<td>".Uteis::exibirData($valor2['dataReferencia'])."</td>";
					} else if ($campo == 'aluno') {
			$html .= "<td>".$onclick.$ClientePf->getNome($valor2['clientePf_idClientePf'])."  <br> <img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor2['planoAcaoGrupo_idPlanoAcaoGrupo']."\",\"\" ,\"\" )'>".$Grupo->getNome($valor2['grupo_idGrupo'])."</td>";
					} else if ($campo == 'aspecto') {
			$html .= "<td>".$valor2['titulo']."<br><span style=\"color:red;\">".$NotasTipoNota->getNome($valor2['notasTipoNota_idNotasTipoNota'])."</span></td>";
					} else if ($campo == 'revertida') {
			// Verifica se houve reversão Regular
			
		$sql4 = " SELECT PIG.integranteGrupo_idIntegranteGrupo, IG.clientePf_idClientePf, IG.planoAcaoGrupo_idPlanoAcaoGrupo, PAG.grupo_idGrupo, GCP.clientePj_idClientePj, PIG.dataReferencia, RPP.psaIntegranteGrupo_idPsaIntegranteGrupo,  RPP.obs, PR.idPsa, PR.titulo, RPP.notasTipoNota_idNotasTipoNota FROM compa184_oficial.psaIntegranteGrupo AS PIG
INNER JOIN respostaPsaRegular as RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo
INNER JOIN psaRegular as PR on PR.idPsa = RPP.psaRegular_idPsa
INNER JOIN integranteGrupo as IG on  IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
INNER JOIN planoAcaoGrupo as PAG on PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = PAG.grupo_idGrupo
left JOIN gerenteTem as GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj
AND GT.dataExclusao is null WHERE  RPP.notasTipoNota_idNotasTipoNota IN (3, 4, 14, 15, 16, 17) AND GCP.clientePj_idClientePj =".$valor2['clientePj_idClientePj']." AND IG.clientePf_idClientePf = ".$valor2['clientePf_idClientePf']." AND date(PIG.dataReferencia) > '".$valor2['dataReferencia']."' AND PR.idPsa = ".$valor2['idPsa']." limit 0,1";

 //  	 Uteis::pr( $sql4);
	
	 $result4 = $this -> query($sql4);
	 
	 			
		if (mysqli_num_rows($result4) > 0) {
			$html4 = "";
			while ($valor4 = mysqli_fetch_array($result4)) {

			$html4 .= "<div>".Uteis::exibirData($valor4['dataReferencia'])." / ".$NotasTipoNota->getNome($valor4['notasTipoNota_idNotasTipoNota'])."</strong>";
			$html4 .= "<img src=\"/cursos/images/excluir.png\" title=\"Não usar essa reversão\" onclick=\"abrirNivelPagina(this, '/cursos/admin/modulos/relatorios/reversaoPsa/deleta_reversao.php?id=3593', '/cursos/admin/modulos/relatorios/reversaoPsa/', '');\" style=\"margin-right:1em;\">
			</div>";
			$desistir = "";
					}
			
				} else {
					
				$html4 = "";
				if ($valor2['desistirPsa'] == 1) {
				$u = "disabled=disabled checked=checked";	
				} else {
				$u = "";
				}
				$desistir = "<input type=\"checkbox\" $u onclick=\"desistir(".$valor2['psaIntegranteGrupo_idPsaIntegranteGrupo'].",'_".$valor2['idPsa']."')\"> Desistir";	
				}
			
						
			$html .= "<td>".$html4."</td>";	
					} else if ($campo == 'acao') {
			$html .= "<td>".$desistir."<div id=\"desistiu_".$valor2['psaIntegranteGrupo_idPsaIntegranteGrupo']."_".$valor2['idPsa']."\"></div></td>";
					}
				}
			$html .= "</tr>";
				}
			}
		}
		
    $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $colunas);	
    return $html_base . $html;
	   
   }
   
    function relatorioPsaPendente($gerente = "", $where = "", $campos, $camposNome, $excel = false, $mostrarComentarios, $idProfessor) {
	
	$psa = new PsaIntegranteGrupo();
	$ClientePf = new ClientePf();
	$AulaGrupoProfessor = new AulaGrupoProfessor();
	$Professor = new Professor();
	$IntegranteGrupo = new IntegranteGrupo();
	$Relatorio = new Relatorio();
	$PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	$StatusCobranca = new StatusCobranca(); 
	 
	$idProfessor = (int) $idProfessor;
	$where = " WHERE 1 " . $where;
    $sql_id = "SELECT PIG.idPsaIntegranteGrupo FROM psaIntegranteGrupo AS PIG " . $where;
    $sql_corpo = " FROM integranteGrupo AS IG 
    INNER JOIN planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
	AND PAG.inativo = 0
    INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
	AND G.inativo = 0
    INNER JOIN grupoClientePj AS GCNPJ ON GCNPJ.grupo_idGrupo = G.idGrupo
    INNER JOIN gerenteTem AS GER ON GER.clientePj_idClientePj = GCNPJ.clientePj_idClientePj  AND GER.dataExclusao IS NULL
    LEFT JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf "; 
	if ($idProfessor > 0) {
		$professor .= " AND RPP.professor_idProfessor = ".$idProfessor;
	}
	$sql = "SELECT SQL_CACHE IG.idIntegranteGrupo, IG.dataEntrada, G.nome AS Grupo, G.idGrupo, CPF.nome AS nomeAluno, CPF.idClientePf, PAG.idPlanoAcaoGrupo, CPF.inativaPSA, IG.obs "
     . $sql_corpo ." ". $where. " AND IG.dataSaida is null  ".$professor." ".$gerente. " AND CPF.inativaPSA = 0";

	 $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";

      while ($valor = mysqli_fetch_array($result)) {
		  
	      $idClientePf = $valor['idClientePf'];
		  $valorI = $IntegranteGrupo->selectIntegranteGrupo(" WHERE clientePf_idClientePf = ".$idClientePf .""); 
		 		  
		  $IntegranteGrupoX = "(";
		  foreach ($valorI as $valor2) {
			  $IntegranteGrupoX .= $valor2['idIntegranteGrupo'].", ";
		  }
		  $IntegranteGrupoX .= "0)";
	 
		$idPsaIntegranteGrupo = $valor['idPsaIntegranteGrupo'];
		$dataEntrada = $valor['dataEntrada'];
		$dataInicio = date("Y-m-01");
		$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
		
		$valorProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo, $dataInicio);
		
		$nomeProfessor = $Professor->getNome($valorProfessor[0]);
		
		//Status Cobrança
		  $valorFinanceiro = $PlanoAcaoGrupoStatusCobranca->selectPlanoAcaoGrupoStatusCobranca(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." ORDER BY idPlanoAcaoGrupoStatusCobranca DESC"); 
		  
		  $idCobranca = $valorFinanceiro[0]['statusCobranca_idStatusCobranca'];
		  $mes = $valorFinanceiro[0]['mes'];
		  $ano = $valorFinanceiro[0]['ano'];
		  if  (($ano != '') || ($mes != '')) {
		  	$dataCobranca = "(01/".$mes."/".$ano.")";
		  }
		  
		  $ValorCobranca = $StatusCobranca->selectStatusCobranca(" WHERE idStatusCobranca = ".$idCobranca);
		  $statusC = $ValorCobranca[0]['status'];
		  $corStatus = $ValorCobranca[0]['cor'];
		  
		  $imgCobranca =  "<div class=\"legenda_box\" title=\"".$statusC." ".$dataCobranca."\" style=\"background-color:$corStatus\"></div>";
	//PSA
         $resp = $psa->selectPsaIntegranteGrupo(" WHERE integranteGrupo_idIntegranteGrupo in ".$IntegranteGrupoX." ORDER BY idPsaIntegranteGrupo DESC ");
				
		  $UltimaPsa = $resp[0]['dataReferencia'];
		  $envioPsa = $valorI[0]['envioPsa'];
				
				if ($UltimaPsa == '') {
					$d = strtotime($dataEntrada);
					$dias = $envioPsa;
				} else {
					$d = strtotime($UltimaPsa);
					$dias = 90;
				}

	           
               $dataReferencia = date('Y-m-d', strtotime("+".$dias ." days",$d));
			   $dataAtual = date("Y-m-d");
                 
               
                if(!$resp && (strtotime($dataReferencia)>=strtotime($dataAtual))) {
                    $cor = "style='border:2px solid #FFFF00'";
					$PsaOK = 0;
					$statusPSA = "No Prazo";
				} else {
                    if($resp[0]['finalizado']) {
                       if(strtotime($dataReferencia)>=strtotime($dataAtual)) {
                            $cor = "style='border:2px solid #006400'";
							$PsaOK = 1;
    						$statusPSA = "Finalizado";
					   } else {
                            $cor = "style='border:2px solid #FF0000'";
							$PsaOK = 0;
     						$statusPSA = "Atrasada!";	
						}
					} else {
						$cor = "style='border:2px solid #FF0000'";
						$PsaOK = 0;
						$statusPSA = "Atrasada!";
					}
				}
				
				if ($campos) {
						
              $html .= "<tr>";
			  
			  foreach ($campos as $campo) {
				  
				  if ($campo == 'grupo') {

      		  $html .= "<td>";
			  if (!$excel) {
				$html .= "  <img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$idPlanoAcaoGrupo."\",\"\" ,\"\" )'>";
			  }
              $html .= $valor['Grupo'] . $imgCobranca;
			  $html .= "</td>"; 
				  } else if ($campo == 'aluno') {
			  
			  $html .= "<td>";
			  if (!$excel) {
				  $html .= "  <img src='/cursos/images/cad.png' title='Ver Aluno' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/cadastro/clientePf/cadastro.php?id=".$idClientePf."\",\"\" ,\"\" )'>";
			  }
			  $html .= $valor['nomeAluno'] . "</td>";
				  } else if ($campo == 'dataEntrada') {
			  $html .= "<td >" . Uteis::exibirData($dataEntrada) . "</td>";
				  } else if ($campo == 'dataUltima') {	
			  $html .= "<td >" . Uteis::exibirData($UltimaPsa) . "</td>";
				  } else if ($campo == 'psa') {
              $html .= "<td align=\"center\">";
		if (!$excel) { 
		$html .= "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Pesquisa de satisfação\" ".$cor." onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "/grupo/include/resourceHTML/psa.php?idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "', '', '')\">";
		}
	          $html .= "</td>";
				  } else if ($campo == 'status') {
		      $html .= "<td>".$statusPSA."</td>";
				  } else if ($campo == 'professor') {
		      $html .= "<td >" . $nomeProfessor . "</td>";
				  } else if ($campo == 'email') {
				$valorEmails  = $ClientePf->getEmail($idClientePf);
		
    	$Emails = "";
		
		if (count($valorEmails) > 0) {
		
		$Emails = "<a href=\"mailto:".$valorEmails."\">".$valorEmails." </div>";	
		
		 $button = "<button class=\"button blue\" onclick=\"postForm('', '" . CAMINHO_RELAT . "psaPendentes/envioPsa.php', 'idIntegranteGrupo=" . $valor['idIntegranteGrupo'] . "');\"> Enviar PSA para esse aluno </button>";
	  	
		} else {
		$Emails = "Aluno não deseja receber emails ou não tem email cadastrado!";
		$button = "";
			
		}
		      $html .= "<td >" . $Emails . "</td>";
				  } else if ($campo == 'dispararEmail') {
	          $html .= "<td align=\"center\">".$button."</td>";
				  } else if ($campo == 'observacoes') {
	   
	    
	   if ($valor['obs']) {
		 $obs = "Obs.";  
	   } else {
		$obs = "";   
	   }
	   
	   $html .= "<td>".$obs." <img src='/cursos/images/editar.png' title='".$valor['obs']."' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/include/form/psaObs.php?id=".$valor['idIntegranteGrupo']."\",\"\" ,\"\" )'></td>";
				  }
	   
			  }
	   
	   $html .= "</tr>";
					}
				}
	  }
		$html .= "</body>";

	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $colunas);
    return $html_base . $html;
	 
  }
   
   function relatorioContratos() {
	   
	   $Relatorio = new Relatorio();
	   
	   $sql .= "SELECT G.nome, PAG.inativo, C.contrato as contratoPf, C.obs, C.dataCadastro as dataGrupo, CPJ.razaoSocial, C2.contrato as contratoEmpresa, C2.obs AS obsEmpresa, C2.dataCadastro as dataEmpresa FROM planoAcaoGrupo AS PAG
inner join grupo as G on PAG.grupo_idGrupo = G.idGrupo
left join contrato as C on PAG.idPlanoAcaoGrupo = C.planoAcaoGrupo_idPlanoAcaoGrupo
inner join grupoClientePj as GC on GC.grupo_idGrupo = G.idGrupo
inner join clientePj as CPJ on GC.clientePj_idClientePj = CPJ.idClientePj
left join contrato as C2 on CPJ.idClientePj = C2.clientePj_idClientePj
/*where PAG.inativo = 0 AND*/ where G.inativo = 0
order by G.nome";

  $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";

      while ($valor = mysqli_fetch_array($result)) {
		
		$nome = $valor['nome'];
		$contratoPf = $valor['contratoPf'];
		$obsPf = $valor['obs'];
		$empresa = $valor['razaoSocial'];
		$contratoPj = $valor['contratoEmpresa'];
		$dataGrupo = $valor['dataGrupo'];
		$obsEmpresa = $valor['obsEmpresa'];
		$dataEmpresa = $valor['dataEmpresa'];
		
		$html .= "<tr>";
		
		$html .= "<td>".$nome."</td>";		
		$html .= "<td>".$contratoPf."</td>";
		
		
		$html .= "<td>";
		if ($contratoPf != '') {
		$html .= "<a href=\"" . CAMINHO_UP . "arquivo/contrato/clientePj/" . $contratoPf . "\" target=\"_blank\">
						<center><img src=\"" . CAMINHO_IMG . "contrato.png\" ><center></a>";
		}
		$html .= "</td>";		
		$html .= "<td>".$ObsPf."</td>";
		$html .= "<td>".Uteis::exibirData($dataGrupo)."</td>";	
			
		$html .= "<td>".$empresa."</td>";		
		$html .= "<td>".$contratoPj."</td>";
		$html .= "<td>";
		if ($contratoPj != ''){
		$html .= "<a href=\"" . CAMINHO_UP . "arquivo/contrato/clientePj/" . $contratoPj . "\" target=\"_blank\">
						<center><img src=\"" . CAMINHO_IMG . "contrato.png\" ><center></a>";
		}
		$html .= "</td>";	
		
		$html .= "<td>".$ObsEmpresa."</td>";		
		$html .= "<td>".Uteis::exibirData($dataEmpresa)."</td>";			
		$html .= "</tr>";		
		  
	  }
	 }
	 $colunas = array("Grupo", "Contrato", "Ver Contrato", "Observação", "Data Cadastro", "Empresa", "Contrato", "Ver Contrato", "Observação", "Data Cadastro");
	 
	 $html_head = $Relatorio -> montaTb($colunas, $excel);
    return $html_head . $html;
	
	   
   }
   
    function relatorioGaCsa($where = "", $tipo, $excel = false,$mesIni, $mesFim) {
	
	$Grupo = new Grupo();
	$AulaPermanenteGrupo = new AulaPermanenteGrupo();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$FolhaFrequencia = new FolhaFrequencia();
	$OcorrenciaFF = new OcorrenciaFF();
	$Relatorio = new Relatorio();
	$CalendarioProva = new CalendarioProva();
	$Prova = new Prova();
	
	$sql = "SELECT 
    distinct(DAF.dataAula),
    DAF.horaRealizada,
    DAF.ocorrenciaFF_idOcorrenciaFF,
	G.nome,
	PAG.idPlanoAcaoGrupo,
	sum((AP5.horaFim - AP5.horaInicio))as Ptotal,
    sum((AF5.horaFim - AF5.horaInicio))as Dtotal 
FROM
    diaAulaFF AS DAF
        LEFT JOIN
    aulaPermanenteGrupo AS AP5 ON AP5.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo
        LEFT JOIN
    aulaDataFixa AS AF5 ON AF5.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa
        INNER JOIN
    planoAcaoGrupo AS PAG ON (AP5.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        OR AF5.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo) 
		INNER JOIN
	grupo as G ON PAG.grupo_idGrupo = G.idGrupo
	    INNER JOIN
	grupoClientePj AS GCP ON GCP.grupo_idGrupo = G.idGrupo
	    INNER JOIN
	gerenteTem as GER ON GER.clientePj_idClientePj = GCP.clientePj_idClientePj
	 " .$where;
	 
 //  echo $sql;	
	 
	  $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";
		
		$totalGeral = 0;
		
      while ($valor = mysqli_fetch_array($result)) {
		  $html2 = "";
		  $valorProvas = $CalendarioProva->selectCalendarioProva("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']);
		  
		  
		 foreach ($valorProvas as $valor2) {
			  
			$dataAplicacao =  $valor2['dataAplicacao'];
			
			$dataPrevistaNova = $valor2['dataPrevistaNova'];
			
			$dataPrevistaInicia = $valor2['dataPrevistaInicial'];
			
			$valorProva = $Prova->selectProva("WHERE idProva = ".$valor2['prova_idProva']);
    		$nomeProva = $valorProva[0]['nome'];
			
			$html2 .= "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Prova\" ".$cor." onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/provas.php?id=" . $valor2['idCalendarioProva'] . "', '', '')\">";
			
			$html2 .= "Prova: ".$nomeProva."<br>";
			
			if ($dataAplicacao > 0) {
				
				$html2 .= "Prova aplicada em ".Uteis::exibirData($dataAplicacao)."<br><br>";
				
			} elseif ($dataPrevistaNova >0) {
				
				$html2 .= "Nova data prevista:  ".Uteis::exibirData($dataPrevistaNova)."<br><br>";
				$html2 .= "Data prevista:  ".Uteis::exibirData($dataPrevistaInicia)."<br><br>";
				
			} else {
				$html2 .= "Data prevista:  ".Uteis::exibirData($dataPrevistaInicia)."<br><br>";
			}
				
		  }
		  
		  if ($valor['Ptotal'] == 0) {
			  $total = $valor['Dtotal'];
		  } else {
			  $total = $valor['Ptotal'];  
		  }
		  
		  $dia = $AulaPermanenteGrupo->montaDias($valor['idAulaPermanenteGrupo']);
		  
		  if ($dia == '') {
			$dia =" Aula Data Fixa";  
		  }
		  
		  $totalGeral += $total;
		  $html .= "<tr>";
		  $html .= "<td><img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['idPlanoAcaoGrupo']."\",\"\" ,\"\" )'>".$valor['nome']."</td>";
		  $html .= "<td>".$OcorrenciaFF->getSiglaOcorrencia($valor['ocorrenciaFF_idOcorrenciaFF'])."</td>";
		  $html .= "<td>".$html2."</td>";
		  $html .= "<td>".Uteis::exibirHoras($total)."</td>";
		  $html .= "</tr>";
		  
	  		}
	 	}
		
		 $colunas = array("Grupo", "Sigla Ocorrência", "Link Prova", "Total: ");
	 
	 $html_head = $Relatorio -> montaTb($colunas, $excel);
    return $html_head . $html;
		
	}
	
	function relatorioCredDeb($where = "", $excel = false, $idProfessor, $campos, $camposNome) {
		
		$Relatorio = new Relatorio();
		$Professor = new Professor();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		$Grupo = new Grupo();
		$GrupoClientePj = new GrupoClientePj();
		
	$sql = "SELECT CDG.planoAcaoGrupo_idPlanoAcaoGrupo, CDG.tipo, CDG.valor, CDG.mes, CDG.ano, CDG.obs, CDG.quem, CDG.professor_idProfessor
				FROM
    		creditoDebitoGrupo AS CDG
  

     ".$where. " AND CDG.excluido = 0";
	 
	 if ($idProfessor == '') {
		$sql .= " AND professor_idProfessor IS NULL"; 
	 }
	
//	echo $sql;
	
	 $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";
		
		$totalGeral = 0;
		
		
      while ($valor = mysqli_fetch_array($result)) {
		  
		  $idGrupo = $PlanoAcaoGrupo->getIdGrupo($valor['planoAcaoGrupo_idPlanoAcaoGrupo']);
		  $nomeGrupo = $Grupo->getNome($idGrupo);
		  
		  $nomeEmpresa = $GrupoClientePj->getNomePJ($idGrupo);
		
		$valorR = $valor['valor'];
		$totalGeral += $valorR;
		
		if ($valor['quem'] == "A") {
			$quem = "Aluno";
		} else {
			$quem = "Empresa";
		}
		
		if ($valor['tipo'] == 1) {
		$tipo = "Débito";	
		} else {
		$tipo = "Crédito";	
		}
		if ($campos) {
			$html .= "<tr>";
			 	foreach ($campos AS $campo) {
					if ($campo == 'empresa') {
			$html .= "<td>".$nomeEmpresa."</td>";
					} else if ($campo == 'grupo') {
			$html .= "<td>".$nomeGrupo."</td>";
					} else if ($campo == 'professor') {
			$html .= "<td>".$Professor->getNome($idProfessor)."</td>";
					} else if ($campo == 'ano') {
			$html .= "<td>".$valor['ano']."</td>";
					} else if ($campo == 'mes') {
			$html .= "<td>".$valor['mes']."</td>";
					} else if ($campo == 'tipo') {
			$html .= "<td>".$tipo."</td>";
					} else if ($campo == 'total') {
			$html .= "<td>".Uteis::exibirMoeda($valorR)."</td>";  
					} else if ($campo == 'quemP') {
			$html .= "<td>".$quem."</td>";  
					}
				}
		$html .= "</tr>";
			}
			
		}
		
	 }
	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $colunas);
    return $html_base . $html;
		
	}
	
	function relatorioPolitica($where = "", $excel = false) {
		
		$Relatorio = new Relatorio();
		
	$sql = "SELECT 
	distinct(CDG.idClientePf),
    CDG.nome AS nAluno,
    CDG.dataPolitica,
    CDG.politicaA,
    G.nome,
    CPJ.nomeFantasia
FROM
    clientePf AS CDG
		INNER JOIN 
	integranteGrupo AS IG on IG.clientePf_idClientePf = CDG.idClientePf
        INNER JOIN
    planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao
        INNER JOIN
    grupo AS G ON PA.grupo_idGrupo = G.idGrupo
        INNER JOIN
    grupoClientePj AS GCP ON GCP.grupo_idGrupo = G.idGrupo
        INNER JOIN
    clientePj AS CPJ ON GCP.clientePj_idClientePj = CPJ.idClientePJ
     ".$where. " AND CDG.excluido = 0 GROUP BY CDG.idClientePf ORDER BY CDG.politicaA";
	
//	echo $sql;
	
	 $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";
		
		$totalGeral = 0;
		
		
      while ($valor = mysqli_fetch_array($result)) {
		
		
		$html .= "<tr><td>".$valor['nomeFantasia']."</td>";
		$html .= "<td>".$valor['nome']."</td>";
		$html .= "<td>".$valor['nAluno']."</td>";
		$html .= "<td>".Uteis::exibirData($valor['dataPolitica'])."</td>";
		if (!$excel) {
		$html .= "<td>".Uteis::exibirStatus($valor['politicaA'])."</td>";
		} else {
			if ($valor['politicaA'] == 1) {
				$pol = "Sim";
			} else {
				$pol = "Não";
			}
				
		$html .= "<td>".$pol."</td>";	
		}
		  	}
		
	 }

	 $html_head = $Relatorio -> montaTb($colunas, $excel);
    return $html_head . $html;
		
	}
	
	function relatorioAniversariantesTr($where, $tipo, $idGerente, $excel) {
	  
	  $ClientePj = new ClientePj();
	  $ClientePf = new ClientePf();
	  $Professor = new Professor();
	  $Relatorio = new Relatorio();
	  
	  $mes = date("m");
	  $ano = date("Y");
	  
      $x= date("Y-m-d", mktime(0, 0, 0, $mes+1, 0, $ano));
	  
	  if ($tipo == 1) {
		  $sql  = "SELECT distinct(P.nome), P.idProfessor, G.nome AS grupo, P.dataNascimento  FROM professor AS P  
		 INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
		 LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
		 LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
		 INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
		 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0 
		 LEFT JOIN grupoClientePj as GCP on G.idGrupo = GCP.grupo_idGrupo
		 LEFT JOIN gerenteTem as GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj
		 ".$where." AND ((AGP.dataFim >= '".$ano."-".$mes."-01' AND AGP.dataFim <= '".$x."') or AGP.dataFim is null) ";

	  } elseif ($tipo == 3) {
		  $sql  = "SELECT distinct(P.nome), P.idProfessor, P.dataNascimento  FROM professor AS P  
		 ".$where." GROUP BY idProfessor";
		  
	  } else {
	  
	  $sql = "SELECT P.nome, P.idClientePf, P.dataNascimento, P.clientePj_idClientePj FROM clientePf AS P 
	  INNER JOIN clientePj as CPJ on CPJ.idClientePj = P.clientePj_idClientePj
	  LEFT JOIN gerenteTem as GT on GT.clientePj_idClientePj = P.clientePj_idClientePj
	  ".$where." AND GT.dataExclusao is null"; 
	  }
	  
	  if ($idGerente > 0) { 
	  
	  $sql .= " AND GT.gerente_idGerente in (".$idGerente.")";	  
	  }
	  
	  if ($tipo == 1) {
		  $sql .= " group by nome";
	  }
	  
	//  echo $sql;
	  $result = $this -> query($sql);
	  
	  while ($valor = mysqli_fetch_array($result)) {
		  if ($tipo == 1) {

		  $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $valor['idProfessor'] . "', '', '$onde')\" ";
		  } else {
		  
		  $onclick = " onclick=\"abrirNivelPagina(this, '". CAMINHO_CAD ."clientePf/cadastro.php?id=".$valor['idClientePf']."', '', 'tr')\" ";
		  }
		  
	  $html .= "<tr>";
	  $html .= "<td></td>";
	  $html .= "<td $onclick>".$valor['nome']."</td>";
	  
	  if ($tipo ==0) {
	  $nomeClientePj = $ClientePj->getNome($valor['clientePj_idClientePj']);
	  
	  $html .= "<td >".$nomeClientePj."</td>";	  
	  }
	  
	  $html .= "<td>".Uteis::exibirData($valor['dataNascimento'])."</td>";
	  
	  if (($tipo == 1) || ($tipo == 3)) {
		  
		  $emails = $Professor->getEmail($valor['idProfessor']);
	  } else {
	  
	  $emails = $ClientePf->getEmail($valor['idClientePf']);
	  }
	  
	  $html .= "<td>";
	  for ($x=0;$x<count($emails);$x++) {
	  $html .= "<div>".$emails."</div>";
	  }
	  $html .= "</td>";	  	  
	  $html .= "</tr>";
	  }
	  if  (($tipo == 1) || ($tipo == 3)) {
		$colunas = array("","Professor", "Data de Nascimento", "Email");
	  } else {
	  
	   $colunas = array("","Aluno", "Empresa", "Data de Nascimento", "Email");
	  }
    $html_base = $Relatorio -> montaTb($colunas, $excel,"",1);

    return $html_base . $html;
	
  }
  
  function relatorioSubvencao($where = "", $excel = false, $campos, $camposNome) {
		
		$Relatorio = new Relatorio();
		
	$sql = "SELECT 	CPJ.nomeFantasia, G.nome AS grupoNome, CPF.nome, SCG.subvencao, SCG.teto, SCG.quemPaga, SCG.dataInicio, SCG.dataFim   
				FROM
    		subvencaoCursoGrupo AS SCG
				INNER JOIN
			integranteGrupo AS IG on IG.idIntegranteGrupo = SCG.integranteGrupo_idIntegranteGrupo
				INNER JOIN
			clientePf AS CPF on CPF.idClientePf = IG.clientePf_idClientePf
        		INNER JOIN
    		planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        		INNER JOIN
    		planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao
        		INNER JOIN
    		grupo AS G ON PA.grupo_idGrupo = G.idGrupo
        		INNER JOIN
    		grupoClientePj AS GCP ON GCP.grupo_idGrupo = G.idGrupo
        		INNER JOIN
    		clientePj AS CPJ ON GCP.clientePj_idClientePj = CPJ.idClientePJ

     ".$where. "  ORDER BY G.nome";
	
//	echo $sql;
	
	 $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {
		
		$totalGeral = 0;
		
		
      while ($valor = mysqli_fetch_array($result)) {
		
		$valorR = $valor['valor'];
		$totalGeral += $valorR;
		
		if ($valor['quem'] == "A") {
			$quem = "Aluno";
		} else {
			$quem = "Empresa";
		}
		if ($campos) {
		
		$html .= "<tr>";
				foreach ($campos as $campo) {
					if ($campo == 'empresa') {
		$html .= "<td>".$valor['nomeFantasia']."</td>";
					} else if ($campo == 'grupo') {
		$html .= "<td>".$valor['grupoNome']."</td>";
					} else if ($campo == 'nome') {
		$html .= "<td>".$valor['nome']."</td>";
					} else if ($campo == 'dataInicio') {
    	$html .= "<td>".Uteis::exibirData($valor['dataInicio'])."</td>";
					} else if ($campo == 'dataFim') {
		$html .= "<td>".Uteis::exibirData($valor['dataFim'])."</td>";
					} else if ($campo == 'subVencao') {
	    $html .= "<td>".$valor['subvencao']."</td>";
					} else if ($campo == 'teto') {
		$html .= "<td>".$valor['teto']."</td>";  
					} else if ($campo == 'quemP') {
		$html .= "<td>".$quem."</td>";  
					}
				}
		$html .= "</tr>";
		
				
			}
	  	}
		
	 }
	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
    return $html_base . $html;
		
	}
	
	 function relatorioSubvencaoMaterial($where = "", $excel = false, $campos, $camposNome, $numero = '') {
		 
		 $html .= "<fieldset>
			       <legend>Subvenção de Material</legend>
				   </fieldset>";
		
		$Relatorio = new Relatorio();
		
	$sql = "SELECT 	CPJ.nomeFantasia,    G.nome AS grupoNome,	CPF.nome,    SCG.subvencao,    SCG.teto,    SCG.quemPaga,    SCG.dataInicio,    SCG.dataFim   
FROM
    subvencaoCursoGrupo AS SCG
		INNER JOIN
	integranteGrupo AS IG on IG.idIntegranteGrupo = SCG.integranteGrupo_idIntegranteGrupo
		INNER JOIN
	clientePf AS CPF on CPF.idClientePf = IG.clientePf_idClientePf
        INNER JOIN
    planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao
        INNER JOIN
    grupo AS G ON PA.grupo_idGrupo = G.idGrupo
        INNER JOIN
    grupoClientePj AS GCP ON GCP.grupo_idGrupo = G.idGrupo
        INNER JOIN
    clientePj AS CPJ ON GCP.clientePj_idClientePj = CPJ.idClientePJ

     ".$where. "  ORDER BY G.nome";
	
//	echo $sql;
	
	 $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";
		
		$totalGeral = 0;
		
		
      while ($valor = mysqli_fetch_array($result)) {
		
		$valorR = $valor['valor'];
		$totalGeral += $valorR;
		
		if ($valor['quem'] == "A") {
			$quem = "Aluno";
		} else {
			$quem = "Empresa";
		}
		
		$html .= "<tr><td>".$valor['nomeFantasia']."</td>";
		$html .= "<td>".$valor['grupoNome']."</td>";
		$html .= "<td>".$valor['nome']."</td>";
		$html .= "<td>".Uteis::exibirData($valor['dataInicio'])."</td>";
		$html .= "<td>".Uteis::exibirData($valor['dataFim'])."</td>";
		$html .= "<td>".$valor['subvencao']."</td>";
		$html .= "<td>".$valor['teto']."</td>";  
		$html .= "<td>".$quem."</td>";  
	  	}
		
	 }

	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head, $numero);
     return $html_base . $html;
		
	}
	
	
	function relatorioAulasPagas($idProfessor, $excel = false,$data_ini, $data_fim,$IdClientePj, $tipo, $statusG) {
		
	/*	echo $idProfessor."<br>";
		echo $data_fim."<br>";
		echo $IdClientePj."<br>";
		echo $tipo."<br>";
*/
	$DemonstrativoPagamento = new DemonstrativoPagamento();	
	$Relatorio = new Relatorio();	
	$Professor = new Professor();
	$Grupo = new Grupo();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$GrupoClientePj = new GrupoClientePj();
	
	$mes = date("m", strtotime($data_ini));
	$ano = date("Y", strtotime($data_ini));
	
//	echo $mes, $ano;
	
	$html = "<tbody>";
	
	if ($idProfessor > 0) {
	
	$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano);
	
	} else {
	// Todos os professores	
	
	$sql3 = " INNER JOIN grupo AS G on G.idGrupo = GPJ.grupo_idGrupo WHERE clientePj_idClientePj = ".$IdClientePj;
	if ($statusG != 2) {
	$sql3 .= " AND G.inativo = ".$statusG;	
		
	}
		
	$gp = $GrupoClientePj->selectGrupoClientePj($sql3);
  			
		$ids = "";
		for($i=0;$i<count($gp);$i++) {
    		$idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
			
		$Pag = $PlanoAcaoGrupo->getPAG_total($gp[$i]['grupo_idGrupo']);
		
		foreach ($Pag as $valor) {
			$ids .= $valor['idPlanoAcaoGrupo'].",";	
			}
  		}
		
		$ids .= 0;
		
		$sql = " SELECT distinct(idProfessor), nome FROM professor WHERE
			 idProfessor IN(
			SELECT DISTINCT(AGP.professor_idProfessor)
			FROM aulaGrupoProfessor AS AGP
			LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo AS PAG ON
			PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo
			WHERE PAG.idPlanoAcaoGrupo in (".$ids. ") ORDER BY nome)";
			
			$rs = Uteis::executarQuery($sql);
	        
			$arrayProf = array();
		
	for($x=0;$x<count($rs);$x++) {
		$arrayProf[$rs[$x]['idProfessor']] = $rs[$x]['nome'];
  	}
	
	foreach ($arrayProf as $key => &$val) {
// inserir função demontrativo	
//	echo $key."<br>".$val;
    }
 }
	
	  if( $rsDemonstrativoPagamento ){
		$totalGeral = 0;
		$total_horasDadas = 0;
			foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
				
				$horaRealizada = $valorDemonstrativoPagamento['horaRealizada'];
				$valorHora = $valorDemonstrativoPagamento['valorHora'];
				$diasAula = $valorDemonstrativoPagamento['diasAula'];
				$total = $valorDemonstrativoPagamento['total'];
				
				$totalGeral += $total;
				
				$total1 = ($horaRealizada/60) * $valorHora;	
				$total_horasDadas += $horaRealizada;
								
		$html .= "<tr>";
	    $html .= "<td><img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valorDemonstrativoPagamento['idPlanoAcaoGrupo']."\",\"\" ,\"\" )'>".$valorDemonstrativoPagamento['nome']."</td>";
		$html .= "<td>".$Professor->getNome($idProfessor)."</td> ";
		$html .= "<td>".Uteis::exibirHoras($horaRealizada)."</td> ";
		$html .= "<td>".Uteis::formatarMoeda($valorHora)."</td> ";
		$html .= "<td>".$diasAula ."</td> ";
		$html .= "<td>". Uteis::formatarMoeda($total1) . "</td> ";
		$html .= "<td>".$mes."</td> ";
		$html .= "<td>".$ano."</td> ";
		$html .= "</tr>";
		
			}
	  }
		$html .= "</tbody>";

	if ($tipo == 1) {
		$colunas = array("Grupo", "Professor", "Horas dadas: (".Uteis::exibirHoras($total_horasDadas).")", "Valor hora", "Dias de aula", "Valor total: (".Uteis::formatarMoeda($totalGeral).")", "Mês", "Ano");
	} else {
		$html = "<tbody>";
		$html .= "<tr>";
		$html .= "<td>".Uteis::exibirHoras($total_horasDadas)."</td>";
		$html .= "<td>".Uteis::formatarMoeda($totalGeral)."</td>";
		$html .= "</tr>";
		$html .= "</tbody>";
		
		$colunas = array("Total horas", "Valor total");
	}

	 $html_head = $Relatorio -> montaTb($colunas, $excel, '',  2);
     return $html_head . $html;
	
	}

  function relatorioFechamentoGrupo($where = "", $tipo, $excel = false, $campos, $camposNome) {
	  
	  $Relatorio = new Relatorio();

    $sql = "SELECT SQL_CACHE DISTINCT (G.idGrupo), G.nome AS nomeGrupo, I.idioma, FG.dataFechamento,
    (CASE FG.tipo WHEN 1 THEN 'Fechamento' WHEN 2 THEN 'Reversão' WHEN 3 THEN 'Pendente' ELSE '' END) AS fechamento, FG.obs  
    FROM planoAcaoGrupo AS PAG 
    INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
    INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao   
    INNER JOIN planoAcaoGrupo AS PAG2 ON PAG2.grupo_idGrupo = G.idGrupo 
    INNER JOIN planoAcao AS P2 ON P2.idPlanoAcao = PAG2.planoAcao_idPlanoAcao    
    INNER JOIN proposta AS PR ON PR.idProposta = PA.proposta_idProposta OR PR.idProposta = P2.proposta_idProposta 
    INNER JOIN idioma AS I ON I.idIdioma = PR.idioma_idIdioma 
    INNER JOIN fechamentoGrupo AS FG ON FG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo " . $where;
 //   echo $sql;
    $result = $this -> query($sql);

    if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
      while ($valor = mysqli_fetch_array($result)) {
			if ($campos) {
        $html .= "<tr>";
			foreach ($campos as $campo) {
				if ($campo == 'grupo') {
        $html .= "<td >" . $valor['nomeGrupo'] . "</td>";
				} else if ($campo == 'idioma') {
        $html .= "<td >" . $valor['idioma'] . "</td>";
				} else if ($campo == 'dataFechamento') {
        $html .= "<td >" . Uteis::exibirData($valor['dataFechamento']) . "</td>";
				} else if ($campo == 'tipo') {
        $html .= "<td >" . $valor['fechamento'] . "</td>";
				} else if ($campo == 'observacoes') {
		$html .= "<td >" . $valor['obs'] . "</td>";
				}
			}
        $html .= "</tr>";
			}
      }
      $html .= "</tbody>";
    }

  	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);

    return $html_base . $html;

  }

function relatorioPsaConsolidado($gerente = "", $where = "", $idProfessor) {
	
    $where = " AND PIG.finalizado = 1 " .$where;

    $sql_id = "SELECT PIG.idPsaIntegranteGrupo FROM psaIntegranteGrupo AS PIG WHERE " . $where;

    $sql_corpo = " FROM psaIntegranteGrupo AS PIG  
    LEFT JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
    INNER JOIN planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
    INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN grupoClientePj AS GCNPJ ON GCNPJ.grupo_idGrupo = G.idGrupo
    INNER JOIN gerenteTem AS GER ON GER.clientePj_idClientePj = GCNPJ.clientePj_idClientePj  AND GER.dataExclusao IS NULL
    INNER JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf ";
	
	
	if ($idProfessor > 0) {
		$sql_corpo .= " INNER JOIN respostaPsaProfessor AS RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo";
		$where .= " AND RPP.professor_idProfessor = ".$idProfessor;
	}
	
 $sql = "SELECT SQL_CACHE PIG.idPsaIntegranteGrupo, G.nome AS Grupo, CPF.nome AS nomeAluno, PIG.dataReferencia, CPF.idClientePf " . $sql_corpo . $where.$gerente;

     $result = $this -> query($sql);
    
    $psaProfessor = new PsaProfessor();
    $ConceitosPsa = $psaProfessor->conceitosPsaProfessor(4);
    foreach($ConceitosPsa as $k => $v){
        $retorno[$v['titulo']][$v['nome']]= 0;
    }
    
    $psaRegular = new PsaRegular();    
    $ConceitosPsa = $psaRegular->conceitosPsaRegular(4);    
    foreach($ConceitosPsa as $k => $v){
        $retorno[$v['titulo']][$v['nome']]= 0;
    }
   
    $rpsa_prof = new RespostaPsaProfessor();
    
    $rpsa_regular = new RespostaPsaRegular();
    
	while($valor = mysqli_fetch_array($result)){
    $integrante = $valor['idPsaIntegranteGrupo'];
    $periodo = $valor['dataReferencia'];    
    $rsp =  $rpsa_prof->selectPsaProfessorNota($integrante, $periodo); 
    for($i=0;$i<count($rsp);$i++){
      if($retorno[$rsp[$i]['titulo']]['total']==""){      
        $retorno[$rsp[$i]['titulo']]['total'] = 0; 
      }         
    if($retorno[$rsp[$i]['titulo']][$rsp[$i]['nome']]>=0){   
        $retorno[$rsp[$i]['titulo']][$rsp[$i]['nome']]+=1;
        $retorno[$rsp[$i]['titulo']]['total'] +=1;
        }
     }
     $rsr = $rpsa_regular->selectPsaRegularNota($integrante, $periodo);
     for($i=0;$i<count($rsr);$i++){
        if($retorno[$rsr[$i]['titulo']]['total']==""){      
        $retorno[$rsr[$i]['titulo']]['total'] = 0; 
      }  
      if($retorno[$rsr[$i]['titulo']][$rsr[$i]['nome']]>=0){   
            $retorno[$rsr[$i]['titulo']][$rsr[$i]['nome']]+=1;
            $retorno[$rsr[$i]['titulo']]['total'] +=1;
        }
     }
    
    } 
    
    return $retorno;
   }
 
  function relatorioAulasAssistidas($where, $excel = false, $campos, $camposNome, $dinicio, $dFim) {
		  $mesI = date("m", strtotime($dinicio));
		  $anoI = date("Y", strtotime($dinicio));
		  
		  $mesF = date("m", strtotime($dFim));
		  $anoF = date("Y", strtotime($dFim));
	
	//	$campos2 = $campos;
	  $Relatorio = new Relatorio();

			$sql = "SELECT SQL_CACHE idFeedbackProfessor, professor_idProfessor, anexo, obs, dataAvaliada, grupo_idGrupo, status, quemAssistiu, status2, professor_idAssistido, pergunta1, pergunta2, pergunta3, pergunta4, pergunta5, pergunta6, pergunta7, pergunta8, pergunta9, pergunta10, pergunta11, pergunta12, pergunta13, pergunta14, pergunta15 FROM feedbackProfessor " . $where;
			echo $sql;
		$result = $this -> query($sql);
		$Grupo = new Grupo();
		$Professor = new Professor();
		
	//	$NotasTipoNotas = new NotasTipoNota();

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$idsPro = "(";

			while ($valor = mysqli_fetch_array($result)) {
				
				$nomeGrupo = $Grupo->getNome($valor['grupo_idGrupo']);
				$status = $valor['status'];
				
	    		$pergunta1 = $valor['pergunta1'];
				$pergunta2 = $valor['pergunta2'];
				$pergunta3 = $valor['pergunta3'];
				$pergunta4 = $valor['pergunta4'];
				$pergunta5 = $valor['pergunta5'];
				$pergunta6 = $valor['pergunta6'];
				$pergunta7 = $valor['pergunta7'];
				$pergunta8 = $valor['pergunta8'];
				$pergunta9 = $valor['pergunta9'];
				$pergunta10 = $valor['pergunta10'];
				$pergunta11 = $valor['pergunta11'];
				$pergunta12 = $valor['pergunta12'];
				$pergunta13 = $valor['pergunta13'];
				$pergunta14 = $valor['pergunta14'];
				$pergunta15 = $valor['pergunta15'];
				
				
		
				$idProfessor = $valor['quemAssistiu'];
				$nomeProfessorAssistiu = $Professor->getNome($valor['professor_idProfessor']);
				$idsPro .= $valor['professor_idProfessor'].",";
				if (is_numeric($idProfessor)) {
					
						$nomeProfessor = "<font color=\"blue\">".$Professor->getNome($idProfessor)."</font>";
				} else {
						$nomeProfessor = $idProfessor;	
				}
				
				if ($status == 1) {
					if (!$excel) {
					$img = "<img src=\"".CAMINHO_IMG."excelente.png\" title=\" Aula excelente\" />"; } else {
						$img = "Aula Excelente";
					}
					
				} elseif ($status == 2) {
					if (!$excel) {
					$img = "<img src=\"".CAMINHO_IMG."boa.png\" title=\"Aula Boa, mas pode ser melhor\"/>"; } else {
						$img = "Aula Boa, mas pode ser melhor";
					}
					
				} elseif ($status == 3) {
					if (!$excel) {
					$img = "<img src=\"".CAMINHO_IMG."regular.png\" title=\"Aula Regular, muitos pontos a melhorar (vetar professor)\"/>"; 
					} else {
						$img = "Aula Regular, muitos pontos a melhorar (vetar professor)";
					}
					
				} elseif ($status == 4) {
					if (!$excel) {
					$img = "<img src=\"".CAMINHO_IMG."ruim.png\" title=\"Aula Ruim (vetar professor e verificar trocas)\"/>";
					} else {
						$img = "Aula Ruim (vetar professor e verificar trocas)";
					}
					
				}
				if ($campos) {

				$html .= "<tr>";
				
				foreach ($campos as $campo) {
				
				if ($campo == 'dataAula') {
	     			$html .= "<td align=\"center\" >" . Uteis::exibirData($valor['dataAvaliada']) . "</td>";
				} else if ($campo == 'grupo') {
					$html .= "<td align=\"center\"> ".$nomeGrupo."</td>";
				} else if ($campo == 'status') {
					$html .= "<td align=\"center\">".$img."</td>";
				} else if ($campo == 'nota') {
					$html .= "<td align=\"center\"> ".$valor['status2']."</td>";
				} else if ($campo == 'professorAssistido') {
					$html .= "<td align=\"center\">".$nomeProfessorAssistiu."</td>";
				} else if ($campo == 'quemAssistiu') {
					$html .= "<td align=\"center\">".$nomeProfessor."</td>";
				} else if ($campo == 'feedback') {
					$html .= "<td align=\"center\">".$valor['obs']."</td>";
				} else if ($campo == 'atencao') {
					$html .= "<td>".$pergunta1."</td>";
				} else if ($campo == 'tecnicas') {
					$html .= "<td>".$pergunta2."</td>";
				} else if ($campo == 'atitudes') {
					$html .= "<td>".$pergunta3."</td>";
				} else if ($campo == 'diferente') {
					$html .= "<td>".$pergunta4."</td>";
				} else if ($campo == 'pergunta5') {
					$html .= "<td>".$pergunta5."</td>";
				} else if ($campo == 'pergunta6') {
					$html .= "<td>".$pergunta6."</td>";
				} else if ($campo == 'pergunta7') {
					$html .= "<td>".$pergunta7."</td>";
				} else if ($campo == 'pergunta8') {
					$html .= "<td>".$pergunta8."</td>";
				} else if ($campo == 'pergunta9') {
					$html .= "<td>".$pergunta9."</td>";
				} else if ($campo == 'pergunta10') {
					$html .= "<td>".$pergunta10."</td>";
				} else if ($campo == 'pergunta11') {
					$html .= "<td>".$pergunta11."</td>";
				} else if ($campo == 'pergunta12') {
					$html .= "<td>".$pergunta12."</td>";
				} else if ($campo == 'pergunta13') {
					$html .= "<td>".$pergunta13."</td>";
				} else if ($campo == 'pergunta14') {
					$html .= "<td>".$pergunta14."</td>";
				} else if ($campo == 'pergunta15') {
					$html .= "<td>".$pergunta15."</td>";
				} 
					
					}
				
			$html .= "	</tr>";
			
				}

			}
			$idsPro .= "4)";
		//Verificando professores que poderiam ter tido aulas assistidas
		$sql = "SELECT 
    P.nome
FROM
    folhaFrequencia AS F
		INNER JOIN
	professor AS P on P.idProfessor = F.professor_idProfessor
		INNER JOIN
	planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = F.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN
	grupo AS G on G.idGrupo = PAG.grupo_idGrupo
WHERE
    F.dataReferencia between '".$anoI."-".$mesI."-01' AND '".$anoF."-".$mesF."-01'
        AND F.professor_idProfessor NOT IN".$idsPro."
		AND P.terceiro = 0
		AND G.inativo = 0
		 GROUP BY P.idProfessor
        ORDER BY P.nome";
//		echo $sql;
		$result = $this -> query($sql);
		
//		Uteis::pr($result);
		
		
		if (mysqli_num_rows($result) > 0) {

	//		$html .= "<tr><td>Professores no periodo que não tiveram aulas assistidas</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
	
			while ($valor = mysqli_fetch_array($result)) {
			
			foreach ($campos as $campo) {
			
			if ($campo == 'dataAula') {
	     			$html .= "<td align=\"center\" >Professor não teve aula assistida</td>";
				} else if ($campo == 'grupo') {
					$html .= "<td align=\"center\"> </td>";
				} else if ($campo == 'status') {
					$html .= "<td align=\"center\"></td>";
				} else if ($campo == 'nota') {
					$html .= "<td align=\"center\"> </td>";
				} else if ($campo == 'professorAssistido') {
					$html .= "<td align=\"center\">".$valor['nome']."</td>";
				} else if ($campo == 'quemAssistiu') {
					$html .= "<td align=\"center\"></td>";
				} else if ($campo == 'feedback') {
					$html .= "<td align=\"center\"></td>";
				} else if ($campo == 'atencao') {
				$html .= "<td></td>";
				} else if ($campo == 'tecnicas') {
					$html .= "<td></td>";
				} else if ($campo == 'atitudes') {
					$html .= "<td></td>";
				} else if ($campo == 'diferente') {
					$html .= "<td></td>";
				} else if ($campo == 'pergunta5') {
					$html .= "<td></td>";
				} else if ($campo == 'pergunta6') {
					$html .= "<td></td>";
				} else if ($campo == 'pergunta7') {
					$html .= "<td></td>";
				} else if ($campo == 'pergunta8') {
					$html .= "<td></td>";
				}	
		
					}
					$html .= "</tr>";
				}
			}
		}
	  
	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
     return $html_base . $html;	  
  }
   
     function relatorioValorHoraHistorico($idProfesor, $excel = false) {
	  
	  $Relatorio = new Relatorio();
	  $AulaGrupoProfessor = new AulaGrupoProfessor();
	  $AulaPermanenteGrupo = new AulaPermanenteGrupo();
	  $PlanoAcaoGrupo = new PlanoAcaoGrupo();
	  $AulaDataFixa = new AulaDataFixa();
	  
	  
	  $result = $AulaGrupoProfessor->selectAulaGrupoProfessor(" WHERE professor_idProfessor = ".$idProfesor);

			$html = "";

			foreach($result AS $valor) {
					
				$dia = $AulaPermanenteGrupo->montaDias($valor['aulaPermanenteGrupo_idAulaPermanenteGrupo']);
				
				$varPlano = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$valor['aulaPermanenteGrupo_idAulaPermanenteGrupo']);
				$idPlanoAcaoGrupo = $varPlano[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
				
				$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
				
				if ($dia == ""){
					$dia = $AulaDataFixa->montaDias($valor['aulaDataFixa_idAulaDataFixa']);
					
					$varPlano = $AulaDataFixa->selectAulaDataFixa(" AND idAulaDataFixa = ".$valor['aulaDataFixa_idAulaDataFixa']);
					$idPlanoAcaoGrupo = $varPlano[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
				
					$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
					
					
				}
	 	
	  $html .= "<tr>";
	  
	  $html .= "<td>".$nomeGrupo."</td>";
	  $html .= "<td>".$dia."</td>";
	  $html .= "<td>".Uteis::exibirData($valor['dataInicio'])."</td>";
	  $html .= "<td>".Uteis::exibirData($valor['dataFim'])."</td>";
	  $html .= "<td>".Uteis::exibirMoeda($valor['plano'])."</td>";
 
	  $html  .= "</tr>";
				}
	  
     return $html_head . $html;	  
	  
	  
	  
	 }

    function relatorioClientePj($where = "", $campos, $camposNome, $excel = false) {
		
		$Relatorio = new Relatorio();

    $where = " WHERE CPJ.excluido = 0 " . $where;

    $sql_id = "SELECT CPJ.idClientePj AS total FROM clientePj AS CPJ " . $where;

    //CARREGA DADOS SIMPLES
    $sql = "SELECT CPJ.idClientePj, CPJ.razaoSocial, CPJ.nomeFantasia, CPJ.cnpj, CPJ.inscricaoEstadual, CPJ.inativo, 
    CPJ.frequenciaMinimaExigida, CPJ.faltaJustificadaPresenca, CPJ.dataContratacao, TC.tipo AS tipoCliente
    FROM clientePj AS CPJ 
    INNER JOIN tipoCliente AS TC ON TC.idTipoCliente = CPJ.tipoCliente_idTipoCliente " . $where;
    //echo $sql;
    $result = $this -> query($sql);

    //CARREGA DADOS DE TABELAS RELACIONADAS
    $colspan = array();

    if (in_array("telefone", $campos)) {

      $Telefone = new Telefone();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idTelefone) AS total 
        FROM telefone 
        WHERE clientePj_idClientePj IN ( $sql_id )
        GROUP BY clientePj_idClientePj
      ) AS total";
      //echo $sql;
       $rs = Uteis::executarQuery($sql);
      $colspan["telefone"] = $rs[0]['total'];
    }

    if (in_array("endereco", $campos)) {

      $Endereco = new Endereco();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idEndereco) AS total 
        FROM endereco  
        WHERE excluido = 0 AND clientePj_idClientePj IN ( $sql_id )
        GROUP BY clientePj_idClientePj
      ) AS total";
      $rs = Uteis::executarQuery($sql);
      $colspan["endereco"] = $rs[0]['total'];
    }

    //CARREGA DADOS DE TABELAS RELACIONADAS DE FORMA DINAMICA (de acordo com a parametrização do sistema)
    $TipoEnderecoVirtual = new TipoEnderecoVirtual();
    $rsTipoEnderecoVirtual = $TipoEnderecoVirtual -> selectTipoEnderecoVirtual(" WHERE excluido = 0 AND inativo = 0 ");

    foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
      if (in_array($valorTipoEnderecoVirtual['tipo'], $campos)) {
        $sql = "SELECT MAX(total) AS total FROM (
          SELECT COUNT(E.idEnderecoVirtual) AS total 
          FROM contatoAdicional AS CA  
          INNER JOIN enderecoVirtual AS E ON E.contatoAdicional_idContatoAdicional = CA.idContatoAdicional
          WHERE CA.clientePj_idClientePj IN ( $sql_id ) AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'] . "
          GROUP BY CA.clientePj_idClientePj
        ) AS total";
         //echo $sql;
         $rs = Uteis::executarQuery($sql);
        $colspan[$valorTipoEnderecoVirtual['tipo']] = $rs[0]['total'];
      }
    }

    $html = "";

    if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";

      while ($valor = mysqli_fetch_array($result)) {

        $idClientePj = $valor['idClientePj'];
		
		
        if ($campos) {

          $html .= "<tr>";

          foreach ($campos as $campo) {

            if ($campo == "razaoSocial")
              $html .= "<td >" . $valor['razaoSocial'] . "</td>";
            elseif ($campo == "nomeFantasia")
              $html .= "<td >" . $valor['nomeFantasia'] . "</td>";
            elseif ($campo == "cnpj")
              $html .= "<td >" . $valor['cnpj'] . "</td>";
            elseif ($campo == "inscricaoEstadual")
              $html .= "<td >" . $valor['inscricaoEstadual'] . "</td>";
            elseif ($campo == "inativo")
              $html .= "<td >" . Uteis::exibirStatus(!$valor['inativo'], !$excel) . "</td>";
            elseif ($campo == "frequenciaMinimaExigida")
              $html .= "<td >" . Uteis::exibirMoeda($valor['frequenciaMinimaExigida']) . "</td>";
            elseif ($campo == "faltaJustificadaPresenca")
              $html .= "<td >" . Uteis::exibirStatus($valor['faltaJustificadaPresenca'], !$excel) . "</td>";
            elseif ($campo == "dataContratacao")
              $html .= "<td >" . Uteis::exibirData($valor['dataContratacao']) . "</td>";
            elseif ($campo == "tipoCliente")
              $html .= "<td >" . $valor['tipoCliente'] . "</td>";
            elseif ($campo == "telefone") {

              $sql = " SELECT idTelefone AS valor FROM telefone WHERE clientePj_idClientePj = $idClientePj ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Telefone -> getTelefone($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } elseif ($campo == "endereco") {

              $sql = " SELECT idEndereco AS valor FROM endereco WHERE clientePj_idClientePj = $idClientePj ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Endereco -> getEnderecoCompleto($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } elseif ($campo == "gruposAtivos") {

              $sql = " SELECT count(grupo_idGrupo) AS total FROM grupoClientePj AS GCPJ
INNER JOIN grupo AS G on G.idGrupo = GCPJ.grupo_idGrupo
WHERE clientePj_idClientePj = ".$idClientePj."
AND G.inativo = 0  ";
              $rs = Uteis::executarQuery($sql);
				$html .= "<td>Total: ".$rs[0]['total']."</td>";

            }
			else {

              foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
                if ($campo == $valorTipoEnderecoVirtual['tipo']) {

                  $sql = " SELECT E.valor FROM contatoAdicional AS CA  
                  INNER JOIN enderecoVirtual AS E ON E.contatoAdicional_idContatoAdicional = CA.idContatoAdicional
                  WHERE CA.clientePj_idClientePj = $idClientePj AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'];
                  $rs = Uteis::executarQuery($sql);

                  for ($i = 0; $i < $colspan[$campo]; $i++) {
                    $valorAtual = isset($rs[$i]) ? $rs[$i]['valor'] : "";
                    $html .= "<td >" . $valorAtual . "</td>";
                  }
                }
              }

            }

          }

          $html .= "</tr>";

        }

      }

      $html .= "</tbody>";

    }

    $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan);

    return $html_base . $html;

  }
  
   function relatorioDownsell($where = "", $tipo, $excel = false, $campos, $camposNome) {
	  
	  $Relatorio = new Relatorio();
	  
	$sql = "SELECT SQL_CACHE D.idDownsell, D.tipo, D.dataInicio, D.dataTermino, D.descricao, D.inativo, D.dataCadastro, D.planoAcaoGrupo_idPlanoAcaoGrupo, D.upselling, D.cargaAntiga, D.cargaNova, G.nome FROM downsell AS D 
	INNER JOIN planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
	INNER JOIN grupo AS G on G.idGrupo = PAG.grupo_idGrupo
	INNER JOIN grupoClientePj AS PR on PR.grupo_idGrupo = PAG.grupo_idGrupo 
	" . $where;
	
//	echo $sql;

    $result = $this -> query($sql);

    if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
      while ($valor = mysqli_fetch_array($result)) {
			if ($campos) {
        $html .= "<tr>";
			foreach ($campos as $campo) {
				if ($campo == 'grupo') {
          $html .= "<td><img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['planoAcaoGrupo_idPlanoAcaoGrupo']."\",\"\" ,\"\" )'>".$valor['nome']."</td>";
				} else if ($campo == 'tipo') {
					if ($valor['tipo'] == 0) {
						$tipo = "Permanente";
					} else {
						$tipo = "Temporário";
					}
					
        $html .= "<td >" . $tipo . "</td>";
				} else if ($campo == 'dataInicio') {
        $html .= "<td >" . Uteis::exibirData($valor['dataInicio']) . "</td>";
				} else if ($campo == 'dataTermino') {
        $html .= "<td >" . Uteis::exibirData($valor['dataTermino']) . "</td>";
				} else if ($campo == 'descricao') {
		$html .= "<td >" . $valor['descricao'] . "</td>";
				} else if ($campo == 'cargaAntiga') {
        $html .= "<td >" . Uteis::exibirHoras($valor['cargaAntiga']) . "</td>";
				} else if ($campo == 'cargaNova') {
        $html .= "<td >" . Uteis::exibirHoras($valor['cargaNova']) . "</td>";
				} else if ($campo == 'upselling') {
        $html .= "<td >" . Uteis::exibirStatus($valor['upselling']) . "</td>";
				} else if ($campo == 'status') {
		$html .= "<td >" . Uteis::exibirStatus($valor['status']) . "</td>";
				}
			}
        $html .= "</tr>";
			}
      }
      $html .= "</tbody>";
    }

  	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);

    return $html_base . $html;

  }
  
  function relatorioTrocaProfessor($where, $excel = false, $tipo, $campos, $camposNome){
	
	$Professor = new Professor();
	$Relatorio = new Relatorio();

     $sql = "SELECT G.nome, APG.diaSemana, AGP.dataInicio, AGP.dataFim, APG.dataFim AS dataFimAula, P.nome AS Pnome, BP.obs, P.idProfessor, PAG.idPlanoAcaoGrupo, AGP.motivo, AGP.subMotivo FROM aulaGrupoProfessor AS AGP
                INNER JOIN professor as P ON AGP.professor_idProfessor = P.idProfessor
                INNER JOIN aulaPermanenteGrupo AS APG ON APG.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN buscaProfessor AS BP ON BP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
                INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = APG.planoAcaoGrupo_idPlanoAcaoGrupo
                INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
				INNER JOIN grupoClientePj AS GCP on GCP.grupo_idGrupo = G.idGrupo
				INNER JOIN gerenteTem AS GT on GT.clientePj_idClientePj = GCP.clientePj_idClientePj
				 ".$where. "
				 group by APG.idAulaPermanenteGrupo";
		//	 echo $sql;
		
			   $result = $this -> query($sql);
			   
			   $html = "";
			    if (mysqli_num_rows($result) > 0) {
     while ($valor = mysqli_fetch_array($result)) {
		 
		 $datafimTmp = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($valor['dataFim']))));
		 
		 $sql2 = " WHERE G.inativo = 0 AND PAG.inativo = 0 AND PAG.idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." AND (AGP.dataFim is null or AGP.dataFim > '".$datafimTmp."') /*AND P.idProfessor NOT IN (".$valor['idProfessor'].")*/";
	//	 echo $sql2;
		 
		 $valorP = $Professor->selectGrupoProfTr_query($sql2); 
		 
		 $professores = "";
		 foreach ($valorP as $value) {
			 $professores .= "<div>".$Professor->getNome($value['idProfessor'])."</div>";
		 }
		 if ($value['idProfessor'] != '') {
		 if ($valor['idProfessor'] != $value['idProfessor']) {
		 
		 	if ($campos) {
		 		$html .= "<tr>";
				
				foreach ($campos as $campo) {
						if ($campo == 'grupo') {
				$html .= "<td>";
				if (!$excel) {
					$html .= "<img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['idPlanoAcaoGrupo']."\", \"\", \"\")'>".$valor['nome'];
				} 
				$html .= "</td>";
						} else if ($campo == 'professor') {
                $html .= "<td>";
				if (!$excel) {
				$html .= "<img src='/cursos/images/cad.png' title='Ver Cadastro' onclick='abrirNivelPagina(this, \"" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $valor['idProfessor'] . "\", \"\", \"\")'>".$valor['Pnome'];
				} 
				$html .= "</td>";
						} else if ($campo == 'diaSemana') {
				$html  .= "<td>".Uteis::exibirDiaSemana($valor['diaSemana'])."</td>";
						} else if ($campo == 'dataTroca') {
		 		$html .= "<td>".Uteis::exibirData($valor['dataFim'])."</td>";
						} else if ($campo == 'dataUltima') {
				$html .= "<td>".Uteis::exibirData($valor['dataFimAula'])."</td>";
						} else if ($campo == 'motivo') {
				
				$motivo = $valor['motivo'];
				
				if ($motivo == 1) {
					$motivo = "Alteração de dia / horário ";
				} elseif ($motivo == 2) {
          			$motivo = "Insatisfação Aluno ou RH ";
				} elseif ($motivo == 3) {
          			$motivo = "Professor deixou o grupo ";
				} elseif ($motivo == 4) {
          			$motivo = "Decisão CI (Coordenação) "; 
				} elseif ($motivo == 5) {
          			$motivo = "Previsto em contrato ";
				}  elseif ($motivo == 13) {
					$motivo = "Grupo fechou";
				} 
				elseif ($motivo == 0) {
					$motivo = "";
				}
					$subMotivo = $valor['subMotivo'];
				if($subMotivo == 6) {
				   $subMotivo = "Emprego CLT/ Passou em concurso";	
				} else if($valor['subMotivo'] == 7) {
				   $subMotivo = "Indisponibilidade de agenda";	
				} else if($valor['subMotivo'] == 8) {
				   $subMotivo = "Mudou de região/ cidade ";	
				} else if($valor['subMotivo'] == 9) {
				   $subMotivo = "Problemas de saúde";	
				} else if($valor['subMotivo'] == 10) {
				   $subMotivo = "Não adaptação ao método";	
				} else if($valor['subMotivo'] == 11) {
				   $subMotivo = "Pedagógico";	
				} else if($valor['subMotivo'] == 12) {
				   $subMotivo = "Comportamental";	
				} else {
					$subMotivo = "";
				}
				
				
				$html .= "<td>".$motivo."</td>"; 
				} else if ($campo == 'subMotivo') {				
				$html .= "<td>".$subMotivo."</td>";
				} else if ($campo == 'professorAtual') {
				$html .= "<td>".$professores."</td>";	
				}
					 	}
					}
				$html .= "</tr>";	 
				}
			}
		}
	}
	 $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);

    return $html_base . $html;	   
}

}