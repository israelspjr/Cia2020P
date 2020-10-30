<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$CalendarioProva = new CalendarioProva();
$arrayRetorno = array();

$idCalendarioProva = $_REQUEST['id'];

if($_POST['acao']=="deletar"){
	
	$CalendarioProva->setIdCalendarioProva($idCalendarioProva);
	$CalendarioProva->deleteCalendarioProva();
	$arrayRetorno['mensagem'] = MSG_CADDEL;

}else{
		
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

	$CalendarioProva->setIdCalendarioProva($idCalendarioProva);
	$CalendarioProva->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);	
	
	$CalendarioProva->setProvaIdProva($_POST['idProva']);	
	$CalendarioProva->setDataPrevistaInicial(Uteis::gravarData($_POST['dataPrevistaInicial']));	
	$CalendarioProva->setDataPrevistaNova(Uteis::gravarData($_POST['dataPrevistaNova']));	
	$CalendarioProva->setDataAplicacao(Uteis::gravarData($_POST['dataAplicacao']));	
	$CalendarioProva->setObs($_POST['obs']);	
	$dataValidacao = date("d/m/Y");
	$CalendarioProva->setValidacao(Uteis::gravarData($dataValidacao));
	
	$CalendarioProva->setProvaOn($_POST['provaOn']);
	
	$codLiberacao = ($_POST['codLiberacao']);
		
		if ($codLiberacao == '') {
		$codLiberacao = Uteis::criarCode();	
					
		}
		


	$CalendarioProva->setCodLiberacao($codLiberacao);	
		
	if($idCalendarioProva != "" && $idCalendarioProva > 0 ){
		$CalendarioProva->updateCalendarioProva();
		$arrayRetorno['mensagem'] = "Prova atualizada com sucesso";
		
	}else{
		$idCalendarioProva= $CalendarioProva->addCalendarioProva();
		$arrayRetorno['mensagem'] = "Prova adicionada com sucesso";
		
	}
	
//	$arrayRetorno['fecharNivel'] = true;
		
}

echo json_encode($arrayRetorno);

?>