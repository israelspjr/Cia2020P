<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Grupo = new Grupo();
$GrupoClientePj = new GrupoClientePj();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$IntegrantePlanoAcao = new IntegrantePlanoAcao();
$IntegranteGrupo = new IntegranteGrupo();
$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();
$EncomendaMaterialGrupo = new EncomendaMaterialGrupo();
$EncomendaMaterialPagamentoParcela = new EncomendaMaterialPagamentoParcela();
$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();
$ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
$ValorHoraGrupo = new ValorHoraGrupo();
$ProdutoAdicionalPlanoAcaoGrupo = new ProdutoAdicionalPlanoAcaoGrupo();
$OpcaoDia = new OpcaoDia();
$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();
$NaoFazAulaNestaSemanaGrupo = new NaoFazAulaNestaSemanaGrupo();
$AulaDataFixa = new AulaDataFixa();
$BuscaProfessor = new BuscaProfessor();
$KitMaterialDidatico = new KitMaterialDidatico();
$MaterialDidatico = new MaterialDidatico();
$PlanoAcaoGrupoKitMaterial = new PlanoAcaoGrupoKitMaterial();
$MaterialDidaticPlanoAcao = new MaterialDidaticPlanoAcao();
$PlanoAcaoGrupoMaterialDidatico = new PlanoAcaoGrupoMaterialDidatico();
$MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();
$PlanoAcaoGrupoMaterialMontado = new PlanoAcaoGrupoMaterialMontado();
$ClientePf = new ClientePf();
$ClientePj = new ClientePj();
$CalendarioProva = new CalendarioProva();
$PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();
$PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
$FechamentoGrupo = new FechamentoGrupo();
$FechamentoGrupoItenMotivoFechamento = new FechamentoGrupoItenMotivoFechamento();


$idPlanoAcao = $_REQUEST['id'];

//VERIFICA DADOS DOS ALUNOS

$sql = " SELECT IPA.idIntegrantePlanoAcao, PF.idClientePf, PF.documentoUnico, PF.nome 
FROM integrantePlanoAcao AS IPA 
INNER JOIN clientePf AS PF ON PF.idClientePf = IPA.clientePf_idClientePf
WHERE planoAcao_idPlanoAcao = $idPlanoAcao ";
$verAlunos = Uteis::executarQuery($sql);

if($verAlunos){
	foreach($verAlunos as $aluno){
		
		$idClientePf = $aluno["idClientePf"];
		$documentoUnico = $aluno["documentoUnico"];
		
		if($documentoUnico){
			$ClientePf->setIdClientePf($idClientePf);
			$ClientePf->updateFieldClientepf("tipoCliente_idTipoCliente", "3");
		}else{
			$nome = $aluno["nome"];
			$arrayRetorno['mensagem'] = "Preencha os documentos obrigatórios do aluno(a) $nome.";			
			echo json_encode($arrayRetorno);
			exit;
		}
	}
}

//VERIFICA DADOS DA EMPRESA
$sql = " SELECT PA.idPlanoAcao, PJ.cnpj, PJ.idClientePj, PJ.razaoSocial
FROM planoAcao AS PA 
INNER JOIN proposta AS P ON P.idProposta = PA.proposta_idProposta
INNER JOIN clientePj AS PJ ON PJ.idClientePj = P.clientePj_idClientePj
WHERE PA.idPlanoAcao = $idPlanoAcao ";
$verEmpresa = Uteis::executarQuery($sql);

if($verEmpresa){
	
	$idClientePj = $verEmpresa[0]["idClientePj"];
	$cnpj = $verEmpresa[0]["cnpj"];
		
	if($cnpj){
		$ClientePj->setIdClientePj($idClientePj);
		$ClientePj->updateFieldClientepj("tipoCliente_idTipoCliente", "3");
	}else{
		$razaoSocial = $verEmpresa[0]["razaoSocial"];
		$arrayRetorno['mensagem'] = "Preencha os documentos obrigatórios da empresa $razaoSocial.";			
		echo json_encode($arrayRetorno);
		exit;
	}
}

