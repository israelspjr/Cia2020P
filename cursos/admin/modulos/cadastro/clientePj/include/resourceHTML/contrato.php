<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Contrato = new Contrato();

$idClientePj = $_GET['id'];
?>

<fieldset>
	<legend>
		Contrato
	</legend>
	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "contrato/include/form/contrato.php"; ?>?idClientePj=<?php echo $idClientePj?>', '<?php echo CAMINHO_CAD."clientePj/include/resourceHTML/contrato.php?id=".$idClientePj?>', '#div_contrato_clientepj');" />
	</div>
	<div id="div_lista_contrato" class="lista">
		<table id="tb_lista_contrato" class="registros">
			<thead>
				<tr>
					<th>Nome</th>
                    <th>Data de cadastro</th>
					<th>Ver contrato</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $Contrato -> selectContratoTr(CAMINHO_CAD . "contrato/include/form/contrato.php", CAMINHO_CAD . "clientePj/include/resourceHTML/contrato.php?id=" . $idClientePj, "#div_contrato_clientepj", "WHERE clientePj_idClientePj = " . $idClientePj);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Nome</th>
                    <th>Data de cadastro</th>
					<th>Ver contrato</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_contrato');</script>

