<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

//MONTA FILTROS 

$status =  $_POST['status'];
if($status != "-"){
if( $status != '' ) $where .= " AND CPJ.inativo = ".$status;
}

?>
