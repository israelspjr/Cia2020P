<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$FolhaFrequencia = new FolhaFrequencia();
$DiaAulaFF = new DiaAulaFF();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$IntegranteGrupo = new IntegranteGrupo();
$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$Aviso = new Aviso();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$GrupoClientePj = new GrupoClientePj();
$Professor = new Professor();
$TextoEmailPadrao = new TextoEmailPadrao();
$OcorrenciaFF = new OcorrenciaFF();
$BancoHoras = new BancoHoras();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();
$Idioma = new Idioma();
$ClientePf = new ClientePf();
$ClientePj = new ClientePj();
$Configuracoes = new Configuracoes();

$arrayRetorno = array();
$config = $Configuracoes->selectConfig();

$idFolhaFrequencia = $_REQUEST['id'];

$FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);

$valorF = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = " . $idFolhaFrequencia);
$idPlanoAcaoGrupo = $valorF[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	//Nova validade a partir de novos grupos 60 dias
		$idG = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);
	
		$idClientePj = $ClientePj->getIdClientePj_porGrupo($idG);
		$rs = $ClientePj->selectClientePj("WHERE idClientePj = " . $idClientePj);
		$rsFreq = $rs[0]['frequenciaMinimaExigida'];
	

if($_POST['acao']=="deletar"){
    //  
}elseif($_REQUEST['acao']=="gravaObs"){
	
	if ($_POST['obsF'] == '') {
		$obsF = " ";	
	} else {
		$obsF = $_POST['obsF'];
		
	}
    
    $FolhaFrequencia->updateFieldFolhaFrequencia("obs", $obsF); 
    $arrayRetorno['mensagem'] = "Observação gravada com sucesso";
    
}elseif($_REQUEST['acao']=="finalizarProfessor"){
    
    $finalizar = $_REQUEST['finalizar'];    
    $af = $_REQUEST['af'];
    $am = $_REQUEST['am'];
	$dataFinalizada = date("Y-m-d h:m:s");
    if($finalizar){     
        
        $continua = true;
        
        if(!$continua) break;
     //INFORMACOES DA FF
        $valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = ".$idFolhaFrequencia);
        $idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
        $idProfessor = $valorFolhaFrequencia[0]['professor_idProfessor'];
        $dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
            $data = explode("-",$dataReferencia);
                $mesRef = $data[1];
                $anoRef = $data[0]; 
        
        $idDiaAulaFF_todos = array();      
		
		        
        $rsFF = $FolhaFrequencia->selectFF_diasHoras($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor);
        $rsFF = array_merge($rsFF['permanente'], $rsFF['fixa']);
        
        if($rsFF){
                  
            foreach($rsFF as $valorFF){                 
                            
                $id = $valorFF["id"];
                $dataAtual = $valorFF["dataAtual"];
                    $diaSemana = $valorFF["diaSemana"];
                    $dia = date('d',strtotime($dataAtual));                     
                $horasTotal = $valorFF["horasTotal"];
                                    
                $where = " WHERE folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia AND dataAula = '$dataAtual' 
                AND (aulaPermanenteGrupo_idAulaPermanenteGrupo = $id OR aulaDataFixa_idAulaDataFixa = $id)";
                $valorDiaAulaFF = $DiaAulaFF->selectDiaAulaFF($where);
                
                if(!$valorDiaAulaFF[0]['aulaInexistente']){              
                    if( !$valorDiaAulaFF || $valorDiaAulaFF[0]['horaRealizada']==''){
                        
                        $arrayRetorno['mensagem'] = "Preencha a frequência do dia ".Uteis::exibirData($dataAtual);
                        $continua = false;
                        break;
                        
                    }else{                              
                        
                        $idOcorrenciaFF = $valorDiaAulaFF[0]['ocorrenciaFF_idOcorrenciaFF'];    
                        $horasDadas = $valorDiaAulaFF[0]['horaRealizada'];
                        
                        if($horasTotal != $horasDadas && !$idOcorrenciaFF){
                            $arrayRetorno['mensagem'] = "Defina a ocorrencia do dia ".Uteis::exibirData($dataAtual);
                            $continua = false;
                            break;
                        }
        
                        $idDiaAulaFF_todos[] = $valorDiaAulaFF[0]['idDiaAulaFF'];
                        
                    }   
                }                                   
            }                           
        }
        
        $FolhaFrequencia->verificaDiasFF($idFolhaFrequencia, $idDiaAulaFF_todos);               
        
        if($continua){
            //VERIFICAR SE TODOS OS DIAS DA FF INDIVIDUAL ESTAO PREENCHIDOS
            $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE aulaInexistente = 0 AND banco=0 AND folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);       
            if(!$rsDiaAulaFF){
                $arrayRetorno['mensagem'] = "Preencha a folha de frequência.";
            }else{                  
                
                $rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);
            
                foreach($rsDiaAulaFF as $valorDiaAulaFF){
                    
                    if(!$continua) break;
                    
                    $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
                    $dataAula = $valorDiaAulaFF['dataAula'];
                    
                    foreach($rsIntegranteGrupo as $valorIntegranteGrupo){                   
                                
                        $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
                        $dataSaida_aluno = $valorIntegranteGrupo['dataSaida'];
                        $dataEntrada_aluno = $valorIntegranteGrupo['dataEntrada'];
            
                        //VERIFICA SE O ALUNO JA SAIU NESTA DATA                        
                        if( $dataEntrada_aluno <= $dataAula && (!$dataSaida_aluno || ( $dataSaida_aluno && $dataSaida_aluno >= $dataAula)) ){                         
                                                                    
                            $where = " WHERE integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo." AND diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF;
                            $valorDiaAulaFFIndividual = $DiaAulaFFIndividual->selectDiaAulaFFIndividual($where);
                            
                            if( !$valorDiaAulaFFIndividual || $valorDiaAulaFFIndividual[0]['horaRealizadaAluno']=='' ){                                             
                                $nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
                                $arrayRetorno['mensagem'] = "Defina a frequência do dia ".Uteis::exibirData($dataAula)." para o aluno! ".$nomeAluno;
                                
                                $arrayRetorno['mudarAba'] = "#aba_div_ff_individual";
                                
                                $continua = false;
                                break;                                              
                            }
                        }
                        
                    }
                }
            }
        }
                
        if(!$continua){         
            echo json_encode($arrayRetorno);
            exit;   
        }               
        
        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaParcial", 1);
		$FolhaFrequencia->updateFieldFolhaFrequencia("dataFinalizada", $dataFinalizada);
        
		$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true); 
		$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo); 
		$idClientePj = $GrupoClientePj->getNomePJ($idGrupo, true);
		
		$Idf = $GerenteTem->selectGerenteTem_porEmp($idClientePj);
        $EmailGerente = $Funcionario->getEmail($Idf);
        $NomeGerente = $Funcionario->getNome($Idf); 
		
		//Idioma
		$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
		$nomeIdioma = $Idioma->getNome($idIdioma);
		
				
		$rsOcorrenciaAl =  $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE ocorrenciaFF_idOcorrenciaFF IN (2, 10, 3) AND folhaFrequencia_idFolhaFrequencia = " . $idFolhaFrequencia);
		
		if ($rsOcorrenciaAl) {
			$horasTotal = 0;
		$msg .= " <table id=\"tb_lista_grupos_Mes_Detalhes\" class=\"registros\">
        <thead>
          <tr>
            <th align=\"center\">Data Aula</th>
            <th align=\"center\">Ocorrência</th>
            <th align=\"center\">Horas perdidas</th>
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
				
			}
		        $msg .= "  </tbody>
        
        <tfoot>
          <tr>
            <th></th>
            <th>Horas perdidas</th>
            <th></th>
          </tr>
        </tfoot>
        
      </table>";
		
		// Mensagem para Coordenador!
		
		$msg .= "<div>Total de ".Uteis::exibirHoras($horasTotal) ." Perdidas em GA/CSA/PA neste mês: ".$mesRef. " Ano: ".$anoRef."</div>";
		
		$assunto = "Atenção Grupo ".$nomeGrupo." teve GA/CSA/PA neste mês";
					 $paraQuem = array("nome" => $NomeGerente, "email" => $EmailGerente);
                     $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
			  		 $naoEnviarEmail = 1;
		} else {
			  		 $naoEnviarEmail = 0;	
		}
        
        //COMUNICA OS ALUNOS
        $rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);
        foreach($rsIntegranteGrupo as $valorIntegranteGrupo){   
	
			$ClientePf = new ClientePf;   
			$Relatorio = new Relatorio();
			$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
			$AcompanhamentoCurso = new AcompanhamentoCurso();
			$RelatorioDesempenho = new RelatorioDesempenho();  
			$EmpresaFreq = 0;
			$AlunoFreq = 0;            
            
            $idIntegranteGrupo = $valorIntegranteGrupo['idIntegranteGrupo'];
            
            $rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = $idIntegranteGrupo");
            $idClientePf = $rsIntegranteGrupo[0]["clientePf_idClientePf"];
			
			$sql2 = "WHERE tipoCliente_idTipoCliente = 3 AND inativo = 0 AND excluido = 0 AND idClientePf =".$idClientePf;
		
			$rs2 = $ClientePf -> selectClientepf($sql2);
			
			$senhaAcesso = $rs2[0]['senhaAcesso'];
			$ValorTipo = $rs2[0]['documentoUnico'];
			
			if ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 1) {
					
			$tipo = "cpf";
			
			} elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 2) {
				
			$tipo = "RNE";
			
			} elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 3) {
				
			$tipo = "Passaporte";
			}
			
			$nome = $ClientePf->getNome($idClientePf);
			$email = $ClientePf->getEmail($idClientePf);
			
			$assunto = "Validação mensal de frequência e desempenho";
			$msg = "Prezado(a) Aluno(a),";
			$msg .= "<p>Seu professor acabou de finalizar sua Folha de Frequência.</p>";
			$msg .= "<p>Período: $mesRef/$anoRef</p><p>Grupo: $nomeGrupo | Idioma: $nomeIdioma</p><p> Nome: $nome</p>"; 
			$msg .= " <table id=\"tb_lista_grupos_Mes_Detalhes\" class=\"registros\">
        <thead>
          <tr>
            <th>Data Aula</th>
            <th>Horas dadas</th>
            <th>Horas assistidas</th>
          </tr>
        </thead>       
        <tbody>";        
				
				 $where = " WHERE CPF.idClientePf = " . $idClientePf . " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND FF.idFolhaFrequencia = $idFolhaFrequencia AND (BH.credDeb = 0 OR BH.credDeb IS NULL) ";
				$msg .= $ClientePf -> selectGrupoAlunoMesDetalhes($where, false, 1);
				
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

 
 $Freq = $Relatorio->relatorioFrequencia_mensal(" WHERE FF.idFolhaFrequencia = ".$idFolhaFrequencia." AND CPF.idClientePf = ".$idClientePf);


			$AlunoJust = $Freq[0]['aulasJustificadas_aluno'];

  			$nome = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
            $email = $IntegranteGrupo->getEmail($idIntegranteGrupo);
            

 				if ($AlunoJust > 0) {
                    $AlunoFreq = $AlunoFreq + $AlunoJust;
                }

                if ($EmpresaFreq > 0) {
                    $AlunoPer = ($AlunoFreq / $EmpresaFreq) * 100;
                } else {
                    $AlunoPer = ($AlunoFreq / 1) * 100;
                }

                if ($AlunoPer > 100) {
                    $AlunoPer = 100;

                }
			
				$msg2 = "";
	  
	$msg .= " <div >
  <p style='font-size:18px; font-weight:700;'>A sua frequência neste mês foi: ".round($AlunoPer, 2)."%. </p>";
  
  $msg .= "<div> A frequência mínima para as aulas é de 75%, sem considerar as justificativas por ausência. Frequência abaixo desta porcentagem pode prejudicar seu desenvolvimento no idioma e atrasar o cronograma de seu curso. Caso sua frequência esteja abaixo, converse com seu coordenador.</div>";
  
   if ($AlunoJust > 0) {
	$msg .= '<p style="font-size:18px; font-weight:700;">Total de horas justificadas: '.Uteis::exibirHoras($AlunoJust).'</p>';
  }
  
  if ($rsFreq != "") { 
  $msg .= '<p style="font-size:18px; font-weight:700;">  A frequência exigida pela empresa é:'. $rsFreq.'%</p>';
  
 if ($AlunoPer < $rsFreq) {
	$msg .= '<p style="font-size:18px; font-weight:700;color: red;">  Atenção aluno sua frequência está abaixo da exigida pela empresa!! </p>';
}
	
 } 
 
 
  $msg .= "</div>";
  
 // Notas de habilidade e atitude 
  $msg .= " <div>
  <p style='font-size:18px; font-weight:700;'>Nota Mensal - Habilidade e Atitude </p>";
  
  $dateU = date("Y-m-t", strtotime($anoRef."-".$mesRef."-01"));
$idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo($idClientePf, $idPlanoAcaoGrupo, "'".$dateU."'");

$valorPeriodo = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE mes = ".$mesRef." AND ano = ".$anoRef);
$idPeriodoAcompanhamentoCurso = $valorPeriodo[0]['idPeriodoAcompanhamentoCurso'];

//Buscar se já existe
$rsAcomapanhamentoCurso = $AcompanhamentoCurso->selectAcompanhamentoCurso("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo."  AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = ".$idPeriodoAcompanhamentoCurso. " AND (arquivado = 0 OR arquivado is null) ");

$idAcompanhamentoCurso = $rsAcomapanhamentoCurso[0]['idAcompanhamentoCurso'];

$nota1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mesRef, 1);

$media1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mesRef, 1,1);

$observacao = $RelatorioDesempenho->selectRelatorioDesempenhoTrObs(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mesRef);


$sql = "SELECT SQL_CACHE TRD.idTipoItenRelatorioDesempenho, TRD.nome,  IRD.orientacao
			FROM tipoItenRelatorioDesempenho AS TRD
			INNER JOIN itenRelatorioDesempenho AS IRD on IRD.tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = TRD.idTipoItenRelatorioDesempenho
			WHERE TRD.inativo = 0 AND (avaliacao = $mesRef or reavaliacao = $mesRef)";
