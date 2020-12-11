<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Proposta.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IntegranteProposta.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItemValorSimuladoProposta.class.php");


$Proposta = new Proposta();
$IntegranteProposta = new IntegranteProposta();
$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();

$idProposta = $_REQUEST['idProposta'];
$idStatus = $_REQUEST['idStatus'];

$arrayRetorno = array();

if($idStatus==3){
	
	$Proposta->setIdProposta($idProposta);
	$Proposta->updateFieldProposta("statusAprovacao_idStatusAprovacao", $idStatus);
	$Proposta->updateFieldProposta("dataAprovacao", date('Y-m-d H:i:s'));
	$arrayRetorno['fecharNivel'] = true;
	$arrayRetorno['mensagem'] = "Proposta reprovada com sucesso.";
	
}else{

	$sql = " AS I INNER JOIN valorSimuladoProposta AS VS ON VS.idValorSimuladoProposta = I.valorSimuladoProposta_idValorSimuladoProposta AND VS.escolhido = 1 ";
	$sql .= " WHERE VS.proposta_idProposta = ".$idProposta;
	$temItemValorSimuladoProposta = $ItemValorSimuladoProposta->selectItemValorSimuladoProposta($sql);
	
	if($temItemValorSimuladoProposta){			
		$Proposta->setIdProposta($idProposta);
		$Proposta->updateFieldProposta("statusAprovacao_idStatusAprovacao", $idStatus);
		$Proposta->updateFieldProposta("dataAprovacao", date('Y-m-d H:i:s'));		
		$arrayRetorno['fecharNivel'] = true;	
		$arrayRetorno['mensagem'] = "Proposta aprovada com sucesso! A partir de agora essa proposta será lista na tela de Aprovações.";
	}else{			
		$arrayRetorno['mensagem'] = "É necessário inserir pelo menos um valor simulado e escolher pelo menos uma opção.";
	}				
	
}

echo json_encode($arrayRetorno);

?>