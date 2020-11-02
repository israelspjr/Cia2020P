<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$RelatorioNovo = new RelatorioNovo();

$arrayRetorno = array();

require_once "filtros.php";

$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

if ($psaPendentes == 1) {
$arrayRetorno['excel'] =  $html . $RelatorioNovo->relatorioPsaPendente($gerente, $where, $campos, $camposNome, true, $mostrarComentarios, $idProfessor);

} else {
$arrayRetorno['excel'] =  $html . $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, true, $mostrarComentarios, $idProfessor, 1);

}
	
//$arrayRetorno['excel'] = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, true, $mostrarComentarios);

echo json_encode($arrayRetorno);
?>