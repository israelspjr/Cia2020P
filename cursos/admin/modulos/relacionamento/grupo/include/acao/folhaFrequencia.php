<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$FolhaFrequencia = new FolhaFrequencia();
$DiaAulaFF = new DiaAulaFF();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$IntegranteGrupo = new IntegranteGrupo();
$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$Aviso = new Aviso();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Professor = new Professor();
$TextoEmailPadrao = new TextoEmailPadrao();
$ClientePf = new ClientePf();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();
$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
$Relatorio = new Relatorio();
$ClientePj = new ClientePj();
$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
$AcompanhamentoCurso = new AcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();
$OcorrenciaFF = new OcorrenciaFF();
$BancoHoras = new BancoHoras();
$Idioma = new Idioma();


$arrayRetorno = array();

$idFolhaFrequencia = $_REQUEST['id'];
$valorF = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = " . $idFolhaFrequencia);
$idPlanoAcaoGrupo = $valorF[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];

//Verificando última FF finalizada.
$idGrupoF = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);

//Gerar Total com Debito e Credito
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupoF);

foreach($ids AS $valor) {
$valorX[] = $valor['idPlanoAcaoGrupo'];		
}

$valorx2 = implode(', ',$valorX);

$valorF2 = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ( " . $valorx2.") AND finalizadaPrincipal = 1 ORDER BY idFolhaFrequencia DESC");

$idFFNovo = $valorF2[0]['idFolhaFrequencia'];

//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$tipoF = $_REQUEST['tipo'];
$FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);

//Nova validade a partir de novos grupos 60 dias
$idG = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);

$idClientePj = $ClientePj->getIdClientePj_porGrupo($idG);
$rs = $ClientePj->selectClientePj("WHERE idClientePj = " . $idClientePj);
$rsFreq = $rs[0]['frequenciaMinimaExigida'];

$dataValidade = $PlanoAcaoGrupo->getDataValidade($idPlanoAcaoGrupo);

