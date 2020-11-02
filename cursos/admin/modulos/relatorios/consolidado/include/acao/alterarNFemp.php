<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$DemonstrativoCobranca = new DemonstrativoCobranca();
$arrayRetorno = array();
if($_POST['acao']=='alterar'){
    $idDemonstrativoCobranca = $_POST['idDemonstrativoCobranca'];
    $obs =  $_POST['obs'];
   
	$DemonstrativoCobranca -> setIdDemonstrativoCobranca($idDemonstrativoCobranca);
    $rs = $DemonstrativoCobranca -> updateFieldDemonstrativoCobranca('obs', $obs);
    
    if($rs==1){
        $arrayRetorno['mensagem'] = "NF empresa Inserida/Atualizada com sucesso!";
	//	$arrayRetorno["updateTr"] = true;
		$arrayRetorno['fecharNivel'] = true;		 
	//	$arrayRetorno['atualizarPagina'] = true;
		//$arrayRetorno['idDemonstrativoCobranca'] = $idDemonstrativoCobranca;
        }
}    
echo json_encode($arrayRetorno);    