<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
array_unshift($campos,"Grupos");
array_unshift($camposNome,"Grupos");


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
	$where .= " AND DATE(PIG.dataReferencia) BETWEEN '".$dataReferencia."' AND  '2018-08-31'";
	
if (($_POST['mostrarComentarios'] == "") || (!isset($_POST['mostrarComentarios']))){
	$mostrarComentarios = 0;
} else {
	$mostrarComentarios = 1;
}

//if (($_POST['professor_idProfessor'] == "") || (!isset($_POST['professor_idProfessor']))){
	$idProfessor = $_SESSION['idProfessor_SS']; //$_POST['professor_idProfessor'];
//} 


//echo $idProfessor;
//echo $where;
?>

