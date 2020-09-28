<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$Professor = new Professor();

$caminhoAbrir = "modulos/ff/professor/ff.php";
$caminhoAtualizar = "modulos/ff/indexProf.php";
$ondeAtualiza = "#centro";


?>

<fieldset>
	<legend>
		Folha de frequência
	</legend>
	<?php require_once("../gruposProf.php");?>
</fieldset>

  