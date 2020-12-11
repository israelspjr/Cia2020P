<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorSimuladoProposta.class.php");

$arrayRetorno = array();
$idValorSimuladoProposta = $_REQUEST['id'];	

$ValorSimuladoProposta = new ValorSimuladoProposta();			

$ValorSimuladoProposta->setIdValorSimuladoProposta($idValorSimuladoProposta);

if($_POST['acao'] == 'gravaOpcaoValorSimuladoProposta'){
	
	$ValorSimuladoProposta->atualizarValorSimuladoPropostaEscolhido();
	$arrayRetorno['mensagem'] = "Opção escolhida com sucesso.";
	
}else{
	
	if($_POST['acao'] == 'deletar'){
		
		$ValorSimuladoProposta->deleteValorSimuladoProposta();
		
		$arrayRetorno['mensagem'] = MSG_CADDEL;
		
	}else{	
		
		$ValorSimuladoProposta->setPropostaIdProposta($_POST['proposta_idProposta']);
		$ValorSimuladoProposta->setNome($_POST['nome']);	
			
		if($idValorSimuladoProposta != "" && $idValorSimuladoProposta > 0 ){		
			$ValorSimuladoProposta->updateValorSimuladoProposta();	
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{	
			$idValorSimuladoProposta = $ValorSimuladoProposta->addValorSimuladoProposta();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;		
		}
		
		$arrayRetorno['pagina'] = CAMINHO_VENDAS."proposta/include/form/valorSimuladoProposta.php?id=".$idValorSimuladoProposta."&idProposta=".$ValorSimuladoProposta->propostaIdProposta;	
		$arrayRetorno['atualizarNivelAtual'] = true;	
		
	}
	
}	

echo json_encode($arrayRetorno);

?>