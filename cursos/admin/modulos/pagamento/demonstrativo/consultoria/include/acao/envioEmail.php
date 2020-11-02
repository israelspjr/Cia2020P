<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$DemonstrativoPagamento = new DemonstrativoPagamento();
$Professor = new Professor();
$TextoEmailPadrao = new TextoEmailPadrao();

$arrayRetorno = array();
$emails = array();
//$paraQuem = array();

$idDemonstrativoPagamento = $_REQUEST['id'];

$rsDemonstrativoPagamento = $DemonstrativoPagamento->selectDemonstrativoPagamento(" WHERE idDemonstrativoPagamento = ".$idDemonstrativoPagamento);
	$idProfessor = $rsDemonstrativoPagamento[0]['professor_idProfessor'];
	$mes = $rsDemonstrativoPagamento[0]['mes'];
	$ano = $rsDemonstrativoPagamento[0]['ano'];
	
$nome = $Professor->getNome($idProfessor);
$email = $Professor->getEmail($idProfessor);

$where1 = "Where idProfessor = ".$idProfessor;

$rs2 = $Professor->selectProfessor($where1);

$senhaAcesso = $rs2[0]['senha'];
$ValorTipo = $rs2[0]['documentoUnico'];

$tipo = $rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'];
			
/*			if ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 1) {
					
			$tipo = "cpf";
			
			} elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 2) {
				
			$tipo = "RNE";
			
			} elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 3) {
				
			$tipo = "Passaporte";
			}
*/

if(Uteis::verEmail($email)){
		
	$Aviso = new Aviso();
	
	$assunto = "Demonstrativo $mes/$ano. Companhia de Idiomas - favor não responder este email";
		
	$mensagem = $TextoEmailPadrao->getTexto("20");
	
	$mensagem .= "<strong><p>Pagamento outros serviços</p></strong>";
	
	$mensagem .=  $DemonstrativoPagamento -> selectDemonstrativoPagamento_imprimir($idDemonstrativoPagamento); 
	
	$mensagem .= "<p>Para acessar o seu demonstrativo  <a href=http://".$_SERVER['SERVER_NAME']."/cursos/professor/login.php?documentoUnico=".$ValorTipo."&password=".EncryptSenha::B64_Decode($senhaAcesso)."&tipoDocumentoUnico_idTipoDocumentoUnico=".$tipo.">clique aqui</a><p> A equipe Companhia de Idiomas agradece.</p>Atenciosamente,</p>";
	
	$paraQuem = array("nome" => $nome, "email" => $email);	
	$paraQuem2 = array("nome" => "Envio", "email" => "envio@companhiadeidiomas.net");
    
    $rs = Uteis::enviarEmail($assunto, $mensagem, $paraQuem, "");
	
	$rs2 = Uteis::enviarEmail($assunto, $mensagem, $paraQuem2, "");
	
//	Uteis::pr($rs);

	$arrayRetorno["mensagem"] = "Demonstrativo enviado com sucesso.";
	
}else{
	$arrayRetorno["mensagem"] = "Não foi possível enviar.";	
}

echo json_encode($arrayRetorno);
?>
