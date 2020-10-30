<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Prova.class.php");

$Prova = new Prova();

$rsItens = ($Prova->query("SELECT SQL_CACHE * FROM itenProva WHERE inativo = 0 AND prova_idProva=".$_GET['idProva']));

while($valor = mysql_fetch_array($rsItens)){
	echo "<p>".$valor['nome']."</p>";
}
?>