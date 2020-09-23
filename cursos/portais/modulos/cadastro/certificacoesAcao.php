<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$arrayRetorno = array();
$idCertificacoes = $_REQUEST['id'];	

$Certificacoes = new Certificacoes();		
$Certificacoes->setidCertificacoes($idCertificacoes);

if($_POST['acao'] == 'deletar'){
	
	$Certificacoes->deleteCertificacoes();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	$arrayRetorno['ondeAtualizar'] = "#div_lista_certificacoes";
	$arrayRetorno['pagina'] = "modulos/cadastro/certificacoes.php?$idCertificacoes=".$$idCertificacoes;
	$arrayRetorno['fecharNivel'] = true;
	
}else{	
	
	$Certificacoes->setProfessorIdProfessor($_POST['professor_idProfessor']);
	$Certificacoes->setCertificado($_POST['idCertificadoCurso']);
	$Certificacoes->setAno($_POST['ano']);
	$Certificacoes->setTipo($_POST['tipo']);
	$Certificacoes->setIdiomaIdIdioma($_POST['idIdioma']);
	
	if($idCertificacoes != "" && $idCertificacoes > 0 ){
		$Certificacoes->updateCertificacoes();
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idCertificacoes = $Certificacoes->addCertificacoes();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['ondeAtualizar'] = "#div_lista_certificacoes";
	$arrayRetorno['pagina'] = "modulos/cadastro/certificacoes.php?idProfessor=".$_POST['professor_idProfessor'];
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
