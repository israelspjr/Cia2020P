<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idClientePf = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."telefone/include/";
$caminhoAtualizar = CAMINHO_CAD."clientePf/include/resourceHTML/telefone.php?id=$idClientePf"; 
$ondeAtualiza = "#div_lista_telefone";
$where = " WHERE clientePf_idClientePf = ".$idClientePf;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."telefone/include/resourceHTML/telefone.php";
 
?>