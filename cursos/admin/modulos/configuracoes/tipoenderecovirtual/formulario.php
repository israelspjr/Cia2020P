<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();

$idTipoEnderecoVirtual = $_REQUEST['id'];

if ($idTipoEnderecoVirtual != '' && $idTipoEnderecoVirtual > 0) {

	$valor = $TipoEnderecoVirtual -> selectTipoEnderecoVirtual('WHERE idTipoEnderecoVirtual=' . $idTipoEnderecoVirtual);

	$idTipoEnderecoVirtual = $valor[0]['idTipoEnderecoVirtual'];
	$tipo = $valor[0]['tipo'];
	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Cadastro - Tipo Endereço Virtual
		</legend>
		<form id="form_TipoEnderecoVirtual" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idTipoEnderecoVirtual ?>" />
			<p>
				<label for="inativo">Inativo</label>
				<input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
			</p>

			<p>
				<label>Tipo:</label>
				<input type="text" name="tipo" id="tipo" class="required" value="<?php echo $tipo?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<button class="button blue" onclick="postForm('form_TipoEnderecoVirtual', '<?php echo CAMINHO_MODULO?>configuracoes/tipoenderecovirtual/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>