if ($_POST['acao'] == "deletar") {
   
   $sql2 = "SELECT SQL_CACHE Diaff.idDiaAulaFF, Diaff.horaRealizada, Diaff.ocorrenciaFF_idOcorrenciaFF, Diaff.reposicao, Diaff.aulaInexistente FROM diaAulaFF AS Diaff INNER JOIN bancoHoras as BH on Diaff.idDiaAulaFF = BH.diaAulaFF_idDiaAulaFF where folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia." AND credDeb = 1";
	$rsd = Uteis::executarQuery($sql2);
//Uteis::pr($rsd);
//Verificando se tem Horas de créditos / débitos e colocando em FF anteriores Fechadas.

	foreach ($rsd as $valor2) {
		$DiaAulaFF->setIdDiaAulaFF($valor2['idDiaAulaFF']);
//		$DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($idFFNovo);
		$DiaAulaFF->updateFieldDiaAulaFF("folhaFrequencia_idFolhaFrequencia", $idFFNovo);
		
	}
   
    //Por conta da programação não é possivel deletar FF gerada, mas é possivel inutilizar ela com dados fantasmas
    // idProfessor excluido = 4
    // IdPlanoAcaoGrupo inativo = 1
    $FolhaFrequencia->updateFieldFolhaFrequencia("professor_idProfessor", 4);
    $FolhaFrequencia->updateFieldFolhaFrequencia("planoAcaoGrupo_idPlanoAcaoGrupo", 1);

//AI nos dias de aula
    $rs = $DiaAulaFF->selectDiaAulaFF(" WHERE folhaFrequencia_idFolhaFrequencia = " . $idFolhaFrequencia);

    foreach ($rs as $valor) {
        $DiaAulaFF->aulaInexistente($valor['idDiaAulaFF'], 1);

    }


    $arrayRetorno['mensagem'] = "FF inutilizada com sucesso";
//	$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/form/folhaFrequencia_abas.php?idFolhaFrequencia=".$idFolhaFrequencia;
    $arrayRetorno['atualizarNivelAtual'] = true;


} elseif ($_REQUEST['acao'] == "gravaObs") {

    $FolhaFrequencia->updateFieldFolhaFrequencia("obs", $_POST['obs']);
    $arrayRetorno['mensagem'] = "Observação gravada com sucesso";
    $arrayRetorno['pagina'] = CAMINHO_REL . "grupo/include/form/folhaFrequencia_abas.php?idFolhaFrequencia=" . $idFolhaFrequencia;
    $arrayRetorno['atualizarNivelAtual'] = true;


} elseif ($_REQUEST['acao'] == "finalizarProfessor") {

    $finalizar = $_REQUEST['finalizar'];
    $EmailIntegrante = $_REQUEST['integrantes'];
//	echo $EmailIntegrante;	

    if ($finalizar) {

        $continua = true;

        if (!$continua) break;
        //INFORMACOES DA FF
        $valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = " . $idFolhaFrequencia);
        $idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
        $idProfessor = $valorFolhaFrequencia[0]['professor_idProfessor'];
        $dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
        $data = explode("-", $dataReferencia);
        $mesRef = $data[1];
        $anoRef = $data[0];

        $mes = $mesRef;
        $ano = $anoRef;

        $idDiaAulaFF_todos = array();

        $rsFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
        $rsFF = array_merge($rsFF['permanente'], $rsFF['fixa']);

        if ($rsFF) {
            foreach ($rsFF as $valorFF) {

                $id = $valorFF["id"];
                $dataAtual = $valorFF["dataAtual"];
                $diaSemana = $valorFF["diaSemana"];
                $dia = date('d', strtotime($dataAtual));
                $horasTotal = $valorFF["horasTotal"];

                $where = " WHERE folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia AND dataAula = '$dataAtual'
				AND (aulaPermanenteGrupo_idAulaPermanenteGrupo = $id OR aulaDataFixa_idAulaDataFixa = $id)";
                $valorDiaAulaFF = $DiaAulaFF->selectDiaAulaFF($where);

                if (!$valorDiaAulaFF[0]['aulaInexistente']) {
                    if (!$valorDiaAulaFF || $valorDiaAulaFF[0]['horaRealizada'] == '') {

                        $arrayRetorno['mensagem'] = "Preencha a frequência do dia " . Uteis::exibirData($dataAtual);
                        $continua = false;
                        break;

                    } else {

                        $idOcorrenciaFF = $valorDiaAulaFF[0]['ocorrenciaFF_idOcorrenciaFF'];
                        $horasDadas = $valorDiaAulaFF[0]['horaRealizada'];

                        if ($horasTotal != $horasDadas && !$idOcorrenciaFF) {
                            $arrayRetorno['mensagem'] = "Defina a ocorrencia do dia " . Uteis::exibirData($dataAtual);
                            $continua = false;
                            break;
                        }

                        $idDiaAulaFF_todos[] = $valorDiaAulaFF[0]['idDiaAulaFF'];

                    }
                }
            }
        }

        $FolhaFrequencia->verificaDiasFF($idFolhaFrequencia, $idDiaAulaFF_todos);
        //echo "ok";exit;

        if ($continua) {
            //VERIFICAR SE TODOS OS DIAS DA FF INDIVIDUAL ESTAO PREENCHIDOS
            $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE aulaInexistente = 0 AND banco=0 AND folhaFrequencia_idFolhaFrequencia = " . $idFolhaFrequencia);
            if (!$rsDiaAulaFF) {
                $arrayRetorno['mensagem'] = "Preencha a folha de frequência.";
            } else {

                $rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);

                foreach ($rsDiaAulaFF as $valorDiaAulaFF) {

                    if (!$continua) break;

                    $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
                    $dataAula = $valorDiaAulaFF['dataAula'];
                    //var_dump($valorDiaAulaFF);

                    foreach ($rsIntegranteGrupo as $valorIntegranteGrupo) {

                        $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                        $dataSaida_aluno = $valorIntegranteGrupo['dataSaida'];
                        $dataEntrada_aluno = $valorIntegranteGrupo['dataEntrada'];

                        //VERIFICA SE O ALUNO JA SAIU NESTA DATA
                        if ($dataEntrada_aluno <= $dataAula && (!$dataSaida_aluno || ($dataSaida_aluno && $dataSaida_aluno >= $dataAula))) {

                            $where = " WHERE integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo . " AND diaAulaFF_idDiaAulaFF = " . $idDiaAulaFF;
                            $valorDiaAulaFFIndividual = $DiaAulaFFIndividual->selectDiaAulaFFIndividual($where);

                            if (!$valorDiaAulaFFIndividual || $valorDiaAulaFFIndividual[0]['horaRealizadaAluno'] == '') {
                                $nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
                                $arrayRetorno['mensagem'] = "Defina a frequência do dia " . Uteis::exibirData($dataAula) . " para o aluno! " . $nomeAluno;

                                $arrayRetorno['mudarAba'] = "#aba_div_ff_individual";

                                $continua = false;
                                break;
                            }
                        }

                    }
                }
            }
        }

        if (!$continua) {
            echo json_encode($arrayRetorno);
            exit;
        }

        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaParcial", 1);

        $nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
        $Idf = $GerenteTem->selectGerenteTem_porGrupo($idPlanoAcaoGrupo);
        $EmailGerente = $Funcionario->getEmail($Idf);
        $NomeGerente = $Funcionario->getNome($Idf);
		
		//Idioma
		$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
		$nomeIdioma = $Idioma->getNome($idIdioma);
		
			$rsOcorrenciaAl =  $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE ocorrenciaFF_idOcorrenciaFF IN (2, 10) AND folhaFrequencia_idFolhaFrequencia = " . $idFolhaFrequencia);
			
		
		if ($rsOcorrenciaAl) {
			$horasTotal = 0;
		$msg .= " <table id=\"tb_lista_grupos_Mes_Detalhes\" class=\"registros\">
        <thead>
          <tr>
            <th>Data Aula</th>
            <th>Ocorrência</th>
            <th>Horas perdidas</th>
          </tr>
        </thead>       
        <tbody>";
			foreach ($rsOcorrenciaAl as $valorDiaAulaFFAl) {
				$idDiaAulaFFAl = $valorDiaAulaFFAl['idDiaAulaFF'];
                $idOcorrenciaFFAl = $valorDiaAulaFFAl['ocorrenciaFF_idOcorrenciaFF'];

                $horaRealizadaAl = $valorDiaAulaFFAl['horaRealizada'];
                $dataAulaAl = $valorDiaAulaFFAl['dataAula'];
                $idAulaPermanenteGrupoAl = $valorDiaAulaFFAl['aulaPermanenteGrupo_idAulaPermanenteGrupo'];
                $idAulaDataFixaAl = $valorDiaAulaFFAl['aulaDataFixa_idAulaDataFixa'];

                if ($idAulaPermanenteGrupoAl) {
                    $rsAula = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = " . $idAulaPermanenteGrupoAl);
                } elseif ($idAulaDataFixaAl) {
                    $rsAula = $AulaDataFixa->selectAulaDataFixa(" AND idAulaDataFixa = " . $idAulaDataFixaAl);
                }

                $horaInicio = $rsAula[0]['horaInicio'];
                $horaFim = $rsAula[0]['horaFim'];
                $horasAula = $horaFim - $horaInicio;
				$horasTotal += $horasAula;
				
				$msg .= "<tr><td>".Uteis::exibirData( $dataAulaAl)."</td>";
				$msg .= "<td>".$OcorrenciaFF->getSiglaOcorrencia($idOcorrenciaFFAl)."</td>";
				$msg .= "<td>".Uteis::exibirHoras($horasAula)."</td></tr>";
				
//                $difHoras = $horasAula - $horaRealizada;
				
			}
			
				        $msg .= "  </tbody>
        
        <tfoot>
          <tr>
            <th></th>
            <th>Horas dadas</th>
            <th></th>
          </tr>
        </tfoot>
        
      </table>";
		
		$msg .= "<div>Total de ".Uteis::exibirHoras($horasTotal) ." Perdidas em GA/CSA neste mês: ".$mes. " Ano: ".$ano."</div>";
		
		$assunto = "Atenção Grupo ".$nomeGrupo." teve GA/CSA neste mês";
		
					 $paraQuem = array("nome" => $NomeGerente, "email" => $EmailGerente);
                    $paraQuem1 = array("nome" => "Site", "email" => "envio@companhiadeidiomas.com.br");
                    $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
     //               $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);
	 
	 $nãoEnviarEmail = 1;
			
		} 
		
	
	

        //COMUNICA OS ALUNOS

        $EmailIntegrantes = rtrim($EmailIntegrante);

        if ((strpos($EmailIntegrantes, " ") == true)) {
            $idClientes = explode(" ", $EmailIntegrante);

        } else {
            $idClientes[] = $EmailIntegrantes;

        }
        //	Uteis::pr($idClientes);

        foreach ($idClientes as $valor) {
//		echo $valor."<br>";	
            if ($valor > 0) {

                $idClientePf = $valor; //$valorIntegranteGrupo["clientePf_idClientePf"];

                $sql2 = "WHERE tipoCliente_idTipoCliente = 3 AND inativo = 0 AND excluido = 0 AND idClientePf =" . $idClientePf;

                $rs2 = $ClientePf->selectClientepf($sql2);
//			var_dump($rs2);

                $senhaAcesso = $rs2[0]['senhaAcesso'];
                $ValorTipo = $rs2[0]['documentoUnico'];

                if ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 1) {

                    $tipo = "cpf";

                } elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 2) {

                    $tipo = "RNE";

                } elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 3) {

                    $tipo = "Passaporte";
                }

                $nome = $ClientePf->getNome($valor);
                $email = $ClientePf->getEmail($valor);

                $assunto = "Preenchimento de folha de frequência";
                $msg = "<p>Período: $mesRef/$anoRef</p><p>Grupo: $nomeGrupo | Idioma: $nomeIdioma</p><p> Nome: $nome</p>";
                $msg .= " <table id=\"tb_lista_grupos_Mes_Detalhes\" class=\"registros\">
        <thead>
          <tr>
            <th>Data Aula</th>
            <th>Horas dadas</th>
            <th>Horas assistidas</th>
          </tr>
        </thead>       
        <tbody>";

                $where = " WHERE CPF.idClientePf = " . $valor . " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND FF.idFolhaFrequencia = $idFolhaFrequencia AND (BH.credDeb = 0 OR BH.credDeb IS NULL) ";
