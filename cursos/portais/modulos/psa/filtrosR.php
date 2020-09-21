<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
     $gerente .= " AND GCNPJ.clientePj_idClientePj =" .$_SESSION['idClientePj_SS'];
         
    if($_POST['grupo_idGrupo'] != "-")  
        $gerente .= " AND G.idGrupo = ".$_POST['grupo_idGrupo'];  

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
	$where .= " AND DATE(PIG.dataReferencia) BETWEEN '".$dataReferencia."' AND '".$dataReferencia2."' ";
	
if (($_POST['mostrarComentarios'] == "") || (!isset($_POST['mostrarComentarios']))){
	$mostrarComentarios = 0;
} else {
	$mostrarComentarios = 1;
}
	$idProfessor = $_POST['professor_idProfessor'];
?>

