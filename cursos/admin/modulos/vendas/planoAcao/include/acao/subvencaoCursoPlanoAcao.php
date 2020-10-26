<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SubvencaoCursoPlanoAcao.class.php");

$SubvencaoCursoPlanoAcao = new SubvencaoCursoPlanoAcao();

$idSubvencaoCursoPlanoAcao = $_REQUEST['id'];
$SubvencaoCursoPlanoAcao->setIdSubvencaoCursoPlanoAcao($idSubvencaoCursoPlanoAcao);

$SubvencaoCursoPlanoAcao->setIntegrantePlanoAcaoIdIntegrantePlanoAcao($_POST['integrantePlanoAcao_idIntegrantePlanoAcao']);
$SubvencaoCursoPlanoAcao->setSubvencao($_POST['subvencao']);
$SubvencaoCursoPlanoAcao->setTeto($_POST['teto']);
$SubvencaoCursoPlanoAcao->setQuemPaga($_POST['quemPaga']);	

$SubvencaoCursoPlanoAcao->deleteSubvencaoCursoPlanoAcao(" OR integrantePlanoAcao_idIntegrantePlanoAcao = ".$_POST['integrantePlanoAcao_idIntegrantePlanoAcao']);
	
$SubvencaoCursoPlanoAcao->addSubvencaoCursoPlanoAcao();
$arrayRetorno['mensagem'] = MSG_CADNEW;

echo json_encode($arrayRetorno);

?>