//			echo $sql;
		$result = Uteis::executarQuery($sql);

	$habilidade = $result[0]['nome'];
	$textoAtitude = $result[0]['orientacao'];	


$mystring = $nota1;
$findme   = ']';

$texto1 = substr($nota1, 1 , 2);
$texto1 = str_replace(']','',$texto1);

$texto1 = (int) $texto1;

$pos = strripos($mystring, $findme);
$pos = $pos - 2;

$texto2 = substr($nota1, $pos);
$texto2 = str_replace(']','',$texto2);
$texto2 = str_replace('[','',$texto2);

$texto2 = (int) $texto2;

	//Mandando Email nota Desempenho Baixa
	
	if (($texto1 >0) && ($texto1 < 7)) {
		$msg5 = "<hr>Nota de desempenho abaixo da média!";		
		$msg5 .= "<p>No último mês foi avaliado seu desempenho em <strong>". $habilidade."</strong> e sua nota foi <strong>".$texto1."</strong>! </p>";
		$msg5 .= "<p>".$textoAtitude."</p>";
		
		if (($habilidade == 'Produção Oral') || ($habilidade == 'Escrita')) {
		
		$msg5 .= $TextoEmailPadrao->getTexto("28");	
		
		$msg5 .= "<p>Estamos aqui para ajudar você nesta jornada da fluência. <br>Fale agora com seu coordenador pedagógico:<br>" .$NomeGerente."<a href=\"mailto:".$EmailGerente.">".$EmailGerente."</a></p>";
		
		$msg5 .= "<p></p>";

//		$msg5 .= "<p>Quer saber mais?  Veja estas dicas, <a href=\"https://www.companhiadeidiomas.com.br/category/apdrendendo-a-aprender/\">clique aqui</a></p>";  
			
		} else {
		
		$msg5 .= $TextoEmailPadrao->getTexto("27");
		
		$msg5 .= "<p>Desenvolvemos também uma trilha de conhecimento que pode ser muito útil, já que não é fácil fazer a curadoria de conteúdos de qualidade na internet.  Quer recebê-la gratuitamente?  É só pedir para seu coordenador: <br>" .$NomeGerente."<a href=\"mailto:".$EmailGerente.">".$EmailGerente."</a><p>";
				
		}
	}

	//Mandando Email nota Atitute Baixa
	
	if (($texto2 >0) && ($texto2 < 7)) {
			$msg7 = "<hr>Nota de atitude abaixo da média!";		
		$msg7 .= "A sua atitude para o desenvolvimento em <strong>". $habilidade."</strong> foi <strong>".$texto2."</strong> ";
		$msg7 .= "<p>".$textoAtitude."</p>";
				
		$msg7 .= $TextoEmailPadrao->getTexto("26");	
		
		$msg7 .= "<p>Estamos aqui para ajudar você nesta jornada da fluência. <br>Fale agora com seu coordenador pedagógico:<br>" .$NomeGerente."<a href=\"mailto:".$EmailGerente.">".$EmailGerente."</a></p>";

//		$msg7 .= "<p>Quer saber mais?  Veja estas dicas, <a href=\"https://www.companhiadeidiomas.com.br/category/apdrendendo-a-aprender/\">clique aqui</a></p>";  
	}
	

 	$msg .= "
	<p>".$textoAtitude."</p>
