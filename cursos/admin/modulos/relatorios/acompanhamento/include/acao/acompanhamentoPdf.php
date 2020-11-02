<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAMINHO_CFG."mpdf60/mpdf.php");

$IntengranteGrupo = new IntegranteGrupo();
$Relatorio = new Relatorio();

$where = "WHERE 1 ";

$ano_ini = $_REQUEST['ano_ini'];
$mes_ini = $_REQUEST['mes_ini'];

$ano_fim = $_REQUEST['ano_fim'];
$mes_fim = $_REQUEST['mes_fim'];

$idProfessor = implode(",",$_REQUEST['idProfessor']);
if($idProfessor) $where .= " AND PR.idProfessor IN(".$idProfessor.")";	 

$idGrupo = $_REQUEST['grupo_idGrupo'];
echo $idGrupo;

if(($idGrupo != "-") && ($idGrupo != '')) {
	$where .= " AND G.idGrupo IN (".$idGrupo.")";	
}


$idGerentes = $_REQUEST['idGerentes'];
if(($idGerentes!="-")&&($idGerentes != '')){    
   $where .= " AND GER.gerente_idGerente in(".$idGerentes.")"; 
}

if($_REQUEST['clientePj_idClientePj']!="" && $_REQUEST['clientePj_idClientePj']!="-") {
        $where .= " AND GPJ.clientePj_idClientePj = ".$_REQUEST['clientePj_idClientePj'];	
$idClientePj = $_REQUEST['clientePj_idClientePj'];
}
		
$status =  $_REQUEST['statusG'];
if($status != "-"){
if( $status != '' ) $where .= " AND G.inativo = ".$status;
}	

$mostrarTudo = $_REQUEST['mostrarTudo'];
if ($mostrarTudo == 0) {
$where .= " AND PAG.inativo = 0";
}

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
if ($idIntegranteGrupo != '') {
$where .= " AND IG.idIntegranteGrupo = ".$idIntegranteGrupo;
$unicoAluno = 1;	
}

$frequencia = $_REQUEST['frequencia'];
if ($frequencia == 'on') {
	
$trazerfrequencia = 1;	
}
//echo $where;
	
$conteudo = $Relatorio->relatorioAcompanhamento($where, "", true,$mes_ini, $ano_ini, $mes_fim, $ano_fim,1, $unicoAluno,$trazerfrequencia);

$conteudo .= "</table>";

  $html .= $conteudo;
  
// echo $html; 
	try {
$mpdf = new mPDF();
$mpdf->debug = true;
$mpdf->allow_output_buffering = true;
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

//$mpdf->allow_charset_conversion=TRUE;
//$mpdf->charset_in='UTF-8';
$mpdf->WriteHTML($html);
$mpdf->Output();
	} catch (MpdfException $e) {
		
		echo $e->getmessage();
	}
?>