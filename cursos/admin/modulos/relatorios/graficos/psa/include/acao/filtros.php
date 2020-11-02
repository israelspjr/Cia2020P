<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
array_unshift($campos,"Grupos");
array_unshift($camposNome,"Grupos");
/*
Uteis::pr($campos);
Uteis::pr($camposNome);exit;
*/
//MONTA FILTROS
$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
        $gerente = " AND GER.gerente_idGerente in(".$idGerentes.")";
        
   if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") 
        $gerente .= " AND GCNPJ.clientePj_idClientePj =". $_POST['clientePj_idClientePj']; 
   if($_POST['grupo_idGrupo'] != "-")  
        $gerente .= " AND G.idGrupo = ".$_POST['grupo_idGrupo'];   
}else{
       
     if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") 
        $gerente .= " AND GCNPJ.clientePj_idClientePj =". $_POST['clientePj_idClientePj'];
         
    if($_POST['grupo_idGrupo'] != "-")  
        $gerente .= " AND G.idGrupo = ".$_POST['grupo_idGrupo'];  
}

$dataReferencia1 = $_POST['dataReferencia'];
$dataReferencia1a = strtotime(str_replace('/', '-', $dataReferencia1)); 

$dataIni = "01/03/2015";
$dataIni = strtotime(str_replace('/', '-', $dataIni)); 

if($dataReferencia1a == "" || ($dataReferencia1a < $dataIni))
    $dataReferencia = "01/03/2015";
else    
    $dataReferencia = $dataReferencia1;
	
	
$dataReferencia2 = $_POST['dataReferencia2'];	


$dataReferencia2a = strtotime(str_replace('/', '-', $dataReferencia2)); 

    
if($dataReferencia2a == "" || ($dataReferencia2a < $dataIni))   { 
    $dataReferencia2 = date("d/m/Y");
}

//if($dataReferencia1 && $dataReferencia2) 
	$where .= " AND DATE(PIG.dataReferencia) BETWEEN '".Uteis::gravarData($dataReferencia)."' AND '".Uteis::gravarData($dataReferencia2)."' ";
	
if (($_POST['mostrarComentarios'] == "") || (!isset($_POST['mostrarComentarios']))){
	$mostrarComentarios = 0;
} else {
	$mostrarComentarios = 1;
}

$idIntegranteGrupo = $_POST['idIntegranteGrupo'];
if($idIntegranteGrupo!="")
    $where.=" AND IG.idIntegranteGrupo =".$idIntegranteGrupo;

#IG.idIntegranteGrupo

//if (($_POST['professor_idProfessor'] == "") || (!isset($_POST['professor_idProfessor']))){
$idProfessor = $_POST['professor_idProfessor'];
//}


//echo $idProfessor;
//echo $where;
?>