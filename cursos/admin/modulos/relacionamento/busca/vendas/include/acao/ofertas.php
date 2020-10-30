<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
$BuscaProfessor = new BuscaProfessor();

echo $idPlanoAcaoGrupo;


?>
