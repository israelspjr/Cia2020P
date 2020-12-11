<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();
$EnderecoVirtual = new EnderecoVirtual();
$IntegranteProposta = new IntegranteProposta();
$IntermediarioProposta = new IntermediarioProposta();
$ClientePf = new ClientePf();

$idProposta = $_REQUEST['idProposta'];

$conteudo = $_POST['conteudoEmailAdd'];
	
$assunto = $_POST['assunto'];
$cc = $_POST['copia'];
$bcc = $_POST['copiaOculta'];
$arquivo = "";//sem arquivo por enqunto

$DisparoEmail->setPropostaIdProposta($idProposta);
$DisparoEmail->setCopia( implode(',', $cc) );
$DisparoEmail->setCopiaOculta( implode(',', $bcc) );
$DisparoEmail->setAssunto($assunto);
$DisparoEmail->setAnexo($arquivo);
$copia = array();
$bcopia = array();

for($i=0;$i<count($cc);$i++){
$copia[] = array('nome' => $cc[$i], 'email'=> $cc[$i]);
}

for($i=0;$i<count($bcc);$i++){
$bcopia[] = array('nome' => $cc[$i], 'email' => $cc[$i]);
}
		
$temEmailSelecionado = false;
	
if( $_POST['check_disparoEmail_integranteProposta']) {
	
	$temEmailSelecionado = true;
	
	foreach($_POST['check_disparoEmail_integranteProposta'] as $id){
		
		//CARREGA LINK	
		$valorIntegranteProposta = $IntegranteProposta->selectIntegranteProposta(" WHERE idIntegranteProposta = ".$id);
		$linkVisualizacao = $valorIntegranteProposta[0]['linkVisualizacao'];
		$idClientePf = $valorIntegranteProposta[0]['clientePf_idClientePf'];						
		$conteudoLink = $conteudo."
		<a target=\"_blank\" href=\"http://".CAMINHO_VER_PP."index.php?".$linkVisualizacao."\">
		veja sua proposta</a>";	
		
		$emails = $ClientePf->getEmail($idClientePf);
		$nome = $ClientePf->getNome($idClientePf);
				
		$paraQuem = array();
		foreach($emails as $email) $paraQuem[] = array("nome" => $nome, "email" => $email);
					
		//GRAVA DISPARO				
		$DisparoEmail->setDestino( implode(',', $emails) );		
		$DisparoEmail->setConteudoEmail($conteudoLink);									
		$DisparoEmail->addDisparoEmail();	
						
		Uteis::enviarEmail($assunto, $conteudoLink, $paraQuem, "", $copia, $bcopia);
		
	}
}

if( $_POST['check_disparoEmail_intermediarioProposta']) {
	
	$temEmailSelecionado = true;
	
	foreach($_POST['check_disparoEmail_intermediarioProposta'] as $id){
		
		//CARREGA LINK	
		$valorIntermediarioProposta = $IntermediarioProposta->selectIntermediarioProposta(" WHERE idIntermediarioProposta = ".$id);
		$linkVisualizacao = $valorIntermediarioProposta[0]['linkVisualizacao'];
		$idClientePf = $valorIntermediarioProposta[0]['clientePf_idClientePf'];		
		$conteudoLink = $conteudo."<a target=\"_blank\" href=\"http://".CAMINHO_VER_PP."index.php?".$linkVisualizacao."\">veja sua proposta</a>";	
		
		$emails = $ClientePf->getEmail($idClientePf);
		$nome = $ClientePf->getNome($idClientePf);
				
		$paraQuem = array();
		foreach($emails as $email) $paraQuem[] = array("nome" => $nome, "email" => $email);
			
		//GRAVA DISPARO				
		$DisparoEmail->setDestino( implode(',', $emails) );		
		$DisparoEmail->setConteudoEmail($conteudoLink);									
		$DisparoEmail->addDisparoEmail();
						
		Uteis::enviarEmail($assunto, $conteudoLink, $paraQuem, "", $copia, $bcopia);
		
	}
}
	
if(!$temEmailSelecionado){	
	$arrayRetorno['mensagem'] = "Nenhum e-mail foi selecionado.";
}else{
	$arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso";
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);	

?>