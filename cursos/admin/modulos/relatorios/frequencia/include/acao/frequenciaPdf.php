<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."mpdf60/mpdf.php");
$IntengranteGrupo = new IntegranteGrupo();
$Relatorio = new Relatorio();

$status = $_REQUEST['statusG'];
$tipo = $_REQUEST['tipoRel'];
$tipoR = $_REQUEST['tipoR'];
$alunoN = $_REQUEST['alunosN'];
$idgerente = $_REQUEST['idGerente'];


if ($status != "-") {
	$and .= " AND G.inativo = ".$status;
}

if ($idgerente != '') {
	if ($idgerente[0] != '-') {
$ids = "(";
foreach ($idgerente as $valor) {
	$ids .= $valor.",";
	
	}
	$ids .= "0)";
	$gerente = " INNER JOIN gerenteTem AS GT on GT.clientepj_idClientePj = PJ.idClientepj WHERE GT.gerente_idGerente in ".$ids." AND GT.dataExclusao IS NULL";
}
} 
if ($ids == '') {
	$gerente = " WHERE 1";
}
$where = $gerente. $and."  AND BH.credDeb is null ";
	
$alunoS = $_REQUEST['statusA'];
if ($alunoS != '') {
	if ($alunoS != '-') {
		$where .= " AND CPF.inativo = ".$alunoS;	
	}
	
}

	

$idGrupo = $_REQUEST['idGrupos'];

if ($idGrupo != "-") {
if ($idGrupo) $where .= " AND G.idGrupo IN (".$idGrupo.")";	
}

$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];
if ($clientePj_idClientePj != "-") {
if($clientePj_idClientePj) $where .= " AND GPJ.clientePj_idClientePj IN (".$clientePj_idClientePj.")";	
}

$di = $_REQUEST['di'];
$d1 = $_REQUEST['d1'];
$df = $_REQUEST['df'];
$d2 = $_REQUEST['d2'];

$where .= " AND FF.dataReferencia >= '$di'";
$where .= " AND FF.dataReferencia <= '$df'";

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
if($idIntegranteGrupo) {
	$valor = $IntengranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
	$idClientePf = $valor[0]['clientePf_idClientePf'];

	$where .= " AND CPF.idClientePf IN (".$idClientePf.")";	
}

$idClientePf = $_REQUEST['idClientePf'];
if ($idClientePf != "-") {
	if ($idClientePf) $where .= " AND CPF.idClientePf IN (".$idClientePf.")";	
}

$frequencia = $_REQUEST['frequencia'];

$FME = substr($_REQUEST['FME'], 0, 3);

$where .= " AND (IG.dataSaida is null or IG.dataSaida >= '$di')";

//echo $where;

$conteudo = $Relatorio->relatorioFrequencia($where, $tipo, true,$FME, $frequencia, $tipoR, $d1, $d2, $alunoN,"","","", 1);

$conteudo .= "</table>";

   $html = '<div class="linha-inteira" style="text-align: center;">';
                $html .= $conteudo;
                $html .= '</div>';
 
$html2 .= $html;

//echo $html2;


	try {
$mpdf = new mPDF();
$mpdf->debug = true;
//$mpdf->allow_output_buffering = true;
$mpdf->SetDisplayMode('fullpage');
$mpdf->AddPage('L', // L - landscape, P - portrait
    '', '', '', '',
    5, // margin_left
    5, // margin right
    0, // margin top
    0, // margin bottom
    0, // margin header
    0  // margin footer
);

$mpdf->allow_charset_conversion=TRUE;
$mpdf->charset_in='UTF-8';
$mpdf->WriteHTML($html2);
$mpdf->Output();
	} catch (MpdfException $e) {
		
		echo $e->getmessage();
	}
?>