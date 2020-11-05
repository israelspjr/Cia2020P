<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/planoAcao.php");

$PlanoAcao = new PlanoAcao();
//require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/css.php");
//require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."include/js.php");


		$idPlanoAcao = ($_REQUEST['idPlanoAcao']);
		$idIntegrantePlanoAcao = ($_REQUEST['integrante']);
		$area = ($_REQUEST['area']);
                
		$PlanoAcao->setIdPlanoAcao($idPlanoAcao);


//$arrayRetorno = array();

$html = $PlanoAcao->imprimePlanoAcao($area, $integrante);

$html2 .= "<div style='width:100%'><img style='width:100%;' src=".CAMINHO_IMG2."_cabecalho.png></div>";

$html2 .= $html;

$html2 .= "<div style='width:100%'><img style='width:100%;' src=".CAMINHO_IMG2."_rodape.png></div>";

	require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."mpdf60/mpdf.php");

	$mpdf=new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
//	$css = file_get_contents("css/estilo.css");
//	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html2);
	$mpdf->Output();
/*
	exit;
*/
?>

