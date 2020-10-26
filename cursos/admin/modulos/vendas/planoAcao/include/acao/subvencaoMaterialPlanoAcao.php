<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SubvencaoMaterialPlanoAcao.class.php");

$SubvencaoMaterialPlanoAcao = new SubvencaoMaterialPlanoAcao();

$idSubvencaoMaterialPlanoAcao = $_REQUEST['id'];
$SubvencaoMaterialPlanoAcao->setIdSubvencaoMaterialPlanoAcao($idSubvencaoMaterialPlanoAcao);


$SubvencaoMaterialPlanoAcao->setIntegrantePlanoAcaoIdIntegrantePlanoAcao($_POST['integrantePlanoAcao_idIntegrantePlanoAcao']);
$SubvencaoMaterialPlanoAcao->setSubvencao($_POST['subvencao']);
$SubvencaoMaterialPlanoAcao->setTeto($_POST['teto']);
$SubvencaoMaterialPlanoAcao->setQuemPaga($_POST['quemPaga']);	

$SubvencaoMaterialPlanoAcao->deleteSubvencaoMaterialPlanoAcao(" OR integrantePlanoAcao_idIntegrantePlanoAcao = ".$_POST['integrantePlanoAcao_idIntegrantePlanoAcao']);
	
$SubvencaoMaterialPlanoAcao->addSubvencaoMaterialPlanoAcao();
$arrayRetorno['mensagem'] = MSG_CADNEW;

echo json_encode($arrayRetorno);

?>