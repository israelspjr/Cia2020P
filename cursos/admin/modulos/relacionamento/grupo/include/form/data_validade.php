<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
//echo $idPlanoAcaoGrupo;

if ($idPlanoAcaoGrupo) {
	$valorDataValidade = $PlanoAcaoGrupo->getDataValidade($idPlanoAcaoGrupo);
	//echo $valorDataValidade;
}

?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Alterar data de validade de expiração do grupo
		</legend>
		<form id="form_BancoHoras" class="validate" action="" method="post" onsubmit="return false" >

			<p>
				<label>Data validade: </label>
                <select id="dataexpira" name="dataExpira" class="required">
                <option <?php if($valorDataValidade ==''){ ?> selected="selected" <?php } ?>  value=""> Selecione </option>
                <option <?php if($valorDataValidade =='2'){ ?> selected="selected" <?php } ?>  value="2"> 2 meses </option>
                <option <?php if($valorDataValidade =='3'){ ?> selected="selected" <?php } ?>  value="3"> 3 meses </option>
                <option <?php if($valorDataValidade =='4'){ ?> selected="selected" <?php } ?>  value="4"> 4 meses </option>
                <option <?php if($valorDataValidade =='5'){ ?> selected="selected" <?php } ?>  value="5"> 5 meses </option>
                <option <?php if($valorDataValidade =='6'){ ?> selected="selected" <?php } ?>  value="6"> 6 meses </option>
                </select>
                <span class="placeholder">Campo Obrigatório</span>
		</p>

			<p>
				<button class="button blue" onclick="postForm('form_BancoHoras', '<?php echo CAMINHO_REL."grupo/include/acao/data_validade.php?id=$idPlanoAcaoGrupo"?>');">
					Enviar
				</button>
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
