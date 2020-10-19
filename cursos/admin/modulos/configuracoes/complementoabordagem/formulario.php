<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$ComplementoAbordagem = new ComplementoAbordagem();
		
$idComplementoAbordagem = $_REQUEST['id'];

if($idComplementoAbordagem != '' && $idComplementoAbordagem  > 0){

	$valor = $ComplementoAbordagem->selectComplementoAbordagem('WHERE idComplementoAbordagem='.$idComplementoAbordagem);
	
	$idComplementoAbordagem = $valor[0]['idComplementoAbordagem'];
		 $item = $valor[0]['item'];
		 $inativo = $valor[0]['inativo'];
		 $padrao = $valor[0]['padrao'];
		 $nome = $valor[0]['nome'];
		 $excluido = $valor[0]['excluido'];
		 $portalProfessor = $valor[0]['portalProfessor'];
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Complemento de Abordagem</legend>
    <form id="form_ComplementoAbordagem" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idComplementoAbordagem ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="padrao">Padrão</label>
        <input type="checkbox" name="padrao" id="padrao" value="1" <?php if($padrao != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
        <span class="placeholder">Campo Obrigatório</span> 
      </p>
      <p>
        <label>Item:</label>
        <textarea name="item_base" id="item_base" cols="40" rows="4"><?php echo $item?></textarea>
        <textarea name="item" id="item" class="required" ></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
     <button class="button blue" onclick="postForm_editor('item', 'form_ComplementoAbordagem', '<?php echo CAMINHO_MODULO?>configuracoes/complementoabordagem/grava.php')">Salvar</button>
      
      </p>
       <p>
        <label for="inativo">Portal do Professor</label>
        <input type="checkbox" name="portalProfessor" id="portalProfessor" value="1" <?php if($portalProfessor != 0){ ?> checked="checked" <?php } ?> />
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();viraEditor('item');</script> 
