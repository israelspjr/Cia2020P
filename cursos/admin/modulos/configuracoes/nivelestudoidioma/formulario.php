<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$NivelEstudoIdioma = new NivelEstudoIdioma();
	$NivelEstudo = new NivelEstudo();
	$Idioma = new Idioma();
		
$idNivelEstudoIdioma = $_REQUEST['id'];

if($idNivelEstudoIdioma != '' && $idNivelEstudoIdioma  > 0){

	$valor = $NivelEstudoIdioma->selectNivelEstudoIdioma('WHERE idNivelEstudoIdioma='.$idNivelEstudoIdioma);
	
	$idNivelEstudoIdioma = $valor[0]['idNivelEstudoIdioma'];
		 $nivel_IdNivel = $valor[0]['nivel_IdNivel'];
		 $idioma_idIdioma = $valor[0]['idioma_idIdioma'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 $provaOral = $valor[0]['provaOral'];
		 $provaOn = $valor[0]['provaOn'];

}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Nível Estudo Idioma</legend>
    <form id="form_NivelEstudoIdioma" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idNivelEstudoIdioma ?>" />
		<div class="esquerda">
                <p>
				<label>Nível:</label>
				
                <?php echo $NivelEstudo->selectNivelEstudoSelect("required", $nivel_IdNivel, ""); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Idioma:</label>
				
                <?php echo $Idioma->selectIdiomaSelect("required", $idioma_idIdioma, " AND excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
		
        	<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
        </div>
        <div class="direita">		
				
		<p><label>Tem prova Oral: 
        
        <input type="checkbox" name="provaOral" id="provaOral" value='1' <?php if ($provaOral == 1) {echo 'checked="checked"'; } ?>> </label>	</p>
        
        <p><label>Tem prova On-line: 
        
        <input type="checkbox" name="provaOn" id="provaOn" value='1' <?php if ($provaOn == 1) {echo 'checked="checked"'; } ?>> </label>	</p>			
	  	
        
      </div>
      <div class="linha-inteira">
        <button class="button blue" onclick="postForm('form_NivelEstudoIdioma', '<?php echo CAMINHO_MODULO?>configuracoes/nivelestudoidioma/grava.php')">Salvar</button>
        
      </p>
      </div>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

