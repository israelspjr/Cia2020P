<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idBuscaAvulsa = $_REQUEST['idBuscaAvulsa'];
$idBuscaAvulsaProfessor = $_REQUEST['idBuscaAvulsaProfessor'];
$idProfessor = $_REQUEST['idProfessor'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$OpcaoBuscaProfessorSelecionada = new DiasBuscaAvulsaProfessor();
$ordem = $_REQUEST['ordem'];
//$aceito = $_REQUEST['aceito'];

//echo $aceito;
//echo $motivo;

//$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();

$OpcaoBuscaProfessorSelecionada->setIdDiasBuscaAvulsaProfessor($idBuscaAvulsaProfessor);
//$OpcaoBuscaProfessorSelecionada->setDiasBuscaAvulsaIdDiasBuscaAvulsa($idBuscaAvulsa);
//$OpcaoBuscaProfessorSelecionada->setEscolhido($aceito);
//$OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
$OpcaoBuscaProfessorSelecionada->updateFieldDiasBuscaAvulsaProfessor("ordem", $ordem);
//$OpcaoBuscaProfessorSelecionada->updateDiasBuscaAvulsaProfessor();


    $arrayRetorno['elementoAtualizar'][0] = "#ordem_".$idBuscaAvulsaProfessor;
    $arrayRetorno['valor2'][0] = $motivo;
	$arrayRetorno['mensagem'] = "Ordem inserida com sucesso!.";
	$arrayRetorno['fecharNivel'] = true;
	
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