<?php 
$idRepresentante = $_GET['id'];

$caminhoAbrir = "";
$caminhoAtualizar = ""; 
$onde = "";
$where = " WHERE representante_idRepresentante = ".$idRepresentante;

require_once '../../aviso/include/resourceHTML/aviso.php';

?>