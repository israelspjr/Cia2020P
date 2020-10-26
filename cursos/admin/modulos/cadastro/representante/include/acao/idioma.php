<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RepresentanteIdioma.class.php");


$RepresentanteIdioma = new RepresentanteIdioma();

$idRepresentanteIdioma= $_REQUEST['id'];
$idRepresentante= $_REQUEST['idRepresentante'];

if($_REQUEST['acao'] == 'deletar'){
	$RepresentanteIdioma->setIdRepresentanteIdioma($idRepresentanteIdioma);
	$RepresentanteIdioma->deleteRepresentanteIdioma();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
}else{

	$RepresentanteIdioma->setIdRepresentanteIdioma($idRepresentanteIdioma);
	$RepresentanteIdioma->setRepresentanteIdRepresentante($idRepresentante);
	$RepresentanteIdioma->setIdiomaIdIdioma($_POST['idIdioma']);
	
	
	if($idRepresentanteIdioma!= "" && $idRepresentanteIdioma> 0 ){
		$RepresentanteIdioma->updateRepresentanteIdioma();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;
	}else{
		$idRepresentanteIdioma = $RepresentanteIdioma->addRepresentanteIdioma();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
	}				
}

echo json_encode($arrayRetorno);

?>