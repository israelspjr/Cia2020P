<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelLinguistico.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$NivelLinguistico = new NivelLinguistico();
	

$idNivelLinguistico = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$NivelLinguistico->setIdNivelLinguistico($idNivelLinguistico);	
	$NivelLinguistico->updateFieldNivelLinguistico("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nivel = $_POST['nivel'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$NivelLinguistico->setIdNivelLinguistico($idNivelLinguistico);
	$NivelLinguistico->setNivel($nivel);
	$NivelLinguistico->setInativo($inativo);
	
	
	
	if($idNivelLinguistico != "" && $idNivelLinguistico > 0 ){
		$NivelLinguistico->updateNivelLinguistico();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idNivelLinguistico = $NivelLinguistico->addNivelLinguistico();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>