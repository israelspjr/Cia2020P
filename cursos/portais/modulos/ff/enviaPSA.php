<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$ContestacaoFF = new ContestacaoFF();
$IntegranteGrupo = new IntegranteGrupo();
$GerenteTem = new GerenteTem();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Aviso = new Aviso();
$Funcionario = new Funcionario();
$Professor = new Professor();
$TextoEmailPadrao = new TextoEmailPadrao();
$ClientePf = new ClientePf();
$Grupo = new Grupo();
$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$RespostaPsaProfessor = new RespostaPsaProfessor();
$RespostaPsaRegular = new RespostaPsaRegular();

$nomeGrupo = $Grupo->getNome($_REQUEST['idGrupo']);
$nomeAluno = $_REQUEST['nome'];

$email = $_REQUEST['email'];
$gerente = $_REQUEST['gerente'];

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];

$idNotasTipoNotaP = $_REQUEST['idNotasTipoNotaP'];
$obsP = $_REQUEST['obsP'];

	// Gerar PSA no sistema
	
	$year = date("Y");
	$mes = date("m");
	$dia = date("d");
	
	$PsaIntegranteGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
	$PsaIntegranteGrupo->setDataReferencia($year."-".$mes."-".$dia);
	$PsaIntegranteGrupo->setObs("Aces Portal Aluno");
	$PsaIntegranteGrupo->setFinalizado(1);	
	$PsaIntegranteGrupo->setDesistirPsa(0);
	
	$idPsa = $PsaIntegranteGrupo->addPsaIntegranteGrupo();

if ($idNotasTipoNotaP != '') {
	
	
	if ($idNotasTipoNotaP == 8) {
		$nota = "1";
		
	} elseif($idNotasTipoNotaP == 9) {
		$nota = "2";
	  	
	} elseif($idNotasTipoNotaP == 10) {
		$nota = "3";
		
	} elseif($idNotasTipoNotaP == 11) {
		$nota = "4";
		
	} elseif($idNotasTipoNotaP == 12) {
		$nota = "5";
		
	} elseif($idNotasTipoNotaP == 13) {
		$nota = "6";
		
	} elseif($idNotasTipoNotaP == 14) {
		$nota = "7";
		
	} elseif($idNotasTipoNotaP == 15) {
		$nota = "8";
		
	} elseif($idNotasTipoNotaP == 16) {
		$nota = "9";
		
	} elseif($idNotasTipoNotaP == 17) {
		$nota = "10";
		
	} elseif($idNotasTipoNotaP == 18) {
		$nota = "Prefiro não avaliar";
		
	}
	
$html = "<p>Item Avaliado = Professor</p>";
$html .= "<p>Professor: ".$Professor->getNome($_REQUEST['idProfessor']);
$html .= "<p>Nota:".$nota."</p>";
$html .= "<p>Obs:".$obsP."</p>";

		$RespostaPsaRegular->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsa);
		$RespostaPsaRegular->addRespostaPsaRegular();

}


$idNotasTipoNotaC = $_REQUEST['idNotasTipoNotaC'];
$obsC = $_REQUEST['obsC'];

if ($idNotasTipoNotaC != '') {
	
	$RespostaPsaRegular->setPsaRegularIdPsa(8);
	$RespostaPsaRegular->setNotasTipoNotaIdNotasTipoNota($idNotasTipoNotaC);
	$RespostaPsaRegular->setObs($obsC);
	
	
	if ($idNotasTipoNotaC == 8) {
		$nota = "1";
		
	} elseif($idNotasTipoNotaC == 9) {
		$nota = "2";
	  	
	} elseif($idNotasTipoNotaC == 10) {
		$nota = "3";
		
	} elseif($idNotasTipoNotaC == 11) {
		$nota = "4";
		
	} elseif($idNotasTipoNotaC == 12) {
		$nota = "5";
		
	} elseif($idNotasTipoNotaC == 13) {
		$nota = "6";
		
	} elseif($idNotasTipoNotaC == 14) {
		$nota = "7";
		
	} elseif($idNotasTipoNotaC == 15) {
		$nota = "8";
		
	} elseif($idNotasTipoNotaC == 16) {
		$nota = "9";
		
	} elseif($idNotasTipoNotaC == 17) {
		$nota = "10";
		
	} elseif($idNotasTipoNotaC == 18) {
		$nota = "Prefiro não avaliar";
		
	}
	
	$html = "<p>Item Avaliado = GESTÃO DE CURSOS</p>";
	$html .= "<p>Nota:".$nota."</p>";
	$html .= "<p>Obs:".$obsC."</p>";

	$RespostaPsaRegular->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsa);
	$RespostaPsaRegular->addRespostaPsaRegular();

}


