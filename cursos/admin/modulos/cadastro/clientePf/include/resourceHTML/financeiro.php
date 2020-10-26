<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Contrato = new Contrato();

$idClientePf = $_GET['id'];
?>

<fieldset>
	<legend>
		Contrato / Boletos / Geral
	</legend>
	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "contrato/include/form/contrato.php"; ?>?idClientePf=<?php echo $idClientePf?>', '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/financeiro.php?id=".$idClientePf?>', '#div_financeiro');" />
	</div>
	<div id="div_lista_boleto" class="lista">
		<table id="tb_lista_boleto" class="registros">
			<thead>
				<tr>
					<th>Nome</th>
                    <th>Data</th>
					<th>Ver arquivo</th>
                    <th>Enviar Email</th>
                    <th>Não mostrar para aluno</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $Contrato -> selectContratoTr(CAMINHO_CAD . "contrato/include/form/contrato.php", CAMINHO_CAD . "clientePf/include/resourceHTML/financeiro.php?id=" . $idClientePf, "#div_financeiro", "WHERE clientePf_idClientePf = " . $idClientePf);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Nome</th>
                    <th>Data</th>
					<th>Ver arquivo</th>
                    <th>Enviar Email</th>
                    <th>Não mostrar para aluno</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_boleto');</script>

