<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$DemonstrativoCobrancaIntegranteGrupo = new DemonstrativoCobrancaIntegranteGrupo();
$arrayRetorno = array();
if($_POST['acao']=='alterar'){
    $idDemonstrativoCobrancaIntegranteGrupo = $_POST['idDemonstrativoCobranca'];
    $obs =  $_POST['obs'];
   
	$DemonstrativoCobrancaIntegranteGrupo -> setIdDemonstrativoCobrancaIntegranteGrupo($idDemonstrativoCobrancaIntegranteGrupo);
    $rs = $DemonstrativoCobrancaIntegranteGrupo -> updateFieldDemonstrativoCobrancaIntegranteGrupo('obs', $obs);
    
  //  if($rs==1){
        $arrayRetorno['mensagem'] = "NF Aluno Inserida/Atualizada com sucesso!";
	//	 $arrayRetorno['mensagem2'] = $rs;
	//	 $arrayRetorno['mensagem3'] = "teste";
	//	 $arrayRetorno["updateTr"] = "tr";
	//	$arrayRetorno['atualizarPagina'] = true;
    //    }
	//var_dump($rs);

		 $arrayRetorno['fecharNivel'] = true;
}    
echo json_encode($arrayRetorno);    