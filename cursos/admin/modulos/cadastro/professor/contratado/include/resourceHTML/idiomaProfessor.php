<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$IdiomaProfessor = new IdiomaProfessor();

$idProfessor = $_GET['id'];
?>

<fieldset>
	<legend>
		Idiomas do professor
	</legend>
	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/contratado/include/form/idiomaProfessor.php?idProfessor=".$idProfessor?>', '<?php echo CAMINHO_CAD."professor/contratado/include/resourceHTML/idiomaProfessor.php?id=".$idProfessor?>', '#div_idioma_professor');" />
	</div>
	<div class="lista">
		<table id="tb_lista_idiomaProfessor" class="registros">
			<thead>
				<tr>
					<th>Idioma</th>
                    <th>Sotaque</th>
					<th>Nivel linguistico</th>
                    <th>Nivel idioma</th>
                    <th>Valor hora</th>
					<th>Ativo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $IdiomaProfessor -> selectIdiomaProfessorContratadoTr(CAMINHO_CAD . "professor/contratado/include/form/idiomaProfessor.php", CAMINHO_CAD . "professor/contratado/include/resourceHTML/idiomaProfessor.php?id=" . $idProfessor, "#div_idioma_professor", "WHERE professor_idProfessor = " . $idProfessor, "&idProfessor=" . $idProfessor);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Idioma</th>
                    <th>Sotaque</th>
					<th>Nivel linguistico</th>
                    <th>Nivel idioma</th>
                    <th>Valor hora</th>
					<th>Ativo</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_idiomaProfessor', 'simples');</script>
