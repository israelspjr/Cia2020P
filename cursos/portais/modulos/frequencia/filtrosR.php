<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$tipo = $_POST['tipoRel'];
$tipoR = $_POST['tipoR'];
$alunoN = $_POST['alunosN'];
$rh = $_POST['rh'];

//$where = " WHERE 1 ";

$where = " WHERE G.inativo = 0 AND CPF.inativo = 0 AND BH.credDeb is null ";
	
$idGrupo = implode(",",$_REQUEST['idGrupo']);
if($idGrupo) $where .= " AND G.idGrupo IN (".$idGrupo.")";	

$clientePj_idClientePj = $_SESSION['idClientePj_SS'];//implode(",",$_REQUEST['clientePj_idClientePj']);
if($clientePj_idClientePj) $where .= " AND GPJ.clientePj_idClientePj IN (".$clientePj_idClientePj.")";	

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if($mes_ini<10):
$d1 = "01-0".$mes_ini."-".$ano_ini;
else: 
$d1 = "01-".$mes_ini."-".$ano_ini;
endif;    

$data_ini = new DateTime($d1);
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];

if($mes_fim<10):
$d2 = "01-0".$mes_fim."-".$ano_fim;
else:
$d2 = "01-".$mes_fim."-".$ano_fim;
endif;



$data_fim = new DateTime($d2);
if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
	$where .= " AND FF.dataReferencia >= '{$data_ini->format('Y-m-d')}' 
	 AND FF.dataReferencia <= '{$data_fim->format('Y-m-d')}' ";
}

$d1k = $data_ini->format('Y-m-d');
$d2k = $data_fim->format('Y-m-d');

$idClientePf = $_REQUEST['idClientePf'];
if($idClientePf) $where .= " AND CPF.idClientePf IN (".$idClientePf.")";	

$frequencia = $_REQUEST['frequencia'];

//echo $where;
?>
