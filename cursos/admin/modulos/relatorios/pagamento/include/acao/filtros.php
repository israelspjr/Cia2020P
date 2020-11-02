<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$aberto = $_POST['baixa'];
//echo $aberto;
if($aberto==1){
$where = " WHERE D.dataBaixa IS NOT NULL ";
} elseif ($aberto==2) {
$where = " WHERE D.dataBaixa IS NULL ";    
} else {
$where =  " WHERE 1 ";
}

		
$mes = $_POST['mes'];
$ano = $_POST['ano'];

$mesF = $_POST['mesF'];
$anoF = $_POST['anoF'];


//if($mes && $ano) { 
//$where .= " AND mes = $mes AND ano = $ano";
	$where	.= " AND mes BETWEEN $mes AND $mesF AND ano BETWEEN $ano AND $anoF"; 	
//}

if (($_POST['credDeb'] == "") || (!isset($_POST['credDeb']))){
	$credDeb = 0;
} else {
	$credDeb = 1;
}


$idProfessor = implode(",",$_POST['idProfessor']);
if($idProfessor) $where .= " AND D.professor_idProfessor IN(".$idProfessor.")";	

$idTipoBaixaPagamento = implode(",",$_POST['idTipoBaixaPagamento']);
//if($idTipoBaixaPagamento) $where .= " AND TP.idTipoBaixaPagamento IN (".$idTipoBaixaPagamento.")";


if (($_POST['impostos'] == "") || (!isset($_POST['impostos']))){
	$impostos = 0;
} else {
	$impostos = 1;
}

$aulas = $_POST['aulas'];
if($aulas) {
	$where .= " AND D.tipoDemo = 1";	
}
//echo $where;
?>
