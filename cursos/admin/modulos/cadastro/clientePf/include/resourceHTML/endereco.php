<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idClientePf = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."endereco/include/";
$caminhoAtualizar = CAMINHO_CAD."clientePf/include/resourceHTML/endereco.php?id=$idClientePf"; 
$ondeAtualiza = "#div_lista_endereco";
$where = " AND clientePf_idClientePf = ".$idClientePf;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."endereco/include/resourceHTML/endereco.php";
 
?>
