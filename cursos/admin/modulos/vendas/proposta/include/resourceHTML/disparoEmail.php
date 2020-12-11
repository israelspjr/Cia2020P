<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idProposta = $_GET['id'];

$caminhoAbrir = CAMINHO_VENDAS."proposta/include/form/disparoEmail.php";
$caminhoAtualizar = CAMINHO_VENDAS."proposta/include/resourceHTML/disparoEmail.php?id=$idProposta";
$onde = "#div_disparo_Proposta";
$where = " WHERE proposta_idProposta = ".$idProposta;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_MODULO."disparoEmail/resourceHTML.php";
 
?>