$idNotasTipoNotaA = $_REQUEST['idNotasTipoNotaA'];
$obsA = $_REQUEST['obsA'];

if ($idNotasTipoNotaA != '') {
	
	$RespostaPsaRegular->setPsaRegularIdPsa(12);
	$RespostaPsaRegular->setNotasTipoNotaIdNotasTipoNota($idNotasTipoNotaA);
	$RespostaPsaRegular->setObs($obsA);
	
	
	if ($idNotasTipoNotaA == 1) {
		$nota = "Sim";
		
	} elseif($idNotasTipoNotaA == 2) {
		$nota = "Não";
	  	
	}
	
	
	$html2 = "<p>Item Avaliado = Divulgação</p>";
	$html2 .= "<p>Nota:".$nota."</p>";
	$html2 .= "<p>Obs:".$obsA."</p>";

	$RespostaPsaRegular->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsa);
	$RespostaPsaRegular->addRespostaPsaRegular();

}

$idNotasTipoNotaR = $_REQUEST['idNotasTipoNotaR'];
$obsR = $_REQUEST['obsR'];

if ($idNotasTipoNotaR != '') {
	
	$RespostaPsaRegular->setPsaRegularIdPsa(13);
	$RespostaPsaRegular->setNotasTipoNotaIdNotasTipoNota($idNotasTipoNotaR);
	$RespostaPsaRegular->setObs($obsR);
	
	
	if ($idNotasTipoNotaR == 8) {
		$nota = "1";
		
	} elseif($idNotasTipoNotaR == 9) {
		$nota = "2";
	  	
	} elseif($idNotasTipoNotaR == 10) {
		$nota = "3";
		
	} elseif($idNotasTipoNotaR == 11) {
		$nota = "4";
		
	} elseif($idNotasTipoNotaR == 12) {
		$nota = "5";
		
	} elseif($idNotasTipoNotaR == 13) {
		$nota = "6";
		
	} elseif($idNotasTipoNotaR == 14) {
		$nota = "7";
		
	} elseif($idNotasTipoNotaR == 15) {
		$nota = "8";
		
	} elseif($idNotasTipoNotaR == 16) {
		$nota = "9";
		
	} elseif($idNotasTipoNotaR == 17) {
		$nota = "10";
		
	} elseif($idNotasTipoNotaR == 18) {
		$nota = "Prefiro não avaliar";
		
	}
	
	$html3 = "<p>Item Avaliado = AULAS AO VIVO</p>";
	$html3 .= "<p>Nota:".$nota."</p>";
	$html3 .= "<p>Obs:".$obsR."</p>";
	
	$RespostaPsaRegular->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsa);
	$RespostaPsaRegular->addRespostaPsaRegular();

}


$idNotasTipoNotaN = $_REQUEST['idNotasTipoNotaN'];
$obsN = $_REQUEST['obsN'];

