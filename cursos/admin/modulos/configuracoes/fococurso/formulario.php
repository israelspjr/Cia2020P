<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FocoCurso.class.php");
	
	
	$FocoCurso = new FocoCurso();
		
$idFocoCurso = $_REQUEST['id'];

if($idFocoCurso != '' && $idFocoCurso  > 0){

	$valor = $FocoCurso->selectFocoCurso('WHERE idFocoCurso='.$idFocoCurso);
	
	$idFocoCurso = $valor[0]['idFocoCurso'];
		 $foco = $valor[0]['foco'];
		 $obs = $valor[0]['obs'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Foco Curso</legend>
    <form id="form_FocoCurso" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idFocoCurso ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Foco:</label>
				<input type="text" name="foco" id="foco" class="required" value="<?php echo $foco?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Observação:</label>
				  <textarea name="obs" id="obs" cols="40" class="" rows="4"><?php echo $obs?></textarea>
				  <span class="placeholder">Campo Obrigatório</span>
				</p>
				 
				
				
	  
        <button class="button blue" onclick="postForm('form_FocoCurso', '<?php echo CAMINHO_MODULO?>configuracoes/fococurso/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