//				$msg .= $where;
                $msg .= $ClientePf->selectGrupoAlunoMesDetalhes($where, false,1);

                $msg .= "  </tbody>
        
        <tfoot>
          <tr>
            <th></th>
            <th>Horas dadas</th>
            <th></th>
          </tr>
        </tfoot>
        
      </table>";
	  

 $result = $Relatorio->relatorioFrequencia_porAula($where, false);
 
// Uteis::pr($result);
 
  foreach($result as $valor){
				
				if ($valor['diaAula'] < 10) {
				$dia = "0".$valor['diaAula'];	
				} else {
				$dia = $valor['diaAula'];		
				}
				
				if ($valor['mes'] < 10) {
				$mes1 = "0".$valor['mes'];	
				} else {
				$mes1 = $valor['mes'];		
				}
				
				$dataAula = $valor['ano']."-".$mes1."-".$dia;
				
				if ($dataAula >= $valor['dataEntrada']) {				
				
				$EmpresaFreq += $valor['horasRealizadasPeloGrupo'];
				$AlunoFreq += $valor['horaRealizadaAluno'];
				
				
				}
	$EmpresaFreq +=	$valor['somarCom_horasRealizadasPeloGrupo'];		
				
  }
  
//  echo $AlunoFreq;

                $Freq = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = " . $idFolhaFrequencia . " AND CPF.idClientePf = " . $idClientePf);
               $AlunoJust = $Freq[0]['aulasJustificadas_aluno'];

                if ($AlunoJust > 0) {
                    $AlunoFreq = ($AlunoFreq + $AlunoJust) ;
                }

                if ($EmpresaFreq > 0) {
                    $AlunoPer = ($AlunoFreq / $EmpresaFreq) * 100;
                } else {
                    $AlunoPer = ($AlunoFreq / 1) * 100;
                }

                if ($AlunoPer > 100) {
                    $AlunoPer = 100;

                }

                $msg .= " <div >
  <p style='font-size:18px; font-weight:700;'>A sua frequência neste mês foi: " . round($AlunoPer, 2) . "%</p>";
  
  $msg .= "<div> A frequência mínima para as aulas é de 75%, sem considerar as justificativas por ausência. Frequência abaixo desta porcentagem pode prejudicar seu desenvolvimento no idioma e atrasar o cronograma de seu curso. Caso sua frequência esteja abaixo, converse com seu coordenador.</div>";

                if ($AlunoJust > 0) {
                    $msg .= '<p style="font-size:18px; font-weight:700;">Total de horas justificadas: ' . Uteis::exibirHoras($AlunoJust) . '</p>';
                }

                if ($rsFreq != "") {
                    $msg .= '<p style="font-size:18px; font-weight:700;">  A frequência exigida pela empresa é:' . $rsFreq . '%</p>';

                    if ($AlunoPer < $rsFreq) {
                        $msg .= '<p style="font-size:18px; font-weight:700;color: red;">  Atenção aluno sua frequência está abaixo da exigida pela empresa!! </p>';
                    }

                }
                $msg .= "</div>";

                // Notas de habilidade e atitude
                $msg .= " <div>
  <center><label><p style='font-size:18px; font-weight:700;'>Nota Mensal - Habilidade e Atitude </p></label></center>";

                $dateU = date("Y-m-t", strtotime($ano . "-" . $mes . "-01"));
                $idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo($idClientePf, $idPlanoAcaoGrupo, "'" . $dateU . "'");

                $valorPeriodo = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE mes = " . $mes . " AND ano = " . $ano);
                $idPeriodoAcompanhamentoCurso = $valorPeriodo[0]['idPeriodoAcompanhamentoCurso'];

