<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$ModalidadeIdioma = new ModalidadeIdioma();
$Idioma = new Idioma();
$Modalidade = new Modalidade();

$idModalidadeIdioma = $_REQUEST['id'];

if ($idModalidadeIdioma != '' && $idModalidadeIdioma > 0) {

	$valor = $ModalidadeIdioma -> selectModalidadeIdioma('WHERE idModalidadeIdioma=' . $idModalidadeIdioma);

	$idModalidadeIdioma = $valor[0]['idModalidadeIdioma'];
	$modalidade_idModalidade = $valor[0]['modalidade_idModalidade'];
	$idioma_idIdioma = $valor[0]['idioma_idIdioma'];
	$valorHoraPadrao = $valor[0]['valorHoraPadrao'];
	$inativo = $valor[0]['inativo'];
	$obs = $valor[0]['obs'];
	$excluido = $valor[0]['excluido'];

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Cadastro - Modalidade Idioma
		</legend>
		<form id="form_ModalidadeIdioma" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idModalidadeIdioma ?>" />
			<p>
				<label for="inativo">inativo</label>
				<input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
			</p>

			<p>
				<label>Modalidade:</label>
				<?php echo $Modalidade -> selectModalidadeSelect("required", $modalidade_idModalidade, ""); ?>

				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<p>
				<label>Idioma:</label>
				<?php echo $Idioma -> selectIdiomaSelect("required", $idioma_idIdioma, ""); ?>

				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<p>
				<label>Valor Hora Padrão:</label>
				<input type="text" name="valorHoraPadrao" id="valorHoraPadrao" class="required" value="<?php echo $valorHoraPadrao?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<p>
				<label>Observação:</label>
				<textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<button class="button blue" onclick="postForm('form_ModalidadeIdioma', '<?php echo CAMINHO_MODULO?>configuracoes/modalidadeidioma/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>

