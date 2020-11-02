<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PeriodoAcompanhamentoCurso.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
	

$idPeriodoAcompanhamentoCurso = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$PeriodoAcompanhamentoCurso->setIdPeriodoAcompanhamentoCurso($idPeriodoAcompanhamentoCurso);	
	$PeriodoAcompanhamentoCurso->updateFieldPeriodoAcompanhamentoCurso("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$PeriodoAcompanhamentoCurso->setIdPeriodoAcompanhamentoCurso($idPeriodoAcompanhamentoCurso);
	$PeriodoAcompanhamentoCurso->setMes($mes);
	$PeriodoAcompanhamentoCurso->setAno($ano);
	
	
	
	if($idPeriodoAcompanhamentoCurso != "" && $idPeriodoAcompanhamentoCurso > 0 ){
		$PeriodoAcompanhamentoCurso->updatePeriodoAcompanhamentoCurso();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idPeriodoAcompanhamentoCurso = $PeriodoAcompanhamentoCurso->addPeriodoAcompanhamentoCurso();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>