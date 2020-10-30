<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$idProfessor = $_REQUEST['idProfessor'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$motivo = $_REQUEST['motivo'];
$aceito = $_REQUEST['aceito'];

//echo $aceito;
//echo $motivo;

$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();

$OpcaoBuscaProfessorSelecionada->setAceito($aceito);
$OpcaoBuscaProfessorSelecionada->setProfessorIdProfessor($idProfessor);
$OpcaoBuscaProfessorSelecionada->setMotivo($motivo);
$OpcaoBuscaProfessorSelecionada->setBuscaProfessorIdBuscaProfessor($idBuscaProfessor);

if ($aceito == 2) {
	$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upAceito();
	
	} else {
	$idOpcaoBuscaProfessorSelecionada = $OpcaoBuscaProfessorSelecionada->upRejeito();
}

$arrayRetorno['mensagem'] = "Aula não foi aceita pelo Professor."; 
$arrayRetorno['fecharNivel'] = true;

echo json_encode($arrayRetorno);
?>