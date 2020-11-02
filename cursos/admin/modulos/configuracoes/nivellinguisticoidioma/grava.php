<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelLinguisticoIdioma.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$NivelLinguisticoIdioma = new NivelLinguisticoIdioma();
	

$idNivelLinguisticoIdioma = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$NivelLinguisticoIdioma->setIdNivelLinguisticoIdioma($idNivelLinguisticoIdioma);	
	$NivelLinguisticoIdioma->updateFieldNivelLinguisticoIdioma("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nivelLinguistico_idNivelLinguistico = $_POST['idNivelLinguistico'];
	$idioma_idIdioma = $_POST['idIdioma'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$NivelLinguisticoIdioma->setIdNivelLinguisticoIdioma($idNivelLinguisticoIdioma);
	$NivelLinguisticoIdioma->setNivelLinguisticoIdNivelLinguistico($nivelLinguistico_idNivelLinguistico);
	$NivelLinguisticoIdioma->setIdiomaIdIdioma($idioma_idIdioma);
	$NivelLinguisticoIdioma->setInativo($inativo);
	
	
	
	if($idNivelLinguisticoIdioma != "" && $idNivelLinguisticoIdioma > 0 ){
		$NivelLinguisticoIdioma->updateNivelLinguisticoIdioma();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idNivelLinguisticoIdioma = $NivelLinguisticoIdioma->addNivelLinguisticoIdioma();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>