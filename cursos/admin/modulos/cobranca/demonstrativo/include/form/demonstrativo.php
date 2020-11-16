<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DemonstrativoCobranca = new DemonstrativoCobranca();
$DemonstrativoCobrancaIntegranteGrupo = new DemonstrativoCobrancaIntegranteGrupo();

$SubCursoDemonstrativoCobrancaIntegranteGrupo = new SubCursoDemonstrativoCobrancaIntegranteGrupo();
$SubMaterialDemonstrativoCobrancaIntegranteGrupo = new SubMaterialDemonstrativoCobrancaIntegranteGrupo();


$DemonstrativoCobrancaDias = new DemonstrativoCobrancaDias();
$DemonstrativoCobrancaProfessor = new DemonstrativoCobrancaProfessor();
$DemonstrativoCobrancaValorHora = new DemonstrativoCobrancaValorHora();
$DemonstrativoCobrancaAjudaCusto = new DemonstrativoCobrancaAjudaCusto();

$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$Professor = new Professor();
$FolhaFrequencia = new FolhaFrequencia();
$ValorHoraGrupo = new ValorHoraGrupo();
$CreditoDebitoGrupo = new CreditoDebitoGrupo();
$EncomendaMaterialGrupo = new EncomendaMaterialGrupo();
$EncomendaMaterialPagamentoParcela = new EncomendaMaterialPagamentoParcela();
$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();
$GrupoClientePj = new GrupoClientePj();
$PlanoAcaoGrupoAjudaCusto = new PlanoAcaoGrupoAjudaCusto();
$DiaAulaFF = new DiaAulaFF();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
//$PlanoAcao = new PlanoAcao();
//PARAM BASICOS
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$ano = $_REQUEST['ano'];
/*
if($_REQUEST['mes']<10):
    $mes = "0".$_REQUEST['mes'];
else:     */
   $mes = $_REQUEST['mes'];
//endif; 
  
$totalAlunos_material = array(); //CONTEM SUBVENÇÃO DOS ALUNOS
$totalEmpresa_material = array(); //CONTEM SUBVENÇÃO DA EMPRESA
$totalAlunos_curso = array(); //CONTEM SUBVENÇÃO DOS ALUNOS	
$totalEmpresa_curso = array(); //CONTEM SUBVENÇÃO DA EMPRESA
	
//CAREGA INFS BASICAS
$idGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = $idPlanoAcaoGrupo");
$idPlanoAcao = $idGrupo[0]['planoAcao_idPlanoAcao'];
$idGrupo = $idGrupo[0]['grupo_idGrupo'];


$dataReferencia = "$ano-$mes-01";
$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));

//NOME DO GRUPO
$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);			

//NOME DA EMPRESA
$nomeEmpresa = $GrupoClientePj->getNomePJ($idGrupo);
	
//COSULTA SE EXISTE REGISTRO
$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ";
$rsDemonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca($where);

