<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idClientePj = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."endereco/include/";
$caminhoAtualizar = CAMINHO_CAD."clientePj/include/resourceHTML/endereco.php?id=$idClientePj"; 
$ondeAtualiza = "#div_lista_endereco";
$where = " AND clientePj_idClientePj = ".$idClientePj;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."endereco/include/resourceHTML/endereco.php";
 
?>