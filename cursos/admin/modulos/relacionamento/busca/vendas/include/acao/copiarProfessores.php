<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada = new EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada();
$EtapaValidacaoBusca = new EtapaValidacaoBusca();

$arrayRetorno = array();
//print_r($_POST);exit;

$idBuscaProfessor = $_POST['idBuscaProfessor'];
$idProfessor = $_POST['idProfessor'];
$valorHora = $_POST['valorHora'];

$rsBusca = $_POST['copiarDia'];

if($rsBusca){
	
	$OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
	$OpcaoBuscaProfessorSelecionada->setAceito("1");
	$OpcaoBuscaProfessorSelecionada->setObs("Adicionado pelo sistema via replicação.");
    $OpcaoBuscaProfessorSelecionada->setValorHora($valorHora);
	
	foreach($rsBusca as $valorBusca){
		
		$OpcaoBuscaProfessorSelecionada->setBuscaProfessorIdBuscaProfessor($valorBusca);	
		$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->addOpcaoBuscaProfessorSelecionada();
		
		//ADICIONAR NA TABELA ETAPAS!
		$where = " WHERE opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada = ".$idOpcaoBuscaProfessorSelecionada;
		$rsTem = $EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->selectEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada($where);
		if(!$rsTem){
			$rsEtapaValidacaoBusca = $EtapaValidacaoBusca->selectEtapaValidacaoBusca(" WHERE inativo = 0");		
			foreach($rsEtapaValidacaoBusca as $valor){
				
				$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->setEtapaValidacaoBuscaIdEtapaValidacaoBusca($valor['idEtapaValidacaoBusca']);
				$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->setOpcaoBuscaProfessorSelecionadaIdOpcaoBuscaProfessorSelecionada($idOpcaoBuscaProfessorSelecionada);
				$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->setConcluida("1");
				
				$EtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada->addEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada();
				
			}
		}
		
	}
	
	$arrayRetorno['mensagem'] = "Professor replicado com sucesso com sucesso.";
	$arrayRetorno['fecharNivel'] = true;
	
}else{
	$arrayRetorno['mensagem'] = "Nenhum dia foi selecionado.";
}
echo json_encode($arrayRetorno);

?>