//Buscar se já existe
                $rsAcomapanhamentoCurso = $AcompanhamentoCurso->selectAcompanhamentoCurso("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . "  AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = " . $idPeriodoAcompanhamentoCurso . " AND (arquivado = 0 OR arquivado is null) ");

                $idAcompanhamentoCurso = $rsAcomapanhamentoCurso[0]['idAcompanhamentoCurso'];

                $nota1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = " . $idAcompanhamentoCurso . " AND integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mes, 1);

                $media1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = " . $idAcompanhamentoCurso . " AND integranteGrupo_idIntegranteGrupo = " . $idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mes, 1, 1);
				
				$observacao = $RelatorioDesempenho->selectRelatorioDesempenhoTrObs(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mes);

                $sql = "SELECT SQL_CACHE TRD.idTipoItenRelatorioDesempenho, TRD.nome,  IRD.orientacao
			FROM tipoItenRelatorioDesempenho AS TRD
			INNER JOIN itenRelatorioDesempenho AS IRD on IRD.tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = TRD.idTipoItenRelatorioDesempenho
			WHERE TRD.inativo = 0 AND (avaliacao = $mes or reavaliacao = $mes)";
//			echo $sql;
                $result = Uteis::executarQuery($sql);

                $habilidade = $result[0]['nome'];
                $textoAtitude = $result[1]['orientacao'];

                if ($media1[0] > 0 && $media1[1] > 0) {
                    $x = ($media1[0] + $media1[1]) / 2;

                }

                $mystring = $nota1;
                $findme = ']';

                $texto1 = substr($nota1, 1, 2);
                $texto1 = str_replace(']', '', $texto1);

                $pos = strripos($mystring, $findme);
                $pos = $pos - 2;

                $texto2 = substr($nota1, $pos);
                $texto2 = str_replace(']', '', $texto2);
				$texto2 = str_replace('[','',$texto2);

                $texto3 = str_replace('média', 'Total ', $media1);

                $msg .= "
        <p><label><strong>1º Nota:</strong> " . $habilidade . ": " . $texto1 . " </label></p>
        <p><label><strong>2º Nota: </strong> Atitude : " . $texto2 . $textoAtitude . " </label></p>
		<p><label><strong>Observações: </strong></label></p>
