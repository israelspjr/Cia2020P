<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$idIdiomabackgroundperfil = $_REQUEST['id'];	

$IdiomaBackgroundPerfil = new IdiomaBackgroundPerfil();
//echo "//";exit;		
$IdiomaBackgroundPerfil->setIdIdiomaBackgroundPerfil($idIdiomabackgroundperfil);

if($_POST['acao'] == 'deletar'){
	
	$IdiomaBackgroundPerfil->deleteIdiomabackgroundperfil();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$IdiomaBackgroundPerfil->setClientePfIdClientePf($_POST['clientePf_idClientePf']);	
	$IdiomaBackgroundPerfil->setIdiomaIdIdioma($_POST['idIdioma']);
	$IdiomaBackgroundPerfil->setEscolaIdEscola($_POST['idEscola']);
	$IdiomaBackgroundPerfil->setObs($_POST['obs']);
	
	if($idIdiomabackgroundperfil != "" && $idIdiomabackgroundperfil > 0 ){
		$IdiomaBackgroundPerfil->updateIdiomabackgroundperfil();
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idIdiomabackgroundperfil = $IdiomaBackgroundPerfil->addIdiomabackgroundperfil();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
	
?>
