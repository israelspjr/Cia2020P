<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidatico.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$MaterialDidatico = new MaterialDidatico();

$idMaterialDidatico = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
			
	$MaterialDidatico->setIdMaterialDidatico($idMaterialDidatico);	
	$MaterialDidatico->updateFieldMaterialDidatico("excluido", "1");	
		
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$editoraMaterialDidatico_idEditoraMaterialDidatico = $_POST['idEditoraMaterialDidatico'];
	$materialDidaticoTipo_idMaterialDidaticoTipo = $_POST['idTipoMaterialDidatico'];
	$idioma_idIdioma = $_POST['idIdioma'];
	$isbn = $_POST['isbn'];
	$valor = $_POST['valor'];
	$opcional = $_POST['opcional'];
	$obs = $_POST['obs'];
	
	$nome = $_POST['nome'];
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$MaterialDidatico->setIdMaterialDidatico($idMaterialDidatico);
	$MaterialDidatico->setEditoraMaterialDidaticoIdEditoraMaterialDidatico($editoraMaterialDidatico_idEditoraMaterialDidatico);
	$MaterialDidatico->setMaterialDidaticoTipoIdMaterialDidaticoTipo($materialDidaticoTipo_idMaterialDidaticoTipo);
	$MaterialDidatico->setIdiomaIdIdioma($idioma_idIdioma);
	$MaterialDidatico->setIsbn($isbn);
	$MaterialDidatico->setValor($valor);
	$MaterialDidatico->setOpcional($opcional);
	$MaterialDidatico->setObs($obs);
	$MaterialDidatico->setInativo($inativo);
	$MaterialDidatico->setNome($nome);
	
	
	
	if($idMaterialDidatico != "" && $idMaterialDidatico > 0 ){
		$MaterialDidatico->updateMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idMaterialDidatico = $MaterialDidatico->addMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>