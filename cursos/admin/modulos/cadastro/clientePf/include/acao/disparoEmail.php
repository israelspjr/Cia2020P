<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
				
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Grupo_PJ = new GrupoClientePj();
$contato = new ContatoAdicional();
$Contrato = new Contrato();
$ClientePf = new ClientePf();

$arrayRetorno = array();

$idContrato = $_REQUEST['idContrato'];
$copia = implode(",",$_REQUEST['copia']);

$TextoEmailPadrao = new TextoEmailPadrao();

$rs = $Contrato->selectContrato(" WHERE idContrato = ".$idContrato);

$nome = $ClientePf->getNome($rs[0]['clientePf_idClientePf']);
$email = $ClientePf->getEmail($rs[0]['clientePf_idClientePf']);

$ano = date("Y", strtotime($rs[0]['dataCadastro']));
$mes = date("m", strtotime($rs[0]['dataCadastro']));
$link = $rs[0]['contrato'];

$assunto = "Boleto de cobrança ".$mes."/".$ano." Companhia de Idiomas - não responder a esse email"; 
$msg = "<p>Clique <a href=\"http://www.companhiadeidiomas.net/cursos/upload/arquivo/contrato/clientePf/".$link."\">aqui</a> para ver o boleto</p>";

       $paraQuem1 = array("nome" => $nome, "email" => $email);
       $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem1);

$arrayRetorno['mensagem'] = "Link do boleto enviado com sucesso!";

	 $paraQuem2 = array("nome" => "copia", "email" => $copia);
     $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem2);
	


echo json_encode($arrayRetorno);


?>