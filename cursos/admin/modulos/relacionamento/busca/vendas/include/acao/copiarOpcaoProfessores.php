<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OpcaoBuscaProfessorSelecionada.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapaValidacaoBusca.class.php");

$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
$BuscaProfessor = new BuscaProfessor();


$arrayRetorno = array();
//print_r($_POST);exit;

$idBuscaProfessor = $_POST['idBuscaProfessor'];
$idProfessor = $_POST['idProfessor'];
$p = 0;
if(count($idProfessor)>0){
foreach($idBuscaProfessor as $valor){
$op = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada("WHERE buscaProfessor_idBuscaProfessor = ".$valor);
for($i=0;$i<count($op);$i++){    
   for($j=0;$j<count($idProfessor);$j++){
      $rs = $OpcaoBuscaProfessorSelecionada->selectOpcaoBuscaProfessorSelecionada("WHERE buscaProfessor_idBuscaProfessor = ".$valor." AND professor_idProfessor = ".$idProfessor[$j]);
      if($rs[0]['professor_idProfessor']==""){
         $OpcaoBuscaProfessorSelecionada->setBuscaProfessorIdBuscaProfessor($valor);
         $OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor[$j]);
         $rs = $OpcaoBuscaProfessorSelecionada->addOpcaoBuscaProfessorSelecionada();
         $p++;
       }
    }   
}
}
    $arrayRetorno['mensagem'] = "Aconteceram $p Replicações de Professores.";
    $arrayRetorno['fecharNivel'] = true;
}else{
    $arrayRetorno['mensagem'] = "Nenhum Professor foi selecionado.";
}
echo json_encode($arrayRetorno); 
