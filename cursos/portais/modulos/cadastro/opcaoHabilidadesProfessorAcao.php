<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$HabilidadesProfessor = new HabilidadesProfessor();	
$Habilidades = new Habilidades();
//$AtividadeExtraProfessor = new AtividadeExtraProfessor();

$arrayRetorno = array();
$idProfessor = $_REQUEST['id'];	

//DELETE TODAS OPÇOES ANTES DE INSERIR NOVAMENTE
$HabilidadesProfessor->deleteHabilidadesProfessor(" idProfessor = ".$idProfessor);

$valoresHabilidades = $Habilidades->selectHabilidades(" WHERE inativo = 0 ");


for ($row = 0; $row < count($valoresHabilidades, 0); $row++){
	$idField = $valoresHabilidades[$row]['idHabilidades'];	
	$field = $_POST["check_habilidade_".$idField];

	// INSERE AS OPÇOES MARCADAS		
	if($field==1){
		$HabilidadesProfessor->setIdHabilidade($idField);
		$HabilidadesProfessor->setIdProfessor($idProfessor);
		$HabilidadesProfessor->setObs("");						
		$HabilidadesProfessor->addHabilidadesProfessor();		
	}
}

// Inserindo Habilidades

for ($r = 0; $r < count($valoresHabilidades, 0); $r++){
	$idField = $valoresHabilidades[$r]['idHabilidades'];
	$resposta = $_POST["pergunta".$idField];

	$anos = $_POST["perguntaA".$idField];
	$escolas = $_POST["perguntaE".$idField];
	$obs = $_POST['obsA'];

	// INSERE AS OPÇOES MARCADAS		

		$HabilidadesProfessor->setIdHabilidade($idField);
		$HabilidadesProfessor->setIdProfessor($idProfessor);
		$HabilidadesProfessor->setObs($obs);						
		$HabilidadesProfessor->setAnos($anos);
		$HabilidadesProfessor->setEscolas($escolas);
		$HabilidadesProfessor->setResposta($resposta);
		$HabilidadesProfessor->addHabilidadesProfessor();		
//	}
}

$arrayRetorno['mensagem'] = MSG_CADNEW;
$arrayRetorno['pagina'] = CAMINHO_CAD."opcaoAtividadeExtraProfessor.php?id=".$idProfessor;
$arrayRetorno['ondeAtualizar'] = "#div_lista_opcaoHabilidadesProfessor";

echo json_encode($arrayRetorno);	
?>
