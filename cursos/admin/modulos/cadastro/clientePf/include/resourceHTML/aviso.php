<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idClientePf = $_GET['id'];

$caminhoAtualizar = CAMINHO_CAD."clientePf/include/resourceHTML/aviso.php?id=$idClientePf"; 
$onde = "#div_aviso";
$where = " WHERE clientePf_idClientePf = ".$idClientePf;
  echo "<div>";
require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."aviso/include/resourceHTML/aviso.php";
echo "</div>";
?>

