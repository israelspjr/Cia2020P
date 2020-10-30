<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();
$Professor = new Professor();
$Aviso = new Aviso();	

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$nomeEmp = $_REQUEST['empresa'];

$conteudo = $_POST['conteudoEmailAdd'];
	
$assunto = $_POST['assunto'];
$cc = array("nome" => implode(',', $_POST['copia']), "email" => implode(',', $_POST['copia']));
//$cc['email'] = implode(',', $_POST['copia']);
//echo $cc;
$bcc = array("nome" => implode(',', $_POST['copiaOculta']), "email" => implode(',', $_POST['copiaOculta']));
$arquivo = "";//sem arquivo por enqunto

$DisparoEmail->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
$DisparoEmail->setCopia( implode(',', $cc) );
$DisparoEmail->setCopiaOculta( implode(',',$bcc) );
$DisparoEmail->setAssunto($assunto);
$DisparoEmail->setAnexo($arquivo);
		
$temEmailSelecionado = false;
	
if( $_POST['check_disparoEmail_professor']) {
	
	$temEmailSelecionado = true;
	
	foreach($_POST['check_disparoEmail_professor'] as $idProfessor){
		
		//CARREGA LINK	
		$emails = $Professor->getEmail($idProfessor);
		
		$nome = $Professor->getNome($idProfessor);
		
		$conteudo .= "<br>Nome da Empresa : ".$nomeEmp."<br>";
	
	
//		Uteis::pr($cc);		
	//	$paraQuem = array();
	//	foreach($emails as $email) 
		
		$paraQuem = array("nome" => $nome, "email" => $emails);
		
		$conteudo_final = $conteudo.$Professor->montaDias($idPlanoAcaoGrupo, $idProfessor);
		
//		Uteis::pr($paraQuem);
		
		//GRAVA DISPARO				
		$DisparoEmail->setDestino( implode(",", $emails) );		
		$DisparoEmail->setConteudoEmail($conteudo_final);									
		$DisparoEmail->addDisparoEmail();						
		
		$rs = Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, "", $cc, $bcc);		
		
	
	}

}

if(!$temEmailSelecionado){	
	$arrayRetorno['mensagem'] = "Nenhum e-mail foi selecionado.";
}else{
	$arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso<br />";
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);	

?>