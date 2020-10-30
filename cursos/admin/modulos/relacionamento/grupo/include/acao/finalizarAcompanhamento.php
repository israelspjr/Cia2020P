<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AcompanhamentoCurso.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IntegranteGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PeriodoAcompanhamentoCurso.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenRelatorioDesempenho.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelatorioDesempenho.class.php");

	
$AcompanhamentoCurso = new AcompanhamentoCurso();	
$IntegranteGrupo = new IntegranteGrupo();
$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
$ItenRelatorioDesempenho = new ItenRelatorioDesempenho();
$RelatorioDesempenho = new RelatorioDesempenho();

$idAcompanhamentoCurso = $_REQUEST['id'];

$arrayRetorno = array();
$atualizarNivelAtual = CAMINHO_REL."grupo/include/resourceHTML/itemAcompanhamento.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idProfessor=".$idProfessor."&idPeriodoAcompanhamentoCurso=".$idPeriodoAcompanhamentoCurso;

if($_REQUEST['acao']=="finalizadoParcial"){
	
	//verificar notas dos alunos
	
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$idPeriodoAcompanhamentoCurso = $_REQUEST['idPeriodoAcompanhamentoCurso'];
	
	$dataReferencia = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE idPeriodoAcompanhamentoCurso = ".$idPeriodoAcompanhamentoCurso);
	$dataReferencia = $dataReferencia[0]['ano']."-".$dataReferencia[0]['mes']."-01";
	
	$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupoFF($idPlanoAcaoGrupo, $dataReferencia);
	
	$notas = true;	
	foreach($rsIntegranteGrupo as $aluno){
		if( !$notas ) break;
		$idIntegranteGrupo = $aluno['idIntegranteGrupo'];
		
		$rsItenRelatorioDesempenho = $ItenRelatorioDesempenho->selectItenRelatorioDesempenho(" WHERE inativo = 0 ");
		foreach($rsItenRelatorioDesempenho as $iten){
			$idItenRelatorioDesempenho = $iten['idItenRelatorioDesempenho'];
			
			$rsRelatorioDesempenho = $RelatorioDesempenho->selectRelatorioDesempenho(" WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo 
			AND itenRelatorioDesempenho_idItenRelatorioDesempenho = $idItenRelatorioDesempenho 
			AND acompanhamentoCurso_idAcompanhamentoCurso = $idAcompanhamentoCurso AND nota IS NOT NULL");
			
			if( !$rsRelatorioDesempenho ){
				$notas = false;
				
				$nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
				$nomeItem = $ItenRelatorioDesempenho->getNome($idItenRelatorioDesempenho);
				
				$msgErro = "Preencha a nota do item \"$nomeItem\" no relatório de desempenho do aluno $nomeAluno.";
				break;
			}
		}
	}		
				
	//verificar se tem um revisaoVPG
	$sql = "SELECT SQL_CACHE idRevisaoVPG FROM revisaoVPG WHERE acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso;
	$rs2 = $AcompanhamentoCurso->query($sql);
	
	//verificar se tem um acompanhamentoMaterial
	$sql = "SELECT SQL_CACHE idAcompanhamentoMaterial FROM acompanhamentoMaterial WHERE acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso;
	$rs3 = $AcompanhamentoCurso->query($sql);
	
	//verificar se tem um variedadeRecurso
	$sql = "SELECT SQL_CACHE idVariedadeRecurso FROM variedadeRecurso WHERE acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso;
	$rs4 = $AcompanhamentoCurso->query($sql);
	
	if(!mysql_num_rows($rs2)){
		
		$arrayRetorno['mensagem'] = "Insira pelo menos um item em \"Revisão de VPG\".";
		
	}elseif(!mysql_num_rows($rs3)){

		$arrayRetorno['mensagem'] = "Insira pelo menos um item em \"Acompanhamento de material\".";
		
	}elseif(!mysql_num_rows($rs4)){

		$arrayRetorno['mensagem'] = "Insira pelo menos um item em \"Variedade de recursos\".";
	
	}elseif(!$notas){
		
		$arrayRetorno['mensagem'] = $msgErro;
		
	}else{
		
		$AcompanhamentoCurso->setIdAcompanhamentoCurso($idAcompanhamentoCurso);
		$AcompanhamentoCurso->updateFieldAcompanhamentoCurso("finalizadoParcial", 1);
		
		$arrayRetorno['mensagem'] = "Finalizado com sucesso";
		$arrayRetorno['atualizarNivelAtual'] = true;
		$arrayRetorno['pagina'] = $atualizarNivelAtual;
		
	}	
	
}elseif($_REQUEST['acao']=="finalizadoGeral"){
	
	$AcompanhamentoCurso->setIdAcompanhamentoCurso($idAcompanhamentoCurso);
	$AcompanhamentoCurso->updateFieldAcompanhamentoCurso("finalizadoGeral", 1);
	
	$arrayRetorno['mensagem'] = "Finalizado[geral] com sucesso";
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] = $atualizarNivelAtual;
	
}elseif($_REQUEST['acao']=="desFinalizadoParcial"){
	
	$AcompanhamentoCurso->setIdAcompanhamentoCurso($idAcompanhamentoCurso);
	$AcompanhamentoCurso->updateFieldAcompanhamentoCurso("finalizadoParcial", 0);

	$arrayRetorno['mensagem'] = "Desfinalizado com sucesso.";
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] = $atualizarNivelAtual;
	
}elseif($_REQUEST['acao']=="desFinalizadoGeral"){
	
	$AcompanhamentoCurso->setIdAcompanhamentoCurso($idAcompanhamentoCurso);
	$AcompanhamentoCurso->updateFieldAcompanhamentoCurso("finalizadoGeral", 0);
	
	$arrayRetorno['mensagem'] = "Desfinalizado[geral] com sucesso.";
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] = $atualizarNivelAtual;
}


echo json_encode($arrayRetorno);

?>