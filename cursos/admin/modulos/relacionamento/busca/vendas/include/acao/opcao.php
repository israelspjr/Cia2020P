<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = new EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada();
$EtapaValidacaoBusca = new EtapaValidacaoBusca();

$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];	
$idProfessor = $_REQUEST['idProfessor'];
$mudarAba = $_REQUEST['mudarAba'];	
$aceito = $_REQUEST['negativa'];
$remover = $_REQUEST['remover'];
$arrayRetorno = array();

if($idProfessor != ""){
if($remover!=""){
    
  $resp = $OpcaoBuscaProfessorSelecionada->deleteOpcaoBuscaProfessorSelecionada("(buscaProfessor_idBuscaProfessor=".$idBuscaProfessor." AND professor_idProfessor =".$idProfessor.")");
  if($resp){
   $arrayRetorno['mensagem'] = "Professor Removido com sucesso";   
   $arrayRetorno['mudarAba']  = $mudarAba;
   }
}elseif($aceito == 0) {
	    	
    $OpcaoBuscaProfessorSelecionada->setAceito(2);
    $OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
    $OpcaoBuscaProfessorSelecionada->setBuscaProfessorIdBuscaProfessor($idBuscaProfessor);
    $idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upAceito();
    
        $arrayRetorno['mensagem'] = "Aula foi aceita pelo Professor.";  
	    $arrayRetorno['mudarAba']  = $mudarAba;       
    
}elseif($aceito == 1){
    $OpcaoBuscaProfessorSelecionada->setAceito(3);
    $OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
    $OpcaoBuscaProfessorSelecionada->setBuscaProfessorIdBuscaProfessor($idBuscaProfessor);
    $idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upRejeito();
    
        $arrayRetorno['mensagem'] = "Aula não foi aceita pelo Professor.";   
        $arrayRetorno['mudarAba']  = $mudarAba;     

}elseif($aceito == 2){
        
	$OpcaoBuscaProfessorSelecionada->setAceito(1);
	$OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
	$OpcaoBuscaProfessorSelecionada->setBuscaProfessorIdBuscaProfessor($idBuscaProfessor);

	$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upEscolha();		
	
	//ADICIONAR NA TABELA ETAPAS!
	$where = " WHERE opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada = ".$idOpcaoBuscaProfessorSelecionada;
	$rsTem = $EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada($where);
	if(!$rsTem){
		$rsEtapaValidacaoBusca = $EtapaValidacaoBusca->selectEtapaValidacaoBusca(" WHERE inativo = 0");		
		foreach($rsEtapaValidacaoBusca as $valor){
			
			$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->setEtapaValidacaoBuscaIdEtapaValidacaoBusca($valor['idEtapaValidacaoBusca']);
			$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->setOpcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada($idOpcaoBuscaProfessorSelecionada);
			$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->setConcluida(1);
			
			$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->addEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada();
			
			
		}
	}
	$arrayRetorno['mensagem'] = "Professor Selecionado para Aula";	
	$arrayRetorno['fecharNivel'] = true;
//	$arrayRetorno['mudarAba']  = $mudarAba;
    }
}
echo json_encode($arrayRetorno);