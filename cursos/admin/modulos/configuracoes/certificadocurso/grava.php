<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$CertificadoCurso = new CertificadoCurso();
	
$idCertificadoCurso = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$CertificadoCurso->setIdCertificadoCurso($idCertificadoCurso);	
	$CertificadoCurso->updateFieldCertificadoCurso("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$titulo = $_POST['titulo'];
	$conteudo = $_POST['conteudo'];
	
	$area = ( $_POST['area'] == "1" ? 1 : 0);
	$nivel = ( $_POST['nivel'] == "1" ? 1 : 0);
	$certificacao = ( $_POST['certificacao'] == "1" ? 1 : 0);
	$formacao = ( $_POST['formacao'] == "1" ? 1 : 0);
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$CertificadoCurso->setIdCertificadoCurso($idCertificadoCurso);
	$CertificadoCurso->setTitulo($titulo);
	$CertificadoCurso->setConteudo($conteudo);
	$CertificadoCurso->setInativo($inativo);
	$CertificadoCurso->setArea($area);
	$CertificadoCurso->setNivel($nivel);
	$CertificadoCurso->setCertificacao($certificacao);
	$CertificadoCurso->setFormacao($formacao);
	
	
	if($idCertificadoCurso != "" && $idCertificadoCurso > 0 ){
		$CertificadoCurso->updateCertificadoCurso();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idCertificadoCurso = $CertificadoCurso->addCertificadoCurso();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>