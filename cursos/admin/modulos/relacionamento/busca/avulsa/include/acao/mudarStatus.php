<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();

$idBuscaAvulsa = $_REQUEST['idBuscaAvulsa'];
//$idBuscaAvulsaProfessor = $_REQUEST['idBuscaAvulsaProfessor'];
//$idProfessor = $_REQUEST['idProfessor'];
//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$mudarStatus = $_REQUEST['status'];
//$aceito = $_REQUEST['aceito'];

//echo $aceito;
//echo $motivo;

//$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();

$BuscaAvulsa->setIdBuscaAvulsa($idBuscaAvulsa);
//$OpcaoBuscaProfessorSelecionada->setDiasBuscaAvulsaIdDiasBuscaAvulsa($idBuscaAvulsa);
//$OpcaoBuscaProfessorSelecionada->setEscolhido($aceito);
//$OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
//$OpcaoBuscaProfessorSelecionada->setObs($motivo);
$BuscaAvulsa->updateFieldBuscaAvulsa('status', $mudarStatus);


//    $arrayRetorno['elementoAtualizar'][0] = "#obs_".$idBuscaAvulsaProfessor;
//    $arrayRetorno['valor2'][0] = $motivo;
	$arrayRetorno['mensagem'] = "Status alterado com sucesso!.";
	$arrayRetorno['AtualizarNivelAtual'] = true;
	
	echo json_encode($arrayRetorno);
/*
if ($aceito == 2) {
//	$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upAceito();
	$arrayRetorno['mensagem'] = "Aula aceita pelo Professor com observações."; 
	$arrayRetorno['fecharNivel'] = true;
	
	} else {
//	$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upRejeito();
	
	$arrayRetorno['mensagem'] = "Aula não foi aceita pelo Professor com observações.";
	$arrayRetorno['fecharNivel'] = true;
}
*/
 
//$arrayRetorno['fecharNivel'] = true;