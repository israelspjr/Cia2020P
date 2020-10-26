<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$ExperienciaProfissionaldiomaProfessor = new ExperienciaProfissionaldiomaProfessor();

$idIdiomaProfessor = $_GET['id'];
?>

<fieldset>
	<legend>
		Experiencia profissional no idioma
	</legend>

	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "professor/contratado/include/form/experienciaProfissionalIdiomaProfessor.php"; ?>?idIdiomaProfessor=<?php echo $idIdiomaProfessor?>','<?php echo CAMINHO_CAD."professor/contratado/include/resourceHTML/experienciaProfissionalIdiomaProfessor.php?id=".$idIdiomaProfessor?>', '#div_lista_experienciaProfissionalIdiomaProfessor');" />
	</div>
	<div class="lista">
		<table id="tb_lista_experienciaProfissionaldiomaProfessor" class="registros">
			<thead>
				<tr>
					<th>Escola</th>
					<th>Nivel</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $ExperienciaProfissionaldiomaProfessor -> selectExperienciaProfissionaldiomaProfessorTr(CAMINHO_CAD . "professor/contratado/include/form/experienciaProfissionalIdiomaProfessor.php", CAMINHO_CAD . "professor/contratado/include/resourceHTML/experienciaProfissionalIdiomaProfessor.php?id=" . $idIdiomaProfessor, "#div_lista_experienciaProfissionalIdiomaProfessor", " WHERE idiomaProfessor_idIdiomaProfessor = " . $idIdiomaProfessor, "&idIdiomaProfessor=" . $idIdiomaProfessor);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Escola</th>
					<th>Nivel</th>
					<th></th>
				</tr>
			</tfoot>
	</div>
	</table>
</fieldset>

<script>tabelaDataTable('tb_lista_experienciaProfissionaldiomaProfessor', 'simples');</script>
