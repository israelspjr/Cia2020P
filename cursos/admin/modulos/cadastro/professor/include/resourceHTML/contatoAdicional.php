<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idProfessor = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."contatoAdicional/include/";
$caminhoAtualizar = CAMINHO_CAD."professor/include/resourceHTML/contatoAdicional.php?id=".$idProfessor; 
$ondeAtualiza = "#div_lista_contatoAdicional";
$where = " AND professor_idProfessor = ".$idProfessor;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."contatoAdicional/include/resourceHTML/contatoAdicional.php";
 
?>