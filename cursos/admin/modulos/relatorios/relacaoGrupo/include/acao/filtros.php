<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$where = " WHERE 1 ";

$idIdioma = implode(",",$_POST['idIdioma']);
if($idIdioma) $where .= " AND I.idIdioma IN(".$idIdioma.")";

$idGrupo = implode(",",$_POST['idGrupo']);
if($idGrupo) $where .= " AND G.idGrupo IN(".$idGrupo.")";

$filtroTipo = implode(",",$_POST['filtroTipo']); 
if($filtroTipo) $where .= " AND FG.tipo IN(".$filtroTipo.")";

//echo $where;
?>
