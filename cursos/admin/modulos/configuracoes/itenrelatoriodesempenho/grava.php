<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenRelatorioDesempenho.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ItenRelatorioDesempenho = new ItenRelatorioDesempenho();
	

$idItenRelatorioDesempenho = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ItenRelatorioDesempenho->setIdItenRelatorioDesempenho($idItenRelatorioDesempenho);	
	$ItenRelatorioDesempenho->updateFieldItenRelatorioDesempenho("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	$tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = $_POST['idTipoItenRelatorioDesempenho'];
	
	$orientacao = $_POST['orientacao'];
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ItenRelatorioDesempenho->setIdItenRelatorioDesempenho($idItenRelatorioDesempenho);
	$ItenRelatorioDesempenho->setNome($nome);
	$ItenRelatorioDesempenho->setInativo($inativo);
	$ItenRelatorioDesempenho->setTipoItenRelatorioDesempenhoIdTipoItenRelatorioDesempenho($tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho);
	$ItenRelatorioDesempenho->setOrientacao($orientacao);
	
	
	if($idItenRelatorioDesempenho != "" && $idItenRelatorioDesempenho > 0 ){
		$ItenRelatorioDesempenho->updateItenRelatorioDesempenho();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idItenRelatorioDesempenho = $ItenRelatorioDesempenho->addItenRelatorioDesempenho();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>