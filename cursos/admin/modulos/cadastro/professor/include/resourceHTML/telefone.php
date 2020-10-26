<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idProfessor = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."telefone/include/";
$caminhoAtualizar = CAMINHO_CAD."professor/include/resourceHTML/telefone.php?id=$idProfessor"; 
$ondeAtualiza = "#div_lista_telefone";
$where = " WHERE professor_idProfessor = ".$idProfessor;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."telefone/include/resourceHTML/telefone.php";
 
?>