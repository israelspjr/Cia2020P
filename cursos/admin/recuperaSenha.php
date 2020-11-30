<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
        
$origem = $_POST['origem'];
$doc = $_POST['doc'];
$senha = $_POST['senha'];

$senhaAcesso = EncryptSenha::B64_Encode($senha);

if($origem == "admin"){
	
	$Funcionario = new Funcionario();
	
	$rs = $Funcionario->selectFuncionario(" WHERE documentoUnico = '".$doc."'");
	if($rs){
		
		$idFuncionario = $rs[0]["idFuncionario"];
		$nome = $rs[0]["nome"];	
		$Funcionario->setIdFuncionario($idFuncionario);
		$Funcionario->updateFieldFuncionario("SenhaAcesso", $senhaAcesso);
		$emails = $Funcionario->getEmail($idFuncionario);
	}
	
}elseif($origem == "aluno"){
	
	$ClientePf = new ClientePf();
	
	$rs = $ClientePf->selectClientepf(" WHERE documentoUnico = '".$doc."'");
	if($rs){
		$idClientePf = $rs[0]["idClientePf"];
		$nome = $rs[0]["nome"];
		$ClientePf->setIdClientePf($idClientePf);
		$ClientePf->updateFieldClientepf("SenhaAcesso", $senhaAcesso);
		$emails = $ClientePf->getEmail($idClientePf, 1);
	}
	
	
}elseif($origem == "professor"){
	
	$Professor = new Professor();
	
	$rs = $Professor->selectProfessor(" WHERE documentoUnico = '".$doc."'");
	if($rs){
		$idProfessor = $rs[0]["idProfessor"];
		$nome = $rs[0]["nome"];
		$Professor->setIdProfessor($idProfessor);
		$Professor->updateFieldProfessor("senha", $senhaAcesso);
		$emails = $Professor->getEmail($idProfessor);		
	}
	
}elseif($origem == "rh"){
	
	$ClientePj = new ClientePj();
	
	$rs = $ClientePj->selectClientePj(" WHERE cnpj = '".$doc."'");
	if($rs){
		$idClientePj = $rs[0]["idClientePj"];
		$nome = $rs[0]["razaoSocial"];
		$ClientePj->setIdClientePj($idClientePj);
		$ClientePj->updateFieldClientePj("SenhaAcesso", $senhaAcesso);
		$emails = $ClientePj->getEmail($idClientePj);
	}
	
}

if( $emails != "" ){
	
	$assunto = "Recuperação de senha";
	
	$msg = "<p>Sua senha é <b>$senha</b></p>";
	
	$paraQuem = array("nome" => $nome, "email" => $emails);	
	$paraQuem1 = array("nome" => $nome, "email" => "envio@companhiadeidiomas.com.br");	
    
	Uteis::enviarEmail($assunto, $msg, $paraQuem);
	Uteis::enviarEmail($assunto, $msg, $paraQuem1);
	
	$arrayRetorno["mensagem"] = "Sua senha foi enviada para o e-mail cadastrado.";
    
 //   $arrayRetorno['atualizarNivelAtual'] = true;
 //   $arrayRetorno['pagina'] = "/cursos/".$origem."/login.php";
	
}else{
	$arrayRetorno["mensagem"] = "Não foi possível enviar a sua senha.";
  //  $arrayRetorno['pagina'] = "/cursos/".$origem."/login.php";
 //   $arrayRetorno['atualizarNivelAtual'] = true;

}
 
echo json_encode($arrayRetorno);
