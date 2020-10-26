<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
			
	$IntegrantePlanoAcao = new IntegrantePlanoAcao();	
	$ClientePf = new ClientePf();
	$Idioma = new Idioma();
	$NivelEstudo = new NivelEstudo();
	$PlanoAcao = new PlanoAcao();
	$Professor = new Professor();
		
	$idIntegrantePlanoAcao = $_GET['id'];
		
	//POR PADRÃO COMEÇA EM ABERTO
	$statusAprovacaoIdStatusAprovacao = "1";
	
	if($idIntegrantePlanoAcao != '' && $idIntegrantePlanoAcao  > 0){

		$valorIntegrantePlanoAcao = $IntegrantePlanoAcao->selectIntegrantePlanoAcao('WHERE idIntegrantePlanoAcao='.$idIntegrantePlanoAcao);

		$clientePfIdClientePf = $valorIntegrantePlanoAcao[0]['clientePf_idClientePf'];
		$planoAcao_idPlanoAcao = $valorIntegrantePlanoAcao[0]['planoAcao_idPlanoAcao'];
		$IdNivelEstudo = $valorIntegrantePlanoAcao[0]['Nivel_IdNivel']; 
		$statusAprovacaoIdStatusAprovacao = $valorIntegrantePlanoAcao[0]['statusAprovacao_idStatusAprovacao'];
		$obsDiagnosticoNivel = $valorIntegrantePlanoAcao[0]['obsDiagnosticoNivel'];
		$idProfessor = $valorIntegrantePlanoAcao[0]['professor_idProfessor'];
		
	}else{	
	
		$planoAcao_idPlanoAcao = $_GET['idPlanoAcao'];
		$IdNivelEstudo = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = ".$planoAcao_idPlanoAcao);
		$IdNivelEstudo = $IdNivelEstudo[0]['nivelEstudo_IdNivelEstudo'];
	}
	
	$idIdioma =  $PlanoAcao->getIdIdioma($planoAcao_idPlanoAcao);
	
?>

<fieldset>
  <legend>Integrantes do plano de ação</legend>
  <form id="form_IntegrantePlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
    <input type="hidden" name="statusAprovacaoIdStatusAprovacao" id="statusAprovacaoIdStatusAprovacao" value="<?php echo $statusAprovacaoIdStatusAprovacao ?>" />
    <input type="hidden" name="planoAcao_idPlanoAcao" id="planoAcao_idPlanoAcao" value="<?php echo $planoAcao_idPlanoAcao ?>" />
    <p>
      <label>Cliente p. física:</label>
      <?php
		 if($idIntegrantePlanoAcao != '' && $idIntegrantePlanoAcao  > 0){
			 $valorClientePf = $ClientePf->selectClientePf(" WHERE idClientePf = ".$clientePfIdClientePf);
			 echo "<strong>".$valorClientePf[0]['nome']."</strong>";
			 echo "<input type=\"hidden\" name=\"idClientePf\" id=\"idClientePf\" value=\"".$clientePfIdClientePf."\" />";
		 }else{
		 	 
			 	$idProposta = $PlanoAcao->getIdProposta($planoAcao_idPlanoAcao);
			 	
		   	$where = " AND COALESCE(clientePj_idClientePj, 0) IN ( 
					SELECT COALESCE(P.clientePj_idClientePj, 0) FROM proposta AS P				
					WHERE P.idProposta = $idProposta 
				) AND idClientePf NOT IN ( 
					SELECT COALESCE(clientePf_idClientePf, 0) FROM integrantePlanoAcao 
					WHERE planoAcao_idPlanoAcao = $planoAcao_idPlanoAcao
				)  OR COALESCE(clientePj_idClientePj2, 0) IN (SELECT COALESCE(P.clientePj_idClientePj, 0) FROM proposta AS P				
					WHERE P.idProposta = $idProposta 
				) ";
		//		echo $where;
		   	echo $ClientePf->selectClientePfSelect("", $clientePfIdClientePf, $where);
		 }
		 ?>
    </p>
    
        <?php 		
	$and = "  AND clientePj_idClientePj IN (SELECT 
            COALESCE(clientePj_idClientePj, 0)
        FROM
            proposta AS P
        INNER JOIN planoAcao AS PA on PA.proposta_idProposta = P.idProposta    
		WHERE
            PA.idPlanoAcao = $planoAcao_idPlanoAcao
ORDER BY nome )";

	?>
    
    
    <p>
    <label>Professor Aluno</label>
    <?php echo $Professor->selectProfessorSelect("",$idProfessor, $and);?>
    </p>
    <p>
      <label>Diagnótico de nível pessoal:</label>
      
      <?php 
			$sql = " INNER JOIN nivelEstudoIdioma AS NI ON NI.nivel_IdNivel = N.IdNivelEstudo ";
			$sql .= "INNER JOIN idioma AS I ON I.idIdioma = NI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;
		
			echo $NivelEstudo->selectNivelEstudoSelect("required", $IdNivelEstudo, $sql);?>
      <span class="placeholder">Campo obrigatório</span></p>
    <p>
      <label>Observações:</label>
      <textarea name="obsDiagnosticoNivel" id="obsDiagnosticoNivel" rows="5" cols="60"><?php echo $obsDiagnosticoNivel?></textarea>
    </p>
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_IntegrantePlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/integrantePlanoAcao.php?id=<?php echo $idIntegrantePlanoAcao?>&idPlanoAcao=<?php echo $planoAcao_idPlanoAcao?>');">Salvar</button>
        
      </p>
    </div>
  </form>
</fieldset>
<script>ativarForm();</script>