<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidaticPlanoAcao.class.php");

$MaterialDidaticPlanoAcao = new MaterialDidaticPlanoAcao();

$idMaterialDidaticPlanoAcao = $_REQUEST['id'];

$MaterialDidaticPlanoAcao->setIdMaterialDidaticPlanoAcao($idMaterialDidaticPlanoAcao);

if($_REQUEST['acao'] == 'deletar'){
	$MaterialDidaticPlanoAcao->setIdMaterialDidaticPlanoAcao($idMaterialDidaticPlanoAcao);
	$MaterialDidaticPlanoAcao->deleteMaterialDidaticPlanoAcao();
	$arrayRetorno['mensagem'] = "Excluído com sucesso";
}else{

	$MaterialDidaticPlanoAcao->setMaterialDidaticoIdMaterialDidatico($_POST['idMaterialDidatico']);
	$MaterialDidaticPlanoAcao->setPlanoAcaoIdPlanoAcao($_REQUEST['idPlanoAcao']);
	
	if($idMaterialDidaticPlanoAcao != "" && $idMaterialDidaticPlanoAcao > 0 ){
		$MaterialDidaticPlanoAcao->updateMaterialDidaticPlanoAcao();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idMaterialDidaticPlanoAcao = $MaterialDidaticPlanoAcao->addMaterialDidaticPlanoAcao();
		$arrayRetorno['mensagem'] = MSG_CADNEW;		
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);

?>