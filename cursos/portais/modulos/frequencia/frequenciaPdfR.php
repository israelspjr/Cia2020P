<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."mpdf60/mpdf.php");

$Relatorio = new Relatorio();

$tipo = $_REQUEST['tipo'];
$FME = $_REQUEST['FME'];
$frequencia = $_REQUEST['frequencia'];
$tipoR = $_REQUEST['tipoR'];
$alunoR = $_REQUEST['alunoR'];
$idGrupo = $_REQUEST['idGrupo'];
$d1 = $_REQUEST['d1'];
$d2 = $_REQUEST['d2'];

$where = " WHERE G.inativo = 0 AND CPF.inativo = 0 AND BH.credDeb is null AND GPJ.clientePj_idClientePj IN (".$_SESSION['idClientePj_SS'].") AND G.idGrupo IN (".$idGrupo.")";

$where .= " AND FF.dataReferencia >= '".$d1."' 
	 AND FF.dataReferencia <= '".$d2."' ";

//$arrayRetorno = array();

//require_once "filtrosR.php";
	
$conteudo = $Relatorio->relatorioFrequencia($where, $tipo, true,$FME, $frequencia, $tipoR, $dInicial, $dFinal, $alunoN,1,"","", 1);

$conteudo .= "</table>";

  $html .= $conteudo;

	try {
$mpdf = new mPDF();
$mpdf->debug = true;
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

$mpdf->WriteHTML($html);
$mpdf->Output();
	} catch (MpdfException $e) {
		
		echo $e->getmessage();
	}
?>