<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
$idFuncionario = $_GET['id'];

$caminhoAtualizar = CAMINHO_CAD."funcionario/include/resourceHTML/aviso.php?id=$idFuncionario"; 
$onde = "#div_aviso_funcionario";
$where = " WHERE funcionario_idFuncionario = ".$idFuncionario;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."aviso/include/resourceHTML/aviso.php";

?>