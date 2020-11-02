<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$AliquotaTipoImpostoProfessor = new AliquotaTipoImpostoProfessor();
$TipoImpostoProfessor = new TipoImpostoProfessor();

$idAliquotaTipoImpostoProfessor = $_REQUEST['id'];

if ($idAliquotaTipoImpostoProfessor != '' && $idAliquotaTipoImpostoProfessor > 0) {

	$valor = $AliquotaTipoImpostoProfessor -> selectAliquotaTipoImpostoProfessor('WHERE idAliquotaTipoImpostoProfessor=' . $idAliquotaTipoImpostoProfessor);

	$tipoImpostoProfessor_idTipoImpostoProfessor = $valor[0]['tipoImpostoProfessor_idTipoImpostoProfessor'];
	$de = Uteis::exibirMoeda($valor[0]['de']);
	$ate = Uteis::exibirMoeda($valor[0]['ate']);
	$porcentagem = Uteis::exibirMoeda($valor[0]['porcentagem']);
	$parcelaDedutiva = Uteis::exibirMoeda($valor[0]['parcelaDedutiva']);
    $valorMaximo = Uteis::exibirMoeda($valor[0]['valorMaximo']); 
	$inativo = $valor[0]['inativo'];
	$dataCadastro = $valor[0]['dataCadastro'];
	$excluido = $valor[0]['excluido'];

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Cadastro - Aliquota Tipo Imposto Professor
		</legend>
		<form id="form_AliquotaTipoImpostoProfessor" class="validate"  method="post" onsubmit="return false" >
			<input name="id" type="hidden" value="<?php echo $idAliquotaTipoImpostoProfessor ?>" />
			<p>
				<label for="inativo">Inativo</label>
				<input type="checkbox" name="inativo" id="inativo" <?php if($inativo != 0){ ?> checked="checked" <?php } ?>  value="1"/>
			</p>
			<p>
				<label>Imposto:</label>
				<?php echo $TipoImpostoProfessor -> selectTipoImpostoProfessorSelect("required", $tipoImpostoProfessor_idTipoImpostoProfessor, " AND inativo = 0 "); ?>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>De:</label>
				<input type="text" name="de" id="de" class="required numeric" value="<?php echo $de?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Ate:</label>
				<input type="text" name="ate" id="ate" class="numeric" value="<?php echo $ate?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Porcentagem:</label>
				<input type="text" name="porcentagem" id="porcentagem" class="percentual" value="<?php echo $porcentagem?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Parcela Dedutiva:</label>
				<input type="text" name="parcelaDedutiva" id="parcelaDedutiva" class="numeric" value="<?php echo $parcelaDedutiva?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
                <label>Teto:</label>
                <input type="text" name="teto" id="teto" class="numeric" value="<?php echo $valorMaximo?>" />
                <span class="placeholder">Campo Obrigatório</span>
            </p>
			<button class="button blue" onclick="postForm('form_AliquotaTipoImpostoProfessor', '<?php echo CAMINHO_MODULO?>configuracoes/aliquotatipoimpostoprofessor/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
