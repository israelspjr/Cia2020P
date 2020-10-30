<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$CreditoDebitoGrupo = new CreditoDebitoGrupo();

$arrayRetorno = array();



if($_POST['acao']=="deletar"){
    
    $arrayRetorno['mensagem'] = MSG_CADDEL;;
    
    
    $idCreditoDebitoGrupo = $_REQUEST['id'];
    $CreditoDebitoGrupo->setIdCreditoDebitoGrupo($idCreditoDebitoGrupo);
    $CreditoDebitoGrupo->updateFieldCreditoDebitoGrupo('excluido',1);

    echo json_encode($arrayRetorno);
    
}else{
    
    $idCreditoDebitoGrupo = $_REQUEST['id'];

    $CreditoDebitoGrupo->setIdCreditoDebitoGrupo($idCreditoDebitoGrupo);
    $CreditoDebitoGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
    if($_POST['flagEmpresa']==1)
    $CreditoDebitoGrupo->setQuem('E');
    else
    $CreditoDebitoGrupo->setQuem('A');
        
    $CreditoDebitoGrupo->setTipo($_POST['tipo']);
    $CreditoDebitoGrupo->setValor($_POST['valor']);
    $CreditoDebitoGrupo->setMes($_POST['mes']);
    $CreditoDebitoGrupo->setAno($_POST['ano']);
    $CreditoDebitoGrupo->setObs($_POST['obs']);
    $CreditoDebitoGrupo->setExcluido("0");

if($idCreditoDebitoGrupo != "" && $idCreditoDebitoGrupo > 0 ){
        $CreditoDebitoGrupo->updateCreditoDebitoGrupo();
        $arrayRetorno['mensagem'] = MSG_CADATU;
        $arrayRetorno['atualizarNivelAtual'] = true;
    }else{
        $idCreditoDebitoGrupo = $CreditoDebitoGrupo->addCreditoDebitoGrupo();
        $arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/form/creditoDebitoGrupo.php?idPlanoAcaoGrupo=".$_POST['idPlanoAcaoGrupo'];
        $arrayRetorno['atualizarNivelAtual'] = true;
    }
    
    echo json_encode($arrayRetorno);
}
?>