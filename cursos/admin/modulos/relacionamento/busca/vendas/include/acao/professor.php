<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();

$OpcaoBuscaProfessorSelecionada = new OpcaoBuscaProfessorSelecionada();
$idOpcaoBuscaProfessorSelecionada = $_REQUEST['id'];

$OpcaoBuscaProfessorSelecionada->setIdOpcaoBuscaProfessorSelecionada($idOpcaoBuscaProfessorSelecionada);
$OpcaoBuscaProfessorSelecionada->updateFieldOpcaoBuscaProfessorSelecionada("aceito", 0);

$OpcaoBuscaProfessorSelecionada->query("DELETE FROM etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada WHERE opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada = ".$idOpcaoBuscaProfessorSelecionada);

$arrayRetorno['mensagem'] = "Excluído com sucesso";

echo json_encode($arrayRetorno);

?>