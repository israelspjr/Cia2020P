<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/BuscaProfessor.class.php");

$arrayRetorno = array();

$idBuscaProfessor = $_REQUEST['id'];

$BuscaProfessor = new BuscaProfessor();

$BuscaProfessor->setIdBuscaProfessor($idBuscaProfessor);
$BuscaProfessor->updateFieldBuscaProfessor("excluida", "1");

$arrayRetorno['mensagem'] = "Excluído com sucesso";

echo json_encode($arrayRetorno);
?>
