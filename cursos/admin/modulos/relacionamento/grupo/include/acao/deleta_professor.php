<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaGrupoProfessor = new AulaGrupoProfessor();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();		

$arrayRetorno = array();

$idAulaGrupoProfessor = $_REQUEST['id'];
$dataFim = Uteis::gravarData( $_REQUEST['dataFim'] );
$motivo = $_REQUEST['motivo'];
$subMotivo = $_REQUEST['subMotivo'];
if ($subMotivo != '') {
$subMotivoOK = $subMotivo;	
}
$subMotivo2 = $_REQUEST['subMotivo2'];
if ($subMotivo2 != '') {
$subMotivoOK = $subMotivo2;	
}

$obs = "";

$AulaGrupoProfessor->setIdAulaGrupoProfessor($idAulaGrupoProfessor);

if($_REQUEST['acao2']=="AulaDataFixa"){
	
	$sql = "SELECT DISTINCT(FF.idFolhaFrequencia), CONCAT(MONTH(FF.dataReferencia), '/', YEAR(FF.dataReferencia)) AS data
	FROM aulaGrupoProfessor AS AGP 
	LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo  = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo 
	LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa  = AGP.aulaDataFixa_idAulaDataFixa 
	INNER JOIN diaAulaFF AS DFF ON 
		(DFF.aulaDataFixa_idAulaDataFixa = AP.idAulaPermanenteGrupo OR DFF.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa)
	INNER JOIN folhaFrequencia AS FF ON 
		FF.idFolhaFrequencia = DFF.folhaFrequencia_idFolhaFrequencia AND (FF.finalizadaParcial = 1 OR FF.finalizadaPrincipal = 1)
	WHERE AGP.idAulaGrupoProfessor = $idAulaGrupoProfessor";
	$rs = Uteis::executarQuery($sql);
	//print_r($rs);
	if( $rs ){
		$arrayRetorno['mensagem'] = "Não é possível excluir, pois existe vinculo.<br />
		<small>Folha de frequência de ".$rs[0]['data']."</small>";		
	}else{
		$AulaGrupoProfessor->deleteAulaGrupoProfessor();
		$arrayRetorno['mensagem'] = "Excluido com sucesso";
	}

}else{
	
	$valorAulaGrupoProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor(" WHERE idAulaGrupoProfessor = ".$idAulaGrupoProfessor);
	$dataInicio = $valorAulaGrupoProfessor[0]['dataInicio'];
	$idAulaPermanenteGrupo = $valorAulaGrupoProfessor[0]['aulaPermanenteGrupo_idAulaPermanenteGrupo'];
	$idPlanoAcaoGrupo = $valorAulaGrupoProfessor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$nomeGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);
	
	
	if($dataFim < $dataInicio ){			
		$arrayRetorno['mensagem'] = "Data do desvinculo deve ser maior que ".Uteis::exibirData($dataInicio);		
	}else{		
					
		$where = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo;
		$where .= " AND idAulaGrupoProfessor NOT IN(".$idAulaGrupoProfessor.") AND ('".$dataFim."' <= dataFim OR '".$dataFim."' BETWEEN dataInicio AND dataFim )";		
		$valorAulaGrupoProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);		
		
		if($valorAulaGrupoProfessor){														
			$arrayRetorno['mensagem'] = "Ja esxiste um professor para aulas nesse periodo.<br/><small>Escolha uma data para saida que seja menor que <strong>".Uteis::exibirData($valorAulaGrupoProfessor[0]['dataInicio'])."</strong></small>";	
		}else{							
	
			$valorAulaPermanenteGrupo = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);
			$dataFim_dia = $valorAulaPermanenteGrupo[0]['dataFim']; 
			
			if($dataFim_dia && $dataFim > $dataFim_dia){ 			
				$obs = "<br /><small> O desvinculo deste dia ja esta programado para ".Uteis::exibirData($dataFim_dia).", como voce entrou com uma data maior para o desvinculo do professor o sistema registrou a data correta.</small>";
				$dataFim = $dataFim_dia;
			}
			
			$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("dataFim", $dataFim);		
			$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("motivo", $motivo);
			$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("subMotivo", $subMotivoOK);
			
			$msg .= "Professor desvinculado do grupo ".$nomeGrupo."<br>Data: ".$dataFim."<br>Motivo: ".$motivo."<br>SubMotivo: ".$subMotivoOK;
			$assunto = "Professor desvinculado";
			  $paraQuem1 = array("nome" => "Site", "email" => "roselicampos@companhiadeidiomas.com.br");
                    $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem1);
			//		Uteis::pr($rs);
			
			
			$arrayRetorno['mensagem'] = "Desvinculado com sucesso.".$obs;		
			$arrayRetorno['fecharNivel'] = true;
		}
	}
}

echo json_encode($arrayRetorno);

?>	