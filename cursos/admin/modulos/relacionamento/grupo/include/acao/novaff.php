<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FolhaFrequencia = new FolhaFrequencia();

$arrayRetorno = array();

if($_POST['acao']=="deletar"){

	/*$idFolhaFrequencia = $_REQUEST['id'];
	$FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
	$FolhaFrequencia->deleteFolhaFrequencia();
	$arrayRetorno['mensagem'] = MSG_CADDEL;

	echo json_encode($arrayRetorno);*/
	
}else{
	
	
	$idPlanoAcaoGrupo = $_REQUEST['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$idProfessor = $_REQUEST['idProfessor'];
	$mes = $_REQUEST['mes'];
	$ano = $_REQUEST['ano'];
	
	$rs = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND professor_idProfessor = $idProfessor AND dataReferencia = '$ano-$mes-01' ");
			
	if( !$rs ){
		
		$FolhaFrequencia->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);	
		$FolhaFrequencia->setProfessorIdProfessor($idProfessor);	
		$FolhaFrequencia->setDataReferencia("$ano-$mes-01");
			
		$FolhaFrequencia->addFolhaFrequencia();
		
		$periodo = new PeriodoAcompanhamentoCurso();
        $p = $periodo->selectPeriodoAcompanhamentoCurso("WHERE mes = $mes AND ano = $ano");
        $novo = new AcompanhamentoCurso();
        $novo->setPeriodoAcompanhamentoCursoIdPeriodoAcompanhamentoCurso($p[0]['idPeriodoAcompanhamentoCurso']);
        $novo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
        $novo->setProfessorIdProfessor($idProfessor);
        $rs = $novo->addAcompanhamentoCurso();   
					
		$arrayRetorno['mensagem'] = "Nova folha de frequencia gerada com sucesso";
		$arrayRetorno['fecharNivel'] = true;
			
	}else{
		
		$arrayRetorno['mensagem'] = "Esta folha de frequencia ja existe, escolha outros valores";
		
	}
		
}

echo json_encode($arrayRetorno);
?>