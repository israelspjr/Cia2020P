<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$idiomaProfessor= new IdiomaProfessor();

if( isset($_REQUEST["tr"]) ){
    
    $arrayRetorno = array();
    
    $idProfessor = $_REQUEST["idProfessor"];
	$ordem = $_REQUEST["ordem"];
    $saida = $Professor->selectProfessorContratadoTr(" AND P.idProfessor = $idProfessor", true, 1);
    $arrayRetorno["updateTr"] = $saida;
    $arrayRetorno["tabela"] = "#tb_lista_professor";
    $arrayRetorno["ordem"] = $ordem;
    
    echo json_encode($arrayRetorno);
    exit;       
}

require ("filtro.php");

$arrayRetorno = array();


$arrayRetorno['excel'] = $Professor->selectProfessorContratadoTr($where, false, $comgrupos, $menor5grupos, true);

echo json_encode($arrayRetorno);

?>

