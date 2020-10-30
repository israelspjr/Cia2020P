<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$BuscaProfessor = new BuscaProfessor();
$NaoFazAulaNestaSemanaGrupo = new NaoFazAulaNestaSemanaGrupo();
$Professor = new Professor();

$arrayRetorno = array();

$idAulaPermanenteGrupo = $_REQUEST['id'];
$atualizarDia = $_REQUEST['atualizarDia'];
$idAulaPermanenteGrupoA = $_REQUEST['idAulaPermanenteGrupo'];
$atualizar = $_POST['atualizar'];


if($_REQUEST['acao']=="deletar"){
	
	$motivo = $_REQUEST['motivo'];
$subMotivo = $_REQUEST['subMotivo'];
if ($subMotivo != '') {
$subMotivoOK = $subMotivo;	
}
$subMotivo2 = $_REQUEST['subMotivo2'];
if ($subMotivo2 != '') {
$subMotivoOK = $subMotivo2;	
}
	
	if( $_POST['reverter'] ){
		
		//VERIFCA SE ESTÁ NA BUSCA OU NA FF
		$sql = "SELECT DISTINCT(AP.idAulaPermanenteGrupo) FROM aulaPermanenteGrupo AS AP";
//		 INNER JOIN buscaProfessor AS BP ON BP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo 
	$sql .= "	 WHERE AP.idAulaPermanenteGrupo = $idAulaPermanenteGrupo ";
	//	echo $sql;
		$rs = Uteis::executarQuery($sql);
		
		if( !$rs ){
			
			$AulaPermanenteGrupo->setIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
			$AulaPermanenteGrupo->deleteAulaPermanenteGrupo();
			
			$arrayRetorno['mensagem'] = MSG_CADDEL;
			$arrayRetorno['fecharNivel'] = true;
			
		}else{
			$arrayRetorno['mensagem'] = "Não é possível reverter pois existe vínculo. Faça o desvínculo normal.";
		}
		
	}else{
	
		$dataFim = Uteis::gravarData($_POST['dataFim']);
			$mes = date('m', strtotime($dataFim));
			$ano = date('Y', strtotime($dataFim));
			
		$valorAulaPermanenteGrupo = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);
			$dataInicio = $valorAulaPermanenteGrupo[0]['dataInicio'];
			$idPlanoAcaoGrupo = $valorAulaPermanenteGrupo[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
			//echo "$idPlanoAcaoGrupo - $mes - $ano";exit;
			
		if($dataFim < $dataInicio ){
	
			$arrayRetorno['mensagem'] = "Data do desvinculo deve ser maior ou igual a ".Uteis::exibirData($dataInicio);
	
		}else{						
			
			//VERIFICA SE EXISTE FOLHA DE FREQUENCIA FINALIZADA PARA O PERIODO OU DEPOIS
			$sql = " SELECT SQL_CACHE idFolhaFrequencia FROM folhaFrequencia 
			WHERE dataReferencia >= '$ano-$mes-01' AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo 
			AND (finalizadaParcial = 1 OR finalizadaPrincipal = 1) AND professor_idProfessor IN( 
				SELECT DISTINCT(AGP.professor_idProfessor) FROM aulaGrupoProfessor AS AGP 
				WHERE AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo = $idAulaPermanenteGrupo 
			) ";
			 //echo $sql;
        //exit;
			$rsTemFF = Uteis::executarQuery($sql);
			if( $rsTemFF ){
				
				$arrayRetorno['mensagem'] = "Existem folhas finalizadas entre o período selecionado.
				<br /><small>Desfinalize as folhas antes de mudar a data de saída.</small>";
				
			}else{
				//DEFINE SAIDA DO PROFESSOR JUNTO DA SAIDA DO DIA PARA CONTROLE DE HISTÓRICO
				$atualiza = $_POST['atualiza'];
				
				$where = " WHERE (dataFim IS NULL OR dataFim > ".$dataFim.") AND aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo;
				$valorAulaGrupoProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);
				
				$dataFim2 = Uteis::gravarData(date('d/m/Y', strtotime("+1 days",strtotime($dataFim)))); 
				
				foreach($valorAulaGrupoProfessor as $valor){
					$AulaGrupoProfessor->setIdAulaGrupoProfessor($valor['idAulaGrupoProfessor']);
					$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("dataFim", $dataFim2);	
				
				}
				
				// Avisa Luanda
				$nomeProfessor = $Professor->getNome($valorAulaGrupoProfessor[0]['professor_idProfessor']);
				
				$idPlanoAcaoGrupo = $AulaPermanenteGrupo->getPlanoAcaoGrupo($valorAulaGrupoProfessor[0]['aulaPermanenteGrupo_idAulaPermanenteGrupo']);
				$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
				
				$assunto = "Professor desvinculado com sucesso!";
				
				$msg = "Nome do Professor: ".$nomeProfessor."<br>";
				$msg .= "Nome do grupo: ".$nomeGrupo;
				
				$paraQuem = array("nome" => "Luanda", "email" => "roselicampos@companhiadeidiomas.com.br");
				$rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
				
					
				$AulaPermanenteGrupo->setIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
				$AulaPermanenteGrupo->updateFieldAulaPermanenteGrupo("dataFim", $dataFim2);
				$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("motivo", $motivo);
       			$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("subMotivo", $subMotivoOK);
		
				//$AulaPermanenteGrupo->updateFieldAulaPermanenteGrupo("inativo", 1);
				$arrayRetorno['mensagem'] = "Desvinculado com sucesso";
				$arrayRetorno['fecharNivel'] = true;
				
				
				
			}
			
		}	
		
	}
	
}else{
	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	
	$dataInicio = Uteis::gravarData($_POST['dataInicio']);
	$dataFim = Uteis::gravarData($_POST['dataFim']);
	
	//echo "$dataFim";exit;
	$horaInicio = Uteis::gravarHoras($_POST['horaInicio']);
	$horaFim = Uteis::gravarHoras($_POST['horaFim']);
	
	$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	$dataInicioEstagio = $valorPlanoAcaoGrupo[0]['dataInicioEstagio'];
	
	if($dataInicioEstagio > $dataInicio){		
		$arrayRetorno['mensagem'] = "A data de inicio do dia deve ser maior ou igual a ".Uteis::exibirData($dataInicioEstagio).", que é a data de inicio do estagio";
	}elseif($dataFim && $dataInicio >= $dataFim){		
		$arrayRetorno['mensagem'] = "A data de inicio nao pode ser maior que data de fim.";
	}elseif($horaFim <= $horaInicio){		
		$arrayRetorno['mensagem'] = "A hora de fim nao pode ser maior nem igual a hora de inicio.";
	}else{
		
		$AulaPermanenteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
		$AulaPermanenteGrupo->setexibirDiaSemana($_POST['diaSemana']);
		$AulaPermanenteGrupo->setHoraInicio($horaInicio);
		$AulaPermanenteGrupo->setHoraFim($horaFim);	
		$AulaPermanenteGrupo->setDataInicio($dataInicio);
	//	if ($atualizar == 1) {
	//		$dataFimA = Uteis::gravarData(date('d/m/Y', strtotime("-1 days",strtotime($dataInicio))));
	//		$AulaPermanenteGrupo->setDataFim($dataFimA);
	//	} else {
			$AulaPermanenteGrupo->setDataFim($dataFim);	
	//	}
		$AulaPermanenteGrupo->setObs($_POST['obs']);
//		echo $atualizar;

$idLocalAula = $_POST['idLocalAula'];
$Endereco_novo = $_POST['endereco_novo'];
//echo $idLocalAula;
		
		 $AulaPermanenteGrupo->setLocalAulaIdLocalAula($idLocalAula);
		
if($idLocalAula == 1){
	$idEndereco = $idEndereco_aluno;
}elseif($idLocalAula == 2){
	$idEndereco = LOC_CIA;
}elseif($idLocalAula == 3){
	$idEndereco = $idEndereco_empresa;
}elseif($idLocalAula == 5){
	$idEndereco = P_TELEFONE;
}elseif($idLocalAula == 6){
	$idEndereco = P_SKYPE;
}elseif($idLocalAula == 8) {
	$array_endereco = explode(",",$Endereco_novo);
	if($array_endereco[0]!=""){
    $end = new Endereco();
    $end->setRua($array_endereco[0]);
	$end->setNumero($array_endereco[1]);
	$end->setCep($array_endereco[2]);
	$end->setComplemento($array_endereco[3]);
	$end->setPaisIdPais(33);
	$end->setPrincipal(1);
	$end->setidPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$idEndereco = $end->addEndereco();
	 }
}
	
	$AulaPermanenteGrupo->setEnderecoIdEndereco($idEndereco); 	
	
	 if ($atualizarDia != 1) {
	
		$idAulaPermanenteNova = $AulaPermanenteGrupo->addAulaPermanenteGrupo();
		
		//Setando semanas sem aulas
		
		$semana_1 = $_REQUEST['semana_1'];
		$semana_2 = $_REQUEST['semana_2'];
		$semana_3 = $_REQUEST['semana_3'];
		$semana_4 = $_REQUEST['semana_4'];
		
		$NaoFazAulaNestaSemanaGrupo->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAulaPermanenteNova);
		
		if ($semana_1 != '') {
			$NaoFazAulaNestaSemanaGrupo->setSemana(1);
			$NaoFazAulaNestaSemanaGrupo->addNaoFazAulaNestaSemanaGrupo();
			
		} 
		
		if ($semana_2 != '') { 
			$NaoFazAulaNestaSemanaGrupo->setSemana(2);		
     		$NaoFazAulaNestaSemanaGrupo->addNaoFazAulaNestaSemanaGrupo();
		}
		
		if ($semana_3 != '') {
			$NaoFazAulaNestaSemanaGrupo->setSemana(3);			
        	$NaoFazAulaNestaSemanaGrupo->addNaoFazAulaNestaSemanaGrupo();		
		} 
		
		if ($semana_4 != '') {
			$NaoFazAulaNestaSemanaGrupo->setSemana(4);			
     		$NaoFazAulaNestaSemanaGrupo->addNaoFazAulaNestaSemanaGrupo();	
		}
		
		//Criando Busca
				$BuscaProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAulaPermanenteNova);			
				$BuscaProfessor->setObs($_POST['obs']);
				$BuscaProfessor->setUrgente($_POST['urgente']);	
				$BuscaProfessor->setDataApartir($dataInicio);	
				$BuscaProfessor->setTipoBuscaIdTipoBusca($_POST['tipo']);			
				
				$BuscaProfessor->addBuscaProfessor();
				
				$arrayRetorno['mensagem'] = "Inserido na busca com sucesso.";
	//			$arrayRetorno['fecharNivel'] = true;
		
//		echo $idAulaPermanenteNova;
		$arrayRetorno['mensagem'] = MSG_CADNEW;
//}
	 } else {
	//	 echo $atualizar;
		 //Pega professor e outros dados e elimina a busca
		 $where = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupoA.  " AND dataFim is null";
			 $valorAulaGrupoProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);
			if ($atualizar == 1) {
			$dataFim1 = Uteis::gravarData(date('d/m/Y', strtotime("-1 days",strtotime($dataInicio))));
	//		echo $dataFim1;
		} else {
			$dataFim1 = Uteis::gravarData($_REQUEST['dataFim1']);
		}	 
	//		 $dataFim1 = Uteis::gravarData($_REQUEST['dataFim1']);
			 
		//	 $dataFimO = ($dataFimO);
			 
		 $AulaPermanenteGrupo->setIdAulaPermanenteGrupo($idAulaPermanenteGrupoA);
		 $AulaPermanenteGrupo->updateFieldAulaPermanenteGrupo("dataFim", $dataFim1);	
		 
		 // Desvincula professor data Antiga
		 $AulaGrupoProfessor->setIdAulaGrupoProfessor($valorAulaGrupoProfessor[0]['idAulaGrupoProfessor']);
		 $AulaGrupoProfessor->updateFieldAulaGrupoProfessor("dataFim", $dataFim1);
		 
		 //Cria a noVa data
	
//		 $AulaPermanenteGrupo->setIdAulaPermanenteGrupo($idAulaPermanenteGrupoA);
		 $idRs = $AulaPermanenteGrupo->AddAulaPermanenteGrupo();
		
		 $AulaGrupoProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idRs);
		 $AulaGrupoProfessor->setProfessorIdProfessor($valorAulaGrupoProfessor[0]['professor_idProfessor']);
		 $AulaGrupoProfessor->setPlano($valorAulaGrupoProfessor[0]['plano']);
		 $AulaGrupoProfessor->setDataInicio($dataInicio);
		 $AulaGrupoProfessor->setDataFim($dataFim);
		 $AulaGrupoProfessor->setTipoAulaGrupoProfessorIdTipoAulaGrupoProfessor($valorAulaGrupoProfessor[0]['tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor']);
		 $idAula =  $AulaGrupoProfessor->addAulaGrupoProfessor();
		
		 $arrayRetorno['mensagem'] = "Cadastro Atualizado com sucesso!";
	 }
		
		
		$arrayRetorno['fecharNivel'] = true;
	}
}

echo json_encode($arrayRetorno);

?>