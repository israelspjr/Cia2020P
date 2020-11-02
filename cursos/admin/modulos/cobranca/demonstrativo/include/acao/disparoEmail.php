<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();
$ClientePf = new ClientePf();
$Contato = new ContatoAdicional();
$Aviso = new Aviso();	

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

	
$assunto = $_POST['assunto'];
$cc = $_POST['copia'];
$bcc = $_POST['copiaOculta'];
$arquivo = "";//sem arquivo por enqunto
$paraQuem2 = array("nome" => "Companhia de idiomas", "email" => "envio@companhiadeidiomas.com.br"); 
/*for($i=0;$i<count($cc);$i++){
$copia = array('nome' => $cc[$i], 'email' => $cc[$i]);
$temEmailSelecionado = true;
}

for($i=0;$i<count($bcc);$i++){
$bcopia = array('nome' => $cc[$i], 'email' => $cc[$i]);
$temEmailSelecionado = true;
}*/


$DisparoEmail->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
$DisparoEmail->setCopia(implode(",",$cc));
$DisparoEmail->setCopiaOculta(implode(",",$bcc));
$DisparoEmail->setAssunto($assunto);
$DisparoEmail->setAnexo($arquivo);

$msg = "Demonstrativos de $mes/$ano <br />";	
$temEmailSelecionado = false;

if( $_POST['check_disparoEmail_integranteGrupo']) {
	
	$temEmailSelecionado = true;
	
	
	foreach($_POST['check_disparoEmail_integranteGrupo'] as $idIntegranteGrupo){
		
		//CARREGA LINK	
		$email = $ClientePf->getEmail($idIntegranteGrupo);
		$nome = $ClientePf->getNome($idIntegranteGrupo);
				
	//	$paraQuem = array();
		$paraQuem = array("nome" => $nome, "email" => $email);
        $idIntegrante = $_POST['idIntegranteGrupo'];    
	  
				
		$conteudo_final = file_get_contents("http://".CAMINHO_VER_DM."demonstratioEmail.php?p=".Uteis::base64_url_encode($idPlanoAcaoGrupo)."&m=".Uteis::base64_url_encode($mes)."&a=".Uteis::base64_url_encode($ano)."&I=".Uteis::base64_url_encode($idIntegrante[$idIntegranteGrupo]));
		
        $msg .= $conteudo_final;
		
		//GRAVA DISPARO				
		$DisparoEmail->setDestino($email);		
		$DisparoEmail->setConteudoEmail($conteudo_final);									
		$DisparoEmail->addDisparoEmail();
        		
		Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, $arquivo, $copia, $bcopia); 
		Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem2, $arquivo, $copia, $bcopia);   
		
	}

}
if( $_POST['check_disparoEmail_contatoAdd']) {
    
    $temEmailSelecionado = true;
    $TextoEmailPadrao = new TextoEmailPadrao();
    $conteudo = $TextoEmailPadrao->getTexto("19");
    foreach($_POST['check_disparoEmail_contatoAdd'] as $idContatoAdicional){
        
        //CARREGA LINK  
        $email = $Contato->getEmail($idContatoAdicional);
        $nome = $Contato->getNome($idContatoAdicional);
                
   //     $paraQuem = array();
        $paraQuem = array("nome" => $nome, "email" => $email);
        
        $conteudo_final = file_get_contents("http://".CAMINHO_VER_DM."demonstratioEmail.php?p=".Uteis::base64_url_encode($idPlanoAcaoGrupo)."&m=".Uteis::base64_url_encode($mes)."&a=".Uteis::base64_url_encode($ano));
        $msg .= $counteudo. $conteudo_final;
        //GRAVA DISPARO             
        $DisparoEmail->setDestino($email);     
        $DisparoEmail->setConteudoEmail($conteudo_final);                                   
        $DisparoEmail->addDisparoEmail();                

        Uteis::enviarEmail($assunto, $msg, $paraQuem, $arquivo, $copia, $bcopia); 
		
		$paraQuem2 = array("nome" => "Companhia de Idiomas", "email" => "envio@companhiadeidiomas.net");     
		 Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem2, $arquivo, $copia, $bcopia); 
    
    }

}
if (($cc != '') || ($bcc != '')) {
	
	$temEmailSelecionado = true;
	
	if ($cc != '') {
	
	foreach($cc as $valor){
		
		//CARREGA LINK	
		$email = $valor;
		$nome = $valor;
				
	//	$paraQuem = array();
		$paraQuem = array("nome" => $nome, "email" => $email);
   //     $idIntegrante = $_POST['idIntegranteGrupo'];    
	  
				
		$conteudo_final = file_get_contents("http://".CAMINHO_VER_DM."demonstratioEmail.php?p=".Uteis::base64_url_encode($idPlanoAcaoGrupo)."&m=".Uteis::base64_url_encode($mes)."&a=".Uteis::base64_url_encode($ano)."&I=".Uteis::base64_url_encode($idIntegrante[$idIntegranteGrupo]));
		
        $msg .= $conteudo_final;
		
		//GRAVA DISPARO				
		$DisparoEmail->setDestino($email);		
		$DisparoEmail->setConteudoEmail($conteudo_final);									
		$DisparoEmail->addDisparoEmail();
        		
		Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, $arquivo, $copia, $bcopia); 
		Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem2, $arquivo, $copia, $bcopia);   
		
		}
	}
	
	if ($bcc != '') {
	
	foreach($bcc as $valor){
		
		//CARREGA LINK	
		$email = $valor;
		$nome = $valor;
				
	//	$paraQuem = array();
		$paraQuem = array("nome" => $nome, "email" => $email);
   //     $idIntegrante = $_POST['idIntegranteGrupo'];    
	  
				
		$conteudo_final = file_get_contents("http://".CAMINHO_VER_DM."demonstratioEmail.php?p=".Uteis::base64_url_encode($idPlanoAcaoGrupo)."&m=".Uteis::base64_url_encode($mes)."&a=".Uteis::base64_url_encode($ano)."&I=".Uteis::base64_url_encode($idIntegrante[$idIntegranteGrupo]));
		
        $msg .= $conteudo_final;
		
		//GRAVA DISPARO				
		$DisparoEmail->setDestino($email);		
		$DisparoEmail->setConteudoEmail($conteudo_final);									
		$DisparoEmail->addDisparoEmail();
        		
		Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem, $arquivo, $copia, $bcopia); 
		Uteis::enviarEmail($assunto, $conteudo_final, $paraQuem2, $arquivo, $copia, $bcopia);   
		
		}
	}
	

	
}

if(!$temEmailSelecionado){	
	$arrayRetorno['mensagem'] = "Nenhum e-mail foi selecionado.";
}else{
    $paraQuem = Uteis::aviso_porSetor("3");
    Uteis::enviarEmail("Demonstrativo Enviado", $msg, $paraQuem);
//	Uteis::enviarEmail("Demonstrativo Enviado", $msg, $paraQuem2);
	
	$arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso<br />";
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);	

?>