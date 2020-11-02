<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$DemonstrativoCobranca = new DemonstrativoCobranca();
$arrayRetorno = array();
if($_POST['acao']=='alterar'){
    $idDemonstrativoCobranca = $_POST['idDemonstrativoCobranca'];
    $dataVencimento =   Uteis::gravarData($_POST['dataVencimento']);
    
    $DemonstrativoCobranca -> setIdDemonstrativoCobranca($idDemonstrativoCobranca);
    $rs = $DemonstrativoCobranca -> updateFieldDemonstrativoCobranca('dataVencimento', $dataVencimento);
    
    if($rs==1){
        $arrayRetorno['mensagem'] = "Vencimento alterado com sucesso.";
        $arrayRetorno['fecharNivel'] = true;
    }
}    
echo json_encode($arrayRetorno);    