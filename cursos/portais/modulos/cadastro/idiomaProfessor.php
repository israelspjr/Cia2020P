<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$IdiomaProfessor = new IdiomaProfessor();

$idProfessor = $_SESSION['idProfessor_SS'];
?>

<fieldset>
	<legend>
		Idiomas do professor
	</legend>
	<div class="menu_interno">
 
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="zerarCentro();carregarModulo( '/cursos/portais/modulos/cadastro/idiomaProfessor.php?id=<?php echo $idProfessor?>', '#centro');" />
	</div>
	<div class="lista">
		<table id="tb_lista_idiomaProfessor" class="registros">
			<thead>
				<tr>
					<th>Idioma</th>
                    <th>Sotaque</th>
					<th>Nivel linguistico</th>
                    <th>Link teste</th>
                    <th>Nota Teste</th>
					<th>Ativo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $IdiomaProfessor -> selectIdiomaProfessorContratadoTr_professor("", "modulos/cadastro/resourceHTML/idiomaProfessor.php?id=" . $idProfessor, "#centro", "WHERE IP.professor_idProfessor = " . $idProfessor." AND EV.ePrinc = 1 GROUP BY idIdiomaProfessor", "&idProfessor=" . $idProfessor);
				?>
	
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_idiomaProfessor', 'simples');</script>
