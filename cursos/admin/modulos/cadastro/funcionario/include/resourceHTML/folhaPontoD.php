<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$FolhaPonto = new FolhaPonto();


$idFuncionario = $_SESSION['idFuncionario_SS'];

$caminhoAtualizar = CAMINHO_CAD."funcionario/include/resourceHTML/folhaPontoD.php?id=$idFuncionario";
$ondeAtualiza = "#centro";

?>

<fieldset>
	<legend>
		Folhas de Ponto
	</legend>
	<div class="menu_interno"><img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Gerar folha de ponto" 	onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."funcionario/include/form/novafp.php?idFuncionario=$idFuncionario"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
 
	</div>
	<div class="lista">
		<table id="tb_lista_FolhaFrequencia" class="registros">
			<thead>
				<tr>
				<th></th>
					<th>Período</th>
					<th>Finalizada</th>
			        <th>Saldo Inicial</th>
                    <th>Tipo</th>
                    <th>Saldo Final</th>
                    <th>Tipo</th>
                    <th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php
$caminhoAbrir = CAMINHO_CAD."funcionario/include/form/folhaPonto.php";
echo $FolhaPonto->selectFolhaPontoTrTotal($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $idFuncionario);
				?>
			</tbody>
			<tfoot>
				<tr>
				<th></th>
					<th>Período</th>
					<th>Finalizada</th>
			         <th>Saldo Inicial</th>
                    <th>Tipo</th>
                    <th>Saldo Final</th>
                    <th>Tipo</th>
                    <th>Ação</th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_FolhaFrequencia', 'ordenaColuna_simples');
ativarForm();

</script>

