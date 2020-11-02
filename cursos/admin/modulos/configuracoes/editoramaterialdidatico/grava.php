<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EditoraMaterialDidatico.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$EditoraMaterialDidatico = new EditoraMaterialDidatico();
	

$idEditoraMaterialDidatico = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$EditoraMaterialDidatico->setIdEditoraMaterialDidatico($idEditoraMaterialDidatico);	
	$EditoraMaterialDidatico->updateFieldEditoraMaterialDidatico("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$editora = $_POST['editora'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$EditoraMaterialDidatico->setIdEditoraMaterialDidatico($idEditoraMaterialDidatico);
	$EditoraMaterialDidatico->setEditora($editora);
	$EditoraMaterialDidatico->setInativo($inativo);
	
	
	
	if($idEditoraMaterialDidatico != "" && $idEditoraMaterialDidatico > 0 ){
		$EditoraMaterialDidatico->updateEditoraMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idEditoraMaterialDidatico = $EditoraMaterialDidatico->addEditoraMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>