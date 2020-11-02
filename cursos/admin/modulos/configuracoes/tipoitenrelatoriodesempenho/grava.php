<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoItenRelatorioDesempenho.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoItenRelatorioDesempenho = new TipoItenRelatorioDesempenho();
	

$idTipoItenRelatorioDesempenho = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoItenRelatorioDesempenho->setIdTipoItenRelatorioDesempenho($idTipoItenRelatorioDesempenho);	
	$TipoItenRelatorioDesempenho->updateFieldTipoItenRelatorioDesempenho("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
    $avaliacao = $_POST['avaliacao'];
    $reavaliacao = $_POST['reavaliacao'];
	
	$TipoItenRelatorioDesempenho->setIdTipoItenRelatorioDesempenho($idTipoItenRelatorioDesempenho);
	$TipoItenRelatorioDesempenho->setNome($nome);
	$TipoItenRelatorioDesempenho->setInativo($inativo);
	$TipoItenRelatorioDesempenho->setAvaliacao($avaliacao);
    $TipoItenRelatorioDesempenho->setReavaliacao($reavaliacao);
	
	
	if($idTipoItenRelatorioDesempenho != "" && $idTipoItenRelatorioDesempenho > 0 ){
		$TipoItenRelatorioDesempenho->updateTipoItenRelatorioDesempenho();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoItenRelatorioDesempenho = $TipoItenRelatorioDesempenho->addTipoItenRelatorioDesempenho();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>