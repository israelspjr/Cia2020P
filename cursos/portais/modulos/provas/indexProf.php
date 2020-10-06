<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$Professor = new Professor();	

$caminhoAbrir = "modulos/provas/provasProfF.php";
$caminhoAtualizar = "modulos/provas/indexProf.php";
$ondeAtualiza = "#centro";		
?>

<fieldset>
	<legend>Provas</legend>
	<?php require_once("../gruposProf.php")?>
</fieldset> 