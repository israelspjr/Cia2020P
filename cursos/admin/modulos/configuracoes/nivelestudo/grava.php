<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelEstudo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$NivelEstudo = new NivelEstudo();
	

$idNivelEstudo = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$NivelEstudo->setIdNivelEstudo($idNivelEstudo);	
	$NivelEstudo->updateFieldNivelEstudo("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nivel = $_POST['nivel'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$NivelEstudo->setIdNivelEstudo($idNivelEstudo);
	$NivelEstudo->setNivel($nivel);
	$NivelEstudo->setInativo($inativo);
	
	
	
	if($idNivelEstudo != "" && $idNivelEstudo > 0 ){
		$NivelEstudo->updateNivelEstudo();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idNivelEstudo = $NivelEstudo->addNivelEstudo();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>