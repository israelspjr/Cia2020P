<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$FolhaFrequencia = new FolhaFrequencia();
$DiaAulaFF = new DiaAulaFF();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$IntegranteGrupo = new IntegranteGrupo();
$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$Aviso = new Aviso();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Professor = new Professor();
$TextoEmailPadrao = new TextoEmailPadrao();
$ClientePf = new ClientePf();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();
$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
$Relatorio = new Relatorio();
$ClientePj = new ClientePj();
$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
$AcompanhamentoCurso = new AcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();


$arrayRetorno = array();

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
	
$arrayRetorno['atualizarNivelAtual'] = true;
//$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['pagina'] = CAMINHO_REL . "grupo/include/form/folhaFrequencia_abas.php?idFolhaFrequencia=$idFolhaFrequencia";
	$arrayRetorno['mudarAba'] = "#aba_div_aulas";
//	$arrayRetorno['mudarAba'] = "#aba_div_principais";



echo json_encode($arrayRetorno);
?>