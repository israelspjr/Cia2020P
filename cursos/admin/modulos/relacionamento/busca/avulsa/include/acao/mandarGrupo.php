<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$DiasBuscaAvulsa = new DiasBuscaAvulsa();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaGrupoProfessor = new AulaGrupoProfessor();
$DiasBuscaAvulsaProfessor = new DiasBuscaAvulsaProfessor();

$arrayRetorno = array();

$idBuscaAvulsa = $_REQUEST['idBuscaAvulsa'];

$rs = $BuscaAvulsa->selectBuscaAvulsa( "WHERE idBuscaAvulsa = ".$idBuscaAvulsa);


//Pode ter uma data ou mais

$rsD = $DiasBuscaAvulsa->selectDiasBuscaAvulsa(" WHERE buscaAvulsa_idBuscaAvulsa = ".$idBuscaAvulsa);

$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($rs[0]['grupo_idGrupo']);


// Adicionar AulaPermanenteGrupo
foreach ($rsD as $valor) {


$AulaPermanenteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
$AulaPermanenteGrupo->setexibirDiaSemana($valor['diaSemanaAula']);
$AulaPermanenteGrupo->setHoraInicio($valor['horaInicio']);
$AulaPermanenteGrupo->setHoraFim($valor['horaFim']);
$AulaPermanenteGrupo->setDataInicio($rs[0]['dataApartir']);
$AulaPermanenteGrupo->setObs($valor['obs']);

$idAulaPermanenteGrupo = $AulaPermanenteGrupo->addAulaPermanenteGrupo();


//Adicionar AulaGrupoProfessor
$rsP = $DiasBuscaAvulsaProfessor->selectDiasBuscaAvulsaProfessor( " WHERE diasBuscaAvulsa_idDiasBuscaAvulsa = ".$valor['idDiasBuscaAvulsa']." AND escolhido = 1");

$AulaGrupoProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
$AulaGrupoProfessor->setProfessorIdProfessor($rsP[0]['professor_idProfessor']);
$AulaGrupoProfessor->setDataInicio($rs[0]['dataApartir']);
$AulaGrupoProfessor->setTipoAulaGrupoProfessorIdTipoAulaGrupoProfessor(1);
$AulaGrupoProfessor->setPlano($rsP[0]['valorHora']);

$AulaGrupoProfessor->addAulaGrupoProfessor();
	
}


		$arrayRetorno['mensagem'] = "Busca avulsa inserida no grupo com sucesso";


	$arrayRetorno['atualizarNivelAtual'] = true;
//	$arrayRetorno['pagina'] =  CAMINHO_REL."busca/avulsa/include/form/avulsa.php?id=$idBuscaAvulsa";


echo json_encode($arrayRetorno);

?>