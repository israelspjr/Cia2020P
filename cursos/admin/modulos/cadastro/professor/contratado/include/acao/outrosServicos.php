<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/CreditoDebitoGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$OutrosServicos = new OutrosServicos();

$arrayRetorno = array();
$idOutrosServicos = $_REQUEST['id'];

if($_POST['acao']=="deletar"){
    
    $arrayRetorno['mensagem'] = MSG_CADDEL;   
	$OutrosServicos->setidOutrosServicos($idOutrosServicos);
    $OutrosServicos->deleteOutrosServicos();

    echo json_encode($arrayRetorno);
    
}else{

	$impostos = ( $_REQUEST['impostos'] == "1" ? 1 : 0);

$OutrosServicos->setProfessorIdProfessor($_POST['idProfessor']);
$OutrosServicos->setTipo($_POST['tipo']);
$OutrosServicos->setValor($_POST['valor']);
$OutrosServicos->setMes($_POST['mes']);
$OutrosServicos->setAno($_POST['ano']);
$OutrosServicos->setObs($_POST['obs']);
$OutrosServicos->setImpostos($impostos);

if($idOutrosServicos != "" && $idOutrosServicos > 0 ){        
		$OutrosServicos->setIdOutrosServicos($idOutrosServicos);
		$OutrosServicos->updateOutrosServicos();
        $arrayRetorno['mensagem'] = MSG_CADATU;
	//	 $arrayRetorno['atualizarNivelAtual'] = true;
    //    $arrayRetorno['fecharNivel'] = true;
    }else{
        $OutrosServicos->addOutrosServicos();
        $arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['pagina'] = CAMINHO_CAD."professor/contratado/include/form/outrosServicos.php?idProfessor=".$_POST['idProfessor'];
		 $arrayRetorno['atualizarNivelAtual'] = true;
  //      $arrayRetorno['fecharNivel'] = true;
   }
    
    echo json_encode($arrayRetorno);
}
?>