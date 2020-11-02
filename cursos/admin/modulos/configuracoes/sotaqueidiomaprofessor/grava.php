<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SotaqueIdiomaProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();
	

$idSotaqueIdiomaProfessor = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$SotaqueIdiomaProfessor->setIdSotaqueIdiomaProfessor($idSotaqueIdiomaProfessor);	
	$SotaqueIdiomaProfessor->updateFieldSotaqueIdiomaProfessor("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$idioma_idIdioma = $_POST['idIdioma'];
	$valor = $_POST['valor'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$SotaqueIdiomaProfessor->setIdSotaqueIdiomaProfessor($idSotaqueIdiomaProfessor);
	$SotaqueIdiomaProfessor->setIdiomaIdIdioma($idioma_idIdioma);
	$SotaqueIdiomaProfessor->setValor($valor);
	$SotaqueIdiomaProfessor->setInativo($inativo);
	
	
	
	if($idSotaqueIdiomaProfessor != "" && $idSotaqueIdiomaProfessor > 0 ){
		$SotaqueIdiomaProfessor->updateSotaqueIdiomaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idSotaqueIdiomaProfessor = $SotaqueIdiomaProfessor->addSotaqueIdiomaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>