$valorPlanoAcao = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = ".$idPlanoAcao);
$idNivel = $valorPlanoAcao[0]['nivelEstudo_IdNivelEstudo'];
$tipoContrato = $valorPlanoAcao[0]['tipoContrato'];

//INSERE GRUPO
$Grupo->setNome($_POST['nomeGrupo']);
$Grupo->setInativo("0");
//$_->setDataCadastro( date('Y-m-d H:i:s') );

$idGrupo = $Grupo->addGrupo();

//VINCULA GRUPO AO CLIENTE PJ
if($_POST['idClientePj']){
	$GrupoClientePj->setGrupoIdGrupo( $idGrupo );
	$GrupoClientePj->setClientePjIdClientePj($_POST['idClientePj']);
	
	
	$GrupoClientePj->addGrupoClientePj();
}

//INSERE HISTÓRICO DO GRUPO
$dataInicioEstagio = Uteis::gravarData($_POST['dataInicioEstagio']);

$PlanoAcaoGrupo->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
$PlanoAcaoGrupo->setGrupoIdGrupo($idGrupo);
//$_->setDataCadastro( date('Y-m-d H:i:s') );
$PlanoAcaoGrupo->setDataInicioEstagio($dataInicioEstagio);
$PlanoAcaoGrupo->setDataPrevisaoTerminoEstagio( Uteis::gravarData($_POST['dataPrevisaoTerminoEstagio']) );
$PlanoAcaoGrupo->setInativo("0");
$PlanoAcaoGrupo->setNivelEstudoIdNivelEstudo($idNivel); 
$PlanoAcaoGrupo->setCategoria($_POST['categoria']);

$idPlanoAcaoGrupo = $PlanoAcaoGrupo->addPlanoAcaoGrupo();

//Cadastrar informação financeira

if ($tipoContrato == 1) {
 $dataContrato = $_REQUEST['dataPrevisaoTerminoEstagio'];
// $dataContrato = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($dataContratoT)));
 
    $FechamentoGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$FechamentoGrupo->setDataFechamento(Uteis::gravarData($dataContrato));
	$FechamentoGrupo->setObs("Término do pacote");
	$FechamentoGrupo->setTipo(3);
	
	$idFechamentoGrupo = $FechamentoGrupo->addFechamentoGrupo();
	
	$PlanoAcaoGrupoNaoFaturar->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$PlanoAcaoGrupoNaoFaturar->setData(Uteis::gravarData($dataContrato));
	
	$idPlanoAcaoGrupoNaoFaturar = $PlanoAcaoGrupoNaoFaturar->addPlanoAcaoGrupoNaoFaturar();
 
 	 $data = explode("/", $dataContrato);

     $statusCobranca = array(1=>2,2=>6,3=>1);

     $PlanoAcaoGrupoStatusCobranca->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
     $PlanoAcaoGrupoStatusCobranca->setStatusCobrancaIdStatusCobranca($statusCobranca[3]);
     $PlanoAcaoGrupoStatusCobranca->setMes($data[1]);
     $PlanoAcaoGrupoStatusCobranca->setAno($data[2]);
     $idm = $PlanoAcaoGrupoStatusCobranca->addPlanoAcaoGrupoStatusCobranca();
		
	$FechamentoGrupoItenMotivoFechamento->setFechamentoGrupoIdFechamentoGrupo($idFechamentoGrupo);
	$FechamentoGrupoItenMotivoFechamento->setItenMotivoFechamentoIdItenMotivoFechamento(11);
	$FechamentoGrupoItenMotivoFechamento->addFechamentoGrupoItenMotivoFechamento();


}

//Insere Calendário de Prova

		$CalendarioProva->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
		$CalendarioProva->setProvaIdProva(3);

//Debitando 15 dias
		
		$dataProva = Uteis::gravarData($_POST['dataPrevisaoTerminoEstagio']);
		$dataProva2 = date('d/m/Y', strtotime('-15 days', strtotime($dataProva)));
		
		$CalendarioProva->setDataPrevistaInicial(Uteis::gravarData($dataProva2));
		$CalendarioProva->addCalendarioProva();

//INSERE VALORES HORA DO GRUPO
$valorValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);

