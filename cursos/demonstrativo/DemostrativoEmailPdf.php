<?php
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/demonstrativo.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."mpdf60/mpdf.php");
$idPlanoAcaoGrupo = $_GET['p'];
$mes = $_GET['m'];
$ano = $_GET['a'];

$url = "https://".CAMINHO_VER_DM."demonstratioEmail.php?pdf=1&p=".$idPlanoAcaoGrupo."&m=".$mes."&a=".$ano;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$conteudo = curl_exec($curl);

//curl_close($curl);

$assunto= "Demonstrativo de cobrança ".Uteis::base64_url_decode($mes)."/".Uteis::base64_url_decode($ano)." Companhia de Idiomas <br>";

           $html = '<div class="linha-inteira" style="text-align: center;">';
             //   $html .= '<img src="'.CAMINHO_IMG2.'_cabecalho_demonstrativo.png">';
                $html .= '<br>';
                        $html .= '<td class="noticia">'.$conteudo.'</td>';
               //         $html .= '<td class="rodape"><img src="' . CAMINHO_IMG2 . '_rodape.png"></td>';
            $html .= '</div>';
//Uteis::pr($html);
$mpdf = new mPDF();
$mpdf->SetDisplayMode('fullpage');
$mpdf->AddPage('P', // L - landscape, P - portrait
    '', '', '', '',
    5, // margin_left
    5, // margin right
    0, // margin top
    0, // margin bottom
    0, // margin header
    0  // margin footer
);

//	$css = file_get_contents("css/estilo.css");
//$mpdf->WriteHTML($stylesheet,1);
$mpdf->allow_charset_conversion=TRUE;
$mpdf->charset_in='UTF-8';
$mpdf->WriteHTML($html);
$mpdf->Output();
