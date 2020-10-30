<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoKitMaterial.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupo.class.php");

$PlanoAcaoGrupoKitMaterial = new PlanoAcaoGrupoKitMaterial();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

	

$arrayRetorno = array();

$idPlanoAcaoGrupoKitMaterial = $_REQUEST['id'];
$PlanoAcaoGrupoKitMaterial->setIdPlanoAcaoGrupoKitMaterial($idPlanoAcaoGrupoKitMaterial);

if($_POST['acao']=="deletar"){
	
	$dataFim = Uteis::gravarData($_REQUEST['dataFim']);
	
	$valorPlanoAcaoGrupoKitMaterial = $PlanoAcaoGrupoKitMaterial->selectPlanoAcaoGrupoKitMaterial(" WHERE idPlanoAcaoGrupoKitMaterial = ".$idPlanoAcaoGrupoKitMaterial);
	$dataInicio = $valorPlanoAcaoGrupoKitMaterial[0]['datainicio'];
	
	if($dataFim <= $dataInicio ){
		$arrayRetorno['mensagem'] = "Data do desvinculo deve ser maior que ".Uteis::exibirData($dataInicio);	
	}else{			
		$PlanoAcaoGrupoKitMaterial->updateFieldPlanoAcaoGrupoKitMaterial("dataFim", $dataFim);	
		$arrayRetorno['mensagem'] = "Kit desvinculado com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
	}
	
}else{
	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	
	$dataInicio = Uteis::gravarData($_REQUEST['dataInicio']);
	$dataFim = Uteis::gravarData($_REQUEST['dataFim']);
			
	$PlanoAcaoGrupoKitMaterial->setKitMaterialIdKitMaterial($_POST['idKitMaterial']);
	$PlanoAcaoGrupoKitMaterial->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoKitMaterial->setDatainicio($dataInicio);	
	$PlanoAcaoGrupoKitMaterial->setDataFim($dataFim);	
	
	if($idPlanoAcaoGrupoKitMaterial){
				
		$PlanoAcaoGrupoKitMaterial->updatePlanoAcaoGrupoKitMaterial();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		
		$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
		$dataInicioEstagio = $valorPlanoAcaoGrupo[0]['dataInicioEstagio'];		
		
		if($dataInicioEstagio > $dataInicio){
			$arrayRetorno['mensagem'] = "O kit não pode ser vinculado antes do inicio do estágio (".Uteis::exibirData($dataInicioEstagio).")";	
		}else{			
			$idPlanoAcaoGrupoKitMaterial = $PlanoAcaoGrupoKitMaterial->addPlanoAcaoGrupoKitMaterial();
			
			$arrayRetorno['mensagem'] = MSG_CADNEW;
			$arrayRetorno['fecharNivel'] = true;
			
			$arrayRetorno['ondeAtualizar'] = "#div_lista_PlanoAcaoGrupoKitMaterial";
			$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoKitMaterial.php?id=".$idPlanoAcaoGrupo;
		}
	}
}

echo json_encode($arrayRetorno);