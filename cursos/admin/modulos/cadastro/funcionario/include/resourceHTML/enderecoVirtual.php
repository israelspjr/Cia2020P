<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idFuncionario = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."enderecoVirtual/include/";
$caminhoAtualizar = CAMINHO_CAD."funcionario/include/resourceHTML/enderecoVirtual.php?id=$idFuncionario"; 
$ondeAtualiza = "#div_lista_enderecoVirtual";
$where = " WHERE funcionario_idFuncionario = ".$idFuncionario;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."enderecoVirtual/include/resourceHTML/enderecoVirtual.php";
 
?>