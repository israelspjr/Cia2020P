<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoMaterialDidatico.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupo.class.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcaoGrupoMaterialDidatico = new PlanoAcaoGrupoMaterialDidatico();
	
$arrayRetorno = array();

$idPlanoAcaoGrupoMaterialDidatico = $_REQUEST['id'];
$PlanoAcaoGrupoMaterialDidatico->setIdPlanoAcaoGrupoMaterialDidatico($idPlanoAcaoGrupoMaterialDidatico);

if($_POST['acao']=="deletar"){
	
	$dataFim = Uteis::gravarData($_REQUEST['dataFim']);
	
	$valor = $PlanoAcaoGrupoMaterialDidatico->selectPlanoAcaoGrupoMaterialDidatico(" WHERE idPlanoAcaoGrupoMaterialDidatico = ".$idPlanoAcaoGrupoMaterialDidatico);
	$dataInicio = $valor[0]['dataInicio'];
	
	if($dataFim <= $dataInicio ){
		$arrayRetorno['mensagem'] = "Data do desvinculo deve ser maior que ".Uteis::exibirData($dataInicio);	
	}else{			
		$PlanoAcaoGrupoMaterialDidatico->updateFieldPlanoAcaoGrupoMaterialDidatico("dataFim", $dataFim);	
		$arrayRetorno['mensagem'] = "Material desvinculado com sucesso.";
		$arrayRetorno['fecharNivel'] = true;
	}
		
}else{
	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	
	$dataInicio = Uteis::gravarData($_REQUEST['dataInicio']);
	$dataFim = Uteis::gravarData($_REQUEST['dataFim']);
			
	$PlanoAcaoGrupoMaterialDidatico->setMaterialDidaticoIdMaterialDidatico($_POST['idMaterialDidatico']);
	$PlanoAcaoGrupoMaterialDidatico->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoMaterialDidatico->setDatainicio($dataInicio);	
	$PlanoAcaoGrupoMaterialDidatico->setDataFim($dataFim);	
	
	if($idPlanoAcaoGrupoMaterialDidatico){
		
		$PlanoAcaoGrupoMaterialDidatico->updatePlanoAcaoGrupoMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		
		$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
		$dataInicioEstagio = $valorPlanoAcaoGrupo[0]['dataInicioEstagio'];		
		
		if($dataInicioEstagio > $dataInicio){			
			$arrayRetorno['mensagem'] = "O material não pode ser vinculado antes do inicio do estágio (".Uteis::exibirData($dataInicioEstagio).")";	
		}else{	
		
			$idPlanoAcaoGrupoMaterialDidatico = $PlanoAcaoGrupoMaterialDidatico->addPlanoAcaoGrupoMaterialDidatico();
			
			$arrayRetorno['mensagem'] = MSG_CADNEW;
			$arrayRetorno['fecharNivel'] = true;
			
			$arrayRetorno['ondeAtualizar'] = "#div_lista_PlanoAcaoGrupoMaterialDidatico";
			$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialDidatico.php?id=".$idPlanoAcaoGrupo;
		}
		
	}
}

echo json_encode($arrayRetorno);