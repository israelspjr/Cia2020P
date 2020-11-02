<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SotaqueIdiomaProfessor.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");
	
	
	$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();
	$Idioma = new Idioma();
		
$idSotaqueIdiomaProfessor = $_REQUEST['id'];

if($idSotaqueIdiomaProfessor != '' && $idSotaqueIdiomaProfessor  > 0){

	$valor = $SotaqueIdiomaProfessor->selectSotaqueIdiomaProfessor('WHERE idSotaqueIdiomaProfessor='.$idSotaqueIdiomaProfessor);
	
	$idSotaqueIdiomaProfessor = $valor[0]['idSotaqueIdiomaProfessor'];
		 $idioma_idIdioma = $valor[0]['idioma_idIdioma'];
		 $valor2 = $valor[0]['valor'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Sotaque Idioma Professor</legend>
    <form id="form_SotaqueIdiomaProfessor" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idSotaqueIdiomaProfessor ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Idioma:</label>
				<?php echo $Idioma->selectIdiomaSelect("required", $idioma_idIdioma, "  AND excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Valor:</label>
				<input type="text" name="valor" id="valor" class="required" value="<?php echo $valor2?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_SotaqueIdiomaProfessor', '<?php echo CAMINHO_MODULO?>configuracoes/sotaqueidiomaprofessor/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

