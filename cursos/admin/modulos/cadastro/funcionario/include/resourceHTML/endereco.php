<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idFuncionario = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."endereco/include/";
$caminhoAtualizar = CAMINHO_CAD."funcionario/include/resourceHTML/endereco.php?id=$idFuncionario"; 
$ondeAtualiza = "#div_lista_endereco";
$where = " AND funcionario_idFuncionario = ".$idFuncionario;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."endereco/include/resourceHTML/endereco.php";
 
?>