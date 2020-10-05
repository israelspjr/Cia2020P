<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$AcompanhamentoCurso = new AcompanhamentoCurso();	
$IntegranteGrupo = new IntegranteGrupo();
$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$idProfessor = $_GET['idProfessor'];
$idPeriodoAcompanhamentoCurso = $_GET['idPeriodoAcompanhamentoCurso'];
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];


$dataReferencia = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE idPeriodoAcompanhamentoCurso = ".$idPeriodoAcompanhamentoCurso);
$dataReferencia = $dataReferencia[0]['ano']."-".$dataReferencia[0]['mes']."-01";

//Buscar se já existe
$rsAcomapanhamentoCurso = $AcompanhamentoCurso->selectAcompanhamentoCurso("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND professor_idProfessor = ".$idProfessor." AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = ".$idPeriodoAcompanhamentoCurso. " AND (arquivado = 0 OR arquivado is null) LIMIT 1");

if(count($rsAcomapanhamentoCurso) > 0){
//se sim pegar dados
	$idAcompanhamentoCurso = $rsAcomapanhamentoCurso[0]['idAcompanhamentoCurso'];
	
	$obs = $rsAcomapanhamentoCurso[0]['obs'];
	
	$finalizadoParcial = $rsAcomapanhamentoCurso[0]['finalizadoParcial'];
	$finalizadoGeral = $rsAcomapanhamentoCurso[0]['finalizadoGeral'];
	
}else{
// se nao cadastrar

	$AcompanhamentoCurso->setProfessorIdProfessor($idProfessor);
	$AcompanhamentoCurso->setPeriodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso($idPeriodoAcompanhamentoCurso);
	$AcompanhamentoCurso->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$AcompanhamentoCurso->setObs("");
	$AcompanhamentoCurso->setFinalizadoParcial("0");
	$AcompanhamentoCurso->setFinalizadoGeral("0");
	$AcompanhamentoCurso->setArquivado("0");
	$obs = "";
	
	$finalizadoParcial = 0;
	$finalizadoGeral=0;
	
	$idAcompanhamentoCurso = $AcompanhamentoCurso->addAcompanhamentoCurso();
	
}

$mostrarAcoes = $AcompanhamentoCurso->verificaPodeEditar($idAcompanhamentoCurso);

$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);
?>

<div id="cadastro_acompanhamento" class="">
     <div class="linha-inteira">
        <?php require_once 'relatorioDesempenho.php'?>
      </div>      
    </div>
<!--  </div>
</div>-->