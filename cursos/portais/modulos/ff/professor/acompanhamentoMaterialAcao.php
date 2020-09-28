<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$AcompanhamentoMaterial = new AcompanhamentoMaterial();

$arrayRetorno = array();

$idAcompanhamentoMaterial = $_REQUEST['id'];


if($_POST['acao']=="deletar"){
    
    $arrayRetorno['mensagem'] = MSG_CADDEL;;
    
    
    $idAcompanhamentoMaterial = $_REQUEST['id'];
    $AcompanhamentoMaterial->setIdAcompanhamentoMaterial($idAcompanhamentoMaterial);
    $AcompanhamentoMaterial->deleteAcompanhamentoMaterial();

    echo json_encode($arrayRetorno);
    
}else{
    
    $idAcompanhamentoMaterial = $_POST['idAcompanhamentoMaterial'];
    $idkit = $_POST['idKit'];
    $idMontado = $_POST['idMontado'];
    $idPlan = $_POST['idPlan'];
    $idFolhaFrequencia = $_POST['idFolhaFrequencia'];
    $unidade = $_POST['unidade'];
    $obs = $_POST['obs'];
    $data = new DateTime();
    
    $AcompanhamentoMaterial->setIdAcompanhamentoMaterial($idAcompanhamentoMaterial);  
    $AcompanhamentoMaterial->setfolhaFrequencia_idFolhaFrequencia($idFolhaFrequencia);
    $AcompanhamentoMaterial->setKitMaterial_idKitMAterial($idkit);
    $AcompanhamentoMaterial->setMaterialMontadoPlanoAcao_idMaterialMontadoPlanoAcao($idMontado);
    $AcompanhamentoMaterial->setMaterialDidaticPlanoAcao_idMaterialDidaticPlanoAcao($idPlan);
    $AcompanhamentoMaterial->setUnidade($unidade);
    $AcompanhamentoMaterial->setObs($obs);
    $AcompanhamentoMaterial->setDataCadastro($data->format("d/m/Y"));
        
if($idAcompanhamentoMaterial != "" && $idAcompanhamentoMaterial > 0 ){
          
        $AcompanhamentoMaterial->updateAcompanhamentoMaterial();
   //     $arrayRetorno['mensagem'] = MSG_CADATU;
    //    $arrayRetorno['fecharNivel'] = true;
    }else{
        $idAcompanhamentoMaterial = $AcompanhamentoMaterial->addAcompanhamentoMaterial();
    //    $arrayRetorno['mensagem'] = MSG_CADNEW;
    //    $arrayRetorno['fecharNivel'] = true;
    }
	 $arrayRetorno['ondeAtualizar'] = "#div_ff_geral";
	$arrayRetorno['pagina'] = "modulos/ff/professor/folhaFrequencia.php?idFolhaFrequencia=".$idFolhaFrequencia;	
//	$arrayRetorno['fecharNivel'] = true;
    
    echo json_encode($arrayRetorno);
}
?>