<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$CreditoDebitoGrupo = new CreditoDebitoGrupo();

$idProfessor = $_GET['id'];
?>
<fieldset>
	<legend>
		Crédito e/ou Debito
	</legend>
	<div class="menu_interno"><img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="cadastrar contrato" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "professor/contratado/include/form/creditoDebitoGrupo.php"; ?>?idProfessor=<?php echo $idProfessor?>', '<?php echo CAMINHO_CAD."professor/contratado/include/resourceHTML/creditoDebitoGrupo.php?id=".$idProfessor?>', '#div_creditoDebitoGrupo');" />
	</div>
	<div id="div_lista_creditoDebitoGrupo" class="lista">
		<table id="tb_lista_creditoDebitoGrupoP" class="registros">
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Mes/Ano</th>
					<th>Premiação</th>
                    <th>Grupo</th>
                    <th></th>
                    
                    
				</tr>
			</thead>
			<tbody>
				<?php
				echo $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr(CAMINHO_CAD . "professor/contratado/include/form/creditoDebitoGrupo.php", CAMINHO_CAD . "professor/contratado/include/resourceHTML/creditoDebitoGrupo.php?id=" . $idProfessor, "#div_creditoDebitoGrupo", "WHERE excluido = 0 AND professor_idProfessor = " . $idProfessor, "&idProfessor=" . $idProfessor, CAMINHO_CAD . "professor/contratado", 1);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Mes/Ano</th>
                    <th>Premiação</th>
                    <th>Grupo</th>
                   	<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_creditoDebitoGrupoP', 'simples');</script>

