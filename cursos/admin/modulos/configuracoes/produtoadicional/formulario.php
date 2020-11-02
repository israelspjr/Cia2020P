<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$ProdutoAdicional = new ProdutoAdicional();

$idProdutoAdicional = $_REQUEST['id'];

if ($idProdutoAdicional != '' && $idProdutoAdicional > 0) {

	$valor = $ProdutoAdicional -> selectProdutoAdicional('WHERE idProdutoAdicional=' . $idProdutoAdicional);

	$idProdutoAdicional = $valor[0]['idProdutoAdicional'];
	$nome = $valor[0]['nome'];

	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];
	$valor2 = $valor[0]['valor'];
    $hora = $valor[0]['porHora'];
    $descricao = $valor[0]['descricao'];
}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Cadastro - Produto Adicional
		</legend>
		<form id="form_ProdutoAdicional" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idProdutoAdicional ?>" />
			<p>
				<label for="inativo">Inativo</label>
				<input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
			</p>
			<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<p>
				<label>Valor:</label>
				<input type="text" name="valor" id="valor" class="required" value="<?php echo $valor2?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
                <label>Valor será cobrado por Hora:</label>
                <input type="checkbox" name="vph" id="vph" value="1" <?php if($hora != 0){ ?> checked="checked" <?php } ?> />                
            </p>
      <p>
        <label>Descrição:</label>
        <textarea name="descricao_base" id="descricao_base" cols="40" rows="4"><?php echo $descricao?></textarea>
        <textarea name="descricao" id="descricao" class="required" ></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      </p>
			<button class="button blue" onclick="postForm_editor('descricao', 'form_ProdutoAdicional', '<?php echo CAMINHO_MODULO?>configuracoes/produtoadicional/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>
ativarForm();
viraEditor('descricao');
</script>

