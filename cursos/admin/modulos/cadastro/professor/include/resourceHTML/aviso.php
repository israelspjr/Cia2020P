<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
$idProfessor = $_GET['id'];

$caminhoAtualizar = CAMINHO_CAD."professor/include/resourceHTML/aviso.php?id=$idProfessor"; 
$onde = "#div_aviso_professor";
$where = " WHERE professor_idProfessor = ".$idProfessor;

require_once $_SERVER['DOCUMENT_ROOT']."/".CAMINHO_CAD."aviso/include/resourceHTML/aviso.php";
 
?>