<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

if($_GET['id']!=''){
$idProposta = $_GET['id'];
}else{
$idProposta = $_GET['idProposta'];
}  

$caminhoAbrir = CAMINHO_CAD."contatoAdicional/include/";
$caminhoAtualizar = CAMINHO_VENDAS."proposta/cadastro.php?id=".$idProposta; 
$ondeAtualiza = "#cadastro_Proposta";
$where = " AND proposta_idProposta = ".$idProposta;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."contatoAdicional/include/resourceHTML/contatoAdicional.php";
 
?>