<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EnderecoVirtual.class.php");

$arrayRetorno = array();
$idworkshop = $_REQUEST['idworkshop'];

$Workshop = new Workshop();   
$Workshop->setidWorkshop($idworkshop);

if($_POST['acao'] == 'deletar'){
  
  $Workshop->setidWorkshop($idworkshop);
  $Workshop->updateFieldWorkShop("excluido", "1");
  $arrayRetorno['mensagem'] = MSG_CADDEL;
  
}else{  
  
  $Workshop->setTema($_POST['tema']);
  $Workshop->setVagas($_POST['vagas']);
  $Workshop->setDataEvento($_POST['dataEvento']);
  $Workshop->setInicio($_POST['inicio']);
  $Workshop->setTermino($_POST['termino']);  
  $Workshop->setFinalizado($_POST['finalizado']);
  $Workshop->setExcluido($_POST['excluido']);


  
  if($idworkshop != "" && $idworkshop > 0 ){
    $Workshop->updateWorkShop();
    $arrayRetorno['mensagem'] = MSG_CADATU;     
  }else{
    $idworkshop = $Workshop->addWorkShop();    
    $arrayRetorno['mensagem'] = MSG_CADNEW;
    $arrayRetorno['fecharNivel'] = true;    
  }
  
  
}
echo json_encode($arrayRetorno);
  
?>
