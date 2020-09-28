<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DiaAulaFF = new DiaAulaFF();
$OcorrenciaFF = new OcorrenciaFF();
$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$FechamentoGrupo = new FechamentoGrupo();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();

$arrayRetorno = array();

$nomeCampo = $_REQUEST['nomeCampo'];
$idDiaAulaFF = $_REQUEST['idDiaAulaFF'];
$ccas = $_REQUEST['ccaspremitidos'];

$DiaAulaFF->setIdDiaAulaFF($idDiaAulaFF);

if($_POST['acao']=="deletar"){
	
	$idDiaAulaFF = $_REQUEST['id'];
	$DiaAulaFF->setIdDiaAulaFF($idDiaAulaFF);
	$DiaAulaFF->deleteDiaAulaFF();		
	
	$arrayRetorno['mensagem'] = "Cadastro deletado com sucessoo.";


//CADASTRO DE REPOSIÇÃO MANUAL
} elseif( $_REQUEST['acao'] == "aulaAut"){
		
		$idDiaAulaFF = $_REQUEST['idDiaAulaFF'];
		$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
		$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
		$dataAula = $_REQUEST['dataAula'];
		
		if( $idDiaAulaFF ){
				
			
			$diaAulaExibir = Uteis::exibirData($dataAula);
			
			//VERIFICA SE HA ALGUMA FREQUENCIA INDIVIDUAL JA PREENCHIDA PARA EXCLUIR
			$rsDiaAulaFFIndividual = $DiaAulaFFIndividual->selectDiaAulaFFIndividual(" WHERE diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF);	
			if($rsDiaAulaFFIndividual){
				foreach($rsDiaAulaFFIndividual as $valorDiaAulaFFIndividual){					
					$DiaAulaFFIndividual->setIdDiaAulaFFIndividual( $valorDiaAulaFFIndividual['idDiaAulaFFIndividual'] );			
					$DiaAulaFFIndividual->deleteDiaAulaFFIndividual();			
				}			
			}
			$idPlanoAcaoGrupo = $AulaPermanenteGrupo->getPlanoAcaoGrupo($idAulaPermanenteGrupo);
			$dataFechamentoTmp = $FechamentoGrupo->getDataFechamento($idPlanoAcaoGrupo);
			$dataFechamento = date("Y-m-d", strtotime($dataFechamentoTmp));
	//		echo $dataFechamento." --".$dataAula;
			if ($dataAula > $dataFechamento) {
	//			echo $dataFechamento." ".$dataAula;
				$aulaInexistente = $_POST['aulaInexistente'] ? "1" : "0";
				$DiaAulaFF->aulaInexistente($idDiaAulaFF, $aulaInexistente);
			}
			
	//			$arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
	//	$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia;	
	
		
		
		}else{
				
				
			$idPlanoAcaoGrupo = $AulaPermanenteGrupo->getPlanoAcaoGrupo($_POST['idAulaPermanenteGrupo']);
			$dataFechamentoTmp = $FechamentoGrupo->getDataFechamento($idPlanoAcaoGrupo);
			$dataFechamento = date("Y-m-d", strtotime($dataFechamentoTmp));
				
			$DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($idFolhaFrequencia);			
			$DiaAulaFF->setDataAula($dataAula);
			$DiaAulaFF->setHoraRealizada("0");
			$DiaAulaFF->setAulaPermanenteGrupoIdAulaPermanenteGrupo($_POST['idAulaPermanenteGrupo']);
			$DiaAulaFF->setAulaDataFixaIdAulaDataFixa($_POST['idAulaDataFixa']);
			//PRINCIPAL
			$DiaAulaFF->setAulaInexistente("1");	
		//	echo $dataFechamento." ---".$dataAula;			
			if ($dataAula > $dataFechamento) {
	//			echo $dataFechamento." ---".$dataAula;	
				$DiaAulaFF->addDiaAulaFF();
			}
		}
		
		$arrayRetorno['mensagem'] = "Dia alterado com sucesso $diaAulaExibir";
		
		$arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
		$arrayRetorno['pagina'] = "modulos/ff/form/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia."&naoAtualizarMais=1";	
	
		
		//print_r($_POST); 

//CADASTRO DE REPOSIÇÃO MANUAL
} elseif($_REQUEST['acao']=="reposicao"){
	
	$idDiaAulaFF = $_REQUEST['idDiaAulaFF'];
	$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];	
	$horasDadas = Uteis::gravarHoras($_REQUEST['horasDadas']);
	
	$DiaAulaFF->setIdDiaAulaFF($idDiaAulaFF);
	
	$DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($idFolhaFrequencia);
	$DiaAulaFF->setReposicao("1");
	$DiaAulaFF->setDataAula($_REQUEST['dataAula']);
	$DiaAulaFF->setHoraRealizada($horasDadas);		
	$DiaAulaFF->setObs($_REQUEST['obs']);
	
	if($idDiaAulaFF){
		
		//VERIFICA SE HA ALGUMA FREQUENCIA INDIVIDUAL JA PREENCHIDA E QUE SEJA MAIOR QUE O VALOR INSERIDO NA FREQUENCIA GERAL
		$rsDiaAulaFFIndividual = $DiaAulaFFIndividual->selectDiaAulaFFIndividual(" WHERE diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF);	
		if($rsDiaAulaFFIndividual){
			foreach($rsDiaAulaFFIndividual as $valorDiaAulaFFIndividual){
				$idDiaAulaFFIndividual = $valorDiaAulaFFIndividual['idDiaAulaFFIndividual'];
				$horaRealizadaAluno = $valorDiaAulaFFIndividual['horaRealizadaAluno'];
				if($horaRealizadaAluno && $horaRealizadaAluno > $horasDadas){
					$DiaAulaFFIndividual->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);
					$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("horaRealizadaAluno", $horasDadas);
				}
			}			
		}
		
		$DiaAulaFF->updateDiaAulaFF();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		
		$idDiaAulaFF = $DiaAulaFF->addDiaAulaFF();	
		$arrayRetorno['mensagem'] = "Cadastro efetuado com sucesso.";
		
	}
	
	$arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
	$arrayRetorno['pagina'] = "modulos/ff/professor/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia;	
//	$arrayRetorno['fecharNivel'] = true;
	
}elseif ($_REQUEST['acao']=="EditarConteudoAula") {
	
	$idDiaAulaFF = $_REQUEST['idDiaAulaFFIndividual'];
	$obs = $_REQUEST['justificaFalta'];
	$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
	
	$DiaAulaFF->setIdDiaAulaFF($idDiaAulaFF);
	$DiaAulaFF->updateFieldDiaAulaFF("obs", $obs);
	
	$arrayRetorno['mensagem'] = "Conteúdo cadastrado com sucesso.";
	$arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
	$arrayRetorno['pagina'] = "modulos/ff/professor/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia;


} else{
	
	$idFolhaFrequencia = $_POST['idFolhaFrequencia'];
	
	$horasDadas = Uteis::gravarHoras($_POST['horasDadas']);
	$horasTotal = $_POST['horasTotal'];
	$difHoras =  $horasTotal - $horasDadas;
	
	$DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($idFolhaFrequencia);	
	$DiaAulaFF->setDataAula($_POST['dataAula']);
	//$_->setDataCadastro( date('Y-m-d H:i:s') );
	
	$diaAulaExibir = Uteis::exibirData($_POST['dataAula']);
	
	if($difHoras >= 0){
	
		$DiaAulaFF->setHoraRealizada($horasDadas);		
	
	}else{	
		
		//INSERIR DIFERENÇA COMO REPOSIÇÃO		
		$DiaAulaFF->setHoraRealizada($difHoras * -1);	
		$DiaAulaFF->setReposicao("1");
		$idDiaAulaFF_rep = $DiaAulaFF->addDiaAulaFF();
		
		$arrayRetorno['addLinha'] = true;
		$arrayRetorno['class'] = "reposicao";
		$arrayRetorno['align'] = "center";
		$arrayRetorno['tabela'] = "#tb_lista_FolhaFrequencia_form";					
		
		$dia = date('d', strtotime($_POST['dataAula']));
		$diaDaSemana = getdate(strtotime($_POST['dataAula']));
		$conteudo = "<img src=\"".CAMINHO_IMG."excluir.png\" title=\"Excluir reposição\" 
		onclick=\"deletaRegistro('modulos/ff/professor/diaAulaFFAcao.php', '$idDiaAulaFF_rep', 'modulos/ff/form/folhaFrequencia.php?idFolhaFrequencia=$idFolhaFrequencia', '#div_ff_geral')\" />&nbsp;"
		.Uteis::exibirHoras(($difHoras * -1));
		
		$arrayRetorno['updateTr'] = array($dia, Uteis::exibirDiaSemana($diaDaSemana['wday']+1), "", "", $conteudo);
		
		$DiaAulaFF->setReposicao("0");
		$DiaAulaFF->setHoraRealizada($horasTotal);
	}	
	
	$DiaAulaFF->setAulaPermanenteGrupoIdAulaPermanenteGrupo($_POST['idAulaPermanenteGrupo']);
	$DiaAulaFF->setAulaDataFixaIdAulaDataFixa($_POST['idAulaDataFixa']);
	
	//VERIFICAR SE A DIFERENÇA NAS HORAS PARA SABER SE REALMENTE
	if($difHoras > 0){		
		
		$idOcorrenciaFF = $_POST['idOcorrenciaFF'];
         $oc = $DiaAulaFF->ContarOcorrencias("WHERE ocorrenciaFF_idOcorrenciaFF = 1 AND folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia);
        if($oc >= $ccas){            
            if($idOcorrenciaFF==1){
                $idOcorrenciaFF = 15;
            }
        }
     
		$DiaAulaFF->setOcorrenciaFFIdOcorrenciaFF($idOcorrenciaFF);		
		
		$res = $OcorrenciaFF->selectOcorrenciaFFSelect("", $idOcorrenciaFF, " AND professorVe = 1 ");
		$arrayRetorno['valor2'][0] = $res;
					
	}else{
		
		$arrayRetorno['valor2'][0] = "";		
		
		$arrayRetorno['valor'][] = Uteis::exibirHorasInput($horasTotal);
		$arrayRetorno['campoAtualizar'][] = "#horasDadas_".$nomeCampo;
	}
	
	$arrayRetorno['elementoAtualizar'][0] = "#div_ocorrencia_".$nomeCampo;
	
	if($idDiaAulaFF){						
		
		//VERIFICA SE HA ALGUMA FREQUENCIA INDIVIDUAL JA PREENCHIDA E QUE SEJA MAIOR QUE O VALOR INSERIDO NA FREQUENCIA GERAL
		$rsDiaAulaFFIndividual = $DiaAulaFFIndividual->selectDiaAulaFFIndividual(" WHERE diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF);	
		if($rsDiaAulaFFIndividual){
			foreach($rsDiaAulaFFIndividual as $valorDiaAulaFFIndividual){
				$idDiaAulaFFIndividual = $valorDiaAulaFFIndividual['idDiaAulaFFIndividual'];
				$horaRealizadaAluno = $valorDiaAulaFFIndividual['horaRealizadaAluno'];
				if($horaRealizadaAluno && $horaRealizadaAluno > $horasDadas){
					$DiaAulaFFIndividual->setIdDiaAulaFFIndividual($idDiaAulaFFIndividual);
					$DiaAulaFFIndividual->updateFieldDiaAulaFFIndividual("horaRealizadaAluno", $horasDadas);
				}
			}			
		}
		
		$DiaAulaFF->updateDiaAulaFF();
		//$arrayRetorno['mensagem'] = "Horas gravadas com sucesso ($diaAulaExibir). up";
		
	}else{								
	
		$idDiaAulaFF = $DiaAulaFF->addDiaAulaFF();
		$arrayRetorno['valor'][] = $idDiaAulaFF;
		$arrayRetorno['campoAtualizar'][] = "#idDiaAulaFF_".$nomeCampo;
		//$arrayRetorno['mensagem'] = "Horas gravadas com sucesso ($diaAulaExibir). add";		
				
	}
	
	$arrayRetorno['mensagem'] = "Horas gravadas com sucesso ($diaAulaExibir).";
	
}

echo json_encode($arrayRetorno);

?>
