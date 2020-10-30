<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$ProdutoAdicionalPlanoAcaoGrupo = new ProdutoAdicionalPlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['id'];
?>

<fieldset>
	<legend>
		Produto adicional
	</legend>
	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL . "grupo/include/form/produtoAdicionalPlanoAcaoGrupo.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"; ?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/produtoAdicionalPlanoAcaoGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_produtoAdicionalPlanoAcaoGrupo');" />
	</div>
	<div class="lista">
		<table id="tb_lista_ProdutoAdicionalPlanoAcaoGrupo" class="registros">
			<thead>
				<tr>
					<th></th>
					<th>Produto</th>
					<th>Inicio</th>
					<th>Fim</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				//$caminhoAbrir= CAMINHO_MODULO."grupo/include/form/produtoAdicionalPlanoAcaoGrupo.php";
				$caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/produtoAdicionalPlanoAcaoGrupo.php?id=" . $idPlanoAcaoGrupo;
				$ondeAtualiza = "#div_produtoAdicionalPlanoAcaoGrupo";
				$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo";

				echo $ProdutoAdicionalPlanoAcaoGrupo -> selectProdutoAdicionalPlanoAcaoGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th>Produto</th>
					<th>Inicio</th>
					<th>Fim</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_ProdutoAdicionalPlanoAcaoGrupo', 'ordenaColuna_simples');</script>
