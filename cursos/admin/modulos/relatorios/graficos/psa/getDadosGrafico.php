<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


if($_POST['tipo_grafico']=='frequencia'):
$tipo = $_REQUEST['tipo'];   
$mes_ini = $_REQUEST['mes_ini'];
$mes_fim = $_REQUEST['mes_fim'];
$ano_ini = $_REQUEST['ano_ini'];
$ano_fim = $_REQUEST['ano_fim'];
$idGrupo = $_REQUEST['idGrupo'];
$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];

$idGrupo = implode(",",$_REQUEST['idGrupo']);
if($idGrupo) $where .= " AND G.idGrupo IN (".$idGrupo.")";  

$clientePj_idClientePj = implode(",",$_REQUEST['clientePj_idClientePj']);
if($clientePj_idClientePj) $where .= " AND GPJ.clientePj_idClientePj IN (".$clientePj_idClientePj.")";  

if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
    $where .= " AND YEAR(FF.dataReferencia) >= $ano_ini AND MONTH(FF.dataReferencia) >= $mes_ini 
     AND YEAR(FF.dataReferencia) <= $ano_fim AND MONTH(FF.dataReferencia) <= $mes_fim ";
}

echo $Relatorio->GraficoFrequencia($where, $tipo);
        
elseif($_POST['tipo_grafico']=='psa'):
        
$mes_ini="";
 
 
elseif($_POST['tipo_grafico']=='pagamento'):  
    
$mes_ini="";
    
else:
    
$mes_ini;
    
endif;