<p><label><strong>1º Nota: </strong> ". $habilidade.": ".$texto1 ." </label></p>
<p><label><strong>2º Nota: </strong> Atitude (Atitude para desenvolvimento da habilidade avaliada): ".$texto2." </label></p>
<p><label><strong>Observações: </strong></label></p>
<p>".$observacao."</p>";
  
	$msg .= $TextoEmailPadrao->getTexto("4");
     
    $msg .= "<p><label>Concorda com a folha de frequência?</label>";
	
	$msg .= "<p>Para acessar a folha de frequência é necessário o seu CPF e uma senha. Caso não saiba sua senha, entre em contato com o seu coordenador pedagógico por e-mail (" .$NomeGerente."-<a href=\"mailto:".$EmailGerente."\">".$EmailGerente."</a>) ou whatsapp."; 
 
    $msg .= "<p><a href='https://".$config[0]['site']."/cursos/portais/login.php?app=1&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&mes=".$mes."&ano=".$ano."&".$tipo."=".$ValorTipo."&password=".EncryptSenha::B64_Decode($senhaAcesso)."&tipo=1&idIntegranteGrupo=".$idIntegranteGrupo."&idFolhaFrequencia=".$idFolhaFrequencia."'>      Sim</a></p>	
          <p><a href='https://".$config[0]['site']."/cursos/portais/login.php?app=1&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&mes=".$mes."&ano=".$ano."&".$tipo."=".$ValorTipo."&password=".EncryptSenha::B64_Decode($senhaAcesso)."&tipo=2&idIntegranteGrupo=".$idIntegranteGrupo."&idFolhaFrequencia=".$idFolhaFrequencia."&idProfessor=".$idProfessor."&mes=".$mes."&ano=".$ano."'>    Não </a></p>";

			$msg8 = "<p>Para acessar o portal do aluno <a href='https://".$config[0]['site']."/cursos/portais/login.php?app=1&mes=".$mes."&ano=".$ano."&".$tipo."=".$ValorTipo."&password=".EncryptSenha::B64_Decode($senhaAcesso)."'>clique aqui</a><p> A equipe da ".$config[0]['nomeEmpresa'].".</p>Atenciosamente,</p>";
          
            $assunto = "Preenchimento de folha de frequência";
			
			$mensagemCompleta = $msg . $msg2 .$msg3. $msg4 .$msg5 .$msg6 .$msg7;
			
			$mensagemCompleta .= $msg8;
			
			$mensagemCompleta .= "<p>Um abraço <br>
					Coordenação Pedagógica<br>";
           if(Uteis::verEmail($email)){
       
             $paraQuem = array("nome" => $nome, "email" => $email);           
			 $paraQuem1 = array("nome" => "Site", "email" => "envio@companhiadeidiomas.com.br");
             $rs1 = Uteis::enviarEmail($assunto, $mensagemCompleta, $paraQuem1);           
             $rs = Uteis::enviarEmail($assunto, $mensagemCompleta, $paraQuem);   
            }else{
             $arrayRetorno['mensagem'] = "Não foi possivel enviar Folha para ".$nome; 
            }
        }
        $arrayRetorno['mensagem'] = "Finalizado com sucesso";
	//	$arrayRetorno['atualizarNivelAtual'] = true;
                
    }else{
        
        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaParcial", 0);
        $arrayRetorno['mensagem'] = "Desfinalizado com sucesso";
        
    }
    
    $arrayRetorno['pagina'] = "modulos/ff/professor/folhaFrequencia_abas.php?idFolhaFrequencia=".$idFolhaFrequencia;
    $arrayRetorno['atualizarNivelAtual'] = true;
    
    
}elseif($_REQUEST['acao']=="finalizarProfessorPri"){
    
       
    //echo "//$idFolhaFrequencia";exit;
    $valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = ".$idFolhaFrequencia);
        $idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
        $idProfessor = $valorFolhaFrequencia[0]['professor_idProfessor'];
        $dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
            $data = explode("-",$dataReferencia);
                $mesRef = $data[1];
                $anoRef = $data[0];     
    
    $finalizar = $_REQUEST['finalizar'];

    if($finalizar){
        
        $rsOcorrenciaFF = $OcorrenciaFF->selectOcorrenciaFF(" WHERE reporAula = 1 ");
        $ocorrenciasValidas = Uteis::arrayCampoEspecifico($rsOcorrenciaFF, "idOcorrenciaFF");
        $ocorrenciasValidas = $ocorrenciasValidas ? implode(",", $ocorrenciasValidas) : "0";
        
        $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE ocorrenciaFF_idOcorrenciaFF IN (".$ocorrenciasValidas.") AND folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);          
        if($rsDiaAulaFF){           
            foreach($rsDiaAulaFF as $valorDiaAulaFF){               
                            
                $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
                $idOcorrenciaFF = $valorDiaAulaFF['ocorrenciaFF_idOcorrenciaFF'];
                    
                $horaRealizada = $valorDiaAulaFF['horaRealizada'];
                $dataAula = $valorDiaAulaFF['dataAula'];
                $idAulaPermanenteGrupo = $valorDiaAulaFF['aulaPermanenteGrupo_idAulaPermanenteGrupo'];
                $idAulaDataFixa = $valorDiaAulaFF['aulaDataFixa_idAulaDataFixa'];
                
                if($idAulaPermanenteGrupo){
                    $rsAula = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);
                }elseif($idAulaDataFixa){
                    $rsAula = $AulaDataFixa->selectAulaDataFixa(" AND idAulaDataFixa = ".$idAulaDataFixa);
                }
                                
                $horaInicio = $rsAula[0]['horaInicio'];
                $horaFim = $rsAula[0]['horaFim'];
                $horasAula = $horaFim - $horaInicio;
                
                $difHoras = $horasAula - $horaRealizada;
                            
                //BANCO DE HORAS
                if($difHoras > 0){
                    
                    $BancoHoras->setDiaAulaFFIdDiaAulaFF($idDiaAulaFF);
                    $BancoHoras->setHoras($difHoras);
                    
                    $dataAula = date('Y-m-d', strtotime('+3 months', strtotime($dataAula)));
                    $BancoHoras->setDataExpira($dataAula);
                    
                    $idBancoHoras = $BancoHoras->addBancoHoras();                                   
                }
            }
        }       
        
        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaPrincipal",1);
        
        $nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);  
		
		//Atualizando quadro do Banco de horas
		
		$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);
		
		 $where2 = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND PAG.idPlanoAcaoGrupo in (".$valorx2.") 
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1";
        //        AND FF.finalizadaPrincipal = 1
    $where2 .= "  INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.")";
		
		
		 $BancoHoras->selectBancoHorasTr($where2, true);
		                     
        $arrayRetorno['mensagem'] = "Finalizado[financeiro] com sucesso";
        
    }else{
        
        $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);
        foreach($rsDiaAulaFF as $valorDiaAulaFF){
            $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
            $BancoHoras->deleteBancoHoras(" OR diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF);
        }
        
        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaPrincipal", 0);
        $arrayRetorno['mensagem'] = "Desfinalizado[financeiro] com sucesso";
        
    }
     $arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
    $arrayRetorno['pagina'] = "modulos/ff/professor/folhaFrequencia_abas.php?idFolhaFrequencia=".$idFolhaFrequencia;
 //   $arrayRetorno['atualizarNivelAtual'] = true;
    
}

echo json_encode($arrayRetorno);
?>