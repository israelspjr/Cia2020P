<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idClientePj = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."contatoAdicional/include/";
$caminhoAtualizar = CAMINHO_CAD."clientePj/include/resourceHTML/contatoAdicional.php?id=".$idClientePj; 
$ondeAtualiza = "#div_lista_contatoAdicional";
$where = " AND clientePj_idClientePj = ".$idClientePj;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."contatoAdicional/include/resourceHTML/contatoAdicional.php";
 
?>