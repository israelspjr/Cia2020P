<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePf = new ClientePf();

$arrayRetorno = array();

$where1 = $_REQUEST['where'];
$grupo1 = $_REQUEST['grupo1'];
$pendentes = $_REQUEST['pendentes'];

$where = str_replace("'", "", $where1);

    $arrayRetorno['excel'] =  $ClientePf->selectClientepfTr($where, false, $grupo1,$pendentes, true);

	echo json_encode($arrayRetorno);



?>
 