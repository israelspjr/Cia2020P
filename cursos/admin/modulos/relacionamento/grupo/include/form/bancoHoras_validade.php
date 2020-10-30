<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BancoHoras = new BancoHoras();

$idBancoHoras = $_GET['id'];

if ($idBancoHoras) {

	$valorBancoHoras = $BancoHoras -> selectBancoHoras('WHERE idBancoHoras=' . $idBancoHoras);
	//Uteis::pr($valorBancoHoras);

	$horas = Uteis::exibirHoras($valorBancoHoras[0]['horas']);
	$dataExpira = Uteis::exibirData($valorBancoHoras[0]['dataExpira']);

}
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Alterar validade do banco de horas
		</legend>
		<form id="form_BancoHoras" class="validate" action="" method="post" onsubmit="return false" >
			<p>
				<label>Horas: </label>
				<?php echo $horas
				?>
			</p>

			<p>
				<label>Data validade: </label>
				<input type="text" name="dataExpira" id="dataExpira" value="<?php echo $dataExpira ?>" class="data" />
			</p>

			<p>
				<button class="button blue" onclick="postForm('form_BancoHoras', '<?php echo CAMINHO_REL."grupo/include/acao/bancoHoras_validade.php?id=$idBancoHoras"?>');">
					Enviar
				</button>
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
