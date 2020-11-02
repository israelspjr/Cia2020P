<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$IntegranteGrupo = new IntegranteGrupo();

$idIntegranteGrupo = $_GET['idIntegranteGrupo'];
$valor = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
$envioPsa = $valor[0]['envioPsa'];
$idClientePf = $valor[0]['clientePf_idClientePf'];
$idPlanoAcaoGrupo = $valor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];


?>

<div id="div_lista_psa" class="lista">
	<div class="conteudo_nivel">
		<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
		<fieldset>
			<legend>
				Pequisa de satisfação
			</legend>
            <p>
             <label>Prazo de envio de PSA em dias:</label>
             <form id="form_Psa_aluno" class="validate" method="post" action="" onsubmit="return false">
              <input type="hidden" name="acao" id="acao"  value="atualizarPsa"/>
              <input type="hidden" name="idIntegranteGrupo" id="idIntegrantegrupo"  value="<?php echo $idIntegranteGrupo?>"/>
       	     <input type="text" name="envioPSA" id="envioPSA"  value="<?php echo $envioPsa?>"/>
            
              <button class="button blue" onclick="postForm('form_Psa_aluno', '<?php echo CAMINHO_REL."grupo/include/acao/integranteGrupo.php"?>')">
      Enviar</button>
       </form>
            </p>
			<div class="menu_interno"><img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="cadastrar PSA" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/psa.php?idIntegranteGrupo=$idIntegranteGrupo"?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/psa.php?idIntegranteGrupo=$idIntegranteGrupo"?>', '#div_lista_psa')" />
			</div>
			<div class="lista">
				<table id="tb_lista_psa" class="registros">
					<thead>
						<tr>
							<th></th>
							<th>Data de referencia</th>
                            <th>Nível</th>
							<th>Descrição</th>
							<th>Finalizado</th>
							<th>Respostas</th>
							<th>Enviar e-mail</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						echo $PsaIntegranteGrupo -> selectPsaIntegranteGrupoTr($idIntegranteGrupo, $idClientePf, $idPlanoAcaoGrupo);
						?>
					</tbody>
					<tfoot>
						<tr>
							<th></th>
							<th>Data de referencia</th>
                            <th>Nível</th>
							<th>Descrição</th>
							<th>Finalizado</th>
							<th>Respostas</th>
							<th>Enviar e-mail</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</fieldset>
	</div>
</div>
<script>tabelaDataTable('tb_lista_psa', 'ordenaColuna');</script>