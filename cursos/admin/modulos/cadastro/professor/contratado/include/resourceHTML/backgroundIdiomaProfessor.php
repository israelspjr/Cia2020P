<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BackgroudIdiomaProfessor = new BackgroudIdiomaProfessor();

$idIdiomaProfessor = $_GET['id'];
?>

<fieldset>
	<legend>
		Background do professor no idioma
	</legend>

	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "professor/contratado/include/form/backgroundIdiomaProfessor.php"; ?>?idIdiomaProfessor=<?php echo $idIdiomaProfessor?>','<?php echo CAMINHO_CAD."professor/contratado/include/resourceHTML/backgroundIdiomaProfessor.php?id=".$idIdiomaProfessor?>', '#div_lista_backgroundIdiomaProfessor');" />
	</div>
	<div class="lista">
		<table id="tb_lista_BackgroudIdiomaProfessor" class="registros">
			<thead>
				<tr>
					<th>Escola</th>
					<th>Tempo que estudou</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $BackgroudIdiomaProfessor -> selectBackgroudIdiomaProfessorTr(CAMINHO_CAD . "professor/contratado/include/form/backgroundIdiomaProfessor.php", CAMINHO_CAD . "professor/contratado/include/resourceHTML/backgroundIdiomaProfessor.php?id=" . $idIdiomaProfessor, "#div_lista_backgroundIdiomaProfessor", " WHERE idiomaProfessor_idIdiomaProfessor = " . $idIdiomaProfessor, "&idIdiomaProfessor=" . $idIdiomaProfessor);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Escola</th>
					<th>Tempo que estudou</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>

<script>tabelaDataTable('tb_lista_BackgroudIdiomaProfessor', 'simples');</script>

