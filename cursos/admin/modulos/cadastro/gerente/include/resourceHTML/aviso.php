#<?php 
$idGerente = $_GET['id'];

$caminhoAbrir = "";
$caminhoAtualizar = ""; 
$onde = "";
$where = " WHERE gerente_idGerente = ".$idGerente;

require_once '../../aviso/include/resourceHTML/aviso.php';

?>