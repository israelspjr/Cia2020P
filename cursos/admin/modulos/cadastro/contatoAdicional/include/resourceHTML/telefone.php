<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idContatoAdicional = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."telefone/include/";
$caminhoAtualizar = CAMINHO_CAD."contatoAdicional/include/resourceHTML/telefone.php?id=$idContatoAdicional"; 
$ondeAtualiza = "#div_lista_telefone_contatoAdicional";
$where = " WHERE contatoAdicional_idContatoAdicional = ".$idContatoAdicional;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."telefone/include/resourceHTML/telefone.php";
 
?>