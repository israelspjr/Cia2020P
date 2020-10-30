<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SubvencaoCursoGrupo.class.php");

$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
//print_r($_POST);exit;

$arrayRetorno = array();

$idSubvencaoCursoGrupo = $_REQUEST['id'];

if($_REQUEST['acao'] == "deletar"){	
	
	$dataSaida = Uteis::gravarData($_POST['dataSaida']);
	
	$rs = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE idSubvencaoCursoGrupo = $idSubvencaoCursoGrupo");
	$dataInicio = $rs[0]['dataInicio'];
	
	if( $dataSaida <= $dataInicio){
		$arrayRetorno['mensagem'] = "Data deve ser maior que ".Uteis::exibirData($dataInicio);	
	}else{
		$SubvencaoCursoGrupo->setIdSubvencaoCursoGrupo($idSubvencaoCursoGrupo);
		$SubvencaoCursoGrupo->updateFieldSubvencaoCursoGrupo('dataFim', $dataSaida );
		
		$arrayRetorno['mensagem'] = "Desvinculado com sucesso";
		$arrayRetorno['fecharNivel'] = true;
	}
	
}else if($_REQUEST['acao'] == "alterar"){

    $idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
    $dataEntrada = Uteis::gravarData($_POST['dataEntrada']);
    
    $rs = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataFim IS NOT NULL ORDER BY dataFim DESC");
    
    if($idSubvencaoCursoGrupo):            
        $SubvencaoCursoGrupo->setIdSubvencaoCursoGrupo($idSubvencaoCursoGrupo);
        $SubvencaoCursoGrupo->updateFieldSubvencaoCursoGrupo("dataFim", $dataEntrada);
   endif; 
             
        $SubvencaoCursoGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
        $SubvencaoCursoGrupo->setSubvencao($_POST['subvencao']);
        $SubvencaoCursoGrupo->setTeto($_POST['teto']);
        $SubvencaoCursoGrupo->setQuemPaga($_POST['quemPaga']);
        $SubvencaoCursoGrupo->setDataInicio($dataEntrada);        
        $SubvencaoCursoGrupo->setObs($_POST['obs']);
        
        $SubvencaoCursoGrupo->addSubvencaoCursoGrupo();
        
        $arrayRetorno['mensagem'] = "Inserido com sucesso.";
        $arrayRetorno['fecharNivel'] = true;    

}else{
	
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
	$dataEntrada = Uteis::gravarData($_POST['dataEntrada']);
	
	$rs = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataFim IS NOT NULL ORDER BY dataFim DESC");
	$dataFim = $rs[0]['dataFim'];
	
	if($idSubvencaoCursoGrupo){	
	
		$SubvencaoCursoGrupo->setIdSubvencaoCursoGrupo($idSubvencaoCursoGrupo);
		$SubvencaoCursoGrupo->updateFieldSubvencaoCursoGrupo("obs", $_POST['obs']);
		
		$arrayRetorno['mensagem'] = "Atualizado com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
		
	}elseif( $dataFim && $dataEntrada <= $dataFim ){
		
		$arrayRetorno['mensagem'] = "Data deve ser maior que ".Uteis::exibirData($dataFim);	
		
	}else{
				
		$SubvencaoCursoGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
		$SubvencaoCursoGrupo->setSubvencao($_POST['subvencao']);
		$SubvencaoCursoGrupo->setTeto($_POST['teto']);
		$SubvencaoCursoGrupo->setQuemPaga($_POST['quemPaga']);
		$SubvencaoCursoGrupo->setDataInicio($dataEntrada);
		
		$SubvencaoCursoGrupo->setObs($_POST['obs']);
		
		$SubvencaoCursoGrupo->addSubvencaoCursoGrupo();
		
		$arrayRetorno['mensagem'] = "Inserido com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
	}
	
}

echo json_encode($arrayRetorno);

?>