for ($row = 0; $row < count($valorValorSimuladoPlanoAcao,0); $row++){

	$ValorHoraGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$ValorHoraGrupo->setModalidadeIdModalidade( $valorValorSimuladoPlanoAcao[$row]['modalidade_idModalidade'] );
	$ValorHoraGrupo->setValorHora( $valorValorSimuladoPlanoAcao[$row]['valorHora'] );
	$ValorHoraGrupo->setCargaHorariaFixaMensal( $valorValorSimuladoPlanoAcao[$row]['cargaHorariaFixaMensal'] );
	$ValorHoraGrupo->setValorDescontoHora( $valorValorSimuladoPlanoAcao[$row]['valorDescontoHora'] );
	$ValorHoraGrupo->setValidadeDesconto( $valorValorSimuladoPlanoAcao[$row]['validadeDesconto'] );
	$ValorHoraGrupo->setPrevisaoReajuste( date('Y-m-d', strtotime("+1 years", strtotime($dataInicioEstagio))) );
	$ValorHoraGrupo->setDataInicio($dataInicioEstagio); 	//$ValorHoraGrupo->setDataFim();
	//$_->setDataCadastro( date('Y-m-d H:i:s') );
	$idValorHoraGrupo = $ValorHoraGrupo->addValorHoraGrupo();

	//PRODUTOS ADICIONAIS
	$where = " WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$valorValorSimuladoPlanoAcao[$row]['idValorSimuladoPlanoAcao'];
	$valorProdutoAdicionalValorSimuladoPlanoAcao = $ProdutoAdicionalValorSimuladoPlanoAcao->selectProdutoAdicionalValorSimuladoPlanoAcao($where);
	
	for ($row2 = 0; $row2 < count($valorProdutoAdicionalValorSimuladoPlanoAcao,0); $row2++){	
		$ProdutoAdicionalPlanoAcaoGrupo->setProdutoAdicionalIdProdutoAdicional( $valorProdutoAdicionalValorSimuladoPlanoAcao[$row2]['produtoAdicional_idProdutoAdicional'] );
		$ProdutoAdicionalPlanoAcaoGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
		
		$ProdutoAdicionalPlanoAcaoGrupo->addProdutoAdicionalPlanoAcaoGrupo();
	}
	
	//INSERE DIAS		
	$where = " WHERE escolhido = 1 AND valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$valorValorSimuladoPlanoAcao[$row]['idValorSimuladoPlanoAcao'];
	$idOpcaoDia = $OpcaoDia->selectOpcaoDia($where);
	$idOpcaoDia = $idOpcaoDia[$row]['idOpcao'] ? $idOpcaoDia[$row]['idOpcao'] : "0";
	
	$valorOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao->selectOpcaoDiaPlanoAcao(" WHERE opcaoDia_idOpcao = ".$idOpcaoDia);
	$tipo = $valorValorSimuladoPlanoAcao[$row]['tipo'];		
	
	for ($row2 = 0; $row2 < count($valorOpcaoDiaPlanoAcao,0); $row2++){
		if( $tipo == "R"){
			
			$AulaPermanenteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
			$AulaPermanenteGrupo->setexibirDiaSemana($valorOpcaoDiaPlanoAcao[$row2]['diaSemana']);
			$AulaPermanenteGrupo->setHoraInicio($valorOpcaoDiaPlanoAcao[$row2]['horaInicio']);
			$AulaPermanenteGrupo->setHoraFim($valorOpcaoDiaPlanoAcao[$row2]['horaFim']);			
			$AulaPermanenteGrupo->setDataInicio($dataInicioEstagio); 
			$AulaPermanenteGrupo->setLocalAulaIdLocalAula($valorOpcaoDiaPlanoAcao[$row2]['localAula_idLocalAula']);
			$AulaPermanenteGrupo->setEnderecoIdEndereco($valorOpcaoDiaPlanoAcao[$row2]['endereco_idEndereco']);
			
			
			$idAulaPermanenteGrupo = $AulaPermanenteGrupo->addAulaPermanenteGrupo();
			
			$where = " WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$valorValorSimuladoPlanoAcao[$row]['idValorSimuladoPlanoAcao'];
			$valorNaoFazAulaNestaSemanaPlanoAcao = $NaoFazAulaNestaSemanaPlanoAcao->selectNaoFazAulaNestaSemanaPlanoAcao($where);
			
			for ($row3 = 0; $row3 < count($valorNaoFazAulaNestaSemanaPlanoAcao,0); $row3++){
				$NaoFazAulaNestaSemanaGrupo->setSemana( $valorNaoFazAulaNestaSemanaPlanoAcao[$row3]['semana'] );
				$NaoFazAulaNestaSemanaGrupo->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
				
				$NaoFazAulaNestaSemanaGrupo->addNaoFazAulaNestaSemanaGrupo();
			}
			
			$BuscaProfessor->setAulaDataFixaIdAulaDataFixa();	
			$BuscaProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo($idAulaPermanenteGrupo);
			$BuscaProfessor->setDataApartir($dataInicioEstagio);
			
		}elseif( $tipo=="T" || $tipo=="E"){		

			$AulaDataFixa->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
			$AulaDataFixa->setDataAula($valorOpcaoDiaPlanoAcao[$row2]['dataAula']);
			$AulaDataFixa->setHoraInicio($valorOpcaoDiaPlanoAcao[$row2]['horaInicio']);
			$AulaDataFixa->setHoraFim($valorOpcaoDiaPlanoAcao[$row2]['horaFim']);
			$AulaDataFixa->setLocalAulaIdLocalAula($valorOpcaoDiaPlanoAcao[$row2]['localAula_idLocalAula']);
			$AulaDataFixa->setEnderecoIdEndereco($valorOpcaoDiaPlanoAcao[$row2]['endereco_idEndereco']);
			$AulaDataFixa->setAddFrom(0);
      
			$idAulaDataFixa = $AulaDataFixa->addAulaDataFixa();			
			$BuscaProfessor->setAulaPermanenteGrupoIdAulaPermanenteGrupo();
			$BuscaProfessor->setAulaDataFixaIdAulaDataFixa($idAulaDataFixa);
			$BuscaProfessor->setDataApartir($valorOpcaoDiaPlanoAcao[$row2]['dataAula']);
		}
		
		//INSERIR NA BUSCA
		$BuscaProfessor->setUrgente("0");		
		$BuscaProfessor->setFinalizada("0");
		$BuscaProfessor->setTipoBuscaIdTipoBusca("3");
		
		$BuscaProfessor->addBuscaProfessor();				
	}
				
}

