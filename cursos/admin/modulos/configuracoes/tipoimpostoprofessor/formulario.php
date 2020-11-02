<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TipoImpostoProfessor = new TipoImpostoProfessor();

$idTipoImpostoProfessor = $_REQUEST['id'];

if ($idTipoImpostoProfessor != '' && $idTipoImpostoProfessor > 0) {

	$valor = $TipoImpostoProfessor -> selectTipoImpostoProfessor('WHERE idTipoImpostoProfessor=' . $idTipoImpostoProfessor);
	
	$nome = $valor[0]['nome'];
	$sigla = $valor[0]['sigla'];
	$inativo = $valor[0]['inativo'];
	$tipoImpostoProfessor_idTipoImpostoProfessor = $valor[0]['tipoImpostoProfessor_idTipoImpostoProfessor'];

}else{
	$idTipoImpostoProfessor = 0;
}

?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Imposto para pagamento de professores
		</legend>
		<form id="form_TipoImpostoProfessor" class="validate"  method="post" onsubmit="return false" >

			<input name="id" type="hidden" value="<?php echo $idTipoImpostoProfessor ?>" />

			<p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<p>
				<label>Sigla:</label>
				<input type="text" name="sigla" id="sigla" class="required" value="<?php echo $sigla?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>		
			
			<p>
				<label>Calcular após:</label>
				<?php echo $TipoImpostoProfessor -> selectTipoImpostoProfessorSelect("", $tipoImpostoProfessor_idTipoImpostoProfessor, " AND idTipoImpostoProfessor NOT IN ($idTipoImpostoProfessor)"); ?>
				<span class="placeholder"></span>
			</p>
			
			<p>
				<label for="inativo">
					<input type="checkbox" name="inativo" id="inativo" <?php if($inativo != 0){ ?> checked="checked" <?php } ?>  value="1"/>
					Inativo</label>
			</p>

			<button class="button blue" onclick="postForm('form_TipoImpostoProfessor', '<?php echo CAMINHO_MODULO?>configuracoes/tipoimpostoprofessor/grava.php')">
				Enviar
			</button>

			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>

