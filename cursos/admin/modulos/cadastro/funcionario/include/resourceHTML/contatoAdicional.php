<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idFuncionario = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."contatoAdicional/include/";
$caminhoAtualizar = CAMINHO_CAD."funcionario/include/resourceHTML/contatoAdicional.php?id=".$idFuncionario; 
$ondeAtualiza = "#div_lista_contatoAdicional";
$where = " AND funcionario_idFuncionario = ".$idFuncionario;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."contatoAdicional/include/resourceHTML/contatoAdicional.php";
 
?>