<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioDesempenho = new RelatorioDesempenho();
$IntegranteGrupo = new IntegranteGrupo();
$ItenRelatorioDesempenho = new ItenRelatorioDesempenho();

$nota = $_REQUEST['nota'];
$idRelatorioDesempenho = $_REQUEST['idRelatorioDesempenho'];
$idItenRelatorioDesempenho = $_REQUEST['idItenRelatorioDesempenho'];
$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
$idAcompanhamentoCurso = $_REQUEST['idAcompanhamentoCurso'];
$obs = str_replace("'","´",$_REQUEST['obs']);

$msgObs = "<br /><small>".$IntegranteGrupo->getNomePF($idIntegranteGrupo)." - ".$ItenRelatorioDesempenho->getNome($idItenRelatorioDesempenho)."</small>";

if($nota==''){
	
	$arrayRetorno['mensagem'] = "Nota inválida.";
	
}else{
	
	if($idRelatorioDesempenho == ''){
		
		$RelatorioDesempenho->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
		$RelatorioDesempenho->setAcompanhamentoCursoIdAcompanhamentoCurso($idAcompanhamentoCurso);
		$RelatorioDesempenho->setItenRelatorioDesempenhoIdItenRelatorioDesempenho($idItenRelatorioDesempenho);
		$RelatorioDesempenho->setNota($nota);
		$RelatorioDesempenho->setObs($obs);
		$idRelatorioDesempenho = $RelatorioDesempenho->addRelatorioDesempenho();
		
	}else{
		
		$RelatorioDesempenho->setIdRelatorioDesempenho($idRelatorioDesempenho);
        $RelatorioDesempenho->updateFieldRelatorioDesempenho('obs',$obs);
		$RelatorioDesempenho->updateFieldRelatorioDesempenho('nota',$nota);
		
	}
	
	$arrayRetorno['mensagem'] = "Nota gravada com sucesso";
	
	$arrayRetorno['valor'][0] = $idRelatorioDesempenho;
	$arrayRetorno['campoAtualizar'][0] = "#idRelatorioDesempenho".$idIntegranteGrupo."_".$idItenRelatorioDesempenho;

}

$arrayRetorno['mensagem'] .= $msgObs;

echo json_encode($arrayRetorno);

?>