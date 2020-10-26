<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoCarreirraIdiomaProfessor = new PlanoCarreirraIdiomaProfessor();

$idIdiomaProfessor = $_GET['id'];   
$professor_idProfessor = $_GET['idProfessor'];  
?>

<fieldset>
	<legend>
		Plano de carreira do professor
	</legend>

	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "professor/contratado/include/form/planoCarreirraIdiomaProfessor.php"; ?>?id_IdiomaProfessor=<?php echo $idIdiomaProfessor?>','<?php echo CAMINHO_CAD."professor/contratado/include/resourceHTML/planoCarreirraIdiomaProfessor.php?id=".$idIdiomaProfessor?>', '#div_lista_PlanoCarreirraIdiomaProfessor');" />
	</div>
	<div class="lista">
		<table id="tb_lista_PlanoCarreirraIdiomaProfessor" class="registros">
			<thead>
				<tr>
					<th>Data</th>
					<th>Tipo do Plano</th>
					<th>Valor hora</th>
					<th>Atual</th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo $PlanoCarreirraIdiomaProfessor -> selectPlanoCarreirraIdiomaProfessorTr(CAMINHO_CAD . "professor/contratado/include/form/planoCarreirraIdiomaProfessor.php", CAMINHO_CAD . "professor/contratado/include/resourceHTML/planoCarreirraIdiomaProfessor.php?id=" . $idIdiomaProfessor, "#div_lista_PlanoCarreirraIdiomaProfessor", " WHERE PCI.idiomaProfessor_idIdiomaProfessor = " . $idIdiomaProfessor, "&idIdiomaProfessor=" . $idIdiomaProfessor);
				?>
			</tbody>
			<tfoot>
				<tr>
				    <th>Data</th>
					<th>Tipo do Plano</th>
					<th>Valor hora</th>
					<th>Atual</th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_PlanoCarreirraIdiomaProfessor', 'simples');</script>
