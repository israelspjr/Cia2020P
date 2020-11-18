<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$OutrosServicos = new OutrosServicos();

$idProfessor = $_GET['id'];
?>
<fieldset>
	<legend>
		Outros Serviços (Consultoria | Tradução | Versão)
	</legend>
	<div class="menu_interno"><img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="cadastrar Outros Serviços" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "professor/contratado/include/form/outrosServicos.php"; ?>?idProfessor=<?php echo $idProfessor?>', '<?php echo CAMINHO_CAD."professor/contratado/include/resourceHTML/outrosServicos.php?id=".$idProfessor?>', '#div_outrosServicos');" />
	</div>
	<div id="div_lista_outrosServicos" class="lista">
		<table id="tb_lista_outrosServicos" class="registros">
			<thead>
				<tr>
                <th>ID</th>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Mes/Ano</th>
                    <th>Obs</th>
                    <th>Não cobrar impostos</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $OutrosServicos -> selectOutrosServicosTr(CAMINHO_CAD . "professor/contratado/include/form/outrosServicos.php", CAMINHO_CAD . "professor/contratado/include/resourceHTML/outrosServicos.php?id=" . $idProfessor, "#div_outrosServicos", "WHERE professor_idProfessor = " . $idProfessor, "&idProfessor=" . $idProfessor, CAMINHO_CAD . "professor/contratado");
				?>
			</tbody>
			<tfoot>
				<tr>
                <th>ID</th>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Mes/Ano</th>
                     <th>Obs</th>
                     <th>Não cobrar impostos</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_outrosServicos', 'simples');</script>

