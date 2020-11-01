<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$NivelEstudo = new NivelEstudo();
$idioma = $_POST['idioma'];
$idNivel = $_POST['idNivel'];
$valor = $NivelEstudo->selectNivelEstudoSelect("",$idNivel,"  LEFT JOIN nivelEstudoIdioma AS NI on NI.Nivel_IdNivel = N.IdNivelEstudo AND NI.idioma_idIdioma = ".$idioma);
echo $valor;
