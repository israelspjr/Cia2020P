<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TipoMaterialDidatico = new TipoMaterialDidatico();

$idTipoMaterialDidatico = $_REQUEST['id'];

if ($idTipoMaterialDidatico != '' && $idTipoMaterialDidatico > 0) {

	$valor = $TipoMaterialDidatico -> selectTipoMaterialDidatico('WHERE idTipoMaterialDidatico=' . $idTipoMaterialDidatico);

	$idTipoMaterialDidatico = $valor[0]['idTipoMaterialDidatico'];
	$tipo = $valor[0]['tipo'];
	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Cadastro de Tipo de Material Didatico
		</legend>
		<form id="form_TipoMaterialDidatico" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idTipoMaterialDidatico ?>" />
			<p>
				<label for="inativo">inativo</label>
				<input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
			</p>

			<p>
				<label>Tipo:</label>
				<input type="text" name="tipo" id="tipo" class="required"  value="<?php echo $tipo?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<button class="button blue" onclick="postForm('form_TipoMaterialDidatico', '<?php echo CAMINHO_MODULO?>configuracoes/tipomaterialdidatico/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>

