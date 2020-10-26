<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$QualidadeComunicacaoPlanoAcao = new QualidadeComunicacaoPlanoAcao();//checks marcados

$idIntegrantePlanoAcao = $_POST['idIntegrantePlanoAcao'];
//deletar todas
$QualidadeComunicacaoPlanoAcao->deleteQualidadeComunicacaoPlanoAcaoTodo("WHERE integrantesPlanoAcao_idIntegrantesPlanoAcao=".$idIntegrantePlanoAcao);

foreach($_POST['iten'] as $valor){
	$QualidadeComunicacaoPlanoAcao->setIntegrantesPlanoAcaoIdIntegrantesPlanoAcao($idIntegrantePlanoAcao);
    $QualidadeComunicacaoPlanoAcao->setItenQualidadeComunicacaoIdItenQualidadeComunicacao($valor);
    
	$QualidadeComunicacaoPlanoAcao->addQualidadeComunicacaoPlanoAcao();
}

$arrayRetorno['mensagem'] = "Atualizado com sucesso";


echo json_encode($arrayRetorno);
?>