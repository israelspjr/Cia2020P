<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidatico.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoMaterialDidatico.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EditoraMaterialDidatico.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");
	
	
	$MaterialDidatico = new MaterialDidatico();
	
	$Idioma = new Idioma();
	$EditoraMaterialDidatico = new EditoraMaterialDidatico();
	$TipoMaterialDidatico = new TipoMaterialDidatico();
		
$idMaterialDidatico = $_REQUEST['id'];

if($idMaterialDidatico != '' && $idMaterialDidatico  > 0){

	$valor = $MaterialDidatico->selectMaterialDidatico('WHERE idMaterialDidatico='.$idMaterialDidatico);
	
	$opcional = $valor[0]['opcional'];
	 $dataCadastro = $valor[0]['dataCadastro'];
	 $obs = $valor[0]['obs'];
	 $inativo = $valor[0]['inativo'];
	 $nome = $valor[0]['nome'];		 
	 $editoraMaterialDidatico_idEditoraMaterialDidatico = $valor[0]['editoraMaterialDidatico_idEditoraMaterialDidatico'];
	 $materialDidaticoTipo_idMaterialDidaticoTipo = $valor[0]['materialDidaticoTipo_idMaterialDidaticoTipo'];
	 $idioma_idIdioma = $valor[0]['idioma_idIdioma'];
	 $isbn = $valor[0]['isbn'];
	 $valor = Uteis::formatarMoeda($valor[0]['valor']);

	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Material Didático</legend>
    <form id="form_MaterialDidatico" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idMaterialDidatico ?>" />
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
        <span class="placeholder">Campo Obrigatório</span>
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="opcional">Opcional</label>
        <input type="checkbox" name="opcional" id="opcional" value="1" <?php if($opcional != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Editora Material Didático:</label>
        <?php echo $EditoraMaterialDidatico->selectEditoraMaterialDidaticoSelect("required", $editoraMaterialDidatico_idEditoraMaterialDidatico, " WHERE inativo = 0 AND excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Material Didático Tipo:</label>
        <?php echo $TipoMaterialDidatico->selectTipoMaterialDidaticoSelect("required", $materialDidaticoTipo_idMaterialDidaticoTipo, " WHERE inativo = 0 AND excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Idioma:</label>
        <?php echo $Idioma->selectIdiomaSelect("required", $idioma_idIdioma, ""); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>I.S.B.N.:</label>
        <input type="text" name="isbn" id="isbn" class="" value="<?php echo $isbn?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Valor:</label>
        <input type="text" name="valor" id="valor" class="numeric" value="<?php echo $valor?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      </p>
      <button class="button blue" onclick="postForm('form_MaterialDidatico', '<?php echo CAMINHO_MODULO?>configuracoes/materialdidatico/grava.php')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
