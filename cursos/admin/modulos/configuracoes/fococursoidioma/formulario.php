<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FocoCursoIdioma.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FocoCurso.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");
	
	
	$FocoCursoIdioma = new FocoCursoIdioma();
	$FocoCurso = new FocoCurso();
	$Idioma = new Idioma();
		
$idFocoCursoIdioma = $_REQUEST['id'];

if($idFocoCursoIdioma != '' && $idFocoCursoIdioma  > 0){

	$valor = $FocoCursoIdioma->selectFocoCursoIdioma('WHERE idFocoCursoIdioma='.$idFocoCursoIdioma);
	
	$idFocoCursoIdioma = $valor[0]['idFocoCursoIdioma'];
		 $focoCurso_idFocoCurso = $valor[0]['focoCurso_idFocoCurso'];
		 $idioma_idIdioma = $valor[0]['idioma_idIdioma'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Foco Curso Idioma</legend>
    <form id="form_FocoCursoIdioma" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idFocoCursoIdioma ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Foco Curso:</label>
				
                <?php echo $FocoCurso->selectFocoCursoSelect("required", $focoCurso_idFocoCurso, " "); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Idioma:</label>
                 <?php echo $Idioma->selectIdiomaSelect("required", $idioma_idIdioma, ""); ?>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_FocoCursoIdioma', '<?php echo CAMINHO_MODULO?>configuracoes/fococursoidioma/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

