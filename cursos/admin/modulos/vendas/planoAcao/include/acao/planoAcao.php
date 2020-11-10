<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$Proposta = new Proposta();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();


if($_POST['acao'] == 'atualizaKitMaterialINF'){ 

	$MaterialDidatico = new MaterialDidatico();
//	$KitMaterial = new KitMaterial(); ?>
	
  <p>
  <label>Material didático:</label>
  
  <?php 
	
//	$idKitMaterial = $_POST['idKitMaterial'] ? $_POST['idKitMaterial'] : 0;
	$idIdioma = $_POST['idIdioma'] ? $_POST['idIdioma'] : 0;
	$idNivelEstudo = $_POST['idNivelEstudo'] ? $_POST['idNivelEstudo'] : 0;
	$idFocoCurso = $_POST['idFocoCurso'] ? $_POST['idFocoCurso'] : 0;
	
	$sql = " WHERE INF.inativo = 0 AND INF.excluido = 0
        AND INF.nivelEstudo_IdNivelEstudo = ".$idNivelEstudo."
        AND INF.focoCurso_idFocoCurso = ".$idFocoCurso."
        AND MD.inativo = 0 AND MD.excluido = 0
AND INF.idioma_idIdioma = ".$idIdioma."";

	$rs = $MaterialDidatico->selectJoin($sql);
    foreach ($rs as $valor) {
		$html .= "<div>".$valor['nome']."</div>";	
	}
	echo $html;
//	echo $KitMaterial->selectKitMaterialSelect("",$idKitMaterial,$sql);?>
	<!--<span class="placeholder">Campo obrigatório</span>-->
    

<?php
}elseif($_POST['acao'] == 'nomeMaterial'){
$KitMaterial = new KitMaterial();  
?>

  <p>
  <label>Livros Kit:</label>  
  <?php 
  
  $idKitMaterial = $_POST['idKitMaterial'] ? $_POST['idKitMaterial'] : 0;
  $idIdioma = $_POST['idIdioma'] ? $_POST['idIdioma'] : 0;
  $idNivelEstudo = $_POST['idNivelEstudo'] ? $_POST['idNivelEstudo'] : 0;
  $idFocoCurso = $_POST['idFocoCurso'] ? $_POST['idFocoCurso'] : 0;  
  
  $sql = " INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma;
  $sql .= " AND INF.nivelEstudo_IdNivelEstudo = ".$idNivelEstudo." AND INF.focoCurso_idFocoCurso = ".$idFocoCurso;
  $sql .= " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";  
  $sql .= " AND KMINF.kitMaterial_idKitMaterial = K.idKitMaterial";
  $sql .= " INNER JOIN kitMaterialDidatico AS KMD ON KMD.kitMaterial_idKitMaterial = KMINF.kitMaterial_idKitMaterial AND KMD.excluido = 0";
  $sql .= " INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";
  $sql .= " AND MDINF.materialDidatico_idMaterialDidatico = KMD.materialDidatico_idMaterialDidatico";
  $sql .= " INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico";
  $sql .= " WHERE K.idKitMaterial = ".$idKitMaterial;
 //    echo $sql;   
  echo $KitMaterial->selectKitMaterialDescricao($sql);
  ?>
  </p>
<?php  
}elseif($_POST['acao'] == 'atualizarCargaHoraria'){ 

	$RelacionamentoINF = new RelacionamentoINF(); 
	  
	$idIdioma = $_POST['idIdioma'] ? $_POST['idIdioma'] : 0;
	$idNivelEstudo = $_POST['idNivelEstudo'] ? $_POST['idNivelEstudo'] : 0;
	$idFocoCurso = $_POST['idFocoCurso'] ? $_POST['idFocoCurso'] : 0;
	 
	$where = " WHERE inativo = 0 AND idioma_idIdioma=".$idIdioma." AND nivelEstudo_IdNivelEstudo = ".$idNivelEstudo." AND focoCurso_idFocoCurso = ".$idFocoCurso;
//	echo $where;
	$valorRelacionamentoINF = $RelacionamentoINF->selectRelacionamentoINF($where);

	$arrayRetorno['valor'][0] = Uteis::exibirHorasInput($valorRelacionamentoINF[0]['cargaHoraria']);	
	$arrayRetorno['campoAtualizar'][0] = "#div_form_PlanoAcao #horasPrograma_1";
	
	$arrayRetorno['valor'][1] = Uteis::exibirHorasInput($valorRelacionamentoINF[0]['cargaHoraria']);	
	$arrayRetorno['campoAtualizar'][1] = "#div_form_PlanoAcao #horasPrograma_2";
	
	echo json_encode($arrayRetorno);
	
} elseif ($_POST['acao'] == 'focoDoCurso') {
	
		$FocoCursoIdioma = new FocoCursoIdioma();
	
	    $idIdioma = $_POST['idIdioma'] ? $_POST['idIdioma'] : 0;
		$semRequirido = $_POST['semRequirido'] ? $_POST['semRequirido'] : 0;
	
	//	$sql = "INNER JOIN focoCursoIdioma AS FI ON FI.focoCurso_idFocoCurso = F.idFocoCurso ";
	//	$sql .= "INNER JOIN idioma AS I ON I.idIdioma = FI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;
	$sql .= " where FCI.excluido = 0 AND FCI.idioma_idIdioma = ".$idIdioma;
		
		echo '<p><label>Foco do curso:</label>';
		if ($semRequirido == 0 ) {
		echo "<p onchange=\"atualizaKitMaterialINF()\">".$FocoCursoIdioma->selectFocoCursoIdiomaSelect2("required inf", $idFocoCurso, $sql);
		} else {
		echo "<p onchange=\"atualizaKitMaterialINF()\">".$FocoCursoIdioma->selectFocoCursoIdiomaSelect2("inf", $idFocoCurso, $sql);	
		}
		echo '</p></p>';
		
} elseif ($_POST['acao'] == 'nivelDoCurso') {
	
		$NivelEstudo = new NivelEstudo();
	
	    $idIdioma = $_POST['idIdioma'] ? $_POST['idIdioma'] : 0;
	
		$sql = " INNER JOIN nivelEstudoIdioma AS NI ON NI.nivel_IdNivel = N.IdNivelEstudo ";
		$sql .= "INNER JOIN idioma AS I ON I.idIdioma = NI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;
	
		echo '<p><label>Nivel de estudo:</label>';
		echo "<p onchange=\"atualizaKitMaterialINF()\">".$NivelEstudo->selectNivelEstudoSelect("required inf", $IdNivelEstudo, $sql);
		echo '</p></p>';
		
}else{
	
	$idPlanoAcao = $_REQUEST['id'];	

	$PlanoAcao = new PlanoAcao();		
	$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
	
	if($_POST['acao'] == 'deletar'){
		
		$PlanoAcao->updateFieldPlanoAcao('dataExclusao', date('Y-m-d H:i:s'));	
		$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso. <br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
	}else{	
		
		$IdNivelEstudo = $_POST['IdNivelEstudo'];
		
		$idClientePj = $_POST['clientePj_idClientePj'];
		
		if ($idClientePj == '') {
		 	$idProposta = $_POST['proposta_idProposta']; 
		} else {
			$Proposta->setClientePjIdClientePj($idClientePj);
			$Proposta->setIdiomaIdIdioma($_POST['idIdioma']);
			$idProposta = $Proposta->addProposta();
		}
		$PlanoAcao->setPropostaIdProposta($idProposta);	
		$PlanoAcao->setFocoCursoIdFocoCurso($_POST['idFocoCursoIdioma']);
		$PlanoAcao->setNivelEstudoIdNivelEstudo($IdNivelEstudo);
	//	$PlanoAcao->setKitMaterialIdKitMaterial($_POST['idKitMaterial']);
		$PlanoAcao->setExpectativaInicioIdExpectativaInicio($_POST['idExpectativaInicio']);
		$PlanoAcao->setDataExpectativaInicio( Uteis::gravarData($_POST['dataExpectativaInicio']));
		$PlanoAcao->setHorasPrograma( Uteis::gravarHoras($_POST['horasPrograma']) );
		$PlanoAcao->setAbordagemCurso($_POST['abordagemCurso']);
		$PlanoAcao->setStatusAprovacaoIdStatusAprovacao($_POST['statusAprovacaoIdStatusAprovacao']);
		$PlanoAcao->setTipoContrato($_POST['tipoContrato']);
		//Mais de um tipo de curso
		$tipoCurso = implode(',',$_POST['idTipoCurso']);	

		$PlanoAcao->setTipoCurso($tipoCurso);
		$PlanoAcao->setTipoAval($_POST['tipoAval']);
		$PlanoAcao->setTipoMaterial($_POST['tipoMaterial']);	
		$PlanoAcao->setDataContrato(Uteis::gravarData($_POST['dataContrato3']));	
			
		if( $idPlanoAcao != "" && $idPlanoAcao > 0 ){
			
			
			$valorPAG = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);
			$idGrupo = $valorPAG[0]['grupo_idGrupo'];
			$idPlanoAcaoGrupo = $valorPAG[0]['idPlanoAcaoGrupo'];
			if ($idPlanoAcaoGrupo > 0) {
				$PlanoAcaoGrupo->setIdPlanoAcaoGrupo($idPlanoAcaoGrupo);
				$PlanoAcaoGrupo->updateFieldPlanoAcaoGrupo("nivelEstudo_IdNivelEstudo",$IdNivelEstudo);	
				
			}
			

			$idPlanoAcao = $PlanoAcao->updatePlanoAcao();	
			$arrayRetorno['mensagem'] = MSG_CADATU;			
			
		}else{
			
			$idPlanoAcao = $PlanoAcao->addPlanoAcao();
			
			
			//Avisar Luanda
			
	/*		if ($idGrupo == '') {
		
		$assunto = "Novo Plano de ação criado, verificar professor!";
		$msg = "Plano de ação número: ".$idPlanoAcao;
		$paraQuem = array('nome'=>'Roseli', 'email'=>'roselicampos@companhiadeidiomas.com.br');
		
		$rs =  Uteis::enviarEmail($assunto, $msg, $paraQuem, "", $copia, $bcopia);
		
			}*/
		
					
			
			$idProposta = $_POST['proposta_idProposta'];
						
			//DUMP DA INFORMAÇOES DA PROPOSTA
			
			$IntegranteProposta = new IntegranteProposta();
			$IntegrantePlanoAcao = new IntegrantePlanoAcao();
			
			$subQuery = " SELECT DISTINCT(clientePf_idClientePf) FROM integrantePlanoAcao IPA ";
			$subQuery .= " INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = IPA.planoAcao_idPlanoAcao ";
			$subQuery .= " INNER JOIN proposta AS PP ON PP.idProposta = PA.proposta_idProposta ";
			$subQuery .= " WHERE idProposta = ".$idProposta;
			
			$where = " WHERE proposta_idProposta = ".$idProposta;
			$where .= " AND clientePf_idClientePf NOT IN( ".$subQuery." )";
			
			$valorIntegranteProposta = $IntegranteProposta->selectIntegranteProposta($where);

			for ($row = 0; $row < count($valorIntegranteProposta,0); $row++){

				$IntegrantePlanoAcao->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
				$IntegrantePlanoAcao->setClientePfIdClientePf($valorIntegranteProposta[$row]['clientePf_idClientePf']);	
				$IntegrantePlanoAcao->setStatusAprovacaoIdStatusAprovacao(1);
				$IntegrantePlanoAcao->setNivelIdNivel( $IdNivelEstudo );
				$IntegrantePlanoAcao->setLinkVisualizacao();
				
				$IntegrantePlanoAcao->addIntegrantePlanoAcao();
			}
			
						
			$ValorSimuladoProposta = new ValorSimuladoProposta();
			$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();
			$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();
			
			$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();
			$NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();
				
			$idValorSimuladoProposta = $ValorSimuladoProposta->selectValorSimuladoProposta(" WHERE escolhido = 1 AND proposta_idProposta = ".$idProposta);		
			$idValorSimuladoProposta = $idValorSimuladoProposta[0]['idValorSimuladoProposta'];
			
			if($idValorSimuladoProposta){
				
				$valorItemValorSimuladoProposta = $ItemValorSimuladoProposta->selectItemValorSimuladoProposta(" WHERE valorSimuladoProposta_idValorSimuladoProposta = ".$idValorSimuladoProposta);
					
				for ($row = 0; $row < count($valorItemValorSimuladoProposta,0); $row++){
					
					$ValorSimuladoPlanoAcao->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
							
					$ValorSimuladoPlanoAcao->setValorHora($valorItemValorSimuladoProposta[$row]['valor']);	
					$ValorSimuladoPlanoAcao->setValorDescontoHora($valorItemValorSimuladoProposta[$row]['valorDescontoHora']);	
					$ValorSimuladoPlanoAcao->setValidadeDesconto($valorItemValorSimuladoProposta[$row]['validadeDesconto']);	
					$ValorSimuladoPlanoAcao->setHorasPorAula($valorItemValorSimuladoProposta[$row]['horasPorAula']);	
					$ValorSimuladoPlanoAcao->setFrequenciaSemanalAula($valorItemValorSimuladoProposta[$row]['frequenciaSemanalAula']);	
					$ValorSimuladoPlanoAcao->setCargaHorariaFixaMensal($valorItemValorSimuladoProposta[$row]['cargaHorariaFixaMensal']);	
					$ValorSimuladoPlanoAcao->setHoraNaoGeraFf($valorItemValorSimuladoProposta[$row]['horaNaoGeraFf']);	
					$ValorSimuladoPlanoAcao->setObs($valorItemValorSimuladoProposta[$row]['obs']);	
					$ValorSimuladoPlanoAcao->setTipo($valorItemValorSimuladoProposta[$row]['tipo']);	
					$ValorSimuladoPlanoAcao->setModalidadeIdModalidade($valorItemValorSimuladoProposta[$row]['modalidade_idModalidade']);	
					
					$idValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->addValorSimuladoPlanoAcao();
					
					$where = " WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = ".$valorItemValorSimuladoProposta[$row]['idItemValorSimuladoProposta'];
					$valorNaoFazAulaNestaSemanaProposta = $NaoFazAulaNestaSemanaProposta->selectNaoFazAulaNestaSemanaProposta($where);
							
					for ($row2 = 0; $row2 < count($valorNaoFazAulaNestaSemanaProposta,0); $row2++){						
						$NaoFazAulaNestaSemanaPlanoAcao->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao( $idValorSimuladoPlanoAcao );
						$NaoFazAulaNestaSemanaPlanoAcao->setSemana( $valorNaoFazAulaNestaSemanaProposta[$row2]['semana'] );
								
						$NaoFazAulaNestaSemanaPlanoAcao->addNaoFazAulaNestaSemanaPlanoAcao();
					}											
					
										
					$ProdutoAdicionalItemValorSimuladoProposta = new ProdutoAdicionalItemValorSimuladoProposta();
					$ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
					
					$valorProdutoAdicionalItemValorSimuladoProposta = $ProdutoAdicionalItemValorSimuladoProposta->selectProdutoAdicionalItemValorSimuladoProposta(" WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = ".$valorItemValorSimuladoProposta[$row]['idItemValorSimuladoProposta']);

					for ($row2 = 0; $row2 < count($valorProdutoAdicionalItemValorSimuladoProposta,0); $row2++){
		
						$ProdutoAdicionalValorSimuladoPlanoAcao->setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao( $idValorSimuladoPlanoAcao );
						$ProdutoAdicionalValorSimuladoPlanoAcao->setProdutoAdicionalIdProdutoAdicional($valorProdutoAdicionalItemValorSimuladoProposta[$row2]['produtoAdicional_idProdutoAdicional']);	
						
						$ProdutoAdicionalValorSimuladoPlanoAcao->addProdutoAdicionalValorSimuladoPlanoAcao();		
					}
					
				}
				
			}
			
			$arrayRetorno['mensagem'] = MSG_CADNEW;
			$arrayRetorno['atualizarNivelAtual'] = true;
			$arrayRetorno['pagina'] = CAMINHO_VENDAS."planoAcao/cadastro.php?id=".$idPlanoAcao;
				
		}
		
	}
	echo json_encode($arrayRetorno);
}

?>
