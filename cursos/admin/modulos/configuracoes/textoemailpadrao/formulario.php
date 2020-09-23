<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TextoEmailPadrao = new TextoEmailPadrao();

$idTextoEmailPadrao = $_REQUEST['id'];

if ($idTextoEmailPadrao != '' && $idTextoEmailPadrao > 0) {

	$valor = $TextoEmailPadrao -> selectTextoEmailPadrao('WHERE idtextoEmailPadrao=' . $idTextoEmailPadrao);

	$texto = $valor[0]['texto'];
	$titulo = $valor[0]['titulo'];
	$excluido = $valor[0]['excluido'];
	$candiato = $valor[0]['candidato'];

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Texto E-mail Padrão
		</legend>
		<form id="form_TextoEmailPadrao" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idTextoEmailPadrao ?>" />
			<p>
				<label>Título:</label>
				<strong><input type="text" id="titulo" name="titulo" value="<?php echo $titulo;?>" /></strong>
			</p>
			<p>
			  <label>Inativo:</label>
        <strong><input type="checkbox" id="inativo" name="inativo" value="1" <?php if($excluido==1){ echo "checked";}?>/></strong>
			</p>
            <p>
			  <label>Candidato:</label>
        <strong><input type="checkbox" id="candidato" name="candidato" value="1" <?php if($candidato==1){ echo "checked";}?>/></strong>
			</p>
			<p>
				<label>Texto:</label>
				<textarea name="texto_base" id="texto_base" class="tinymce" ><?php echo $texto?></textarea>
				<textarea name="texto" id="texto" class="" ></textarea>								

			</p>
  			<button class="button blue" onclick="postForm_editor('texto', 'form_TextoEmailPadrao', '<?php echo CAMINHO_MODULO?>configuracoes/textoemailpadrao/grava.php')">
				Salvar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>
viraEditor('texto');
ativarForm();
</script>

