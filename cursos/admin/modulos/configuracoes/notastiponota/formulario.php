<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$NotasTipoNota = new NotasTipoNota();
$TipoNota = new TipoNota();

$idNotasTipoNota = $_REQUEST['id'];

if ($idNotasTipoNota != '' && $idNotasTipoNota > 0) {

	$valor = $NotasTipoNota -> selectNotasTipoNota('WHERE idNotasTipoNota=' . $idNotasTipoNota);

	$idNotasTipoNota = $valor[0]['idNotasTipoNota'];
	$tipoNota_idTipoNota = $valor[0]['tipoNota_idTipoNota'];
	$nome = $valor[0]['nome'];
	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Cadastro - Notas Tipo Nota
		</legend>
		<form id="form_NotasTipoNota" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idNotasTipoNota ?>" />
			<p>
				<label for="inativo">Inativo</label>
				<input type="checkbox" name="inativo" id="inativo" <?php if($inativo != 0){ ?> checked="checked" <?php } ?>  value="1"/>
			</p>

			<p>
				<label>Tipo Nota:</label>

				<?php echo $TipoNota -> selectTipoNotaSelect("required", $tipoNota_idTipoNota, " WHERE inativo = 0 AND excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<button class="button blue" onclick="postForm('form_NotasTipoNota', '<?php echo CAMINHO_MODULO?>configuracoes/notastiponota/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>

