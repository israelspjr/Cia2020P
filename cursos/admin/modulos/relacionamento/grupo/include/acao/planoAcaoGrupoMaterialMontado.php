<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupoMaterialMontado.class.php");

$PlanoAcaoGrupoMaterialMontado = new PlanoAcaoGrupoMaterialMontado();
	
$arrayRetorno = array();

$idPlanoAcaoGrupoMaterialMontado = $_REQUEST['id'];
$PlanoAcaoGrupoMaterialMontado->setIdPlanoAcaoGrupoMaterialMontado($idPlanoAcaoGrupoMaterialMontado);

if($_POST['acao']=="deletar"){
	
	$dataFim = Uteis::gravarData($_REQUEST['dataFim']);
	
	$valor = $PlanoAcaoGrupoMaterialMontado->selectPlanoAcaoGrupoMaterialMontado(" WHERE idPlanoAcaoGrupoMaterialMontado = ".$idPlanoAcaoGrupoMaterialMontado);
	$dataInicio = $valor[0]['dataInicio'];

	if($dataFim <= $dataInicio ){
		$arrayRetorno['mensagem'] = "Data do desvínculo deve ser maior que ".Uteis::exibirData($dataInicio);	
	}else{	
	
		$PlanoAcaoGrupoMaterialMontado->updateFieldPlanoAcaoGrupoMaterialMontado("dataFim", $dataFim);	
		$arrayRetorno['mensagem'] = MSG_CADDEL;
		$arrayRetorno['fecharNivel'] = true;
	}
	
}else{
	
	$idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	$dataInicio = $_REQUEST['dataInicio'];
	$dataFim = $_REQUEST['dataFim'];
				
	$PlanoAcaoGrupoMaterialMontado->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoMaterialMontado->setNome($_POST['nome']);
	$PlanoAcaoGrupoMaterialMontado->setPreco($_POST['preco']);
	$PlanoAcaoGrupoMaterialMontado->setObs($_POST['obs']);
	
	$PlanoAcaoGrupoMaterialMontado->setDatainicio(Uteis::gravarData($dataInicio));	
	$PlanoAcaoGrupoMaterialMontado->setDataFim(Uteis::gravarData($dataFim));	
	
	if($idPlanoAcaoGrupoMaterialMontado){
		
		$PlanoAcaoGrupoMaterialMontado->updatePlanoAcaoGrupoMaterialMontado();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		
		$idPlanoAcaoGrupoMaterialMontado = $PlanoAcaoGrupoMaterialMontado->addPlanoAcaoGrupoMaterialMontado();
		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		$arrayRetorno['fecharNivel'] = true;
		
		$arrayRetorno['ondeAtualizar'] = "#div_lista_PlanoAcaoGrupoMaterialMontado";
		$arrayRetorno['pagina'] = CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoMaterialMontado.php?id=".$idPlanoAcaoGrupo;
	}
}

echo json_encode($arrayRetorno);