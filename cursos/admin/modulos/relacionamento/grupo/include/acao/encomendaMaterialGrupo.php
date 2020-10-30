<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EncomendaMaterialGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EncomendaMaterialPagamentoParcela.class.php");
//print_r($_POST);exit;

$arrayRetorno = array();

$EncomendaMaterialGrupo = new EncomendaMaterialGrupo();
$EncomendaMaterialPagamentoParcela = new EncomendaMaterialPagamentoParcela();

$rsKitMaterialDidatico = $_POST['checkbox_KitMaterialDidatico'];
$rsMaterialDidaticPlanoAcao = $_POST['checkbox_MaterialDidaticPlanoAcao'];
$rsMaterialMontadoPlanoAcao = $_POST['checkbox_MaterialMontadoPlanoAcao'];

if($rsKitMaterialDidatico || $rsMaterialDidaticPlanoAcao || $rsMaterialMontadoPlanoAcao){
	
	foreach($rsKitMaterialDidatico as $valor){
		
		$id = $valor;
		
		$val = explode("_", $id);	
		$idMaterialDidatico = $val[0];
		$idIntegranteGrupo = $val[1];
			
		$preco = $_POST['valor_KitMaterialDidatico_'.$id];
		$parcelas = $_POST['parcelas_KitMaterialDidatico_'.$id];		
		$primeira = Uteis::gravarData( $_POST['dataPrimeiraCobranca_KitMaterialDidatico_'.$id] );
		$previsao = Uteis::gravarData( $_POST['dataPrevisaoEntregaMaterial_KitMaterialDidatico_'.$id] );
		//echo " id = $id / preco = $preco / parcelas = $parcelas / primeira = $primeira / previsao = $previsao \n";
		
		$EncomendaMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);				
		$EncomendaMaterialGrupo->setMaterialDidaticoIdMaterialDidatico($idMaterialDidatico);
		$EncomendaMaterialGrupo->setPlanoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado();
		$EncomendaMaterialGrupo->setValor($preco);
		$EncomendaMaterialGrupo->setParcelas($parcelas);
		$EncomendaMaterialGrupo->setDataPrimeiraCobranca($primeira);
		$EncomendaMaterialGrupo->setDataPrevisaoEntregaMaterial($previsao);
		
		$idEncomendaMaterialGrupo = $EncomendaMaterialGrupo->addEncomendaMaterialGrupo();
		
		for($p=0; $p < $parcelas; $p++){
			$EncomendaMaterialPagamentoParcela->setEncomendaMaterialGrupoIdEncomendaMaterialGrupo($idEncomendaMaterialGrupo);
			$EncomendaMaterialPagamentoParcela->setParcela(($p+1));
			$EncomendaMaterialPagamentoParcela->setQuitada("0");
			$EncomendaMaterialPagamentoParcela->setDataReferencia( date('Y-m-d', strtotime("+$p months", strtotime($primeira))) );
			
			$EncomendaMaterialPagamentoParcela->addEncomendaMaterialPagamentoParcela();
		}
	
	}
	
	foreach($rsMaterialDidaticPlanoAcao as $valor){
		
		$id = $valor;
		
		$val = explode("_", $id);	
		$idMaterialDidatico = $val[0];
		$idIntegranteGrupo = $val[1];
		
		$preco = $_POST['valor_MaterialDidaticPlanoAcao_'.$id];
		$parcelas = $_POST['parcelas_MaterialDidaticPlanoAcao_'.$id];		
		$primeira = Uteis::gravarData( $_POST['dataPrimeiraCobranca_MaterialDidaticPlanoAcao_'.$id] );
		$previsao = Uteis::gravarData( $_POST['dataPrevisaoEntregaMaterial_MaterialDidaticPlanoAcao_'.$id] );
		//echo " id = $id / preco = $preco / parcelas = $parcelas / primeira = $primeira / previsao = $previsao \n";
		
		$EncomendaMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);				
		$EncomendaMaterialGrupo->setMaterialDidaticoIdMaterialDidatico($idMaterialDidatico);
		$EncomendaMaterialGrupo->setPlanoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado();
		$EncomendaMaterialGrupo->setValor($preco);
		$EncomendaMaterialGrupo->setParcelas($parcelas);
		$EncomendaMaterialGrupo->setDataPrimeiraCobranca($primeira);
		$EncomendaMaterialGrupo->setDataPrevisaoEntregaMaterial($previsao);
		
		$idEncomendaMaterialGrupo = $EncomendaMaterialGrupo->addEncomendaMaterialGrupo();
		
		for($p=0; $p < $parcelas; $p++){
			$EncomendaMaterialPagamentoParcela->setEncomendaMaterialGrupoIdEncomendaMaterialGrupo($idEncomendaMaterialGrupo);
			$EncomendaMaterialPagamentoParcela->setParcela(($p+1));
			$EncomendaMaterialPagamentoParcela->setQuitada("0");
			$EncomendaMaterialPagamentoParcela->setDataReferencia( date('Y-m-d', strtotime("+$p months", strtotime($primeira))) );
			
			$EncomendaMaterialPagamentoParcela->addEncomendaMaterialPagamentoParcela();
		}
	}
	
	foreach($rsMaterialMontadoPlanoAcao as $valor){
		
		$id = $valor;
		
		$val = explode("_", $id);	
		$idPlanoAcaoGrupoMaterialMontado = $val[0];
		$idIntegranteGrupo = $val[1];
		
		$preco = $_POST['valor_MaterialMontadoPlanoAcao_'.$id];
		$parcelas = $_POST['parcelas_MaterialMontadoPlanoAcao_'.$id];		
		$primeira = Uteis::gravarData( $_POST['dataPrimeiraCobranca_MaterialMontadoPlanoAcao_'.$id] );
		$previsao = Uteis::gravarData( $_POST['dataPrevisaoEntregaMaterial_MaterialMontadoPlanoAcao_'.$id] );
		//echo " id = $id / preco = $preco / parcelas = $parcelas / primeira = $primeira / previsao = $previsao \n";
		
		$EncomendaMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);				
		$EncomendaMaterialGrupo->setMaterialDidaticoIdMaterialDidatico();
		$EncomendaMaterialGrupo->setPlanoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado($idPlanoAcaoGrupoMaterialMontado);
		$EncomendaMaterialGrupo->setValor($preco);
		$EncomendaMaterialGrupo->setParcelas($parcelas);
		$EncomendaMaterialGrupo->setDataPrimeiraCobranca($primeira);
		$EncomendaMaterialGrupo->setDataPrevisaoEntregaMaterial($previsao);
		
		$idEncomendaMaterialGrupo = $EncomendaMaterialGrupo->addEncomendaMaterialGrupo();
		
		for($p=0; $p < $parcelas; $p++){
			$EncomendaMaterialPagamentoParcela->setEncomendaMaterialGrupoIdEncomendaMaterialGrupo($idEncomendaMaterialGrupo);
			$EncomendaMaterialPagamentoParcela->setParcela(($p+1));
			$EncomendaMaterialPagamentoParcela->setQuitada("0");
			$EncomendaMaterialPagamentoParcela->setDataReferencia( date('Y-m-d', strtotime("+$p months", strtotime($primeira))) );
			
			$EncomendaMaterialPagamentoParcela->addEncomendaMaterialPagamentoParcela();
		}
		
	}
	
	$arrayRetorno['mensagem'] = "Materiais encomendados com sucesso.";
	$arrayRetorno['mudarAba'] = "#aba_div_encomendarMaterial_ver";
	
}else{
	$arrayRetorno['mensagem'] = "Nehuma encomenda selecionada.";
}

echo json_encode($arrayRetorno);
