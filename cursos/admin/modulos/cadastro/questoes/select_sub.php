<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$SubCategoria = new SubCategoria();
$idCategoria = $_POST['idCategoria'];
if ($idCategoria > 0 ) {
	$where = " WHERE categoria_idCategoria = ".$idCategoria;
}
$idSubCategoria = $_POST['idSubCategoria'];
$valor = $SubCategoria->selectSubCategoriaSelect("required",$idSubCategoria, $where);
echo $valor;
