<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$arrayRetorno = array();

$idIntegranteGrupo = $_REQUEST['integrante'];

  $IntegranteGrupo->setIdIntegranteGrupo($idIntegranteGrupo);
  $IntegranteGrupo->updateFieldIntegranteGrupo("dataSaida", $dataSaida);
  $IntegranteGrupo->updateFieldIntegranteGrupo("obs", $motivo);
  $IntegranteGrupo->updateFieldIntegranteGrupo("dataRetorno", $dataRetorno);
  $IntegranteGrupo->updateFieldIntegranteGrupo("dataSaidaDemonstrativo", $dataSaidaDemonstrativo);
  
	
	$arrayRetorno['mensagem'] = "Cadastro efetuado com sucesso".$obs;
	$arrayRetorno['atualizarNivelAtual'] = true;
	
	echo json_encode($arrayRetorno);

?>