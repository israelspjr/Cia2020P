<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
$Professor = new Professor();

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
?>
<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>

	<fieldset>
		<legend>
			Gerar folha de frequencia
		</legend>

		<form id="form_novaff" class="validate" action="" method="post" onsubmit="return false" >
			
			<input type="hidden" name="planoAcaoGrupo_idPlanoAcaoGrupo" id="planoAcaoGrupo_idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
			
			<div class="esquerda">
				<p>
					<label>Professor:</label>
					<?php
					$and = ""; //$Professor->queryProfessorGrupo($idPlanoAcaoGrupo);
					echo $Professor->selectProfessorSelect("required", $idProfessor, $and)
					?>
					<span class="placeholder">Campo Obrigatório</span>
				</p>
				<p>
					<label>Mês:</label>
					<select name="mes" id="mes" class="required">
						<option value="" >Selecione</option>
						<?php for($x=1; $x <= 12; $x++){
						?>
						<option value="<?php echo $x?>" <?php echo ($mesIni == $x) ? "selected" : ""?> ><?php echo Uteis::retornaNomeMes($x); ?></option>
						<?php } ?>
					</select>
					<span class="placeholder">Campo Obrigatório</span>
				</p>
				<p>
					<label>Ano:</label>
					<select name="ano" id="ano" class="required">
						<option value="" >Selecione</option>
						<?php for($x = date('Y')+1; $x >= 2010; $x-- ){
						?>
						<option value="<?php echo $x?>" <?php echo ($anoIni == $x) ? "selected" : "" ?>><?php echo $x
							?></option>
						<?php } ?>
					</select>
					<span class="placeholder">Campo Obrigatório</span>
				</p>

				<p>
					<button class="button blue" onclick="postForm('form_novaff', '<?php echo CAMINHO_REL."grupo/include/acao/novaff.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>');">
						Enviar
					</button>

				</p>
			</div>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
