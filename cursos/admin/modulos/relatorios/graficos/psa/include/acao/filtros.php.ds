<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//MONTA FILTROS
$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
        $gerente = " AND GER.gerente_idGerente in(".$idGerentes.")";
        
   if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") 
        $gerente .= " AND GCNPJ.clientePj_idClientePj =". $_POST['clientePj_idClientePj']; 
   if($_POST['grupo_idGrupo'] != "-")  
        $gerente .= " AND G.idGrupo = ".$_POST['grupo_idGrupo'];   
}else{
    $idGerentes="";
}

if($_POST['dataReferencia'] == "" || $_POST['dataReferencia'] < "01/03/2015")
    $dataReferencia = "01/03/2015";
else    
    $dataReferencia = $_POST['dataReferencia'];
    
if($_POST['dataReferencia2'] == "" || $_POST['dataReferencia2'] < "01/03/2015")    
    $dataReferencia2 = date("d/m/Y");
else    
    $dataReferencia2 = $_POST['dataReferencia2'];

if($dataReferencia && $dataReferencia2) 
    $where .= " AND DATE(PIG.dataReferencia) BETWEEN '".Uteis::gravarData($dataReferencia)."' AND '".Uteis::gravarData($dataReferencia2)."' ";

//echo $where;
?>

