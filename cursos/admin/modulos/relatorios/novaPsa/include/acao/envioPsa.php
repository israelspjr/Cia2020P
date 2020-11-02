<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$TextoEmailPadrao = new TextoEmailPadrao();
$ClientePf = new ClientePf();
$IntegranteGrupo = new IntegranteGrupo();

$arrayRetorno = array();

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];

$rs = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
$idClientePf = $rs[0]['clientePf_idClientePf'];
$idPlanoAcaoGrupo = $rs[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];

$nome = $ClientePf->getNome($idClientePf);
$email = $ClientePf->getEmail($idClientePf);

$where1 = " Where idClientePf = ".$idClientePf;

$rs2 = $ClientePf->selectClientePf($where1);

$senhaAcesso = $rs2[0]['senhaAcesso'];
$ValorTipo = $rs2[0]['documentoUnico'];

/*$tipo = $rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'];
			
			if ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 1) {
					
			$tipo = "cpf";
			
			} elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 2) {
				
			$tipo = "RNE";
			
			} elseif ($rs2[0]['tipoDocumentoUnico_idTipoDocumentoUnico'] == 3) {
				
			$tipo = "Passaporte";
			}
*/

if(Uteis::verEmail($email)){
		
	$Aviso = new Aviso();
	
	$assunto = "Seu curso na Companhia de Idiomas";
		
	$mensagem = $TextoEmailPadrao->getTexto("6");
	
	$mensagem .= "<p>Para acessar a pesquisa  <a href=http://".$_SERVER['SERVER_NAME']."/cursos/aluno/login.php?cpf=".$ValorTipo."&password=".EncryptSenha::B64_Decode($senhaAcesso)."&responderPsa=1&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo.">clique aqui</a><p> A equipe Companhia de Idiomas agradece.</p>Atenciosamente,</p>";
	
	$paraQuem = array("nome" => $nome, "email" => $email);	
	$paraQuem2 = array("nome" => "Israel Junior", "email" => "envio@companhiadeidiomas.net");
    
    $rs = Uteis::enviarEmail($assunto, $mensagem, $paraQuem, "");
	
	$rs2 = Uteis::enviarEmail($assunto, $mensagem, $paraQuem2, "");
	
//	Uteis::pr($rs);

	$arrayRetorno["mensagem"] = "Pesquisa enviada com sucesso.";
	
}else{
	$arrayRetorno["mensagem"] = "Não foi possível enviar.";	
}
	$arrayRetorno["fecharNivel"] = true;
echo json_encode($arrayRetorno);
?>
