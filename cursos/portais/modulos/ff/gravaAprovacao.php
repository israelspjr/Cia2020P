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

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$posicao = $_REQUEST['posicao'];
$obs = $_REQUEST['obs'];

$where = " WHERE clientePf_idClientePf = " . $_SESSION['idClientePf_SS'] . " AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo ";
$rsIntegranteGrupo = $IntegranteGrupo -> selectIntegranteGrupo($where);
$idIntegranteGrupo = $rsIntegranteGrupo[0]['idIntegranteGrupo'];

$nomeGrupo = $PlanoAcaoGrupo -> getNomeGrupo($idPlanoAcaoGrupo);
$nomeAluno = $ClientePf->getNome($_SESSION['idClientePf_SS']);

$ContestacaoFF -> setFolhaFrequenciaIdFolhaFrequencia($idFolhaFrequencia);
$ContestacaoFF -> setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
$ContestacaoFF -> setStatus($posicao);
$ContestacaoFF -> setObs($obs);

$ContestacaoFF -> addContestacaoFF();

if ($posicao == "2") {

	$assunto = "Contestação da Folha de frequência";
	$msg_base = "<p>Período: $mes/$ano</p>
	<p>Grupo: $nomeGrupo.</p>
	<p>Aluno: $nomeAluno.</p>
	<p>Comentário: <br><strong> $obs </strong></br></p>";

	//COMUNICA O GERENTE SOBRE A FINALIZAÇÃO DA FF
	$idFuncionario_gerente = $GerenteTem -> selectGerenteTem_porGrupo($idPlanoAcaoGrupo);
	echo $idFuncionario_gerente;
	if ($idFuncionario_gerente) {    
		//EMAIL
		$nome = $Funcionario -> getNome($idFuncionario_gerente);
		$email = $Funcionario -> getEmail($idFuncionario_gerente);
		$msg = $msg_base.$TextoEmailPadrao -> getTexto("5");
		$paraQuem = array("nome" => $nome, "email" => $email);

		$rs = Uteis::enviarEmail($assunto, $msg, $paraQuem, "");
		
	}

  	$paraQuem2 = array("israel"=> "Companhia de idiomas", "email" => "envio@companhiadeidiomas.com.br");
	$rs = Uteis::enviarEmail($assunto, $msg, $paraQuem2, "");
	Uteis::pr($rs);
  
  $arrayRetorno['mensagem'] = "Contestação enviada com sucesso, aguarde o nosso contato.";
    
}
$arrayRetorno['mensagem'] = "Observação gravada, obrigado.";

//$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);
?>