<p>".$observacao."</p>
        <label><p style=\"font-size:18px; font-weight:700;\">Média: " . $texto3 . " </p></label>";

                $msg .= $TextoEmailPadrao->getTexto("4");

                $msg .= "<p><label>Concorda com a folha de frequência?</label>";

                $msg .= "<p><a href=http://" . $_SERVER['SERVER_NAME'] . "/cursos/mobile/aluno/login.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano . "&" . $tipo . "=" . $ValorTipo . "&password=" . EncryptSenha::B64_Decode($senhaAcesso) . "&tipo=1&idIntegranteGrupo=" . $idIntegranteGrupo . "&idFolhaFrequencia=" . $idFolhaFrequencia . ">      Sim</a></p>
          <p><a href=http://" . $_SERVER['SERVER_NAME'] . "/cursos/mobile/aluno/login.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&mes=" . $mes . "&ano=" . $ano . "&" . $tipo . "=" . $ValorTipo . "&password=" . EncryptSenha::B64_Decode($senhaAcesso) . "&tipo=2&idIntegranteGrupo=" . $idIntegranteGrupo . "&idFolhaFrequencia=" . $idFolhaFrequencia . "&idProfessor=" . $idProfessor . "&mes=" . $mes . "&ano=" . $ano . ">    Não </a></p>";

                $msg .= "Para acessar o portal do aluno <a href=http://" . $_SERVER['SERVER_NAME'] . "/cursos/mobile/aluno/login.php?mes=" . $mes . "&ano=" . $ano . "&" . $tipo . "=" . $ValorTipo . "&password=" . EncryptSenha::B64_Decode($senhaAcesso) . ">clique aqui</a><p> A equipe Companhia de Idiomas agradece.</p>Atenciosamente,</p>";

                //EMAIL
                if (Uteis::verEmail($email)) {
                    $paraQuem = array("nome" => $nome, "email" => $email);
                    $paraQuem1 = array("nome" => "Site", "email" => "envio@companhiadeidiomas.com.br");
                    $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
                    $rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);

						$sql2 = "SELECT DISTINCT
    (nome), integranteGrupo_idIntegranteGrupo, nota, data
