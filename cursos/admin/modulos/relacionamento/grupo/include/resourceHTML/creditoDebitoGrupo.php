<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$CreditoDebitoGrupo = new CreditoDebitoGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['id'];

$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);

$ids = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = ".$idGrupo);

//echo $idGrupo;

foreach($ids AS $valor) {
$valorX[] = $valor['idPlanoAcaoGrupo'];		
}

$valorx2 = implode(', ',$valorX);

/*$ValorIntegrante = $IntegranteGrupo->selectIntegranteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")");

foreach($ValorIntegrante AS $valor) {
$valorXx[] = $valor['idIntegranteGrupo'];		
}

$valorx3 = implode(', ',$valorXx);
*/
//Uteis::pr($valorx3);


?>
<fieldset>
	<legend>
		Crédito e/ou Debito Grupo
	</legend>
	<div class="menu_interno"><img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="cadastrar contrato" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL . "grupo/include/form/creditoDebitoGrupo.php"; ?>?idPlanoAcaoGrupo=<?php echo $idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/creditoDebitoGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_creditoDebitoGrupo');" />
	</div>
	<div id="div_lista_creditoDebitoGrupo" class="lista">
		<table id="tb_lista_creditoDebitoGrupo" class="registros">
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Mes/Ano</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr(CAMINHO_REL . "grupo/include/form/creditoDebitoGrupo.php", CAMINHO_REL . "grupo/include/resourceHTML/creditoDebitoGrupo.php?id=" . $idPlanoAcaoGrupo, "#div_creditoDebitoGrupo", "WHERE excluido = 0 AND planoAcaoGrupo_idPlanoAcaoGrupo in (" . $valorx2. ") ORDER BY idCreditoDebitoGrupo DESC", "&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo, CAMINHO_REL . "grupo");
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Mes/Ano</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_creditoDebitoGrupo', 'ordenaColuna_simples');</script>

