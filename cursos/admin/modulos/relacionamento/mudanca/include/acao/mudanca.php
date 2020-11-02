<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$idAnterior = $_REQUEST['idAnterior'];
$arrayRetorno = array();



$idPlanoAcao = $_REQUEST['idPlanoAcao'];

if($_POST['acao']=="gerar"){
	
	$idGrupo = $_POST['grupo_idGrupo'];
	$IdNivelEstudo = $_POST['IdNivelEstudo'];
	
	$PlanoAcao->setPropostaIdProposta($_POST['proposta_idProposta']);
	$PlanoAcao->setGrupoIdGrupo($idGrupo);		
	$PlanoAcao->setFocoCursoIdFocoCurso($_POST['idFocoCurso']);
	$PlanoAcao->setNivelEstudoIdNivelEstudo($IdNivelEstudo);
	$PlanoAcao->setKitMaterialIdKitMaterial($_POST['idKitMaterial']);
	$PlanoAcao->setExpectativaInicioIdExpectativaInicio($_POST['idExpectativaInicio']);
	$PlanoAcao->setDataExpectativaInicio( Uteis::gravarData($_POST['dataExpectativaInicio']));
	$PlanoAcao->setHorasPrograma( Uteis::gravarHoras($_POST['horasPrograma']) );
	$PlanoAcao->setAbordagemCurso($_POST['abordagemCurso']);
	$PlanoAcao->setStatusAprovacaoIdStatusAprovacao("1");				
	$PlanoAcao->setMesReferenciaMudanca($_POST['mes']);
	$PlanoAcao->setAnoReferenciaMudanca($_POST['ano']);
	
	if( $idPlanoAcao ){
		
		$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
		
		$PlanoAcao->updatePlanoAcao();	
		$arrayRetorno['mensagem'] = "Mudança de estágio atualizada com sucesso";			
		
	}else{
		
		$PlanoAcaoRegras = new PlanoAcaoRegras();
		$IntegranteGrupo = new IntegranteGrupo();
		$IntegrantePlanoAcao = new IntegrantePlanoAcao();		
		$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
		$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();
		$SubvencaoCursoPlanoAcao = new SubvencaoCursoPlanoAcao();
		$SubvencaoMaterialPlanoAcao = new SubvencaoMaterialPlanoAcao();
        $VPG = new VpgPlanoAcao();
        $Qualy = new QualidadeComunicacaoPlanoAcao();
        $valorSimulado = new ValorSimuladoPlanoAcao();        
       		
		$idPlanoAcao = $PlanoAcao->addPlanoAcao();	

		//IDPLANOACAO DO ÚLTIMO NIVEL
		$rsPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcao = ".$idAnterior);		
		$idPlanoAcao_ant = $rsPlanoAcaoGrupo[0]['planoAcao_idPlanoAcao'];
		$idPlanoAcaoGrupo_ant = $rsPlanoAcaoGrupo[0]['idPlanoAcaoGrupo'];
		
		//INSERE INTEGRANTES
		$rsIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo_ant." 
		AND dataEntrada <= CURDATE() AND (dataSaida > CURDATE() OR dataSaida IS NULL OR dataSaida = '') ");
		foreach($rsIntegranteGrupo as $valor){
			
			$IntegrantePlanoAcao->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
			$IntegrantePlanoAcao->setClientePfIdClientePf($valor['clientePf_idClientePf']);
			$IntegrantePlanoAcao->setNivelIdNivel($IdNivelEstudo);
			$IntegrantePlanoAcao->setStatusAprovacaoIdStatusAprovacao("1");
			$IntegrantePlanoAcao->setLinkVisualizacao();
			
			$idIntegrantePlanoAcao = $IntegrantePlanoAcao->addIntegrantePlanoAcao();
			
			$rsSubvencaoCursoGrupo = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE integranteGrupo_idIntegranteGrupo = ".$valor['idIntegranteGrupo']."
			AND dataInicio <= CURDATE() AND (dataFim > CURDATE() OR dataFim IS NULL OR dataFim = '')");
			foreach($rsSubvencaoCursoGrupo as $valorSubvencaoCursoGrupo){
				$SubvencaoCursoPlanoAcao->setIntegrantePlanoAcaoIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
				$SubvencaoCursoPlanoAcao->setSubvencao($valorSubvencaoCursoGrupo['subvencao']);
				$SubvencaoCursoPlanoAcao->setTeto($valorSubvencaoCursoGrupo['teto']);
				$SubvencaoCursoPlanoAcao->setQuemPaga($valorSubvencaoCursoGrupo['quemPaga']);
				
				$SubvencaoCursoPlanoAcao->addSubvencaoCursoPlanoAcao();
			}
			
			$rsSubvencaoMaterialGrupo = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo(" WHERE integranteGrupo_idIntegranteGrupo = ".$valor['idIntegranteGrupo']."
			AND dataInicio <= CURDATE() AND (dataFim > CURDATE() OR dataFim IS NULL OR dataFim = '')");
			foreach($rsSubvencaoMaterialGrupo as $valorSubvencaoMaterialGrupo){
				$SubvencaoMaterialPlanoAcao->setIntegrantePlanoAcaoIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
				$SubvencaoMaterialPlanoAcao->setSubvencao($valorSubvencaoMaterialGrupo['subvencao']);
				$SubvencaoMaterialPlanoAcao->setTeto($valorSubvencaoMaterialGrupo['teto']);
				$SubvencaoMaterialPlanoAcao->setQuemPaga($valorSubvencaoMaterialGrupo['quemPaga']);
				
				$SubvencaoMaterialPlanoAcao->addSubvencaoMaterialPlanoAcao();
			} 
            
            //qualidade Comunicação
            $rsQualy = $Qualy->selectQualidadeComunicacaoPlanoAcao(" WHERE integrantesPlanoAcao_idIntegrantesPlanoAcao = ".$idIntegrantePlanoAcao);
            foreach($rsQualy as $valorQualy){
                $Qualy->setIntegrantesPlanoAcaoIdIntegrantesPlanoAcao($idIntegrantePlanoAcao);
                $Qualy->setItenQualidadeComunicacaoIdItenQualidadeComunicacao($rsQualy['itenQualidadeComunicacao_idItenQualidadeComunicacao']);                
            }
        }
        //valor simulado
        $rsValorSimuladoPlanoAcao = $valorSimulado->selectValorSimuladoPlanoAcao("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo_ant);
        
              
		//INSERE REGRAS
		$rsPlanoAcaoRegras = $PlanoAcaoRegras->selectPlanoAcaoRegras(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao_ant);	
		foreach($rsPlanoAcaoRegras as $valor){
			$PlanoAcaoRegras->setPlanoAcaoIdPlanoAcao($idPlanoAcao);	
			$PlanoAcaoRegras->setRegrasIdRegras($valor['regras_idRegras']);	
			
			$PlanoAcaoRegras->addPlanoAcaoRegras();	
		}
		
		$arrayRetorno['fecharNivel'] = true;   	
		$arrayRetorno['mensagem'] = "Mudança de estágio iniciada com sucesso.";   
	}
				
}

echo json_encode($arrayRetorno);
?>