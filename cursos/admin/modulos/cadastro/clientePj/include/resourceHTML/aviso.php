<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
$idClientePj = $_GET['id'];

$caminhoAtualizar = CAMINHO_CAD."clientePj/include/resourceHTML/aviso.php?id=$idClientePj"; 
$onde = "#div_lista_aviso";
$where = " WHERE clientePj_idClientePj = ".$idClientePj;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."aviso/include/resourceHTML/aviso.php";
 
?>