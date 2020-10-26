<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idProfessor = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."enderecoVirtual/include/";
$caminhoAtualizar = CAMINHO_CAD."professor/include/resourceHTML/enderecoVirtual.php?id=$idProfessor"; 
$ondeAtualiza = "#div_lista_enderecoVirtual";
$where = " WHERE professor_idProfessor = ".$idProfessor;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."enderecoVirtual/include/resourceHTML/enderecoVirtual.php";
 
?>