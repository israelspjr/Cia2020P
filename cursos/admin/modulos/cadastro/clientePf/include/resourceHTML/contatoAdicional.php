<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idClientePf = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."contatoAdicional/include/";
$caminhoAtualizar = CAMINHO_CAD."clientePf/include/resourceHTML/contatoAdicional.php?id=".$idClientePf; 
$ondeAtualiza = "#div_lista_contatoAdicional";
$where = " AND clientePf_idClientePf = ".$idClientePf;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."contatoAdicional/include/resourceHTML/contatoAdicional.php";
 
?>