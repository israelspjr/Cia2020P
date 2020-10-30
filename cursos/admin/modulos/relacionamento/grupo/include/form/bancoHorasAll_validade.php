<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BancoHoras = new BancoHoras();


$ids = $_GET['ids'];
$arr_ids = explode(',', $ids);
$horas = '';
foreach($arr_ids as $id){
    $idBancoHoras = $id;

    if ($idBancoHoras) {

        $valorBancoHoras = $BancoHoras -> selectBancoHoras('WHERE idBancoHoras=' . $idBancoHoras);
        //Uteis::pr($valorBancoHoras);

        $horas .= Uteis::exibirData($valorBancoHoras[0]['dataExpira']).' - '. Uteis::exibirHoras($valorBancoHoras[0]['horas']) .'<br/>';
        $dataExpira = Uteis::exibirData($valorBancoHoras[0]['dataExpira']).'<br/>';

    }
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
				<?php echo $horas; ?>
			</p>

			<p>
				<label>Data validade: </label>
				<input type="text" name="dataExpira" id="dataExpira" value="" class="data" />
			</p>

			<p>
				<button class="button blue" onclick="postForm('form_BancoHoras', '<?php echo CAMINHO_REL."grupo/include/acao/bancoHorasAll_validade.php?id=$ids"?>');">
					Enviar
				</button>
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
