<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$IntegranteGrupo = new IntegranteGrupo();

$idIntegranteGrupo = $_GET['id'];
//echo $idPlanoAcaoGrupo;

//if ($idIntegranteGrupo) {
	$valor = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
	$obs = $valor[0]['obs'];
	echo $obs;
//}

?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Alterar Observação sobre envio de PSA
		</legend>
		<form id="form_BancoHoras" class="validate" action="" method="post" onsubmit="return false" >

			<p>
				<label>Observação: </label>
               <textarea id="Obs" name="obs" style="    width: 100%;   height: 200px;"><?php echo $obs?></textarea>
                <span class="placeholder">Campo Obrigatório</span>
		</p>

			<p>
				<button class="button blue" onclick="postForm('form_BancoHoras', '<?php echo CAMINHO_REL."grupo/include/acao/integranteGrupo.php?acao=atualizarObs&idIntegranteGrupo=$idIntegranteGrupo"?>');">
					Enviar
				</button>
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
