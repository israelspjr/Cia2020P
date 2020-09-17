<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$caminhoAbrir = "modulos/provas/provas.php";
$caminhoAtualizar = "modulos/provas/index.php";
$ondeAtualiza = "#centro";		
?>
<fieldset>
	<legend>Avaliações</legend>
</fieldset>   
<fieldset>
	<legend>Clique no grupo abaixo para acessar as notas de todos os níveis.</legend>
</fieldset>

<?php require_once("../grupos.php")?> 