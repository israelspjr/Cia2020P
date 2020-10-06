<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Prova = new Prova();

$rsItens = $Prova->query("SELECT SQL_CACHE nome FROM itenProva WHERE inativo = 0 AND prova_idProva = ".$_GET['idProva']);
Uteis::pr($rsItens);

while($valor = mysql_fetch_array($rsItens)) echo "<p>".$valor['nome']."</p>";

?>