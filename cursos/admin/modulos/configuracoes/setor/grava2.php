<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Setor = new Setor();

$arrayRetorno = array();

$idSetor = $_REQUEST['id'];
$Setor->setIdSetor($idSetor);

if($_POST['acao']=="deletar"){
	
	$Setor->setIdSetor($idFuncionarioSetor);
	$Setor->deleteSetor();

	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{

	$Setor->setNome($_POST['nome']);
	$Setor->setExcluido($_POST['excluido']);
	
	if( $idSetor != "" && $idSetor > 0 ){
		$Setor->updateSetor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idSetor = $Setor->addSetor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;		
	}
	
	$arrayRetorno['fecharNivel'] = true;
		
}

echo json_encode($arrayRetorno);

?>