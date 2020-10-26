<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Grupo = new Grupo();
$idGrupo = $_REQUEST['idGrupo'];
$rsGrupo = $Grupo -> selectGrupo("WHERE idGrupo = " . $idGrupo);
?>
<fieldset>
	<legend>
		Troca Nome do Grupo
	</legend>
	<div class="lista">
		<form name="Form_trocaNome" id="Form_trocaNome" class="validate" action="" method="post"  onsubmit="return false" >
			<input type="hidden" name="acao" id="acao" value="mudarNome" />
			<input type="hidden" name="idGrupo" id="idGrupo" value="<?=$rsGrupo[0]['idGrupo']?>" />
			<div class="linha-inteira">
				<p>
					<label>Nome Atual:</label>
					<strong><?=$rsGrupo[0]['nome']; ?></strong>
				</p>
				<p>
					<label>Novo Nome:</label>
					<input type="text" name="nome" id="nome" class="required" />
					<span class="placeholder">Campo Obrigatório</span>
				</p>
			</div>
			<div class="linha-inteira">
				<p>
					<button class="button blue" onclick="postForm('Form_trocaNome', '<?php echo CAMINHO_CAD."grupo/include/acao/grupos.php"?>')">
						Salvar
					</button>
				</p>
			</div>
		</form>
	</div>
</fieldset>
<script>
ativarForm();
</script>