//INSERE INTEGRANTES
$where = " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao;
$valorIntegrantePlanoAcao = $IntegrantePlanoAcao->selectIntegrantePlanoAcao($where);

for ($row = 0; $row < count($valorIntegrantePlanoAcao,0); $row++){
	
	$idIntegrantePlanoAcao = $valorIntegrantePlanoAcao[$row]['idIntegrantePlanoAcao'];

	$IntegranteGrupo->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
	$IntegranteGrupo->setClientePfIdClientePf( $valorIntegrantePlanoAcao[$row]['clientePf_idClientePf'] );		
	$IntegranteGrupo->setEnvioPsa($_POST['envioPsa_'.$idIntegrantePlanoAcao]);		
	$IntegranteGrupo->setDataEntrada($dataInicioEstagio);
	//$_->setDataCadastro( date('Y-m-d H:i:s') );
	
	$idIntegranteGrupo = $IntegranteGrupo->addIntegranteGrupo();
		
	//INSERE SUB CURSO
	$SubvencaoCursoGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
	$SubvencaoCursoGrupo->setSubvencao($_POST['subvencao_curso_'.$idIntegrantePlanoAcao]);
	$SubvencaoCursoGrupo->setTeto($_POST['teto_curso_'.$idIntegrantePlanoAcao]);
	$SubvencaoCursoGrupo->setQuemPaga($_POST['quemPaga_curso_'.$idIntegrantePlanoAcao]);	
	$SubvencaoCursoGrupo->setDataInicio($dataInicioEstagio);
	
	$SubvencaoCursoGrupo->setObs($_POST['obs_curso_'.$idIntegrantePlanoAcao]);
	
	$SubvencaoCursoGrupo->addSubvencaoCursoGrupo();
	
	//INSERE SUB MATERIAL
	$SubvencaoMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
	$SubvencaoMaterialGrupo->setSubvencao($_POST['subvencao_material_'.$idIntegrantePlanoAcao]);
	$SubvencaoMaterialGrupo->setTeto($_POST['teto_material_'.$idIntegrantePlanoAcao]);
	$SubvencaoMaterialGrupo->setQuemPaga($_POST['quemPaga_material_'.$idIntegrantePlanoAcao]);	
	$SubvencaoMaterialGrupo->setDataInicio($dataInicioEstagio);
	
	$SubvencaoMaterialGrupo->setObs($_POST['obs_material_'.$idIntegrantePlanoAcao]);
	
	$SubvencaoMaterialGrupo->addSubvencaoMaterialGrupo();		

	//MATERIAL E ENCOMENDA

	//KIT DE MATERIAL
	$idKit = $valorPlanoAcao[0]['kitMaterial_idKitMaterial'] ? $valorPlanoAcao[0]['kitMaterial_idKitMaterial'] : "0";			
	$idMaterialDidatico = $KitMaterialDidatico->selectKitMaterialDidatico(" WHERE kitMaterial_idKitMaterial = ".$idKit);
	$idMaterialDidatico = implode(",", Uteis::arrayCampoEspecifico($idMaterialDidatico, "materialDidatico_idMaterialDidatico"));
	$idMaterialDidatico = $idMaterialDidatico ? $idMaterialDidatico : "0";	
	$valorMaterialDidatico = $MaterialDidatico->selectMaterialDidatico(" WHERE idMaterialDidatico IN (".$idMaterialDidatico.")");

	if($valorMaterialDidatico){
		
		//INSERE O KIT
		if( $row == 0 ){
			$PlanoAcaoGrupoKitMaterial->setKitMaterialIdKitMaterial($idKit);
			$PlanoAcaoGrupoKitMaterial->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
			$PlanoAcaoGrupoKitMaterial->setDatainicio($dataInicioEstagio);
			
			
			$PlanoAcaoGrupoKitMaterial->addPlanoAcaoGrupoKitMaterial();
		}
		
		//INSERE ITENS PARA ENCOMENDA		
		for($row2=0; $row2 < count($valorMaterialDidatico,0); $row2++){
			
			$id = $valorMaterialDidatico[$row2]['idMaterialDidatico']."_".$idIntegrantePlanoAcao;
			$field = $_POST["checkbox_KitMaterialDidatico_".$id];	

			if($field){
				
				$valor = $_POST['valor_KitMaterialDidatico_'.$id];
				$parcelas = $_POST['parcelas_KitMaterialDidatico_'.$id];		
				$primeira = Uteis::gravarData( $_POST['dataPrimeiraCobranca_KitMaterialDidatico_'.$id] );
				$previsao = Uteis::gravarData( $_POST['dataPrevisaoEntregaMaterial_KitMaterialDidatico_'.$id] );
			
				$EncomendaMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
				$val = explode("_", $field);			
				$EncomendaMaterialGrupo->setMaterialDidaticoIdMaterialDidatico($val[0]);
				$EncomendaMaterialGrupo->setPlanoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado();
				$EncomendaMaterialGrupo->setValor($valor);
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
		}
								
	}

	//MATERIAL AVULSO
	
	$idMaterialDidatico = $MaterialDidaticPlanoAcao->selectMaterialDidaticPlanoAcao(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);
	$idMaterialDidatico = implode(",", Uteis::arrayCampoEspecifico($idMaterialDidatico, "materialDidatico_idMaterialDidatico"));
	$idMaterialDidatico = $idMaterialDidatico ? $idMaterialDidatico : "0";	
	$valorMaterialDidatico = $MaterialDidatico->selectMaterialDidatico(" WHERE idMaterialDidatico IN (".$idMaterialDidatico.")");

	if($valorMaterialDidatico){
		for($row2 = 0; $row2 < count($valorMaterialDidatico,0); $row2++){
			
			if( $row == 0 ){
				$PlanoAcaoGrupoMaterialDidatico->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
				$PlanoAcaoGrupoMaterialDidatico->setMaterialDidaticoIdMaterialDidatico( $valorMaterialDidatico[$row2]['idMaterialDidatico'] );
				$PlanoAcaoGrupoMaterialDidatico->setDataInicio($dataInicioEstagio);
				
				
				$PlanoAcaoGrupoMaterialDidatico->addPlanoAcaoGrupoMaterialDidatico();
			}
			
			$id = $valorMaterialDidatico[$row2]['idMaterialDidatico']."_".$idIntegrantePlanoAcao;
			$field = $_POST["checkbox_MaterialDidaticPlanoAcao_".$id];	
				
			if($field){
								
				$valor = $_POST['valor_MaterialDidaticPlanoAcao_'.$id];
				$parcelas = $_POST['parcelas_MaterialDidaticPlanoAcao_'.$id];		
				$primeira = Uteis::gravarData( $_POST['dataPrimeiraCobranca_MaterialDidaticPlanoAcao_'.$id] );
				$previsao = Uteis::gravarData( $_POST['dataPrevisaoEntregaMaterial_MaterialDidaticPlanoAcao_'.$id] );
				
				$EncomendaMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
				$val = explode("_", $field);
				$EncomendaMaterialGrupo->setMaterialDidaticoIdMaterialDidatico($val[0]);
				$EncomendaMaterialGrupo->setPlanoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado();
				$EncomendaMaterialGrupo->setValor($valor);
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
		}	
				
	}				
	
	//MATERIAL MONTADO/PERSONALIZADO/APOSTILAS	
	$valorMaterialMontadoPlanoAcao = $MaterialMontadoPlanoAcao->selectMaterialMontadoPlanoAcao(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);
	
	if($valorMaterialMontadoPlanoAcao){
		
		for($row2 = 0; $row2 < count($valorMaterialMontadoPlanoAcao,0); $row2++){
		
			if( $row == 0 ){
				
				$PlanoAcaoGrupoMaterialMontado->setPlanoAcaoGrupoIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
				$PlanoAcaoGrupoMaterialMontado->setNome( $valorMaterialMontadoPlanoAcao[$row2]['nome'] );
				$PlanoAcaoGrupoMaterialMontado->setPreco( $valorMaterialMontadoPlanoAcao[$row2]['preco'] );
				$PlanoAcaoGrupoMaterialMontado->setDataInicio($dataInicioEstagio);
				
				$PlanoAcaoGrupoMaterialMontado->setObs( $valorMaterialMontadoPlanoAcao[$row2]['obs'] );
						
				$idPlanoAcaoGrupoMaterialMontado = $PlanoAcaoGrupoMaterialMontado->addPlanoAcaoGrupoMaterialMontado();
			}
			
			$id = $valorMaterialMontadoPlanoAcao[$row]['idMaterialMontadoPlanoAcao']."_".$idIntegrantePlanoAcao;			
			$field = $_POST["checkbox_MaterialMontadoPlanoAcao_".$id];	
				
			if($field){			
				
				$valor = $_POST['valor_MaterialMontadoPlanoAcao_'.$id];
				$parcelas = $_POST['parcelas_MaterialMontadoPlanoAcao_'.$id];		
				$primeira = Uteis::gravarData( $_POST['dataPrimeiraCobranca_MaterialMontadoPlanoAcao_'.$id] );
				$previsao = Uteis::gravarData( $_POST['dataPrevisaoEntregaMaterial_MaterialMontadoPlanoAcao_'.$id] );
				$EncomendaMaterialGrupo->setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
				$EncomendaMaterialGrupo->setPlanoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado($idPlanoAcaoGrupoMaterialMontado);
				$EncomendaMaterialGrupo->setMaterialDidaticoIdMaterialDidatico();
				$EncomendaMaterialGrupo->setValor($valor);
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
		}	
						
	}
		
	
}
			
$arrayRetorno['mensagem'] = "Grupo criado com sucesso.";		
$arrayRetorno['fecharNivel'] = true;	

echo json_encode($arrayRetorno);

?>