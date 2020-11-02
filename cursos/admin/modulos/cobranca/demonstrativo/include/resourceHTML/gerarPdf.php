<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/mpdf60/mpdf.php");

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
$GrupoClientePj = new GrupoClientePj();
$Grupo =  new Grupo();

//PARAM BASICOS
$idClientePj = $_GET['idClientePj'];
//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$ano = $_REQUEST['ano'];
$mes = $_REQUEST['mes'];

$valor = $GrupoClientePj->selectGrupoClientePj(" INNER JOIN
    grupo as G on G.idGrupo = GPJ.grupo_idGrupo
    where clientePj_idClientePj = " . $idClientePj . "
    AND G.inativo = 0");
//Uteis::pr($valor);
?>
    <div class="conteudo_nivel">
        <?php if (!isset($_GET['pdf'])) { ?>
            <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
            <style media="all">
                #demonstrativo_geral, #demonstrativo_sub, tr, td, th {
                    padding: 5px;
                    border: 1px solid #000;
                }
            </style>
        <?php } ?>
    <fieldset>
    <legend>Demonstrativo de cobrança</legend>
    <div class="linha-inteira" align="center">
        <img src="<?php echo CAMINHO_IMG . "_logo.png" ?>"/>
        <?php if (!isset($_GET['pdf'])) {
            $abripdf = CAMINHO_COBRANCA . 'demonstrativo/include/resourceHTML/gerarPdf.php?pdf=1&idClientePj=' . $idClientePj . '&mes=' . $mes . '&ano=' . $ano;
        ?>
            <a class="button blue" target="_blank" href="<?php echo $abripdf; ?>">Gerar PDF</a>
        <?php } ?>
    </div>
    <div class="menu_interno">
    <?php
	
    foreach ($valor as $valorG) {
  
    $totalAlunos_material = array(); //CONTEM SUBVENÇÃO DOS ALUNOS
    $totalEmpresa_material = array(); //CONTEM SUBVENÇÃO DA EMPRESA
    $totalAlunos_curso = array(); //CONTEM SUBVENÇÃO DOS ALUNOS
    $totalEmpresa_curso = array(); //CONTEM SUBVENÇÃO DA EMPRESA

    //CAREGA INFS BASICAS
    $idGrupo = $valorG['grupo_idGrupo']; 
    $dataReferencia = "$ano-$mes-01";
    $dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
	
				$sql2 = "SELECT  max(PAG.idPlanoAcaoGrupo) as idPlanoAcaoGrupo
							FROM
    					planoAcao AS P
        					INNER JOIN
    					planoAcaoGrupo PAG ON P.idPlanoAcao = PAG.planoAcao_idPlanoAcao
    						AND PAG.dataInicioEstagio <= '".$dataReferenciaFinal."'
        					INNER JOIN
    					grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
							WHERE
						G.idGrupo = ".$idGrupo;
						
				$result2= Uteis::executarQuery($sql2);
	
                $idPlanoAcaoGrupo = $result2[0]['idPlanoAcaoGrupo']; 
				$todosPAG = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
				

    //NOME DO GRUPO
    $nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);

    //NOME DA EMPRESA
    $nomeEmpresa = $GrupoClientePj->getNomePJ($idGrupo);

    //COSULTA SE EXISTE REGISTRO
    $where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ($todosPAG) AND mes = $mes AND ano = $ano ";
    $rsDemonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca($where);

	if ($rsDemonstrativo) {
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
        foreach ($rsDemonstrativoCobrancaDias as $valorDemonstrativoCobrancaDias) {
            $dia = $valorDemonstrativoCobrancaDias['dia'];
            $totalDias[$cont++] = $dia;
        }

        //PROFS
        $cont = 0;
        $rsDemonstrativoCobrancaProfessor = $DemonstrativoCobrancaProfessor->selectDemonstrativoCobrancaProfessor($where);
        foreach ($rsDemonstrativoCobrancaProfessor as $valorDemonstrativoCobrancaProfessor) {
            $idProfessor = $valorDemonstrativoCobrancaProfessor['professor_idProfessor'];
            $rsProfessores[$cont++] = $idProfessor;

        }

        //VALOR HORAS
        $cont = 0;
        $rsDemonstrativoCobrancaValorHora = $DemonstrativoCobrancaValorHora->selectDemonstrativoCobrancaValorHora($where);
        foreach ($rsDemonstrativoCobrancaValorHora as $valorDemonstrativoCobrancaValorHora) {

            $rsValorHoraGrupo[$cont]['valorHora'] = $valorDemonstrativoCobrancaValorHora['valor'];
            $rsValorHoraGrupo[$cont]['valorDescontoHora'] = $valorDemonstrativoCobrancaValorHora['valorDesconto'];
            $rsValorHoraGrupo[$cont]['validadeDesconto'] = $valorDemonstrativoCobrancaValorHora['validadeDesconto'];

            $cont++;
        }

        //AJUDA CUSTO
        $cont = 0;
        $rsDemonstrativoCobrancaAjudaCusto = $DemonstrativoCobrancaAjudaCusto->selectDemonstrativoCobrancaAjudaCusto($where . " AND porDia = 1");
        if ($rsDemonstrativoCobrancaAjudaCusto) {
            foreach ($rsDemonstrativoCobrancaAjudaCusto as $valorDemonstrativoCobrancaAjudaCusto) {

                $rsPlanoAcaoGrupoAjudaCusto_dia[$cont]['descricao'] = $valorDemonstrativoCobrancaAjudaCusto['descricao'];
                $rsPlanoAcaoGrupoAjudaCusto_dia[$cont]['valor'] = $valorDemonstrativoCobrancaAjudaCusto['valor'];

                $totalAjudaCusto_dia += $valorDemonstrativoCobrancaAjudaCusto['valor'];
                $cont++;
            }
        }

        $cont = 0;
        $rsDemonstrativoCobrancaAjudaCusto = $DemonstrativoCobrancaAjudaCusto->selectDemonstrativoCobrancaAjudaCusto($where . " AND porDia = 0");
        if ($rsDemonstrativoCobrancaAjudaCusto) {
            foreach ($rsDemonstrativoCobrancaAjudaCusto as $valorDemonstrativoCobrancaAjudaCusto) {

                $rsPlanoAcaoGrupoAjudaCusto_hora[$cont]['descricao'] = $valorDemonstrativoCobrancaAjudaCusto['descricao'];
                $rsPlanoAcaoGrupoAjudaCusto_hora[$cont]['valor'] = $valorDemonstrativoCobrancaAjudaCusto['valor'];

                $totalAjudaCusto_hora += $valorDemonstrativoCobrancaAjudaCusto['valor'];
                $cont++;
            }
        }


        //INTEGRANTES
        $cont = 0;
		unset ($rsIntegranteGrupo);
        $rsDemonstrativoCobrancaIntegranteGrupo = $DemonstrativoCobrancaIntegranteGrupo->selectDemonstrativoCobrancaIntegranteGrupo($where);
        // Uteis::pr($rsDemonstrativoCobrancaIntegranteGrupo);
        foreach ($rsDemonstrativoCobrancaIntegranteGrupo as $k => $valorDemonstrativoCobrancaIntegranteGrupo) {

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
    } else {
//GERA A PARTIR DA FF E OUTROS

        //PROFESSORES
        $rsProfessores = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($idPlanoAcaoGrupo, $dataReferencia);
//	Uteis::pr($rsProfessores);

        //ALUNOS QUE FAZEM PARTE DA FF
        $rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupo_Demonstrativo($idPlanoAcaoGrupo, $dataReferencia);

        //DIAS E HORAS
        $demonstrativo = 1;
        $rsTotalFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $ano, $mes, $idProfessor, $demonstrativo);
	//    Uteis::pr($rsTotalFF);	exit;
	
        $rsTotalFF = array_merge($rsTotalFF['permanente'], $rsTotalFF['fixa']);


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

        $rsPlanoAcaoGrupoAjudaCusto_dia = $PlanoAcaoGrupoAjudaCusto->selectPlanoAcaoGrupoAjudaCusto($where . " AND porDia = 1");
        if ($rsPlanoAcaoGrupoAjudaCusto_dia) {
            foreach ($rsPlanoAcaoGrupoAjudaCusto_dia as $valorAjudaCusto) $totalAjudaCusto_dia += $valorAjudaCusto['valor'];
        }

        $rsPlanoAcaoGrupoAjudaCusto_hora = $PlanoAcaoGrupoAjudaCusto->selectPlanoAcaoGrupoAjudaCusto($where . " AND porDia = 0");
        if ($rsPlanoAcaoGrupoAjudaCusto_hora) {
            foreach ($rsPlanoAcaoGrupoAjudaCusto_hora as $valorAjudaCusto) $totalAjudaCusto_hora += $valorAjudaCusto['valor'];
        }

        //VALOR HORA / CURSO
        if ($rsTotalFF) {
            $arrDiasJaFoi = array();
            foreach ($rsTotalFF as $valorFF) {

                $horas = $valorFF['horasTotal'];
                $dataAula = $valorFF['dataAtual'];
				
				$where = " WHERE banco = 0 AND aulaInexistente = 1 AND dataAula = '$dataAula' AND folhaFrequencia_idFolhaFrequencia IN(
					SELECT idFolhaFrequencia FROM folhaFrequencia 
					WHERE  planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND MONTH(dataReferencia) = $mes AND YEAR(dataReferencia) = $ano
				)";
				
				//echo $where;
				
                $temAI = $DiaAulaFF->selectDiaAulaFF($where);
				
				
                //echo $temAI;
                if ($temAI) continue;

                $totalDias[] = date('d', strtotime($dataAula));
                //              Uteis::pr($totalDias);
                $totalHoras += $horas;

                //TOTAL DO CURSO
                $where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND dataInicio <= '$dataAula' AND (dataFim >= '$dataAula' OR dataFim IS NULL OR dataFim = '')";

  //             	echo $where;

                //VALOR HORA ATUAL PARA O DIA
                $rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo($where);
                $valorHora = (float)$rsValorHoraGrupo[0]['valorHora'];
//				echo $valorHora;
				
/*				if ($valorHora == 0) {
					
				} else {
				
				
                if (!$valorHora) {
                    $mensagem = "Nao existe valor hora definido para " . Uteis::exibirData($dataAula)." Grupo:".$Grupo->getNome($idGrupo);
             //       break;
                	}
				}
*/
                $valorDescontoHora = $rsValorHoraGrupo[0]['valorDescontoHora'];
                $validadeDesconto = $rsValorHoraGrupo[0]['validadeDesconto'];


                if ($valorDescontoHora > 0 && $validadeDesconto == "" || $validadeDesconto >= $dataAula) $valorHora -= (float)$valorDescontoHora;

                $totalParcial = (float)($valorHora + $totalAjudaCusto_hora) * ($horas / 60);
                if (!in_array($dataAula, $arrDiasJaFoi)) {
                    $arrDiasJaFoi[] = $dataAula;
                    $totalParcial += $totalAjudaCusto_dia;
                }

                $totalCurso += $totalParcial;
            }

            //VALOR SUBVENCAO CURSO ATUAL PARA O DIA
            $cont = 0;
            $totalParcial_porAluno = $totalCurso / count($rsIntegranteGrupo, 0);

            //		Uteis::pr($totalParcial_porAluno);

            foreach ($rsIntegranteGrupo as $valorIntegranteGrupo) {

                $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                $where = " WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataInicio <= '$dataAula' AND (dataFim >= '$dataAula' OR dataFim IS NULL OR dataFim = '')";
                $rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo($where);

                if ($rsSubvencaoCursoGrupo) {
                    //echo"<pre>";print_r($rsSubvencaoCursoGrupo);echo"</pre>";
                    $subvencao = ($rsSubvencaoCursoGrupo[0]['subvencao'] / 100);
                    $teto = $rsSubvencaoCursoGrupo[0]['teto'];
                    $quemPaga = $rsSubvencaoCursoGrupo[0]['quemPaga'];

                    $totalAlunos_curso[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
                    $totalEmpresa_curso[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;

                    $totalSomar = $totalParcial_porAluno * $subvencao;
                    if ($teto) $totalSomar = $teto;

                    $diferenca = $totalParcial_porAluno - $totalSomar;

                    //ALUNO
                    if ($quemPaga == "A") {
                        $totalAlunos_curso[$cont]["total"] += $totalSomar;
                        //diferença para o outro
                        $totalEmpresa_curso[$cont]["total"] += $diferenca;
                        //EMPRESA
                    } elseif ($quemPaga == "E") {
                        $totalEmpresa_curso[$cont]["total"] += $totalSomar;
                        //diferença para o outro
                        $totalAlunos_curso[$cont]["total"] += $diferenca;
                    }
                } else {
                    $nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
                    $mensagem = "Nao existe subvenção curso definida para todos os dias (" . $nome . ") Grupo: ".$nomeGrupo;
                    //		break;
                }
                $cont++;
            }


        }

        //MATERIAL
        $cont = 0;
        foreach ($rsIntegranteGrupo as $valorIntegranteGrupo) {

            $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];

            $and = " AND IG.idIntegranteGrupo = $idIntegranteGrupo";
            $rsEncomendaMaterialGrupo = $EncomendaMaterialGrupo->selectEncomendaMaterialGrupo_parcela($idPlanoAcaoGrupo, $dataReferencia, $and);
            foreach ($rsEncomendaMaterialGrupo as $valorEncomendaMaterialGrupo) {

                $totalMaterial_porAluno = $valorEncomendaMaterialGrupo['valor'];
                $dataReferencia_pgtMaterial = $valorEncomendaMaterialGrupo['dataReferencia'];

                $where = " WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataInicio <= '$dataReferencia_pgtMaterial'
			AND (dataFim >= '$dataReferencia_pgtMaterial' OR dataFim IS NULL OR dataFim = '')";
                $rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo($where);

                if ($rsSubvencaoMaterialGrupo) {

                    $subvencao = ($rsSubvencaoMaterialGrupo[0]['subvencao'] / 100);
                    $teto = $rsSubvencaoMaterialGrupo[0]['teto'];
                    $quemPaga = $rsSubvencaoMaterialGrupo[0]['quemPaga'];
                    //echo " $subvencao - $teto - $quemPaga";

                    $totalAlunos_material[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;
                    $totalEmpresa_material[$cont]["idIntegranteGrupo"] = $idIntegranteGrupo;

                    $totalSomar = $totalMaterial_porAluno * $subvencao;
                    if ($teto && $totalSomar > $teto) $totalSomar = $teto;

                    $diferenca = $totalMaterial_porAluno - $totalSomar;

                    //ALUNO
                    if ($quemPaga == "A") {
                        $totalAlunos_material[$cont]["total"] += $totalSomar;
                        //diferença para o outro
                        $totalEmpresa_material[$cont]["total"] += $diferenca;
                        //EMPRESA
                    } elseif ($quemPaga == "E") {
                        $totalEmpresa_material[$cont]["total"] += $totalSomar;
                        //diferença para o outro
                        $totalAlunos_material[$cont]["total"] += $diferenca;
                    }
                } else {
                    $nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
                    $mensagem = "Nao existe subvenção de material definida para todos os dias (" . $nome . ").";
                    break;
                }
            }
            $cont++;
        }


        if ($mensagem) {
            ?>
            <script>alert('<?php echo $mensagem?>');
                fecharNivel();</script>
            <?php exit;
        }

    }
    //VALOR HORA
    $rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);

    //TOTAL MATERIAL
    $totalMaterial = 0;
    $rsMaterial = $EncomendaMaterialGrupo->selectEncomendaMaterialGrupo_parcela($idPlanoAcaoGrupo, $dataReferencia);
    foreach ($rsMaterial as $valorMaterial) $totalMaterial += $valorMaterial['valor'];

    //TOTAL CRÉDITO (tipo 1 E)
    $totalCreditoE = 0;
    $rsCreditoE = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 1 AND quem = 'E' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach ($rsCreditoE as $valorCreditoE) $totalCreditoE += $valorCreditoE['valor'];

    //TOTAL DÉBITO (tipo 2 E)
    $totalDebitoE = 0;
    $rsDebitoE = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 2 AND quem = 'E' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach ($rsDebitoE as $valorDebitoE) $totalDebitoE += $valorDebitoE['valor'];

    //TOTAL CRÉDITO (tipo 1 A)
    $totalCreditoA = 0;
    $rsCreditoA = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 1 AND quem = 'A' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach ($rsCreditoA as $valorCreditoA) $totalCreditoA += $valorCreditoA['valor'];

    //TOTAL DÉBITO (tipo 2 A)
    $totalDebitoA = 0;
    $rsDebitoA = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 2 AND quem = 'A' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach ($rsDebitoA as $valorDebitoA) $totalDebitoA += $valorDebitoA['valor'];

    //TOTAL CRÉDITO (tipo 1 )
    $totalCredito = 0;
    $rsCredito = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 1 AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach ($rsCredito as $valorCredito) $totalCredito += $valorCredito['valor'];

    //TOTAL DÉBITO (tipo 2)
    $totalDebito = 0;
    $rsDebito = $CreditoDebitoGrupo->selectCreditoDebitoGrupo(" WHERE excluido = 0 AND tipo = 2 AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND mes = $mes AND ano = $ano ");
    foreach ($rsDebito as $valorDebito) $totalDebito += $valorDebito['valor'];


    $totalDias = array_unique($totalDias);
    sort($totalDias);


    $temAulaPermanenteGrupo = $AulaPermanenteGrupo->ffTem_AulaPermanenteGrupoDemonstrativo($idPlanoAcaoGrupo, $ano, $mes);
    $temAulaDataFixa = $AulaDataFixa->ffTem_AulaDataFixaDemonstrativo($idPlanoAcaoGrupo, $ano, $mes);
    //Uteis::pr($temAulaPermanenteGrupo);
    ?>
    <?php if (!$idDemonstrativoCobranca) {

        $valorGrupoClientePj = $GrupoClientePj->selectGrupoClientePj(" WHERE grupo_idGrupo = " . $idGrupo);
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

        $cont = 0;

        $creditoEmp = $totalCreditoE / count($rsIntegranteGrupo);
        $debEmp = $totalDebitoE / count($rsIntegranteGrupo);

        $creditoAlu = $totalCreditoA / count($rsIntegranteGrupo);
        $debAlu = $totalDebitoA / count($rsIntegranteGrupo);

        foreach ($rsIntegranteGrupo as $valorIntegranteGrupo) {

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

        <!--     <button class="button blue" onclick="gravaDemon()">Gravar</button>-->

    <?php } else { ?>
        <!--
        <button class="button gray" onclick="deletaRegistro('<?php echo CAMINHO_COBRANCA."demonstrativo/include/acao/demonstrativo.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&mes=".$mes."&ano=".$ano?>', '<?php echo $idDemonstrativoCobranca?>', '<?php echo CAMINHO_COBRANCA."demonstrativo/include/form/demonstrativo.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&mes=".$mes."&ano=".$ano?>', '')">Excluir</button>    -->


        <!--
        <button class="button blue" onclick="print1('div_demonstrativoCobranca')" >Imprimir</button>-->
    <?php } ?>

    </div>

    <div class="lista">
    <?php if ($rsDemonstrativo) { ?>
    <div id="div_demonstrativoCobranca" class="linha-inteira">
    <div class="linha-inteira" align="center">
    <br/>
        <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; border-color: #000000;">

    <!--demonstrativo_geral-->
    <tr>
        <td align="center">
            <table id="demonstrativo_geral" class="tab2" width="800px" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; border-color: #000000;">
                <tr>
                    <th colspan="4">COBRANÇA GERAL</th>
                </tr>
                <tr>
                    <td>
                        &nbsp;<strong>Grupo</strong>: <?php echo $nomeGrupo ?>
                    </td>
                    <td>
                        &nbsp;<strong>Período</strong>: <?php echo $mes ?>/<?php echo $ano ?>
                    </td>
                    <td>
                        &nbsp;<strong>Empresa</strong>: <?php echo $nomeEmpresa ?>
                    </td>
                    <td>
                        &nbsp;<strong>Data de Vencimento</strong>: <?php echo Uteis::exibirData($dataVencimento); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;<strong>Integrantes</strong>:
                    </td>
                    <td colspan="3">
                        <div class="tab1">
                            <?php 
							$nomesIntegrantes = "";
							if ($rsIntegranteGrupo) {
                                
                                echo "<p><strong>";
                                foreach ($rsIntegranteGrupo as $valorIntegranteGrupo) {
                                    $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                                 $nomesIntegrantes .= $IntegranteGrupo->getNomePF($idIntegranteGrupo) . "<br>";
                                }
                                echo substr($nomesIntegrantes, 0, -4);
							$nomesIntegrantes = "";
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
                            <?php if ($rsIntegranteGrupo) {
                                $nomesProf = "";
                                foreach ($rsProfessores as $valorProfessor) $nomesProf .= $Professor->getNome($valorProfessor) . "<br>";

                                echo substr($nomesProf, 0, -4);
                                echo "<br />";
                            }?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Datas cobradas</strong>:
                    </td>
                    <td colspan="3"><?php echo implode(", ", $totalDias) ?></td>
                </tr>
                <tr>
                    <td>
                        <strong> Dias e Horários</strong>
                    </td>
                    <td colspan="4">
                        <?php
                        foreach ($temAulaPermanenteGrupo as $ap => $valor):
                            ?>
                            <strong><?= Uteis::exibirDiaSemana($valor['diaSemana']); ?></strong> - <?= Uteis::exibirHoras($valor['horaInicio']); ?> as <?= Uteis::exibirHoras($valor['horaFim']); ?>(Permanente)
                            <br/>
                        <?php
                        endforeach;
                        ?>
                        <?php
                        foreach ($temAulaDataFixa as $ad => $valor):
                            $semana = new DateTime($valor['dataAula']);
                            ?>
                            <strong><?= Uteis::exibirDiaSemana($semana->format('N')); ?></strong> -
                            <?= Uteis::exibirHoras($valor['horaInicio']); ?> as <?= Uteis::exibirHoras($valor['horaFim']); ?>(Aula Agendada)
                            <br/>
                        <?php
                        endforeach;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Quantidade de dias</strong>:
                    </td>
                    <td colspan="3"><?php echo count($totalDias) ?> </td>
                </tr>
                <tr>
                    <td>
                        <strong>Horas de aula</strong>:
                    </td>
                    <td colspan="3"><?php echo Uteis::exibirHoras($totalHoras) ?></td>
                </tr>
                <tr>
                    <td>
                        <strong>Valor(es) hora do curso</strong>:
                    </td>
                    <td colspan="3">
                        <?php if ($rsValorHoraGrupo) {
                            foreach ($rsValorHoraGrupo as $valorValorHoraGrupo) {
                                $valorHora = $valorValorHoraGrupo['valorHora'];
                                $valorDescontoHora = $valorValorHoraGrupo['valorDescontoHora'];
                                $validadeDesconto = $valorValorHoraGrupo['validadeDesconto'];

                                if ($valorDescontoHora && $validadeDesconto && $validadeDesconto >= $dataReferenciaFinal) {
                                    $obs = "&nbsp;<font color=\"#FF0000\">com desconto de R$" . $valorDescontoHora . " até " . Uteis::exibirData($validadeDesconto) . "</font>";
                                } else {
                                    $obs = "";
                                }

                                echo "R$ " . Uteis::formatarMoeda($valorHora) . $obs;
                            }
                        } else {
                            echo "R$ " . Uteis::formatarMoeda(0);
                        }?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Valor(es) acréscimo ao curso</strong>:
                    </td>
                    <td colspan="3">
                        <?php if ($rsCredito) {
                            foreach ($rsCredito as $valorCredito) {
                                $valor = $valorCredito['valor'];
                                $obs = $valorCredito['obs'] ? " (" . $valorCredito['obs'] . ")" : "";
                                echo "R$ " . Uteis::formatarMoeda($valor) . $obs;
                            }
                        } else {
                            echo "R$ " . Uteis::formatarMoeda(0);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Valor(es) de abatimento</strong>:
                    </td>
                    <td colspan="3">
                        <?php if ($rsDebito) {
                            foreach ($rsDebito as $valorDebito) {
                                $valor = $valorDebito['valor'];
                                $obs = $valorDebito['obs'] ? " (" . $valorDebito['obs'] . ")" : "";
                                echo "R$ " . Uteis::formatarMoeda($valor) . $obs;
                            }
                        } else {
                            echo "R$ " . Uteis::formatarMoeda(0);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong>Taxa de transporte:</strong>:
                        <?php if ($rsPlanoAcaoGrupoAjudaCusto_dia || $rsPlanoAcaoGrupoAjudaCusto_hora) {
                            if ($rsPlanoAcaoGrupoAjudaCusto_dia) {
                                foreach ($rsPlanoAcaoGrupoAjudaCusto_dia as $valorAjudaCusto) {

                                    $totalAJ = (count($totalDias) * $valorAjudaCusto['valor']);
                                    echo /*$valorAjudaCusto['descricao'].":*/
                                        " R$ " . Uteis::formatarMoeda($valorAjudaCusto['valor']) . " por dia de aula. Total de R$ " . Uteis::formatarMoeda($totalAJ) . "</p>";
                                }
                            }
                            if ($rsPlanoAcaoGrupoAjudaCusto_hora) {

                                $totalAJ = ($totalHoras * $valorAjudaCusto['valor']);
                                foreach ($rsPlanoAcaoGrupoAjudaCusto_hora as $valorAjudaCusto) {
                                    echo /*$valorAjudaCusto['descricao'].":*/
                                        " R$ " . Uteis::formatarMoeda($valorAjudaCusto['valor']) . " por hora de aula. Total de R$  " . Uteis::formatarMoeda($totalAJ) . "</p>";
                                }
                            }
                        } else {
                            echo "R$ " . Uteis::formatarMoeda(0);
                        }?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Sub total</strong>:
                    </td>
                    <td colspan="3">
                        <div class="tab1">
                            <?php if ($totalCurso) { ?>
                                <strong>Curso</strong>: R$ <?php echo Uteis::formatarMoeda($totalCurso) ?><br/>
                            <?php } ?>
                            <?php if ($totalMaterial) { ?>
                                <strong>Material</strong>: R$ <?php echo Uteis::formatarMoeda($totalMaterial) ?> <br/>
                            <?php } ?>
                            <?php if ($totalCredito) { ?>
                                <strong>Acréscimos</strong>: R$ <?php echo Uteis::formatarMoeda($totalCredito) ?><br/>
                            <?php } ?>
                            <?php if ($totalDebito) { ?>
                                <strong>Abatimentos</strong>: R$ <?php echo Uteis::formatarMoeda($totalDebito) ?><br/>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong>TOTAL:</strong>
                        <?php
                        $total = $totalCurso + $totalMaterial + $totalAjudaCusto + $totalCredito - $totalDebito;
                        echo "<strong>R$ " . Uteis::formatarMoeda($total) . "</strong>"
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="4">
            <table id="demonstrativo_sub" width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; border-color: #000000;">
                <tr>
                    <th colspan="3"><strong>EMPRESA</strong></th>
                </tr>
                <?php $cont = 0;
                $TDE = $totalDebitoE / count($rsIntegranteGrupo);
                $TCE = $totalCreditoE / count($rsIntegranteGrupo);
                foreach ($rsIntegranteGrupo as $valorIntegranteGrupo){
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
                    <?php //print_r($totalEmpresa_curso);
                    $totalCurso_sub = /*$totalParcial_porAluno;*/
                        $totalEmpresa_curso[$cont]['total'];
                    if ($totalCurso_sub) {
                        $and = " AND quemPaga = 'E'";
                        //SUBVENÇÃO DE CURSO
                        if (!$idDemonstrativoCobranca) {
                            $rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                        } else {
                            $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo " . $and;
                            $rsSubvencaoCursoGrupo = $SubCursoDemonstrativoCobrancaIntegranteGrupo->selectSubCursoDemonstrativoCobrancaIntegranteGrupo($where);
                        }
                        if ($rsSubvencaoCursoGrupo) {
                            foreach ($rsSubvencaoCursoGrupo as $valorSubvencaoCursoGrupo) {
                                $subvencao = $valorSubvencaoCursoGrupo['subvencao'];
                                $teto = $valorSubvencaoCursoGrupo['teto'];
                                $txt_subvencao = " - subvenção de " . $subvencao . "%" . ($teto ? " com teto de R$ " . Uteis::formatarMoeda($teto) : "") . ", pagos pela EMPRESA";
                            }
                        }
                    } else {
                        $txt_subvencao = "";
                    }
                    ?>

                    <td><strong>Curso</strong>: R$ <?php echo Uteis::formatarMoeda($totalCurso_sub) . $txt_subvencao; ?></td>
                    <?php
                    //<!--SUB MATERIAL-->
                    //print_r($totalEmpresa_material);
                    $totalMaterial_sub = $totalEmpresa_material[$cont]['total'];
                    if ($totalMaterial_sub) {

                        $and = " AND quemPaga = 'E'";

                        //SUBVENÇÃO DE CURSO
                        if (!$idDemonstrativoCobranca) {
                            $rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                        } else {
                            $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo " . $and;
                            $rsSubvencaoMaterialGrupo = $SubMaterialDemonstrativoCobrancaIntegranteGrupo->selectSubMaterialDemonstrativoCobrancaIntegranteGrupo($where);
                        }

                        if ($rsSubvencaoMaterialGrupo) {
                            foreach ($rsSubvencaoMaterialGrupo as $valorSubvencaoMaterialGrupo) {

                                $subvencao = $valorSubvencaoMaterialGrupo['subvencao'];
                                $teto = $valorSubvencaoMaterialGrupo['teto'];

                                $txt_subvencao = " - subvenção de " . $subvencao . "%" . ($teto ? " com teto de R$ " . Uteis::formatarMoeda($teto) : "") . ", pagos pela EMPRESA";
                            }
                        } else {
                            $txt_subvencao = "";
                        }
                        ?>
                        <td><strong>Material</strong>:
                            R$ <?php echo Uteis::formatarMoeda($totalMaterial_sub) . $txt_subvencao ?></td>
                    <?php
                    }
                    ?>
                    <td><strong>Acréscimo</strong>: R$
                        <?php
                        if ($TCE) {
                            echo Uteis::formatarMoeda($TCE);
                        } else {
                            $TCE = $totalEmpresa_credito[$cont]["total"];
                            echo Uteis::formatarMoeda($TCE);
                        }
                        ?></td>


                    <td>
                        <strong>Abatimento</strong>: R$
                        <?php if ($TDE) {
                            echo Uteis::formatarMoeda($TDE);
                        } else {
                            $TDE = $totalEmpresa_debito[$cont]["total"];
                            echo Uteis::formatarMoeda($TDE);
                        }
                        $cont++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <strong>TOTAL:</strong>
                        <?php
                        $totalCurso_sub = 0;
                        foreach ($totalEmpresa_curso as $val) $totalCurso_sub += $val['total'];
                        $totalMaterial_sub = 0;
                        foreach ($totalEmpresa_material as $val) $totalMaterial_sub += $val['total'];
                        $total_sub = $totalCurso_sub + $totalMaterial_sub + $totalCreditoE - $totalDebitoE; //$TCE - $TDE;
                        echo "<strong>R$ " . Uteis::formatarMoeda($total_sub) . "</strong>";?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center"><!--demonstrativo_sub_empresa-->
            <table id="demonstrativo_sub_empresa" class="tab2" width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; border-color: #000000;">
                <tr>
                    <th colspan="3">RATEAMENTO ENTRE ALUNOS</th>
                </tr>
                <?php
                $cont = 0;
                $TDA = $totalDebitoA / count($rsIntegranteGrupo);
                $TCA = $totalCreditoA / count($rsIntegranteGrupo);

                foreach ($rsIntegranteGrupo as $valorIntegranteGrupo) {

                    $txt_subvencao = "";

                    $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                    $idDemonstrativoCobrancaIntegranteGrupo = $valorIntegranteGrupo['idDemonstrativoCobrancaIntegranteGrupo'];

                    $nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo);

                    ?>
                    <tr>
                        <td colspan="3">
                            <?php echo $nome ?>
                        </td>
                    </tr>
                    <tr>
                        <?php
                        //print_r($totalAlunos_curso);
                        $totalCurso_sub = $totalAlunos_curso[$cont]['total'];
                        if ($totalCurso_sub) {

                            $and = " AND quemPaga = 'A'";

                            //SUBVENÇÃO DE CURSO
                            if (!$idDemonstrativoCobranca) {
                                $rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                            } else {
                                $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo " . $and;
                                $rsSubvencaoCursoGrupo = $SubCursoDemonstrativoCobrancaIntegranteGrupo->selectSubCursoDemonstrativoCobrancaIntegranteGrupo($where);
                            }

                            if ($rsSubvencaoCursoGrupo) {
                                foreach ($rsSubvencaoCursoGrupo as $valorSubvencaoCursoGrupo) {

                                    $subvencao = $valorSubvencaoCursoGrupo['subvencao'];
                                    $teto = $valorSubvencaoCursoGrupo['teto'];

                                    $txt_subvencao = " - subvenção de " . $subvencao . "%" . ($teto ? " com teto de R$ " . Uteis::formatarMoeda($teto) : "") . ", pagos pelo ALUNO";
                                }

                            } else {
                                $txt_subvencao = "";
                            }
                            ?>
                            <td><strong>Curso</strong>:
                                R$<?php echo Uteis::formatarMoeda($totalCurso_sub) . $txt_subvencao ?></td>
                        <?php } ?>

                        <?php
                        $totalMaterial_sub = $totalAlunos_material[$cont]['total'];
                        if ($totalMaterial_sub) {

                            $and = " AND quemPaga = 'A'";

                            //SUBVENÇÃO DE MATERIAL
                            if (!$idDemonstrativoCobranca) {
                                $rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo_periodo($idIntegranteGrupo, $dataReferencia, $and);
                            } else {
                                $where = " WHERE demonstrativoCobrancaIntegranteGrupo_id = $idDemonstrativoCobrancaIntegranteGrupo " . $and;
                                $rsSubvencaoMaterialGrupo = $SubMaterialDemonstrativoCobrancaIntegranteGrupo->selectSubMaterialDemonstrativoCobrancaIntegranteGrupo($where);
                            }

                            if ($rsSubvencaoMaterialGrupo) {
                                foreach ($rsSubvencaoMaterialGrupo as $valorSubvencaoMaterialGrupo) {

                                    $subvencao = $valorSubvencaoMaterialGrupo['subvencao'];
                                    $teto = $valorSubvencaoMaterialGrupo['teto'];

                                    $txt_subvencao = " - subvenção de " . $subvencao . "%" . ($teto ? " com teto de R$ " . Uteis::formatarMoeda($teto) : "") . ", pagos pelo ALUNO";
                                }
                            } else {
                                $txt_subvencao = "";
                            }?>
                            <td><strong>Material</strong>:
                                R$<?php echo Uteis::formatarMoeda($totalMaterial_sub) . $txt_subvencao ?></td>
                        <?php } ?>
                        <td><strong>Acréscimo</strong>: R$
                            <?php
                            if ($TCA) {
                                echo Uteis::formatarMoeda($TCA);
                            } else {
                                $TCA = $totalAlunos_credito[$cont]["total"];
                                echo Uteis::formatarMoeda($TCA);
                            }
                            ?></td>


                        <td>
                            <strong>Abatimento</strong>: R$
                            <?php
                            if ($TDA) {
                                echo Uteis::formatarMoeda($TDA);
                            } else {
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
                            $total_sub = $totalCurso_sub + $totalMaterial_sub + $TCA - $TDA; // $totalCreditoA - $totalDebitoA; //
                            echo "<strong>R$ " . Uteis::formatarMoeda($total_sub) . "</strong>";
                            $cont++;
                            ?>
                        </th>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
    <tr>
        <td class="validate" colspan="4">
            <?php if (!isset($_GET['pdf'])) { ?>
            <label>Observação:</label>
            <textarea name="obs" id="obs_demostrativo" rows="6" style="width:90%"><?php echo $obsDem?></textarea>
            <?php }else{ ?>
                <strong>Observação:</strong><br>
                <?php echo $obsDem?>
                <p>&nbsp;</p>
            <?php } ?>
        </td>
    </tr>
    </table>

    </div><!--linha-inteira-->
    </div><!--div_demonstrativoCobranca-->
    <?php } ?>
    <?php } // end foreach ?>


    </div><!--lista-->
    </fieldset>
    </div>
<?php
$html = ob_get_contents();
ob_end_clean();
if (isset($_GET['pdf'])) {

    $mpdf = new mPDF();
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->AddPage('P', // L - landscape, P - portrait
        '', '', '', '',
        5, // margin_left
        5, // margin right
        5, // margin top
        5, // margin bottom
        0, // margin header
        0 // margin footer
    );

    //	$css = file_get_contents("css/estilo.css");
    //$mpdf->WriteHTML($stylesheet,1);
    $mpdf->allow_charset_conversion = TRUE;
    $mpdf->charset_in = 'UTF-8';
   $mpdf->WriteHTML($html);
    $mpdf->Output();

//    echo $html;
} else {
    echo $html;
    ?>
    <script>
        function gravaDemon() {
            postForm('', '<?php echo CAMINHO_COBRANCA."demonstrativo/include/acao/demonstrativo.php"?>', '<?php echo $param?>&obs = ' + $('#obs_demostrativo').val());
        }
    </script>
    <script type="text/javascript">

        function print1(strid) {
            if (confirm("Do you want to print?")) {
                var values = document.getElementById(strid);
                var printing =
                    window.open('', '', 'left=0,top=0,width=800,height=600,toolbar=0,scrollbars=0,sta­?tus=0');
                printing.document.write(values.innerHTML);
                printing.document.close();
                printing.focus();
                printing.print();
                printing.close();
            }
        }
    </script>
<?php } ?>