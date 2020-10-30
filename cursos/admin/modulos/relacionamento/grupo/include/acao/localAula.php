<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$AulaDataFixa = new AulaDataFixa();

$arrayRetorno = array();

$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
$idAulaDataFixa = $_REQUEST['idAulaDataFixa'];
$idPlanoAcaoGrupo =  $_REQUEST['idPlanoAcaoGrupo'];

$idLocalAula =  $_REQUEST['idLocalAula'];
$idEndereco_aluno =  $_REQUEST['idEndereco'];
$idEndereco_empresa =  $_REQUEST['idEndereco_empresa'];
$Endereco_novo =  $_REQUEST['endereco_novo'];


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
}else{
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

if($idAulaDataFixa!=""):
  $AulaDataFixa->setIdAulaDataFixa($idAulaDataFixa);
  $AulaDataFixa->updateFieldAulaDataFixa("localAula_idLocalAula", $idLocalAula);
  $AulaDataFixa->updateFieldAulaDataFixa("endereco_idEndereco", $idEndereco);
  
  $arrayRetorno['mensagem'] = "Endereço Salvo com Sucesso";
  $arrayRetorno['fecharNivel'] = true;
  echo json_encode($arrayRetorno);		  
endif;
    
if($idAulaPermanenteGrupo!=""):
   $AulaPermanenteGrupo->setIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
   $AulaPermanenteGrupo->updateFieldAulaPermanenteGrupo("localAula_idLocalAula", $idLocalAula);
   $AulaPermanenteGrupo->updateFieldAulaPermanenteGrupo("endereco_idEndereco", $idEndereco);
   $arrayRetorno['mensagem'] = "Endereço Salvo com Sucesso";
   $arrayRetorno['fecharNivel'] = true;
	echo json_encode($arrayRetorno);
endif;            