<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RegistroDeAnotacoes.class.php");


$RegistroDeAnotacoes = new RegistroDeAnotacoes();




$arrayRetorno = array();



if($_POST['acao']=="deletar"){
	

	$idRegistroDeAnotacoes = $_REQUEST['id'];
	$RegistroDeAnotacoes->setIdRegistroDeAnotacoes($idRegistroDeAnotacoes);
	$RegistroDeAnotacoes->deleteRegistroDeAnotacoes();
	$arrayRetorno['mensagem'] = MSG_CADDEL;

	echo json_encode($arrayRetorno);
	
}else{
	
	$idRegistroDeAnotacoes = $_REQUEST['id'];
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

	$RegistroDeAnotacoes->setIdRegistroDeAnotacoes($idRegistroDeAnotacoes);
	
	$RegistroDeAnotacoes->setPropostaIdProposta($_POST['proposta_idProposta']);	
	$RegistroDeAnotacoes->setPlanoAcaoIdPlanoAcao($_POST['planoAcao_idPlanoAcao']);
	$RegistroDeAnotacoes->setPlanoAcaoGrupoIdPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
	$RegistroDeAnotacoes->setTitulo($_POST['titulo']);
	$RegistroDeAnotacoes->setAnotacao($_POST['anotacao']);
	$RegistroDeAnotacoes->setDataNovoContato( Uteis::gravarData($_POST['dataNovoContato']) );
		
	if($idRegistroDeAnotacoes != "" && $idRegistroDeAnotacoes > 0 ){
		$RegistroDeAnotacoes->updateRegistroDeAnotacoes();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
				
		$idRegistroDeAnotacoes= $RegistroDeAnotacoes->addRegistroDeAnotacoes();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		
	}
	
	$arrayRetorno['fecharNivel'] = true;
	
	echo json_encode($arrayRetorno);
}



?>