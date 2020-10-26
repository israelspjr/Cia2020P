<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$idPlanoAcao = $_GET['id'];

$caminhoAbrir = CAMINHO_VENDAS."planoAcao/include/form/disparoEmail.php";
$caminhoAtualizar = CAMINHO_VENDAS."planoAcao/include/resourceHTML/disparoEmail.php?id=$idPlanoAcao";
$onde = "#div_disparo_PlanoAcao";
$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_MODULO."disparoEmail/resourceHTML.php";
 
?>
