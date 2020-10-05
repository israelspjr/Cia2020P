<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Professor = new Professor();	

$caminhoAbrir = "modulos/bancoHoras/bancoHoras.php";
$caminhoAtualizar = "modulos/bancoHoras/indexProf.php";
$ondeAtualiza = "#centro";		
?>

<fieldset>
  <legend>Banco de horas</legend>
  <?php require_once("../grupos.php")?>
</fieldset>
