<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$Permissao = new PermProfessor();
$idPer = $Permissao->setIdPerProfGroup($_POST['id']);
$porfessor = $_GET['idProfessor'];
$grupo = $_POST['idGrupo'];
$ativo = $_POST['permissao'];


if($_POST['acao'] == 'deletar'){
       
    $Permissao->deletePerm();
    $arrayRetorno['mensagem'] = MSG_CADDEL;
 
}else{
    
    $Permissao->setGrupoIdGrupo($grupo);
    $Permissao->setProfessorIdProfessor($porfessor);
    $Permissao->setPerAtivo($ativo);
    
    if($idPer != "" || $idPer > 0 ){
        
        $Permissao->updatePerm();
        $arrayRetorno['mensagem'] = MSG_CADATU;  
      
               
    }else{
        
        $Permissao->addPerm();        
        $arrayRetorno['mensagem'] = MSG_CADNEW;    
           
    }
    
      $arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);