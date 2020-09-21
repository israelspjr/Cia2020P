<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

$arrayRetorno = array();

require_once "filtrosR.php";

if ($psaPendentes == 1) {
$arrayRetorno['excel'] =  $Relatorio->relatorioPsaPendente($gerente, $where, $campos, $camposNome, true, $mostrarComentarios, $idProfessor);

} else {
$arrayRetorno['excel'] =  $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, true, $mostrarComentarios, $idProfessor);

}

echo json_encode($arrayRetorno);
?>