<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$tipoG = $_POST['tipoGraf'];

	
$idGrupo = implode(",",$_REQUEST['idGrupo']);
$clientePj_idClientePj = implode(",",$_REQUEST['clientePj_idClientePj']);	
$professor_idProfessor = implode(",",$_REQUEST['idProfessor']);

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];

$filtro = array(
                  "Grupo"=>$idGrupo,
                  "Empresa"=>$clientePj_idClientePj,
                  "Professor"=>$professor_idProfessor,                  
                  "MesIni" =>$mes_ini,
                  "AnoIni" =>$ano_ini,
                  "MesFin" =>$mes_fim,
                  "AnoFin" =>$ano_fim
);
//echo $where;

?>