if($rsDemonstrativo){
//GERA A PARTIR DO Q FOI GRAVADO
	$rsDemonstrativo = $rsDemonstrativo[0];
	
	//DADOS BASICOS
	$idDemonstrativoCobranca = $rsDemonstrativo['idDemonstrativoCobranca'];	
	$totalCurso = $rsDemonstrativo['valCurso'];	
	$totalMaterial = $rsDemonstrativo['valMaterial'];	
	$totalCredito = $rsDemonstrativo['valCredito'];	
	$totalDebito = $rsDemonstrativo['valDebito'];		
	$totalHoras = $rsDemonstrativo['totalHoras'];	
	$obsDem = $rsDemonstrativo['obs'];
	$dataVencimento = $rsDemonstrativo['dataVencimento'];	
	$where = " WHERE demonstrativoCobranca_idDemonstrativoCobranca = $idDemonstrativoCobranca";
	
	//DIAS	
	$cont = 0;
	$rsDemonstrativoCobrancaDias = $DemonstrativoCobrancaDias->selectDemonstrativoCobrancaDias($where);
	foreach($rsDemonstrativoCobrancaDias as $valorDemonstrativoCobrancaDias){		
		$dia = $valorDemonstrativoCobrancaDias['dia'];				
		$totalDias[$cont++] = $dia;
	}
//	echo $totalDias;
 //   echo '<hr><br>';
	//PROFS
	$cont = 0;
	$rsDemonstrativoCobrancaProfessor = $DemonstrativoCobrancaProfessor->selectDemonstrativoCobrancaProfessor($where);
	foreach($rsDemonstrativoCobrancaProfessor as $valorDemonstrativoCobrancaProfessor){		
		$idProfessor = $valorDemonstrativoCobrancaProfessor['professor_idProfessor'];		
		$rsProfessores[$cont++] = $idProfessor;		
		
	}
	
	//VALOR HORAS
	$cont = 0;
	$rsDemonstrativoCobrancaValorHora = $DemonstrativoCobrancaValorHora->selectDemonstrativoCobrancaValorHora($where);
	foreach($rsDemonstrativoCobrancaValorHora as $valorDemonstrativoCobrancaValorHora){
		
		$rsValorHoraGrupo[$cont]['valorHora'] = $valorDemonstrativoCobrancaValorHora['valor'];
		$rsValorHoraGrupo[$cont]['valorDescontoHora'] = $valorDemonstrativoCobrancaValorHora['valorDesconto'];
		$rsValorHoraGrupo[$cont]['validadeDesconto'] = $valorDemonstrativoCobrancaValorHora['validadeDesconto'];
		
		$cont++;
	}
	
	//AJUDA CUSTO
	$cont = 0;
	$rsDemonstrativoCobrancaAjudaCusto = $DemonstrativoCobrancaAjudaCusto->selectDemonstrativoCobrancaAjudaCusto($where." AND porDia = 1");
	if( $rsDemonstrativoCobrancaAjudaCusto ){
		foreach($rsDemonstrativoCobrancaAjudaCusto as $valorDemonstrativoCobrancaAjudaCusto){
				
			$rsPlanoAcaoGrupoAjudaCusto_dia[$cont]['descricao'] = $valorDemonstrativoCobrancaAjudaCusto['descricao'];
			$rsPlanoAcaoGrupoAjudaCusto_dia[$cont]['valor'] = $valorDemonstrativoCobrancaAjudaCusto['valor'];
			
			$totalAjudaCusto_dia += $valorDemonstrativoCobrancaAjudaCusto['valor'];
			$cont++;
		}
	}
	
	$cont = 0;
	$rsDemonstrativoCobrancaAjudaCusto = $DemonstrativoCobrancaAjudaCusto->selectDemonstrativoCobrancaAjudaCusto($where." AND porDia = 0");
	if( $rsDemonstrativoCobrancaAjudaCusto ){
		foreach($rsDemonstrativoCobrancaAjudaCusto as $valorDemonstrativoCobrancaAjudaCusto){
				
			$rsPlanoAcaoGrupoAjudaCusto_hora[$cont]['descricao'] = $valorDemonstrativoCobrancaAjudaCusto['descricao'];
			$rsPlanoAcaoGrupoAjudaCusto_hora[$cont]['valor'] = $valorDemonstrativoCobrancaAjudaCusto['valor'];
			
			$totalAjudaCusto_hora += $valorDemonstrativoCobrancaAjudaCusto['valor'];
			$cont++;
		}
	}
	
		
	//INTEGRANTES
	$cont = 0;
	$rsDemonstrativoCobrancaIntegranteGrupo = $DemonstrativoCobrancaIntegranteGrupo->selectDemonstrativoCobrancaIntegranteGrupo($where);
  // Uteis::pr($rsDemonstrativoCobrancaIntegranteGrupo); 
	foreach($rsDemonstrativoCobrancaIntegranteGrupo as $k => $valorDemonstrativoCobrancaIntegranteGrupo){
		
		$idDemonstrativoCobrancaIntegranteGrupo = $valorDemonstrativoCobrancaIntegranteGrupo['idDemonstrativoCobrancaIntegranteGrupo'];
		$idIntegranteGrupo = $valorDemonstrativoCobrancaIntegranteGrupo['integranteGrupo_idIntegranteGrupo'];
		
		$cursoEmpresa = $valorDemonstrativoCobrancaIntegranteGrupo['cursoEmpresa'];
		$materialEmpresa = $valorDemonstrativoCobrancaIntegranteGrupo['materialEmpresa'];
		$cursoAluno = $valorDemonstrativoCobrancaIntegranteGrupo['cursoAluno'];
		$materialAluno = $valorDemonstrativoCobrancaIntegranteGrupo['materialAluno'];
		$creditoEmpresa = $valorDemonstrativoCobrancaIntegranteGrupo['creditoEmpresa'];
		$debitoEmpresa = $valorDemonstrativoCobrancaIntegranteGrupo['debitoEmpresa'];
		$creditoAluno = $valorDemonstrativoCobrancaIntegranteGrupo['creditoAluno'];
		$debitoAluno = $valorDemonstrativoCobrancaIntegranteGrupo['debitoAluno'];
	
		//CARREGA
		$rsIntegranteGrupo[$cont]['idIntegranteGrupo'] = $idIntegranteGrupo;
		$rsIntegranteGrupo[$cont]['idDemonstrativoCobrancaIntegranteGrupo'] = $idDemonstrativoCobrancaIntegranteGrupo;
				
		$totalAlunos_curso[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
		$totalAlunos_curso[$cont]["total"] = $cursoAluno;
		
		$totalAlunos_material[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
		$totalAlunos_material[$cont]["total"] = $materialAluno;
        
        $totalAlunos_credito[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
        $totalAlunos_credito[$cont]["total"] = $creditoAluno;
        
        $totalAlunos_debito[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
        $totalAlunos_debito[$cont]["total"] = $debitoAluno;        
      	
      	//empresa
		$totalEmpresa_curso[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;		
		$totalEmpresa_curso[$cont]["total"] = $cursoEmpresa;
		
		$totalEmpresa_material[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
		$totalEmpresa_material[$cont]["total"] = $materialEmpresa;
        
        $totalEmpresa_credito[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
        $totalEmpresa_credito[$cont]["total"] = $creditoEmpresa;
        
        $totalEmpresa_debito[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
        $totalEmpresa_debito[$cont]["total"] = $debitoEmpresa;
                    
		$cont++;
		
	}

	//Uteis::pr($totalAlunos_debito);

}else{
//GERA A PARTIR DA FF E OUTROS
		
	//PROFESSORES
	$rsProfessores = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodoDemo($idPlanoAcaoGrupo, $dataReferencia);
	//Uteis::pr($rsProfessores);
		
	//ALUNOS QUE FAZEM PARTE DA FF
	$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupo_Demonstrativo($idPlanoAcaoGrupo, $dataReferencia);
	
//	Uteis::pr($rsIntegranteGrupo);
	
	//DIAS E HORAS
	$demonstrativo = 1;
	
	$arrayAulas = array();
	
	$x = 0;	
	foreach ($rsProfessores as $prof) {
	$rsTotalFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $ano, $mes, $prof, $demonstrativo);
	
   
   $arrayAulas[] = $rsTotalFF;
   $x++;
   
	}
	

	if ($x >0) {
	for($y=0;$y<=$x;$y++) {
			$rsTotalFF2[] = $arrayAulas[$y]['permanente'];
			$rsTotalFF2[] = $arrayAulas[$y]['fixa'];
	}

	$aulasNovas = array();
	foreach ($rsTotalFF2 as $value => $key) {
		foreach($key as $valor4) {
			$aulasNovas[] = $valor4;
		}
	}

	$rsTotalFF = $aulasNovas;
} else {

	$rsTotalFF = array_merge($permanente['permanente'], $permanente['fixa']);
}

	$totalDias = array();
	$totalHoras = 0;
	$totalCurso = 0;
	$totalAjudaCusto = 0;
	$totalAjudaCusto_dia = 0;
	$totalAjudaCusto_hora = 0;
								
	//AJUDA DE CUSTO
	$where = " AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo 
	AND CAST('$ano-$mes-01' AS DATE) >= CAST(CONCAT(anoIni, '-', mesIni, '-01') AS DATE)
	AND ( 
		CAST('$ano-$mes-01' AS DATE) <= CAST(CONCAT(anoFim,'-', mesFim, '-01') AS DATE) 
		OR 
		(anoFim IS NULL AND mesFim IS NULL)
	) AND cobrarAluno = 1 ";	
	
	$rsPlanoAcaoGrupoAjudaCusto_dia = $PlanoAcaoGrupoAjudaCusto->selectPlanoAcaoGrupoAjudaCusto($where." AND porDia = 1");			
    if( $rsPlanoAcaoGrupoAjudaCusto_dia ){
		foreach($rsPlanoAcaoGrupoAjudaCusto_dia as $valorAjudaCusto) $totalAjudaCusto_dia += $valorAjudaCusto['valor'];
    }
			
	$rsPlanoAcaoGrupoAjudaCusto_hora = $PlanoAcaoGrupoAjudaCusto->selectPlanoAcaoGrupoAjudaCusto($where." AND porDia = 0");	
	if( $rsPlanoAcaoGrupoAjudaCusto_hora ){									
		foreach($rsPlanoAcaoGrupoAjudaCusto_hora as $valorAjudaCusto) $totalAjudaCusto_hora += $valorAjudaCusto['valor'];
	}
	
	//VALOR HORA / CURSO							
	if( $rsTotalFF ){
		$arrDiasJaFoi = array();
  //      var_dump($rsTotalFF);
		foreach($rsTotalFF as $valorFF){
				
				$horas = $valorFF['horasTotal'];
				$dataAula = $valorFF['dataAtual'];
                $dataAulaID = $valorFF['id']; // campo: aulaPermanenteGrupo_idAulaPermanenteGrupo

                $sqlTemAI = " WHERE banco = 0 AND aulaInexistente = 1 AND dataAula = '$dataAula' ";
                $sqlTemAI .= "AND aulaPermanenteGrupo_idAulaPermanenteGrupo = $dataAulaID ";
                $sqlTemAI .= "AND folhaFrequencia_idFolhaFrequencia IN(SELECT idFolhaFrequencia FROM folhaFrequencia ";
                $sqlTemAI .= "WHERE  planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo ";
                $sqlTemAI .= "AND MONTH(dataReferencia) = $mes AND YEAR(dataReferencia) = $ano)";
				
		//		echo $sqlTemAI."<br>";

				$temAI = $DiaAulaFF->selectDiaAulaFF($sqlTemAI);
				
		//		Uteis::pr($totalDias);
		//		Uteis::pr($temAI);
				if( $temAI ) continue;

                $totalDias[] = date('d',strtotime($dataAula));
         //      Uteis::pr($totalDias);
				$totalHoras += $horas;
				
				//TOTAL DO CURSO
				$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND dataInicio <= '$dataAula' AND (dataFim >= '$dataAula' OR dataFim IS NULL OR dataFim = '')";
				
	//				echo $where;
				
				//VALOR HORA ATUAL PARA O DIA
				$rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo($where);
//				Uteis::pr($rsValorHoraGrupo);
				$valorHora = (float)$rsValorHoraGrupo[0]['valorHora'];		
//				Uteis::pr($valorHora);
//				if(!$valorHora){
//					$mensagem = "Nao existe valor hora definido para ".Uteis::exibirData($dataAula);
			//		break;		
//				}
				
				$valorDescontoHora = $rsValorHoraGrupo[0]['valorDescontoHora'];                
				$validadeDesconto = $rsValorHoraGrupo[0]['validadeDesconto'];
				
				
				
				if( $valorDescontoHora > 0 && $validadeDesconto=="" || $validadeDesconto >= $dataAula) $valorHora -= (float)$valorDescontoHora;
				
				$totalParcial = (float)($valorHora + $totalAjudaCusto_hora) * ($horas/60); 
				if( !in_array($dataAula, $arrDiasJaFoi) ){
					$arrDiasJaFoi[] = $dataAula;
					$totalParcial += $totalAjudaCusto_dia;
				}
				
				$totalCurso += $totalParcial;

				}
				
				//VALOR SUBVENCAO CURSO ATUAL PARA O DIA	
				$cont = 0;
				$totalParcial_porAluno = $totalCurso / count($rsIntegranteGrupo, 0);

				foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
					
					$idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
					$where = " WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataInicio <= '$dataAula' AND (dataFim >= '$dataAula' OR dataFim IS NULL OR dataFim = '')";
		//			echo $where;
					$rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo($where);
					
					if($rsSubvencaoCursoGrupo){
//						echo"<pre>";print_r($rsSubvencaoCursoGrupo);echo"</pre>";		
						$subvencao = ($rsSubvencaoCursoGrupo[0]['subvencao'] /100);
						$teto = $rsSubvencaoCursoGrupo[0]['teto'];
						$quemPaga = $rsSubvencaoCursoGrupo[0]['quemPaga'];
						
						$totalAlunos_curso[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
						$totalEmpresa_curso[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
						
						$totalSomar = $totalParcial_porAluno * $subvencao;
						if($teto) {
							if ($totalSomar > $teto) {
						
						$totalSomar = $teto;
						
							}
						
						}
						
						
						$diferenca = $totalParcial_porAluno - $totalSomar;
		//				echo "diferenca".$diferenca;
						//ALUNO
						if($quemPaga == "A"){
							$totalAlunos_curso[$cont]["total"] += $totalSomar;
							//diferença para o outro
							$totalEmpresa_curso[$cont]["total"] += $diferenca;	
						//EMPRESA
						}elseif($quemPaga == "E"){
							$totalEmpresa_curso[$cont]["total"] += $totalSomar;
							//diferença para o outro
							$totalAlunos_curso[$cont]["total"] += $diferenca;
						}
					}else{
						$nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo);		
						$mensagem = "Nao existe subvenção curso definida para todos os dias (".$nome.").";
				//		break;			
					}
					$cont++;		
				}				
			
		
	}
	
	//MATERIAL
	$cont = 0;	
	foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
					
		$idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];	
		
		$and = " AND IG.idIntegranteGrupo = $idIntegranteGrupo";
		$rsEncomendaMaterialGrupo = $EncomendaMaterialGrupo->selectEncomendaMaterialGrupo_parcela($idPlanoAcaoGrupo, $dataReferencia, $and);
		foreach($rsEncomendaMaterialGrupo as $valorEncomendaMaterialGrupo) {
			
			$totalMaterial_porAluno = $valorEncomendaMaterialGrupo['valor'];
			$dataReferencia_pgtMaterial = $valorEncomendaMaterialGrupo['dataReferencia'];
			
			$where = " WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataInicio <= '$dataReferencia_pgtMaterial' 
			AND (dataFim >= '$dataReferencia_pgtMaterial' OR dataFim IS NULL OR dataFim = '')";
			$rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo($where);
		
			if($rsSubvencaoMaterialGrupo){
								
				$subvencao = ($rsSubvencaoMaterialGrupo[0]['subvencao'] /100);
				$teto = $rsSubvencaoMaterialGrupo[0]['teto'];
				$quemPaga = $rsSubvencaoMaterialGrupo[0]['quemPaga'];
				//echo " $subvencao - $teto - $quemPaga";
				
				$totalAlunos_material[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
				$totalEmpresa_material[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
				
				$totalSomar = $totalMaterial_porAluno * $subvencao;
				if($teto && $totalSomar > $teto) $totalSomar = $teto;
				
				$diferenca = $totalMaterial_porAluno - $totalSomar;
				
				//ALUNO
				if($quemPaga == "A"){
					$totalAlunos_material[$cont]["total"] += $totalSomar;
					//diferença para o outro
					$totalEmpresa_material[$cont]["total"] += $diferenca;	
				//EMPRESA
				}elseif($quemPaga == "E"){
					$totalEmpresa_material[$cont]["total"] += $totalSomar;
					//diferença para o outro
					$totalAlunos_material[$cont]["total"] += $diferenca;
				}
			}else{
				$nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo);		
				$mensagem = "Nao existe subvenção de material definida para todos os dias (".$nome.").";
				break;			
			}			
		}
		$cont++;
	}
	
	
	   if($mensagem){?>
        <script>alert('<?php echo $mensagem?>');fecharNivel();</script>
        <?php exit;
    } 
    
}   //VALOR HORA
    $rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);
        
    //TOTAL MATERIAL
    $totalMaterial = 0;
    $rsMaterial = $EncomendaMaterialGrupo->selectEncomendaMaterialGrupo_parcela($idPlanoAcaoGrupo, $dataReferencia);
    foreach($rsMaterial as $valorMaterial) $totalMaterial += $valorMaterial['valor'];
       
	//TOTAL CRÉDITO (tipo 1 E)
	$totalCreditoE = 0;
	$rsCreditoE = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 1 AND quem = 'E' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
	foreach($rsCreditoE as $valorCreditoE) $totalCreditoE += $valorCreditoE['valor'];
	
	//TOTAL DÉBITO (tipo 2 E)
	$totalDebitoE = 0;
	$rsDebitoE = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 2 AND quem = 'E' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
	foreach($rsDebitoE as $valorDebitoE) $totalDebitoE += $valorDebitoE['valor'];
  
    //TOTAL CRÉDITO (tipo 1 A)
    $totalCreditoA = 0;
    $rsCreditoA = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 1 AND quem = 'A' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach($rsCreditoA as $valorCreditoA) $totalCreditoA += $valorCreditoA['valor'];
    
    //TOTAL DÉBITO (tipo 2 A)
    $totalDebitoA = 0;
    $rsDebitoA = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 2 AND quem = 'A' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach($rsDebitoA as $valorDebitoA) $totalDebitoA += $valorDebitoA['valor'];

    //TOTAL CRÉDITO (tipo 1 )
    $totalCredito = 0;
    $rsCredito = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 1 AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
	
    foreach($rsCredito as $valorCredito) $totalCredito += $valorCredito['valor'];
    
    //TOTAL DÉBITO (tipo 2)
    $totalDebito = 0;
    $rsDebito = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 2 AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach($rsDebito as $valorDebito) $totalDebito += $valorDebito['valor'];
	
	

$totalDias = array_unique($totalDias);
sort($totalDias);


$temAulaPermanenteGrupo = $AulaPermanenteGrupo -> ffTem_AulaPermanenteGrupoDemonstrativo($idPlanoAcaoGrupo, $ano, $mes);
$temAulaDataFixa = $AulaDataFixa -> ffTem_AulaDataFixaDemonstrativo($idPlanoAcaoGrupo, $ano, $mes);
//Uteis::pr($temAulaPermanenteGrupo);
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <fieldset>
  <form id="demo" onSubmit="return false" action="" method="_POST">
  
    <legend>Demonstrativo de cobrança</legend>
    <style media="all">
        #demonstrativo_geral, #demonstrativo_sub, tr,td,th{
          padding:5px;
          border:1px solid #000;
        }       
    </style>
    <div class="menu_interno">
      <?php if(!$idDemonstrativoCobranca){
		
    		$valorGrupoClientePj = $GrupoClientePj->selectGrupoClientePj(" WHERE grupo_idGrupo = ".$idGrupo);
    		$idClientePj = $valorGrupoClientePj[0]['clientePj_idClientePj'];
    		
    		$param = "&idPlanoAcaoGrupo=$idPlanoAcaoGrupo";
    		$param .= "&idClientePj=$idClientePj";
    		$param .= "&ano=$ano";
    		$param .= "&mes=$mes";
    		$param .= "&totalCredito=$totalCredito";
    		$param .= "&totalDebito=$totalDebito";
    		$param .= "&totalCurso=$totalCurso";
    		$param .= "&totalMaterial=$totalMaterial";
    		$param .= "&totalHoras=$totalHoras";
		//	$param .= "&obs=10100101";
    		
    		$cont = 0;
    		
    		$creditoEmp = $totalCreditoE/count($rsIntegranteGrupo);
    		$debEmp = $totalDebitoE/count($rsIntegranteGrupo);
            
    		$creditoAlu = $totalCreditoA/count($rsIntegranteGrupo);
    		$debAlu = $totalDebitoA/count($rsIntegranteGrupo);
            
    		foreach($rsIntegranteGrupo as $valorIntegranteGrupo){						
    			
    			$idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
    			
    			//SUB ALUNO
    			$totalCurso_sub = $totalAlunos_curso[$cont]['total'];
    			$param .= "&totalCurso_Aluno_$idIntegranteGrupo=$totalCurso_sub";			
    			
    			$totalMaterial_sub = $totalAlunos_material[$cont]['total'];							
    			$param .= "&totalMaterial_Aluno_$idIntegranteGrupo=$totalMaterial_sub";
    			
                $totalAlunos_credito = $creditoAlu;
                $param .= "&totalAlunos_credito_$idIntegranteGrupo=$totalAlunos_credito";
                 
    			$totalAlunos_debito = $debAlu;
    			$param .= "&totalAlunos_debito_$idIntegranteGrupo=$totalAlunos_debito";
                
    			//SUB EMPRESA
    			$totalCurso_sub = $totalEmpresa_curso[$cont]['total'];
    			$param .= "&totalCurso_Empresa_$idIntegranteGrupo=$totalCurso_sub";
    			
    			$totalMaterial_sub = $totalEmpresa_material[$cont]['total'];				
    			$param .= "&totalMaterial_Empresa_$idIntegranteGrupo=$totalMaterial_sub";
    			
    			$totalEmpresa_debito = $debEmp;
                $param .= "&totalEmpresa_debito_$idIntegranteGrupo=$totalEmpresa_debito";
                
                $totalEmpresa_credito = $creditoEmp;
    			$param .= "&totalEmpresa_credito_$idIntegranteGrupo=$totalEmpresa_credito";
    			
    			$cont++;
    		}?>
        
        <button class="button blue" onclick="gravaDemon()">Gravar</button>
        
      <?php }else{?>
      	
        <button class="button gray" onclick="deletaRegistro('<?php echo CAMINHO_COBRANCA."demonstrativo/include/acao/demonstrativo.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&mes=".$mes."&ano=".$ano?>', '<?php echo $idDemonstrativoCobranca?>', '<?php echo CAMINHO_COBRANCA."demonstrativo/include/form/demonstrativo.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&mes=".$mes."&ano=".$ano?>', '')">Excluir</button>

      <!--  <button class="button blue" onclick="imprimirDiv('#div_demonstrativoCobranca', 'Demonstrativo <?php echo "$mes - $ano"?>')" >Imprimir</button>-->
        <a href="https://<?php echo CAMINHO_VER_DM . 'DemostrativoEmailPdf.php?p=' . Uteis::base64_url_encode($idPlanoAcaoGrupo) . '&m=' . Uteis::base64_url_encode($mes) . '&a=' . Uteis::base64_url_encode($ano); ?>" class="button blue" target="_blank">Gerar PDF</a>
         <!--
         <button class="button blue" onclick="print1('div_demonstrativoCobranca')" >Imprimir</button>-->
      <?php }?>
      </form>
    </div>
    
    <div class="lista">
    
      <div id="div_demonstrativoCobranca" class="linha-inteira">

        <div class="linha-inteira" align="center">
        	
	        <img src="<?php echo CAMINHO_IMG."_logo.png"?>" />
       		<br />
       	<table>
       	        
          <!--demonstrativo_geral-->
           <tr>
               <td align="center">
                   <table id="demonstrativo_geral" class="tab2" width="800px">
                     <tr><th colspan="4" >COBRANÇA GERAL</th></tr>  
                     <tr>
                         <td>
                             &nbsp;<strong>Grupo</strong>: <?php echo $nomeGrupo?> <strong ><img src="<?php echo CAMINHO_IMG."pa.png"?>" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/cadastro.php?id=$idPlanoAcao"?>', '', '')" />Plano de ação</strong>
                         </td>
                         <td>
                             &nbsp;<strong>Período</strong>: <?php echo $mes?>/<?php echo $ano?>
                         </td>
                         <td>
                             &nbsp;<strong>Empresa</strong>: <?php echo $nomeEmpresa?>
                         </td>
                         <td>
                             &nbsp;<strong>Data de Vencimento</strong>: <?php echo Uteis::exibirData($dataVencimento);?>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             &nbsp;<strong>Integrantes</strong>:
                         </td>
                         <td colspan="3">
                              <div class="tab1">
                                    <?php if( $rsIntegranteGrupo ){
                                        $nomesIntegrantes = "";
                                        echo "<p><strong>";
                                        foreach($rsIntegranteGrupo as $valorIntegranteGrupo){               
                                        $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];                
                                        $nomesIntegrantes .= $IntegranteGrupo->getNomePF($idIntegranteGrupo)."<br />";
                                                    }
                                            echo substr($nomesIntegrantes, 0, -2);
                                            echo "</strong></p>";
                                     }?>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <strong>Professor(es)</strong>:
                         </td>
                         <td colspan="3">
                            <div class="tab1">
                                <?php if( $rsIntegranteGrupo ){
                                        $nomesProf = "";                                        
                                        foreach($rsProfessores as $valorProfessor) $nomesProf .= $Professor->getNome($valorProfessor)."<br />"; 
										
                                      echo substr($nomesProf, 0, -2);
                                echo "<br />";
                                }?>
                            </div>
                         </td>
                     </tr>    
                 
                     <tr>
                         <td>
                            <strong>Datas cobradas</strong>:</td> <td colspan="3"><?php echo implode(", ",$totalDias)?></td>
                         </td>
                     </tr>
                     <tr> 
                     <td>
                         <strong> Dias e Horários</strong>
                     </td>  
                         <td colspan="4">                  
                             <?php
                               foreach($temAulaPermanenteGrupo as $ap => $valor):
                             ?>
                             <strong><?=Uteis::exibirDiaSemana($valor['diaSemana']);?></strong> - <?=Uteis::exibirHoras($valor['horaInicio']);?> as <?=Uteis::exibirHoras($valor['horaFim']);?>(Permanente)<br />
                            <?php
                             endforeach;
                             ?>
                             <?php
                               foreach($temAulaDataFixa as $ad => $valor):
                                   $semana = new DateTime($valor['dataAula']);
                             ?>
                             <strong><?=Uteis::exibirDiaSemana($semana->format('N'));?></strong> - <?=Uteis::exibirHoras($valor['horaInicio']);?> as <?=Uteis::exibirHoras($valor['horaFim']);?>(Aula Agendada)<br />
                            <?php
                             endforeach;
                             ?>                             
                             </td>                         
                       </tr>
                     <tr>    
                         <td>
                            <strong>Quantidade de dias</strong>: </td><td colspan="3"><?php echo count($totalDias)?> </td>
                         </td>
                       </tr>
                     <tr>    
                         <td>
                            <strong>Horas de aula</strong>:</td> <td colspan="3"><?php echo Uteis::exibirHoras($totalHoras)?></td>
                         </td>
                     </tr>
                     <tr>
                     <tr>          
                         <td>                
                               <strong>Valor(es) hora do curso</strong>:
                         </td>
                         <td colspan = "3">      
                               <?php if($rsValorHoraGrupo){                                           
                                    foreach($rsValorHoraGrupo as $valorValorHoraGrupo){                                      
                                      $valorHora = $valorValorHoraGrupo['valorHora'];                       
                                      $valorDescontoHora = $valorValorHoraGrupo['valorDescontoHora'];
                                      $validadeDesconto = $valorValorHoraGrupo['validadeDesconto'];
                                      
                                      if( $valorDescontoHora && $validadeDesconto && $validadeDesconto >= $dataReferenciaFinal ){
                                        $obs = "&nbsp;<font color=\"#FF0000\">com desconto de R$".$valorDescontoHora." até ".Uteis::exibirData($validadeDesconto)."</font>";
                                      }else{
                                        $obs = "";
                                      }
                                      
                                      echo "R$ ".Uteis::formatarMoeda($valorHora).$obs;
                                    }}else{echo "R$ ".Uteis::formatarMoeda(0);}?>                            
                         </td> 
                   </tr>
                   <tr>  
                        <td>
                        <strong>Valor(es) acréscimo ao curso</strong>:
                        </td>                         
                        <td colspan = "3">                             
                              <?php if($rsCredito){
                               foreach($rsCredito as $valorCredito){
                                      $valor = $valorCredito['valor'];
                                      $obs = $valorCredito['obs'] ? " (".$valorCredito['obs'].")" : "";
                                      echo "R$ ".Uteis::formatarMoeda($valor).$obs;				
                                  }
                              }else{echo "R$ ".Uteis::formatarMoeda(0);}
                             ?>
                         </td>
                 </tr>
                 <tr>
                     <td>
                         <strong>Valor(es) de abatimento</strong>:
                     </td>
                     <td  colspan = "3">  
                          <?php if($rsDebito){
                                  foreach($rsDebito as $valorDebito){
                                  $valor = $valorDebito['valor'];
                                  $obs = $valorDebito['obs'] ? " (".$valorDebito['obs'].")" : "";
                                  echo "R$ ".Uteis::formatarMoeda($valor).$obs;	
                              }}else{echo "R$ ".Uteis::formatarMoeda(0);}
                              ?>
                     </td>
                  </tr>
                 <tr>
                     <td colspan = "4">
                         <strong>Taxa de transporte:</strong>: 
                        <?php if( $rsPlanoAcaoGrupoAjudaCusto_dia || $rsPlanoAcaoGrupoAjudaCusto_hora ){
                                if( $rsPlanoAcaoGrupoAjudaCusto_dia ){
                                    foreach($rsPlanoAcaoGrupoAjudaCusto_dia as $valorAjudaCusto){
										
										$totalAJ = (count($totalDias) *  $valorAjudaCusto['valor']);                      
                                            echo /*$valorAjudaCusto['descricao'].":*/ " R$ ".Uteis::formatarMoeda($valorAjudaCusto['valor'])." por dia de aula. Total de R$ ".Uteis::formatarMoeda($totalAJ)."</p>";                   
                                     }
                            }
                            if( $rsPlanoAcaoGrupoAjudaCusto_hora ){
								
						$totalAJ = ($totalHoras *  $valorAjudaCusto['valor']);                      		
                                    foreach($rsPlanoAcaoGrupoAjudaCusto_hora as $valorAjudaCusto){                      
                                        echo /*$valorAjudaCusto['descricao'].":*/ " R$ ".Uteis::formatarMoeda($valorAjudaCusto['valor'])." por hora de aula. Total de R$  " .Uteis::formatarMoeda($totalAJ)."</p>";                      
                             }
                            }
                        }else{echo "R$ ".Uteis::formatarMoeda(0);}?> 
                     </td>         
                <tr>
                    <td>
                        <strong>Sub total</strong>:
                    </td>   
                         <td colspan = "3">
                            <div class="tab1">
                              <?php if($totalCurso){?>
                              <strong>Curso</strong>: R$ <?php echo Uteis::formatarMoeda($totalCurso)?><br />
                              <?php }?>
                              <?php if($totalMaterial){?>
                              <strong>Material</strong>: R$ <?php echo Uteis::formatarMoeda($totalMaterial)?> <br />
                              <?php }?>
                              <?php if($totalCredito){?>
                              <strong>Acréscimos</strong>: R$ <?php echo Uteis::formatarMoeda($totalCredito)?><br />
                              <?php }?>
                              <?php if($totalDebito){?>
                              <strong>Abatimentos</strong>: R$ <?php echo Uteis::formatarMoeda($totalDebito)?><br />
                              <?php }?>              
                            </div>
                     </td>
                </tr>     
                <tr>
                    <td colspan = "4">
                        <strong>TOTAL:</strong>
                        <?php 
		                      $total = $totalCurso + $totalMaterial + $totalAjudaCusto + $totalCredito - $totalDebito;
		                      echo "<strong>R$ ".Uteis::formatarMoeda($total)."</strong>"
		                ?>
                    </td>
                </tr>
          </table>
       </td>
   </tr>
   <tr>
       <td align="center" colspan="4">
           <table id="demonstrativo_sub" width="100%">
                  <tr>
                      <th colspan="3"><strong>EMPRESA</strong></th>
                  </tr>
                        <?php $cont = 0;                         
                        $TDE = $totalDebitoE/count($rsIntegranteGrupo);
                        $TCE = $totalCreditoE/count($rsIntegranteGrupo); 
                                foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
                                    $txt_subvencao = "";                  
                                    $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                                    $idDemonstrativoCobrancaIntegranteGrupo = $valorIntegranteGrupo['idDemonstrativoCobrancaIntegranteGrupo'];
                                    $nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo); 
                                                                                                                                     
                             ?>
                  <tr>
                      <td colspan="3"> 
                            <!--NOME DO ALUNO-->
                            <?php 
                                echo $nome;              
                                //SUB CURSO
                             ?>
                      </td>
                   </tr>
                   <tr>
                             <?php   //print_r($totalEmpresa_curso); 
                                $totalCurso_sub = /*$totalParcial_porAluno;*/$totalEmpresa_curso[$cont]['total']; 
                                if($totalCurso_sub) {                          
                                        $and = " AND quemPaga = 'E'";                          
                                        //SUBVENÇÃO DE CURSO
                                        if(!$idDemonstrativoCobranca){                                                                             
                                            $rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                                        }else{                                                                    
                                            $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo ".$and;    
                                            $rsSubvencaoCursoGrupo = $SubCursoDemonstrativoCobrancaIntegranteGrupo->selectSubCursoDemonstrativoCobrancaIntegranteGrupo($where);
                                        }          
                                if($rsSubvencaoCursoGrupo){
                                    foreach($rsSubvencaoCursoGrupo as $valorSubvencaoCursoGrupo){                                  
                                        $subvencao = $valorSubvencaoCursoGrupo['subvencao'];
                                        $teto = $valorSubvencaoCursoGrupo['teto'];                                                        
                                        $txt_subvencao = " - subvenção de ".$subvencao."%".($teto ? " com teto de R$ ".Uteis::formatarMoeda($teto) : "").", pagos pela EMPRESA";  
                                    }
                                }              
                                }else{
                                    $txt_subvencao="";
                                }
                            ?>
                               
                                <td><strong>Curso</strong>: R$ <?php echo Uteis::formatarMoeda($totalCurso_sub).$txt_subvencao;?></td>
                            <?php                    
                            //<!--SUB MATERIAL-->
                            //print_r($totalEmpresa_material); 
                                $totalMaterial_sub = $totalEmpresa_material[$cont]['total']; 
                          if($totalMaterial_sub) {
                
                                            $and = " AND quemPaga = 'E'";
                          
                                        //SUBVENÇÃO DE CURSO
                          if(!$idDemonstrativoCobranca){
                                            $rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                          }else{                                                                    
                              $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo ".$and;    
                              $rsSubvencaoMaterialGrupo = $SubMaterialDemonstrativoCobrancaIntegranteGrupo->selectSubMaterialDemonstrativoCobrancaIntegranteGrupo($where);
                          }     
                              
                                          if($rsSubvencaoMaterialGrupo){
                                            foreach($rsSubvencaoMaterialGrupo as $valorSubvencaoMaterialGrupo){
                                                              
                                              $subvencao = $valorSubvencaoMaterialGrupo['subvencao'];
                                              $teto = $valorSubvencaoMaterialGrupo['teto']; 
                                                          
                                              $txt_subvencao = " - subvenção de ".$subvencao."%".($teto ? " com teto de R$ ".Uteis::formatarMoeda($teto) : "").", pagos pela EMPRESA";  
                                            }                   
                                          }else{
                                             $txt_subvencao="";
                                          }
                                          ?>
                          <td><strong>Material</strong>: R$ <?php echo Uteis::formatarMoeda($totalMaterial_sub).$txt_subvencao?></td>
                    <?php }
                               ?>
                  <td><strong>Acréscimo</strong>: R$ 
                  <?php
                        if($TCE) {
                            echo Uteis::formatarMoeda($TCE);
                        }else{
                           $TCE = $totalEmpresa_credito[$cont]["total"];
                            echo Uteis::formatarMoeda($TCE);
                        }                            
                    ?></td>
                    
             
                  <td>
                      <strong>Abatimento</strong>: R$ 
                      <?php if($TDE) {
                            echo Uteis::formatarMoeda($TDE);
                      }else{
                            $TDE = $totalEmpresa_debito[$cont]["total"];                         
                            echo Uteis::formatarMoeda($TDE);
                        } $cont++;
                   //  }
                      ?>
                </td>
               <tr>
                <td colspan="3" align="center"><STRONG>TOTAL: R$ <?php echo Uteis::formatarMoeda($totalCurso_sub + $TCE - $TDE) ?></STRONG></td>
               </tr>
                <?php } ?>
             <!--  </tr>-->
               <tr>  
                  <td colspan="3">
                    <strong>TOTAL:</strong>
                        <?php 
                            $totalCurso_sub = 0;
                            foreach($totalEmpresa_curso as $val) $totalCurso_sub += $val['total'];
                                $totalMaterial_sub = 0;
                            foreach($totalEmpresa_material as $val) $totalMaterial_sub += $val['total'];
                                $total_sub = $totalCurso_sub + $totalMaterial_sub + $totalCreditoE  - $totalDebitoE; //$TCE - $TDE;
                            echo "<strong>R$ ".Uteis::formatarMoeda($total_sub)."</strong>";?>
                   </td>
                </tr>                 
           </table>
      </td>
   </tr>
   <tr>
       <td align="center"><!--demonstrativo_sub_empresa-->
          <table id="demonstrativo_sub_empresa" class="tab2"  width="100%">
            <tr>
                <th colspan="3">RATEIO ENTRE ALUNOS</th>
           </tr> 
            <?php 
            $cont = 0;
            $TDA = $totalDebitoA/count($rsIntegranteGrupo);
            $TCA = $totalCreditoA/count($rsIntegranteGrupo);
            
              foreach($rsIntegranteGrupo as $valorIntegranteGrupo){
                  
                  $txt_subvencao = "";
                  
                  $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                  $idDemonstrativoCobrancaIntegranteGrupo = $valorIntegranteGrupo['idDemonstrativoCobrancaIntegranteGrupo'];
          
                  $nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
                                                                                                                    
                  ?> 
                <tr>
                    <td colspan="3">
                        <?php echo $nome?>
                    </td>
                </tr>
                <tr>
                    <?php 
                          //print_r($totalAlunos_curso); 
                          $totalCurso_sub = $totalAlunos_curso[$cont]['total']; 
                          if($totalCurso_sub) {
                              
                              $and = " AND quemPaga = 'A'";       
                              
                              //SUBVENÇÃO DE CURSO
                              if(!$idDemonstrativoCobranca){                                                                             
                                  $rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                              }else{                                                                    
                                  $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo ".$and;    
                                  $rsSubvencaoCursoGrupo = $SubCursoDemonstrativoCobrancaIntegranteGrupo->selectSubCursoDemonstrativoCobrancaIntegranteGrupo($where);
                              } 
  
                              if($rsSubvencaoCursoGrupo){
                                  foreach($rsSubvencaoCursoGrupo as $valorSubvencaoCursoGrupo){
                                      
                                      $subvencao = $valorSubvencaoCursoGrupo['subvencao'];
                                      $teto = $valorSubvencaoCursoGrupo['teto'];    
                                                              
                                      $txt_subvencao = " - subvenção de ".$subvencao."%".($teto ? " com teto de R$ ".Uteis::formatarMoeda($teto) : "").", pagos pelo ALUNO";    
                                  }
                                                  
                              }else{
                                   $txt_subvencao="";
                              }
                              ?>
                              <td><strong>Curso</strong>: R$<?php echo Uteis::formatarMoeda($totalCurso_sub).$txt_subvencao?></td>
                      <?php }?>
                         
                      <?php                 
                          $totalMaterial_sub = $totalAlunos_material[$cont]['total']; 
                          if($totalMaterial_sub) {
                              
                              $and = " AND quemPaga = 'A'";
                              
                              //SUBVENÇÃO DE MATERIAL
                              if(!$idDemonstrativoCobranca){
                                  $rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                              }else{                                                                    
                                  $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo ".$and;    
                                  $rsSubvencaoMaterialGrupo = $SubMaterialDemonstrativoCobrancaIntegranteGrupo->selectSubMaterialDemonstrativoCobrancaIntegranteGrupo($where);
                              }     
                                  
                              if($rsSubvencaoMaterialGrupo){
                                  foreach($rsSubvencaoMaterialGrupo as $valorSubvencaoMaterialGrupo){
                                                                      
                                      $subvencao = $valorSubvencaoMaterialGrupo['subvencao'];
                                      $teto = $valorSubvencaoMaterialGrupo['teto']; 
                                                              
                                      $txt_subvencao = " - subvenção de ".$subvencao."%".($teto ? " com teto de R$ ".Uteis::formatarMoeda($teto) : "").", pagos pelo ALUNO";    
                                  }                 
                              }else{
                                   $txt_subvencao="";
                              }?>
                              <td><strong>Material</strong>: R$<?php echo Uteis::formatarMoeda($totalMaterial_sub).$txt_subvencao?></td>
                      <?php } ?>
                       <td><strong>Acréscimo</strong>: R$ 
                  <?php
                        if($TCA) {
                            echo Uteis::formatarMoeda($TCA);
                        }else{
                            $TCA = $totalAlunos_credito[$cont]["total"];                        
                            echo Uteis::formatarMoeda($TCA);
                        }                            
                    ?></td>
                    
             
                  <td>
                      <strong>Abatimento</strong>: R$ 
                      <?php 
                      if($TDA) {
                            echo Uteis::formatarMoeda($TDA);
                      }else{
                          $TDA = $totalAlunos_debito[$cont]["total"];                      
                          echo Uteis::formatarMoeda($TDA);
                        } 
                      ?>
                </td>
                </tr>  
        
    <tr>
        <th colspan="3">
            <strong>TOTAL:</strong>
            <?php 
                  $totalCurso_sub = $totalAlunos_curso[$cont]['total'];                         
                  $totalMaterial_sub = $totalAlunos_material[$cont]['total'];
                  $total_sub = $totalCurso_sub + $totalMaterial_sub + $TCA - $TDA ;// $totalCreditoA - $totalDebitoA; //
                    echo "<strong>R$ ".Uteis::formatarMoeda($total_sub)."</strong>";
                  $cont++;
              ?>
        </th>
    </tr> 
    <?php }?> 
       </table>
       </td>                   
  </tr>                    
 <tr>
     <td class="validate" colspan="4">
  
        <label>Observação:</label>
     <!--   <textarea name="obs" id="obs_demostrativo" rows="6" style="width:90%"><?php echo $obsDem?></textarea> -->
      <textarea name="obsD_base" id="obsD_base" cols="100" rows="6" style="width:796px"><?php echo $obsDem?></textarea>
        <textarea name="obsD" id="obsD" ></textarea>
        <input id="upload" type="file" name="upload" style="display: none;" onchange="" />

        <?php if($idDemonstrativoCobranca) { ?>
        <button class="button blue" onclick="gravarObs()">Gravar Observação </button>
        <?php } ?>
     </td>
     
 </tr>
</div>
</fieldset>
</div>

<script>
viraEditor('obsD');

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function gravaDemon(){
	var obs = tinyMCE.activeEditor.getContent({format : 'html'});
/*	var param = '<?php echo $param?>';
	
	retorno = $.ajax({
    url:"<?php echo CAMINHO_COBRANCA."demonstrativo/include/acao/demonstrativo.php?post=1".$param?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{obs:obs,param:param}   
  });
  retorno.done(function( html ) {
//    $( "#grupo_idGrupo" ).append( html );
  });
	*/
//	alert(a);
	postForm('demo', '<?php echo CAMINHO_COBRANCA."demonstrativo/include/acao/demonstrativo.php"?>', '<?php echo $param?>' );
	await sleep(1000);
	gravarObs();
}
function gravarObs(){
	var a = tinyMCE.activeEditor.getContent({format : 'html'});
	var ano = '<?php echo $ano; ?>';
	var mes = '<?php echo $mes; ?>';
	var idPlanoAcaoGrupo = '<?php echo $idPlanoAcaoGrupo; ?>';
	if (a == '') {
		
	}  else {
	var id = '<?php echo $idDemonstrativoCobranca ?>';	
	retorno = $.ajax({
    url:"<?php echo CAMINHO_COBRANCA."demonstrativo/include/acao/demonstrativo.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{obs:a,acao:'gravaObs',idDemonstrativoCobranca:id,ano:ano,mes:mes,idPlanoAcaoGrupo:idPlanoAcaoGrupo}   
  });
  retorno.done(function( html ) {
	alert("Observação inserida com sucesso!");
  });
	}
}
</script>
<script type="text/javascript">

function print1(strid)
{
if(confirm("Do you want to print?"))
{
var values = document.getElementById(strid);
var printing =
window.open('','','left=0,top=0,width=800,height=600,toolbar=0,scrollbars=0,sta­?tus=0');
printing.document.write(values.innerHTML);
printing.document.close();
printing.focus();
printing.print();
printing.close();
}
}
</script>