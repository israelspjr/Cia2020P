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
	
	$premiacao = ( $_REQUEST['premiacao'] == "1" ? 1 : 0);
    
    $idCreditoDebitoGrupo = $_REQUEST['id'];
	$CreditoDebitoGrupo->setIdCreditoDebitoGrupo($idCreditoDebitoGrupo);
	$CreditoDebitoGrupo->setProfessorIdProfessor($_POST['idProfessor']);
	$CreditoDebitoGrupo->setTipo($_POST['tipo']);
	$CreditoDebitoGrupo->setValor($_POST['valor']);
	$CreditoDebitoGrupo->setMes($_POST['mes']);
	$CreditoDebitoGrupo->setAno($_POST['ano']);
	$CreditoDebitoGrupo->setObs($_POST['obs']);
	$CreditoDebitoGrupo->setQuem("A");
	$CreditoDebitoGrupo->setExcluido("0");
	$CreditoDebitoGrupo->setPremiacao($premiacao);
	$CreditoDebitoGrupo->setGrupoIdGrupo($_REQUEST['idGrupo']);

if($idCreditoDebitoGrupo != "" && $idCreditoDebitoGrupo > 0 ){
        $CreditoDebitoGrupo->updateCreditoDebitoGrupo();
        $arrayRetorno['mensagem'] = MSG_CADATU;
    //    $arrayRetorno['fecharNivel'] = true;
    }else{
        $idCreditoDebitoGrupo =$CreditoDebitoGrupo->addCreditoDebitoGrupo();
        $arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['pagina'] = CAMINHO_CAD."professor/contratado/include/form/creditoDebitoGrupo.php?idProfessor=".$_POST['idProfessor'];
        $arrayRetorno['atualizarNivelAtual'] = true;
 //       $arrayRetorno['fecharNivel'] = true;
    }
    
    echo json_encode($arrayRetorno);
}
?>