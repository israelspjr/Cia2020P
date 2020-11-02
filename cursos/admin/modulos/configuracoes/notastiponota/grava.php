<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NotasTipoNota.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$NotasTipoNota = new NotasTipoNota();
	

$idNotasTipoNota = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$NotasTipoNota->setIdNotasTipoNota($idNotasTipoNota);	
	$NotasTipoNota->updateFieldNotasTipoNota("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipoNota_idTipoNota = $_POST['idTipoNota'];
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$NotasTipoNota->setIdNotasTipoNota($idNotasTipoNota);
	$NotasTipoNota->setTipoNotaIdTipoNota($tipoNota_idTipoNota);
	$NotasTipoNota->setNome($nome);
	$NotasTipoNota->setInativo($inativo);
	
	
	
	if($idNotasTipoNota != "" && $idNotasTipoNota > 0 ){
		$NotasTipoNota->updateNotasTipoNota();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idNotasTipoNota = $NotasTipoNota->addNotasTipoNota();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>