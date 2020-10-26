<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idProfessor = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."endereco/include/";
$caminhoAtualizar = CAMINHO_CAD."professor/include/resourceHTML/endereco.php?id=$idProfessor"; 
$ondeAtualiza = "#div_lista_endereco";
$where = " AND professor_idProfessor = ".$idProfessor;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."endereco/include/resourceHTML/endereco.php";
 
?>