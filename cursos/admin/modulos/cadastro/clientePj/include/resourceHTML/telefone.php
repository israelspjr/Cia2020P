<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idClientePj = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."telefone/include/";
$caminhoAtualizar = CAMINHO_CAD."clientePj/include/resourceHTML/telefone.php?id=$idClientePj"; 
$ondeAtualiza = "#div_lista_telefone";
$where = " WHERE clientePj_idClientePj = ".$idClientePj;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."telefone/include/resourceHTML/telefone.php";
 
?>