<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
array_unshift($campos,"grupo");
array_unshift($camposNome,"Grupo");


 $rs = count($_POST['idGrupo']);
 $idGrupos = implode(",", $_POST['idGrupo']);

 if (($idGrupos != "") && (count($idGrupos) > 0))  {
        $gerente .= " AND G.idGrupo in (".$idGrupos.")";  
 }
//}

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
	$where .= " AND DATE(PIG.dataReferencia) BETWEEN '2018-09-01' AND '".$dataReferencia2."' ";
	
if (($_POST['mostrarComentarios'] == "") || (!isset($_POST['mostrarComentarios']))){
	$mostrarComentarios = 0;
} else {
	$mostrarComentarios = 1;
}

	$idProfessor = $_SESSION['idProfessor_SS']; 
?>

