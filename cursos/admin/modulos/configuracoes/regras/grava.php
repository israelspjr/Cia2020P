<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Regras = new Regras();

$idRegras = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$Regras->setIdRegras($idRegras);	
	$Regras->updateFieldRegras("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tituloRegra = $_POST['tituloRegra'];
	$regra = $_POST['regra'];
	
	$padrao = $_POST['padrao'];
	$tipoCursoIdCurso = implode(",", $_POST['idTipoCurso']);
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$B2B = ( $_POST['B2B'] == "1" ? 1 : 0);
	$B2C = ( $_POST['B2C'] == "1" ? 1 : 0);
	
	$Regras->setIdRegras($idRegras);
	$Regras->setTituloRegra($tituloRegra);
	$Regras->setRegra($regra);
	$Regras->setInativo($inativo);
	$Regras->setPadrao($padrao);
	$Regras->setTipoCursoIdCurso($tipoCursoIdCurso);
	$Regras->setB2b($B2B);
	$Regras->setB2c($B2C);
	$Regras->setPlanoAcaoIdPlanoAcao($_REQUEST['idPlanoAcao']);
	
	
	if($idRegras != "" && $idRegras > 0 ){
		$Regras->updateRegras();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idRegras = $Regras->addRegras();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>