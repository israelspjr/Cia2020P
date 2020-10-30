<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SubvencaoMaterialGrupo.class.php");


$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();
//print_r($_POST);exit;

$arrayRetorno = array();

$idSubvencaoMaterialGrupo = $_REQUEST['id'];

if($_REQUEST['acao'] == "deletar"){	
	
	$dataSaida = Uteis::gravarData($_POST['dataSaida']);
	
	$rs = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo(" WHERE idSubvencaoMaterialGrupo = $idSubvencaoMaterialGrupo");
	$dataInicio = $rs[0]['dataInicio'];
	
	if( $dataSaida <= $dataInicio){
		
		$arrayRetorno['mensagem'] = "Data deve ser maior que ".Uteis::exibirData($dataInicio);	
		
	}else{
		
		$SubvencaoMaterialGrupo->setIdSubvencaoMaterialGrupo($idSubvencaoMaterialGrupo);
		$SubvencaoMaterialGrupo->updateFieldSubvencaoMaterialGrupo('dataFim', $dataSaida );
		
		$arrayRetorno['mensagem'] = "Desvinculado com sucesso";
		$arrayRetorno['fecharNivel'] = true;
	}
		
}else if($_REQUEST['acao'] == "alterar"){
    $idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];    
    $rs = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo(" WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataFim IS NOT NULL ORDER BY dataFim DESC");
    $dataInicio = Uteis::gravarData($_POST['dataInicio']);       
    
    if($idSubvencaoMaterialGrupo):        
        $SubvencaoMaterialGrupo->setIdSubvencaoMaterialGrupo($idSubvencaoMaterialGrupo);
        $SubvencaoMaterialGrupo->updateFieldSubvencaoMaterialGrupo("dataFim", $dataInicio);
    endif;    
       
        $SubvencaoMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
        $SubvencaoMaterialGrupo->setSubvencao($_POST['subvencao']);
        $SubvencaoMaterialGrupo->setTeto($_POST['teto']);
        $SubvencaoMaterialGrupo->setQuemPaga($_POST['quemPaga']);
        $SubvencaoMaterialGrupo->setDataInicio(Uteis::gravarData($_POST['dataInicio']));
        $SubvencaoMaterialGrupo->setObs($_POST['obs']);
        
        $SubvencaoMaterialGrupo->addSubvencaoMaterialGrupo();
        
        $arrayRetorno['mensagem'] = "Inserido com sucesso.";
        $arrayRetorno['fecharNivel'] = true;
    
} else {
	
	$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
	$dataEntrada = Uteis::gravarData($_POST['dataEntrada']);
	
	$rs = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo(" WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataFim IS NOT NULL ORDER BY dataFim DESC");
	$dataFim = $rs[0]['dataFim'];

	if($idSubvencaoMaterialGrupo){
		
		$SubvencaoMaterialGrupo->setIdSubvencaoMaterialGrupo($idSubvencaoMaterialGrupo);
		$SubvencaoMaterialGrupo->updateFieldSubvencaoMaterialGrupo("obs", $_POST['obs']);
		$arrayRetorno['mensagem'] = "Atualizado com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
		
	}elseif( $dataFim && $dataEntrada <= $dataFim ){
		
		$arrayRetorno['mensagem'] = "Data deve ser maior que ".Uteis::exibirData($dataFim);	
		
	}else{
				
		$SubvencaoMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
		$SubvencaoMaterialGrupo->setSubvencao($_POST['subvencao']);
		$SubvencaoMaterialGrupo->setTeto($_POST['teto']);
		$SubvencaoMaterialGrupo->setQuemPaga($_POST['quemPaga']);
		$SubvencaoMaterialGrupo->setDataInicio(Uteis::gravarData($_POST['dataEntrada']));
		$SubvencaoMaterialGrupo->setDataFim(Uteis::gravarData($_POST['dataFim']));
		$SubvencaoMaterialGrupo->setObs($_POST['obs']);
		
		$SubvencaoMaterialGrupo->addSubvencaoMaterialGrupo();
		
		$arrayRetorno['mensagem'] = "Inserido com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
		
	}
	
	
}

echo json_encode($arrayRetorno);

?>