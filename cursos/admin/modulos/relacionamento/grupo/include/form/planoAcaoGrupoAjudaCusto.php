<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$idPlanoAcaoGrupoAjudaCusto = $_GET['id'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

$PlanoAcaoGrupoAjudaCusto = new PlanoAcaoGrupoAjudaCusto();
$Professor = new Professor();

if ($idPlanoAcaoGrupoAjudaCusto) {

	$where = " AND idPlanoAcaoGrupoAjudaCusto = " . $PlanoAcaoGrupoAjudaCusto -> gravarBd($idPlanoAcaoGrupoAjudaCusto);
	$valor = $PlanoAcaoGrupoAjudaCusto -> selectPlanoAcaoGrupoAjudaCusto($where);

	$idProfessor = $valor[0]['professor_idProfessor'];
	$idPlanoAcaoGrupo = $valor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$mesIni = $valor[0]['mesIni'];
	$mesFim = $valor[0]['mesFim'];
	$anoIni = $valor[0]['anoIni'];
	$anoFim = $valor[0]['anoFim'];
	$porDia = $valor[0]['porDia'];
	$descricao = $valor[0]['descricao'];
	$cobrarAluno = $valor[0]['cobrarAluno'];
	$valor = Uteis::exibirMoeda($valor[0]['valor']);

} else {

	$mesIni = date('m');
	$anoIni = date('Y');

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Ajuda de custo para professor:
		</legend>
		<form id="form_PlanoAcaoGrupoAjudaCusto" class="validate" method="post" action="" onsubmit="return false" >
			
			<input type="hidden" name="idPlanoAcaoGrupoAjudaCusto" id="idPlanoAcaoGrupoAjudaCusto" value="<?php echo $idPlanoAcaoGrupoAjudaCusto?>" />
			<input type="hidden" name="planoAcaoGrupo_idPlanoAcaoGrupo" id="planoAcaoGrupo_idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />

			<p>
				<label>Descrição:</label>
				<input type="text" name="descricao" id="descricao" class="required" value="<?php echo $descricao?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>

			<p>
				<label>
				<input type="checkbox" name="cobrarAluno" id="cobrarAluno" value="1" <?php $cobrarAluno ? "checked" : ""?> />Cobrar do aluno</label>
			</p>
			
			<p>
				<label>Forma de calculo:</label>
				<input type="radio" name="porDia" id="porDia1" value="1"  <?php echo $porDia ? "checked" : ""?> />Por dia
				<input type="radio" name="porDia" id="porDia0" value="0" <?php echo !$porDia ? "checked" : ""?> />Por hora
			</p>

			<p>
				<label>Professor:</label>
				<?php
					$and = $Professor->queryProfessorGrupo($idPlanoAcaoGrupo);
					echo $Professor->selectProfessorSelect("required", $idProfessor, $and)
									?>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Mês inicio:</label>
				<select name="mesIni" id="mesIni" class="required">
					<?php for($x=1; $x <= 12; $x++){
					?>
					<option value="<?php echo $x?>" <?php echo ($mesIni == $x) ? "selected" : ""?> ><?php echo Uteis::retornaNomeMes($x); ?>
					</option>
					<?php } ?>
				</select>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Ano inicio:</label>
				<select name="anoIni" id="anoIni" class="required">
					<?php for($x = date('Y')+1; $x >= 2010; $x-- ){
					?>
					<option value="<?php echo $x?>" <?php echo ($anoIni == $x) ? "selected" : "" ?>><?php echo $x?>
					</option>
					<?php } ?>
				</select>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Mês fim:</label>
				<select name="mesFim" id="mesFim" class="">
					<option value="" >Selecione</option>
					<?php for($x=1; $x <= 12; $x++){
					?>
					<option value="<?php echo $x?>" <?php echo ($mesFim == $x) ? "selected" : ""?> ><?php echo Uteis::retornaNomeMes($x); ?>
					</option>
					<?php } ?>
				</select>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Ano fim:</label>
				<select name="anoFim" id="anoFim" class="">
					<option value="" >Selecione</option>
					<?php for($x = date('Y')+1; $x >= 2010; $x-- ){
					?>
					<option value="<?php echo $x?>" <?php echo ($anoFim == $x) ? "selected" : "" ?>><?php echo $x?>
					</option>
					<?php } ?>
				</select>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Valor:</label>
				<input type="text" name="valor" id="valor" class="required numeric" value="<?php echo $valor?>" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<button class="button blue" onclick="postForm('form_PlanoAcaoGrupoAjudaCusto', '<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupoAjudaCusto.php?id=$idPlanoAcaoGrupoAjudaCusto"?>');">
					Enviar
				</button>
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
