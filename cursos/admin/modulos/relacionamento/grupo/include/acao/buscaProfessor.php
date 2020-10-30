<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaProfessor = new BuscaProfessor();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$AulaGrupoProfessor = new AulaGrupoProfessor();

$arrayRetorno = array();

if($_REQUEST['acao']=="deletar"){
			
}else{
	
	$dataInicio = Uteis::gravarData($_REQUEST['dataInicio']);	
	
	$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
	$idAulaDataFixa = $_REQUEST['idAulaDataFixa'];
	
	if($idAulaPermanenteGrupo){
		
		$valor = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);
		$dataInicio_dia = $valor[0]['dataInicio']; 
		$dataFim_dia = $valor[0]['dataFim']; 
		$idPlanoAcaoGrupo = $valor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];		
		
		if($dataInicio_dia && $dataInicio < $dataInicio_dia){
			$arrayRetorno['mensagem'] = "O dia para inicio do professor deve ser maior ou igual a ".Uteis::exibirData($dataInicio_dia);
		}elseif($dataFim_dia && $dataInicio > $dataFim_dia){
			$arrayRetorno['mensagem'] = "O dia para inicio do professor deve ser menor ou igual a ".Uteis::exibirData($dataFim_dia);
		}else{								
			$where = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo." AND '".$dataInicio."' BETWEEN dataInicio AND dataFim ";		
			$valorAulaGrupoProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);		
			//echo $where;exit;
			
			if($valorAulaGrupoProfessor){								
				$arrayRetorno['mensagem'] = "Ja esxiste um professor para aulas nesse periodo.<br/><small>Escolha uma data para inicio que nao esteja entre <strong>".Uteis::exibirData($valorAulaGrupoProfessor[0]['dataInicio'])."</strong> e <strong>".Uteis::exibirData($valorAulaGrupoProfessor[0]['dataFim'])."</strong></small>";
			}else{			
			
				$BuscaProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAulaPermanenteGrupo);			
				$BuscaProfessor->setObs($_POST['obs']);
				$BuscaProfessor->setUrgente($_POST['urgente']);	
				$BuscaProfessor->setDataApartir($dataInicio);	
				$BuscaProfessor->setTipoBuscaIdTipoBusca($_POST['tipo']);			
				
				$BuscaProfessor->addBuscaProfessor();
				
				$arrayRetorno['mensagem'] = "Inserido na busca com sucesso.";
				$arrayRetorno['fecharNivel'] = true;
				$arrayRetorno['pagina'] = CAMINHO_REL . "grupo/cadastro.php?id=$idPlanoAcaoGrupo";
			}
		}
	}elseif($idAulaDataFixa){
		
		$BuscaProfessor->setAulaDataFixaIdAulaDataFixa($idAulaDataFixa);			
		$BuscaProfessor->setObs($_POST['obs']);
		$BuscaProfessor->setUrgente($_POST['urgente']);	
		$BuscaProfessor->setDataApartir($dataInicio);	
		$BuscaProfessor->setTipoBuscaIdTipoBusca($_POST['tipo']);	
				
		$BuscaProfessor->addBuscaProfessor();
		
		$arrayRetorno['mensagem'] = "Inserido na busca com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

echo json_encode($arrayRetorno);

?>