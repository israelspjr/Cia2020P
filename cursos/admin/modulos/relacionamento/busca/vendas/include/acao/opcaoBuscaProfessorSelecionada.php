<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();

$idProfessor = $_REQUEST['idProfessor'];
$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$mudarAba = $_REQUEST['mudarAba'];

$arrayRetorno = array();

if ($idBuscaProfessor != "" && $idProfessor != '') {

	$OpcaoBuscaProfessorSelecionada -> setBuscaProfessorIdBuscaProfessor($idBuscaProfessor);
	$OpcaoBuscaProfessorSelecionada -> setProfessorIdProfessor($idProfessor);
	$OpcaoBuscaProfessorSelecionada -> addOpcaoBuscaProfessorSelecionada();

	$arrayRetorno['mensagem'] = "Professor selecionado com sucesso.";
	$arrayRetorno['mudarAba'] = $mudarAba;

}

echo json_encode($arrayRetorno);
?>