<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();
$Funcionario = new Funcionario();
$arrayRetorno = array();
$GerenteTem = new GerenteTem();
$Gerente = new Gerente();
$Configuracoes = new Configuracoes();

//$idFuncionario = $_REQUEST['idFuncionario'];
$nome = $_REQUEST['nomeExibicao'];
$email = $_REQUEST['email'];
$idClientePj = $_REQUEST['clientePj_idClientePj'];
$config = $Configuracoes->selectConfig();


$valorGerenteTem = $GerenteTem->selectGerenteTem(" WHERE clientePj_idClientePj = ".$idClientePj." AND dataExclusao IS NULL");


	$idGerente = $valorGerenteTem[0]['gerente_idGerente'];

	$valorGerente = $Gerente->selectGerente(" WHERE idGerente = ".$idGerente);

	$idFuncionario = $valorGerente[0]['funcionario_idFuncionario'];
	
	$emailF = $Funcionario->getEmail($idFuncionario);
	$nomeF = $Funcionario->getNome($idFuncionario);

	$assunto = "Novo Aluno inserido no sistema, clique no link e termine o seu cadastro para ingressar em um grupo.";
	
	$conteudo = "Nome: ".$nome."<br> Email: ".$email;
	
	$conteudo = "Para acessar o portal do aluno, utilize o link abaixo: <p> <a href=\"https://". $config[0]['site']."/cursos/portais/precadastro.php?nomeExibicao=".$nome."&email=".$email."\">Clique aqui para acessar o sistema e terminar o seu cadastro</a></p>";
	
		$paraQuem = array("nome" => $nome, "email" => $email);
		$paraQuem3 = array("nome" => $nomeF, "email" => $emailF);
	
		$rs = Uteis::enviarEmail($assunto, $conteudo, $paraQuem, "", $paraQuem3); //, $bcc);	

	$arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso<br />";


echo json_encode($arrayRetorno);	

?>