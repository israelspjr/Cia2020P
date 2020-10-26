<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialMontadoPlanoAcao.class.php");

$MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();

$idMaterialMontadoPlanoAcao = $_REQUEST['id'];
$MaterialMontadoPlanoAcao->setIdMaterialMontadoPlanoAcao($idMaterialMontadoPlanoAcao);

if($_REQUEST['acao'] == 'deletar'){
	
	$MaterialMontadoPlanoAcao->deleteMaterialMontadoPlanoAcao();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
	
}else{
	
	$MaterialMontadoPlanoAcao->setPlanoAcaoIdPlanoAcao($_POST['idPlanoAcao']);
	$MaterialMontadoPlanoAcao->setNome($_POST['nome']);
	$MaterialMontadoPlanoAcao->setPreco($_POST['preco']);
	$MaterialMontadoPlanoAcao->setObs($_POST['obs']);
	
	
	if($idMaterialMontadoPlanoAcao != "" && $idMaterialMontadoPlanoAcao > 0 ){
		$MaterialMontadoPlanoAcao->updateMaterialMontadoPlanoAcao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;
		
	}else{
		$idMaterialMontadoPlanoAcao = $MaterialMontadoPlanoAcao->addMaterialMontadoPlanoAcao();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

echo json_encode($arrayRetorno);

?>