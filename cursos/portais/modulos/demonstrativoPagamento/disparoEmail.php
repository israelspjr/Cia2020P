<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DisparoEmail = new DisparoEmail();
$Professor = new Professor();
$Aviso = new Aviso();	
$DemonstrativoPagamento = new DemonstrativoPagamento();
$arrayRetorno = array();

$idDemonstrativoPagamento = $_REQUEST['idp'];
$texto = $_REQUEST['contesta'];
	
	$idProfessor = $DemonstrativoPagamento->selectDemonstrativoPagamento("where idDemonstrativoPagamento = ".$idDemonstrativoPagamento);
	
	$valorIdProfessor = $idProfessor[0]['professor_idProfessor'];
	$mes = $idProfessor[0]['mes'];
	$ano = $idProfessor[0]['ano'];

	$assunto = "Demonstrativo Pagamento $mes/$ano - Contestação";
	
	$conteudo = $DemonstrativoPagamento->selectDemonstrativoPagamento_imprimir($idDemonstrativoPagamento);
	
	$conteudo .= "<p>Observação : <br>".$texto;
	
		//CARREGA LINK	
		$emails = $Professor->getEmail($idProfessor);
		$nome = $Professor->getNome($valorIdProfessor);
		
		
		$paraQuem = array("nome" => $nome, "email" => $emails);
	//	$paraQuem2 = array("israel"=> "Israel Junior", "email" => "envio@companhiadeidiomas.com.br");
	//	$paraQuem3 = array("janaina"=> "Roseli Campos", "email" => "roselicampos@companhiadeidiomas.com.br");
		
	
		$rs = Uteis::enviarEmail($assunto, $conteudo, $paraQuem, "");//, $cc, $bcc);	
	//	$rs2 = Uteis::enviarEmail($assunto, $conteudo, $paraQuem2, "");//, $cc, $bcc);	
	//	$rs3 = Uteis::enviarEmail($assunto, $conteudo, $paraQuem3, "");//, $cc, $bcc);		
		
	

	$arrayRetorno['mensagem'] = "E-mail(os) enviado(s) com sucesso<br />";


echo json_encode($arrayRetorno);	

?>