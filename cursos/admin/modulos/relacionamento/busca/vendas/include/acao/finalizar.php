<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaProfessor = new BuscaProfessor();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();

$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$data = Uteis::gravarData($_REQUEST['data']);
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
//echo "teste".$idPlanoAcaoGrupo;

$caminho = CAMINHO_REL."grupo/include/resourceHTML/aulaPermanenteGrupo.php?id=$idPlanoAcaoGrupo";

//BUSCA PROFESSOR
$valorBuscaProfessor = $BuscaProfessor->selectBuscaProfessor(" WHERE idBuscaProfessor = ".$idBuscaProfessor);
$valorBuscaProfessor = $valorBuscaProfessor[0];

$idAulaPermanenteGrupo = $valorBuscaProfessor['aulaPermanenteGrupo_idAulaPermanenteGrupo'];
$idAulaDataFixa = $valorBuscaProfessor['aulaDataFixa_idAulaDataFixa'];

$continua = true;
$obs = "";
		
if($idAulaPermanenteGrupo){	
	
	//VERIFICAR SE DATA DE INICIO DO PROFESSOR SE ENCAIXA NAS DATAS INCIO E FIM DO DIA
	$valorAulaPermanenteGrupo = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);	
	if($valorAulaPermanenteGrupo){			
	$idPlanoAcaoGrupo = $valorAulaPermanenteGrupo['planoAcaoGrupo_idPlanoAcaoGrupo'];	
		
		$dataFim = $valorAulaPermanenteGrupo[0]['dataFim'];	
		if($dataFim) $obs = "<br /><small>A data de saida desse professor foi inserida pois a data de saida do dia ja esta programada.</small>";
		$dataInicio = $valorAulaPermanenteGrupo[0]['dataInicio'];		
		
		if($data < $dataInicio){
			$continua = false;
			$arrayRetorno['mensagem'] = "Data de inicio deve ser maior ou igual a ".Uteis::exibirData($dataInicio);
		}elseif($dataFim && $data > $dataFim){
			$continua = false;
			$arrayRetorno['mensagem'] = "Data de inicio deve ser menor ou igual a ".Uteis::exibirData($dataFim);
		}
	}	
	
	//VERIFICAR SE JA EXISTE PROFESSOR PARA O PERIODO DE INICIO
	$where = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo." AND '".$data."' BETWEEN dataInicio AND dataFim ";		
	$valorAulaGrupoProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);		
	
	if($continua && $valorAulaGrupoProfessor){	
		$continua = false;							
		$arrayRetorno['mensagem'] = "Ja esxiste um professor para aulas nesse periodo.<br/><small>Escolha uma data para inicio que nao esteja entre <strong>".Uteis::exibirData($valorAulaGrupoProfessor[0]['dataInicio'])."</strong> e <strong>".Uteis::exibirData($valorAulaGrupoProfessor[0]['dataFim'])."</strong></small>";
	}
	
}elseif($idAulaDataFixa){	

	$valorAulaDataFixa = $AulaDataFixa->selectAulaDataFixa(" AND idAulaDataFixa = ".$idAulaDataFixa);
	$dataFim = $valorAulaDataFixa[0]['dataAula'];
	$data = $dataFim;
	
}
	
if($continua){

	// OPCAO BUSCA
	$valorOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada(" WHERE aceito = 1 AND buscaProfessor_idBuscaProfessor = ".$idBuscaProfessor);	
	$idProfessor = $valorOpcaoBuscaProfessorSelecionada[0]['professor_idProfessor'];
	$valorHora = $valorOpcaoBuscaProfessorSelecionada[0]['valorHora'];
	
	$AulaGrupoProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
	$AulaGrupoProfessor->setAulaDataFixaIdAulaDataFixa($idAulaDataFixa);
	$AulaGrupoProfessor->setProfessorIdProfessor($idProfessor);
	$AulaGrupoProfessor->setDataInicio($data);
	$AulaGrupoProfessor->setPlano($valorHora);
		
	//SE ESTIVER PREVISTO A DATA DE SAIDA DO DIA, DEVE INSERIR O PROFESSOR COM A MESMA DATA DE SAIDA
	if($idAulaPermanenteGrupo){	
		$where = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo." AND dataInicio >= '".$data."' ";		
		$valorAulaGrupoProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);	
		if($valorAulaGrupoProfessor){
			$dataFim = date('Y-m-d', strtotime("-1 days", strtotime($valorAulaGrupoProfessor[0]['dataInicio'])));
			$obs = "<br /><small>A data de saida desse professor foi programada para ".Uteis::exibirData($dataFim)." pois ja existe um professor com inicio programado para o dia ".Uteis::exibirData($valorAulaGrupoProfessor[0]['dataInicio'])."</small>";
		}
	}
	
	if($dataFim) $AulaGrupoProfessor->setdataFim($dataFim);
	
	
	$AulaGrupoProfessor->setTipoAulaGrupoProfessorIdTipoAulaGrupoProfessor("1");	
	
	$AulaGrupoProfessor->addAulaGrupoProfessor();
	
	//FINALIZA A BUSCA
	$BuscaProfessor->setIdBuscaProfessor($idBuscaProfessor);
	$BuscaProfessor->updateFieldBuscaProfessor("finalizada","1");
	
	if($idAulaPermanenteGrupo){
		
		if ($idPlanoAcaoGrupo > 0) {
			$arrayRetorno['mensagem'] = "Professor inserido com sucesso! Feche a aba caso não apareça.".$obs;
		} else {
			$arrayRetorno['mensagem'] = "Finalizado com sucesso.".$obs;	
		}
		
		$arrayRetorno['fecharNivel'] = true;	
		$arrayRetorno['ondeAtualizar'] = "#div_aulaPermanenteGrupo";		
		$arrayRetorno['pagina'] = $caminho;

	}else{
		$arrayRetorno['mensagem'] = "Finalizado com sucesso!";
		
		$arrayRetorno['ondeAtualizar'] = "tr";		
		$arrayRetorno['pagina'] = $_REQUEST['caminhoAtualizar'];
	}
	
}

echo json_encode($arrayRetorno);

?>
