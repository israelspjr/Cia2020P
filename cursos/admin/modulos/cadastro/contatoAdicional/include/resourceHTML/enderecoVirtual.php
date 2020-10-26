<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idContatoAdicional = $_GET['id'];

$caminhoAbrir = CAMINHO_CAD."enderecoVirtual/include/";
$caminhoAtualizar = CAMINHO_CAD."contatoAdicional/include/resourceHTML/enderecoVirtual.php?id=$idContatoAdicional"; 
$ondeAtualiza = "#div_lista_enderecoVirtual_contatoAdicional";
$where = " WHERE contatoAdicional_idContatoAdicional = ".$idContatoAdicional;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."enderecoVirtual/include/resourceHTML/enderecoVirtual.php";
 
?>