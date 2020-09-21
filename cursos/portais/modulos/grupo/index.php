<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$caminhoAbrir = "modulos/grupo/abas.php";
$caminhoAtualizar = "modulos/grupo/index.php";
$ondeAtualiza = "#centro";		
?>

<fieldset>
	<legend>Grupos</legend>
</fieldset>   

<?php require_once("../grupos.php")?>
