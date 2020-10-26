<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idClientePf = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."enderecoVirtual/include/";
$caminhoAtualizar = CAMINHO_CAD."clientePf/include/resourceHTML/enderecoVirtual.php?id=$idClientePf"; 
$ondeAtualiza = "#div_lista_enderecoVirtual";
$where = " WHERE clientePf_idClientePf = ".$idClientePf;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."enderecoVirtual/include/resourceHTML/enderecoVirtual.php";
 
?>