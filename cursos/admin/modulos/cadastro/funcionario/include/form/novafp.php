<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
$Funcionario = new Funcionario();

$idFuncionario = $_REQUEST['idFuncionario'];
?>
<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>

	<fieldset>
		<legend>
			Gerar folha de ponto
		</legend>

		<form id="form_novaff" class="validate" action="" method="post" onsubmit="return false" >
			
			<input type="hidden" name="funcionario_idFuncionario" id="funcionario_idFuncionario" value="<?php echo $idFuncionario?>" />
			
			<div class="esquerda">
				<p>
					<label>Funcionário::</label>
					<?php
					echo $Funcionario->getNome($idFuncionario);
					?>
					
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
						<?php for($x = date('Y')+1; $x >= 2020; $x-- ){
						?>
						<option value="<?php echo $x?>" <?php echo ($anoIni == $x) ? "selected" : "" ?>><?php echo $x
							?></option>
						<?php } ?>
					</select>
					<span class="placeholder">Campo Obrigatório</span>
				</p>

				<p>
					<button class="button blue" onclick="postForm('form_novaff', '<?php echo CAMINHO_CAD."funcionario/include/acao/novafp.php"?>');">
						Enviar
					</button>

				</p>
			</div>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
