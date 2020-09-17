<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/aluno.php");

$RespostaPsaProfessor = new RespostaPsaProfessor();
$RespostaPsaRegular = new RespostaPsaRegular();
$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();
$TextoEmailPadrao = new TextoEmailPadrao();
$IntegranteGrupo = new IntegranteGrupo();
$ClientePf = new ClientePf();

$acao = $_REQUEST['acao'];

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

if ($acao == "addProfessor") {

	$idPsaIntegranteGrupo = $_REQUEST['id'];
	$idPsaProfessor = $_REQUEST['idPsaProfessor'];

	$RespostaPsaProfessor -> setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
	$RespostaPsaProfessor -> setPsaProfessorIdPsaProfessor($idPsaProfessor);
	
	$RespostaPsaProfessor -> addRespostaPsaProfessor();

	$arrayRetorno['mensagem'] = "Adicionado com sucesso.";

	$arrayRetorno['pagina'] = CAMINHO_MODULO . "psa/perguntasPsa.php?id=" . $idPsaIntegranteGrupo . "&idIntegranteGrupo=" . $idIntegranteGrupo;
	$arrayRetorno['atualizarNivelAtual'] = true;

} elseif ($acao == "finalizar") {

	$idPsaIntegranteGrupo = $_REQUEST['idPsaIntegranteGrupo'];
			
	$PsaIntegranteGrupo -> finalizarPSA($idPsaIntegranteGrupo);
	
	// Avisar coordenador
	$idGerente = $GerenteTem->selectGerenteTem_porGrupo($idPlanoAcaoGrupo);
	
	$valor = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
	$idClientePf = $valor[0]['clientePf_idClientePf'];
	
	$nomeAluno = $ClientePf->getNome($idClientePf);
	
	$nome = $Funcionario -> getNome($idGerente);
 	$email = $Funcionario -> getEmail($idGerente);
	
	//$paraQuem = array();
 
	//foreach ($emails as $email)  
	
	$paraQuem = array("nome" => $nome,	"email" => $email);
	
//	$paraQuem2 = array("nome" => "Israel",	"email" => "envio@companhiadeidiomas.com.br");
	
	$paraQuem3 = array("nome" => "Ana",	"email" => "michelle@companhiadeidiomas.com.br");
	
	$mensagem = $TextoEmailPadrao -> getTexto("7");
	
	$assunto = "Aluno ".$nomeAluno." finalizou PSA";

	//ENVIO POR EMAIL
	
	Uteis::enviarEmail($assunto, $mensagem, $paraQuem, "");
//	Uteis::enviarEmail($assunto, $mensagem, $paraQuem2, "");
	Uteis::enviarEmail($assunto, $mensagem, $paraQuem3, "");
		

	$arrayRetorno['mensagem'] = "Finalizado com sucesso.";
	$arrayRetorno['fecharNivel'] = true;

}

echo json_encode($arrayRetorno);
?>