FROM
    compa184_oficial.itemCalendarioProva AS ICP
        INNER JOIN
    itenProva AS IP ON IP.idItenProva = ICP.itenProva_idItenProva
WHERE
    integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo."
        AND nome = 'Prova Escrita'
        AND nota IS NOT NULL"; 

				$result2 = Uteis::executarQuery($sql2);
							
    			$nota = $result2[0]['nota'];
					
				if ($nota > 9) {
					
				$assunto  = "Parabéns pela sua nota";
				
				$msg3 = "<p>Olá ".$nome."</p>";
				$msg3 .= "<p>Sua nota na última prova foi de: ".$nota."</p>";
				
				$msg3 .= $TextoEmailPadrao->getTexto("23");	
					
		        $rs = Uteis::enviarEmail($assunto, $msg3, $paraQuem);
				$rs1 = Uteis::enviarEmail($assunto, $msg, $paraQuem1);   
		
					
				}
			
			

                } else {
                    $arrayRetorno['mensagem'] = "Não foi possivel enviar Folha para " . $nome;
                }

            }

            $arrayRetorno['mensagem'] = "Finalizado com sucesso";
        }
    } else {

        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaParcial", 0);
        $arrayRetorno['mensagem'] = "Desfinalizado com sucesso";

    }

    $arrayRetorno['pagina'] = CAMINHO_REL . "grupo/include/form/folhaFrequencia_abas.php?idFolhaFrequencia=" . $idFolhaFrequencia;
    $arrayRetorno['atualizarNivelAtual'] = true;


} elseif ($_REQUEST['acao'] == "finalizarProfessorPri") {



    //echo "//$idFolhaFrequencia";exit;
    $valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = " . $idFolhaFrequencia);
    $idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
    $idProfessor = $valorFolhaFrequencia[0]['professor_idProfessor'];
    $dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
    $data = explode("-", $dataReferencia);
    $mesRef = $data[1];
    $anoRef = $data[0];

    $finalizar = $_REQUEST['finalizar'];

    if ($finalizar) {

        $rsOcorrenciaFF = $OcorrenciaFF->selectOcorrenciaFF(" WHERE reporAula = 1 ");
        $rsOcorrenciaExp = $OcorrenciaFF->selectOcorrenciaFF(" WHERE reporAula = 1 AND expira = 1");
        $expira = Uteis::arrayCampoEspecifico($rsOcorrenciaExp, "idOcorrenciaFF");
        $ocorrenciasValidas = Uteis::arrayCampoEspecifico($rsOcorrenciaFF, "idOcorrenciaFF");
        $ocorrenciasValidas = $ocorrenciasValidas ? implode(",", $ocorrenciasValidas) : "0";
		
		
		
        $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE ocorrenciaFF_idOcorrenciaFF IN (" . $ocorrenciasValidas . ") AND folhaFrequencia_idFolhaFrequencia = " . $idFolhaFrequencia);
        if ($rsDiaAulaFF) {
            foreach ($rsDiaAulaFF as $valorDiaAulaFF) {

                $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
                $idOcorrenciaFF = $valorDiaAulaFF['ocorrenciaFF_idOcorrenciaFF'];

                $horaRealizada = $valorDiaAulaFF['horaRealizada'];
                $dataAula = $valorDiaAulaFF['dataAula'];
                $idAulaPermanenteGrupo = $valorDiaAulaFF['aulaPermanenteGrupo_idAulaPermanenteGrupo'];
                $idAulaDataFixa = $valorDiaAulaFF['aulaDataFixa_idAulaDataFixa'];

                if ($idAulaPermanenteGrupo) {
                    $rsAula = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = " . $idAulaPermanenteGrupo);
                } elseif ($idAulaDataFixa) {
                    $rsAula = $AulaDataFixa->selectAulaDataFixa(" AND idAulaDataFixa = " . $idAulaDataFixa);
                }

                $horaInicio = $rsAula[0]['horaInicio'];
                $horaFim = $rsAula[0]['horaFim'];
                $horasAula = $horaFim - $horaInicio;

                $difHoras = $horasAula - $horaRealizada;

                //BANCO DE HORAS
                if ($difHoras > 0) {

                    $BancoHoras->setDiaAulaFFIdDiaAulaFF($idDiaAulaFF);
                    $BancoHoras->setHoras($difHoras);

                    //último grupo gerado antes da mudança 24/07/2015
                    if ($idOcorrenciaFF != 3) {

                        $dataAulaExpira = date('Y-m-d', strtotime('+3 months', strtotime($dataAula)));

                    } else {

                        $dataAulaExpira = "";
                    }

                    $BancoHoras->setDataExpira($dataAulaExpira);
                    $idBancoHoras = $BancoHoras->addBancoHoras();
                }
            }
        }

        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaPrincipal", 1);

        $nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);

        $arrayRetorno['mensagem'] = "Finalizado[financeiro] com sucesso";

        if ($tipoF != 1) {

            $arrayRetorno['fecharNivel'] = true;

        } else {


            $arrayRetorno['pagina'] = CAMINHO_REL . "grupo/cadastro.php?id=$idPlanoAcaoGrupo";
       }


    } else {

        $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE folhaFrequencia_idFolhaFrequencia = " . $idFolhaFrequencia);

        $valorFolhaFrequencia2 = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = " . $idFolhaFrequencia);
        $dataReferencia2 = $valorFolhaFrequencia2[0]['dataReferencia'];
        $idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];

        $dataReferenciaFinal2 = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia2))));

        foreach ($rsDiaAulaFF as $valorDiaAulaFF) {
            $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
            $BancoHoras->deleteBancoHoras(" OR diaAulaFF_idDiaAulaFF = " . $idDiaAulaFF . " AND (credDeb is null or credDeb = 0)");
            $BancoHorasAulasRepostas->deleteBancoHorasAulasRepostasPlanoAcaoGrupo($idDiaAulaFF . " or (dataReferenciaFinal >= '" . $dataReferenciaFinal2 . "' And planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . ")");
        }

        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaPrincipal", 0);
        $arrayRetorno['mensagem'] = "Desfinalizado[financeiro] com sucesso";

    }

    if ($tipoF != 1) {

        $arrayRetorno['pagina'] = CAMINHO_REL . "grupo/include/form/folhaFrequencia_abas.php?idFolhaFrequencia=" . $idFolhaFrequencia;

    } else {

        $arrayRetorno['pagina'] = CAMINHO_REL . "grupo/cadastro.php?id=$idPlanoAcaoGrupo";

    }

    $arrayRetorno['atualizarNivelAtual'] = true;
    echo json_encode($arrayRetorno);
    exit;

}
$arrayRetorno['atualizarNivelAtual'] = true;
$arrayRetorno['mudarAba'] = "#aba_div_aulas";

echo json_encode($arrayRetorno);
?>