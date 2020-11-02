<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$RelatorioNovo = new RelatorioNovo();

$arrayRetorno = array();

require_once "filtros.php";

if ($psaPendentes == 1) {
$arrayRetorno['excel'] =  $RelatorioNovo->relatorioPsaPendente($gerente, $where, $campos, $camposNome, true, $mostrarComentarios, $idProfessor);

} else {
$arrayRetorno['excel'] =  $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, true, $mostrarComentarios, $idProfessor, 4);

}
	
//$arrayRetorno['excel'] = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, true, $mostrarComentarios);

echo json_encode($arrayRetorno);
?>