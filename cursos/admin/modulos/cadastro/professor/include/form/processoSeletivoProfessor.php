<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$Idioma = new Idioma();
	
	$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
	
	$idProcessoSeletivoProfessor = $_GET['id'];	
	$professor_idProfessor = $_GET['idProfessor'];	
	
	if($idProcessoSeletivoProfessor!=''){
		
		$valorProcessoSeletivoProfessor = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE idProcessoSeletivoProfessor = ".$idProcessoSeletivoProfessor);
			
		$professor_idProfessor = $valorProcessoSeletivoProfessor[0]['professor_idProfessor'];
		$idIdioma = $valorProcessoSeletivoProfessor[0]['idioma_idIdioma'];
		$dataReferencia = Uteis::exibirData($valorProcessoSeletivoProfessor[0]['dataReferencia']);		
		$obs = $valorProcessoSeletivoProfessor[0]['obs'];
		$notaTeste = $valorProcessoSeletivoProfessor[0]['notaTeste'];
		$niveF = $valorProcessoSeletivoProfessor[0]['nivelF'];
	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de processo seletivo do professor</legend>
    <form id="form_processoSeletivoProfessor" class="validate" method="post" onsubmit="return false">
      <input type="hidden" name="professor_idProfessor" id="professor_idProfessor" value="<?php echo $professor_idProfessor?>" /> 
      
      <p>
        <label>Idioma:</label>        
		 <?php 
		  if($idProcessoSeletivoProfessor==""){	
			  $and = " AND ( ";
			  $and .= " 	disponivelAula = 1 AND idIdioma NOT IN (";
			  $and .= "			SELECT idioma_idIdioma FROM processoSeletivoProfessor AS PS WHERE PS.professor_idProfessor = ".$professor_idProfessor;
			  $and .= " 	)";
			  $and .= " )";
			  echo $Idioma->selectIdiomaSelect("required", $idIdioma, $and);
			  echo "<span class=\"placeholder\">Campo Obrigatório</span> ";
          }else{
          	$idiomaSelecionado =  $Idioma->selectIdioma(" WHERE idIdioma = ".$idIdioma);
			echo "<strong>".$idiomaSelecionado[0]['idioma']."</strong>";
			echo "<input type=\"hidden\" name=\"idIdioma\" id=\"idIdioma\" value=\"".$idIdioma."\" />";
		  }
		 ?>
        </p>
          <div>
          	<label>Nível do Idioma: </label>
          		<select name="nivelF" id="nivelF">
                	<option value="" <?php if ($nivel == '') { echo "selected"; } ?>>Selecione</option>
          			<option value="1" <?php if ($nivel == 1) { echo "selected"; } ?>>Fluente</option>
          			<option value="2" <?php if ($nivel == 2) { echo "selected"; } ?>>Nativo</option>
          			<option value="3" <?php if ($nivel == 3) { echo "selected"; } ?>>Avançado</option>
          			<option value="4" <?php if ($nivel == 4) { echo "selected"; } ?>>Intermediário</option>
          			<option value="5" <?php if ($nivel == 5) { echo "selected"; } ?>>Básico</option>
          		</select>
          </div>
      <p>
        <label>Data de referência:</label>
        <input type="text" name="dataReferencia" id="dataReferencia" class="required data" value="<?php echo $dataReferencia?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
    
      <p>
      <label>Nota teste:</label>
      <input type="text" id="notaTeste" name="notaTeste" value="<?php echo $notaTeste?>" />
      </p>
    
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      
    
      
      <div class="linha-inteira"><p>
        <button class="button blue" onclick="postForm('form_processoSeletivoProfessor', '<?php echo CAMINHO_CAD."professor/"?>include/acao/processoSeletivoProfessor.php?id=<?php echo $idProcessoSeletivoProfessor?>');" >Salvar</button>
        
      </p>
      </div>
    </form>
    <div id="div_lista_processoSeletivoProfessorComEtapas">
      <?php if( $idProcessoSeletivoProfessor != ''){ 
        require_once '../resourceHTML/processoSeletivoProfessorComEtapas.php';
	  }?>
    </div>
  </fieldset>
</div>
<script>
	ativarForm();
</script> 