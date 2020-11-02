<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Modalidade = new Modalidade();

$idModalidade = $_REQUEST['id'];

if ($idModalidade != '' && $idModalidade > 0) {

	$valor = $Modalidade -> selectModalidade('WHERE idModalidade=' . $idModalidade);

	$idModalidade = $valor[0]['idModalidade'];
	$nome = $valor[0]['nome'];
	$inativo = $valor[0]['inativo'];
	$excluido = $valor[0]['excluido'];

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Cadastro - Modalidade
		</legend>
		<form id="form_Modalidade" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idModalidade ?>" />
			<p>
				<label for="inativo">inativo</label>
				<input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
			</p>

			<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<button class="button blue" onclick="postForm('form_Modalidade', '<?php echo CAMINHO_MODULO?>configuracoes/modalidade/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>

