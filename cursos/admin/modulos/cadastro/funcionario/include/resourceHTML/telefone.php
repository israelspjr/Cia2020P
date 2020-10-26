<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idFuncionario = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."telefone/include/";
$caminhoAtualizar = CAMINHO_CAD."funcionario/include/resourceHTML/telefone.php?id=$idFuncionario"; 
$ondeAtualiza = "#div_lista_telefone";
$where = " WHERE funcionario_idFuncionario = ".$idFuncionario;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."telefone/include/resourceHTML/telefone.php";
 
?>