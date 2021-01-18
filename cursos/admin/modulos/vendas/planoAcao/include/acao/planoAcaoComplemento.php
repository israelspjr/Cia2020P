<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
    
$arrayRetorno = array();

$idPlanoAcao = $_REQUEST['id']; 

$PlanoAcaoComplemento = new PlanoAcaoComplemento();   
$Abordagem = new ComplementoAbordagem();

//DELETE TODAS OPÇOES ANTES DE INSERIR NOVAMENTE
$PlanoAcaoComplemento->deletePlanoAcaoComplemento(" OR ( planoAcao_idPlanoAcao = ".$idPlanoAcao.")");

$valoresAbordagem = $Abordagem->selectComplementoAbordagem(" WHERE inativo = 0 ");

for ($row = 0; $row < count($valoresAbordagem); $row++){
  $idField = $valoresAbordagem[$row]['idComplementoAbordagem'];    
  $field = $_POST["dcheck_abordagem_".$idField];
    
  // INSERE AS OPÇOES MARCADAS    
  if($field==1){
    $PlanoAcaoComplemento->setComplementoAbordagemIdComplementoAbordagem($idField);
    $PlanoAcaoComplemento->setplanoAcao_idPlanoAcao($idPlanoAcao);    
    $PlanoAcaoComplemento->addPlanoAcaoComplemento();   
  }
}


$arrayRetorno['mensagem'] = MSG_CADNEW;
$arrayRetorno['pagina'] = CAMINHO_VENDAS."planoAcao/include/form/planoAcaoComplemento.php?id=".$idPlanoAcao;
$arrayRetorno['ondeAtualizar'] = "#div_Abordagem_PlanoAcao";

echo json_encode($arrayRetorno);  

?>
