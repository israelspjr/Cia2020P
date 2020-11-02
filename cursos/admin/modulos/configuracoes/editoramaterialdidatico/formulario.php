<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EditoraMaterialDidatico.class.php");
	
	
	$EditoraMaterialDidatico = new EditoraMaterialDidatico();
		
$idEditoraMaterialDidatico = $_REQUEST['id'];

if($idEditoraMaterialDidatico != '' && $idEditoraMaterialDidatico  > 0){

	$valor = $EditoraMaterialDidatico->selectEditoraMaterialDidatico('WHERE idEditoraMaterialDidatico='.$idEditoraMaterialDidatico);
	
	$idEditoraMaterialDidatico = $valor[0]['idEditoraMaterialDidatico'];
		 $editora = $valor[0]['editora'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Editora Material Didático</legend>
    <form id="form_EditoraMaterialDidatico" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idEditoraMaterialDidatico ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                <p>
				<label>Editora:</label>
				<input type="text" name="editora" id="editora" class="required" value="<?php echo $editora?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				
				
	  
        <button class="button blue" onclick="postForm('form_EditoraMaterialDidatico', '<?php echo CAMINHO_MODULO?>configuracoes/editoramaterialdidatico/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

