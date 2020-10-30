<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaGrupoProfessor = new AulaGrupoProfessor();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();

$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
$idProfessor = $_REQUEST['idProfessor'];
$valorHora = str_replace(",",".", $_REQUEST['valorHora']);
if ($_REQUEST['dataInicio'] != '') {
	
$dataInicio = Uteis::gravarData($_REQUEST['dataInicio']);

}



if ($idAulaPermanenteGrupo > 0) {
	$and = 	" AND aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo;

$where = " WHERE professor_idProfessor = ".$idProfessor. $and;

$rs = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);

$idAulaGrupoProfessor = $rs[0]['idAulaGrupoProfessor']; 



}
$idAulaFixa = $_REQUEST['idAulaFixa'];
if ($idAulaFixa > 0) {
	$and = 	" AND aulaDataFixa_idAulaDataFixa = ".$idAulaFixa;

$where = " WHERE professor_idProfessor = ".$idProfessor. $and;

$rs = $AulaGrupoProfessor->selectAulaGrupoProfessor($where);

$idAulaGrupoProfessor = $rs[0]['idAulaGrupoProfessor']; 

$AulaGrupoProfessor->setIdAulaGrupoProfessor($idAulaGrupoProfessor);
$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("plano", Uteis::gravarMoeda($valorHora)); 
}


if ($_REQUEST['dataInicio'] == '') {
$AulaGrupoProfessor->setIdAulaGrupoProfessor($idAulaGrupoProfessor);
$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("plano", Uteis::gravarMoeda($valorHora)); 

} else {

//Criar AulapermanenteGrupo
//Finalizar a aulapermanente antigo
$dataFim = Uteis::gravarData($_REQUEST['dataInicio']);
// $dataFim = date("Y-m-d", strtotime("-1 days", strtotime($_REQUEST['dataInicio'])));
 
 $AulaPermanenteGrupo->setIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
 $AulaPermanenteGrupo->updateFieldAulaPermanenteGrupo("dataFim", $dataFim);

$valorAPG = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);

$AulaPermanenteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($valorAPG[0]['planoAcaoGrupo_idPlanoAcaoGrupo']);
$AulaPermanenteGrupo->setexibirDiaSemana($valorAPG[0]['diaSemana']);
$AulaPermanenteGrupo->setHoraInicio($valorAPG[0]['horaInicio']);
$AulaPermanenteGrupo->setHoraFim($valorAPG[0]['horaFim']);
$AulaPermanenteGrupo->setObs($valorAPG[0]['obs']);
$AulaPermanenteGrupo->setDataInicio($valorAPG[0]['dataInicio']);
//$AulaPermanenteGrupo->setDataFim($valorAPG[0]['dataFim']);
$AulaPermanenteGrupo->setLocalAulaIdLocalAula($valorAPG[0]['localAula_idLocalAula']);
$AulaPermanenteGrupo->setEnderecoIdEndereco($valorAPG[0]['endereco_idEndereco']);
$AulaPermanenteGrupo->setInativo(0);

$novoIdAPG = $AulaPermanenteGrupo->addAulaPermanenteGrupo();
//Criar aulaProfessorGrupo	

$valorAPG = $AulaGrupoProfessor->selectAulaGrupoProfessor(" WHERE idAulaGrupoProfessor = ".$idAulaGrupoProfessor);
// Desativar AulaProfessor
$AulaGrupoProfessor->setIdAulaGrupoProfessor($valorAPG[0]['idAulaGrupoProfessor']);
$AulaGrupoProfessor->updateFieldAulaGrupoProfessor("dataFim", $dataFim);

$AulaGrupoProfessor->setIdAulaGrupoProfessor();

$AulaGrupoProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($novoIdAPG);
$AulaGrupoProfessor->setProfessorIdProfessor($valorAPG[0]['professor_idProfessor']);
$AulaGrupoProfessor->setDataInicio($dataInicio);
$AulaGrupoProfessor->setTipoAulaGrupoProfessorIdTipoAulaGrupoProfessor($valorAPG[0]['tipoAulaGrupoProfessor_idTipoAulaGrupoProfessor']);
$AulaGrupoProfessor->setMotivo("Mudança no valor do plano");
$AulaGrupoProfessor->setPlano(Uteis::gravarMoeda($valorHora));

$AulaGrupoProfessor->addAulaGrupoProfessor();
	
}


$arrayRetorno['mensagem'] = "Novo valor hora adicionado para esta aula."; 
$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);

?>