if ($idNotasTipoNotaN != '') {
	
$RespostaPsaRegular->setPsaRegularIdPsa(7);
$RespostaPsaRegular->setNotasTipoNotaIdNotasTipoNota($idNotasTipoNotaN);
$RespostaPsaRegular->setObs($obsN);
	
	if ($idNotasTipoNotaN == 8) {
		$nota = "1";
		
	} elseif($idNotasTipoNotaN == 9) {
		$nota = "2";
	  	
	} elseif($idNotasTipoNotaN == 10) {
		$nota = "3";
		
	} elseif($idNotasTipoNotaN == 11) {
		$nota = "4";
		
	} elseif($idNotasTipoNotaN == 12) {
		$nota = "5";
		
	} elseif($idNotasTipoNotaN == 13) {
		$nota = "6";
		
	} elseif($idNotasTipoNotaN == 14) {
		$nota = "7";
		
	} elseif($idNotasTipoNotaN == 15) {
		$nota = "8";
		
	} elseif($idNotasTipoNotaN == 16) {
		$nota = "9";
		
	} elseif($idNotasTipoNotaN == 17) {
		$nota = "10";
		
	} elseif($idNotasTipoNotaN == 18) {
		$nota = "Prefiro não avaliar";
		
	}
	
	$html4 = "<p>Item Avaliado = NPS - NET PROMOTER SCORE</p>";
	$html4 .= "<p>Nota: ".$nota."</p>";
	$html4 .= "<p>Obs: ".$obsN."</p>";

	$RespostaPsaRegular->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsa);
	$RespostaPsaRegular->addRespostaPsaRegular();

}


$idNotasTipoNotaComp = $_REQUEST['idNotasTipoNotaComp'];
$obsComp = $_REQUEST['obsComp'];

if ($idNotasTipoNotaComp != '') {
	
	$RespostaPsaRegular->setPsaRegularIdPsa(11);
	$RespostaPsaRegular->setNotasTipoNotaIdNotasTipoNota($idNotasTipoNotaComp);
	$RespostaPsaRegular->setObs($obsComp);
	
	if ($idNotasTipoNotaComp == 8) {
		$nota = "1";
		
	} elseif($idNotasTipoNotaComp == 9) {
		$nota = "2";
	  	
	} elseif($idNotasTipoNotaComp == 10) {
		$nota = "3";
		
	} elseif($idNotasTipoNotaComp == 11) {
		$nota = "4";
		
	} elseif($idNotasTipoNotaComp == 12) {
		$nota = "5";
		
	} elseif($idNotasTipoNotaComp == 13) {
		$nota = "6";
		
	} elseif($idNotasTipoNotaComp == 14) {
		$nota = "7";
		
	} elseif($idNotasTipoNotaComp == 15) {
		$nota = "8";
		
	} elseif($idNotasTipoNotaComp == 16) {
		$nota = "9";
		
	} elseif($idNotasTipoNotaComp == 17) {
		$nota = "10";
		
	} elseif($idNotasTipoNotaComp == 18) {
		$nota = "Prefiro não avaliar";
		
	}
	
	$html5 = "<p>Item Avaliado = SEU ENGAJAMENTO</p>";
	$html5 .= "<p>Nota: ".$nota."</p>";
	$html5 .= "<p>Obs: ".$obsComp."</p>";
	
	$RespostaPsaRegular->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsa);
	$RespostaPsaRegular->addRespostaPsaRegular();

}


	$assunto = "Resposta Dinamica de ACES portal do Aluno";
	$msg_base = "<p>Período: $mes/$ano</p>
	<p>Grupo: $nomeGrupo.</p>
	<p>Aluno: $nomeAluno.</p>";

	//COMUNICA O GERENTE SOBRE A FINALIZAÇÃO DA PSA
		
	$msg = $msg_base.$html.$html2.$html3.$html4.$html5;
	
  	$paraQuem2 = array("nome"=> $gerente, "email" => "israel@companhiadeidiomas.com.br"); //$email);

	$rs = Uteis::enviarEmail($assunto, $msg, $paraQuem2, "");
	
	// Cadastrar resultado
	
	//nota Professor
/*	if ($idNotasTipoNotaP != '') {
		$RespostaPsaProfessor->setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsa);	
		$RespostaPsaProfessor->setPsaProfessorIdPsaProfessor(2);	
		$RespostaPsaProfessor->setProfessorIdProfessor($_REQUEST['idProfessor']);			
		$RespostaPsaProfessor->setNotasTipoNotaIdNotasTipoNota($idNotasTipoNotaP);			
		$RespostaPsaProfessor->setObs($obsP);			
	//nota Regular
	} else  {
		
	}
	
	*/
	
  
  $arrayRetorno['mensagem'] = "ACES enviada com sucesso, obrigado.";

$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);
?>

