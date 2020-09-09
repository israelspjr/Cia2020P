<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$arrayRetorno = array();

$Aviso = new Aviso();
if ($_SESSION['idFuncionario_SS']) {
	$rs = $Aviso -> selectAviso(" WHERE (lido IS NULL OR dataVisualizacao IS NULL) AND funcionario_idFuncionario = " . $_SESSION['idFuncionario_SS']);
	if ($rs)
		$arrayRetorno["novoAviso"] = true;
} else {
}
echo json_encode($arrayRetorno);
?>