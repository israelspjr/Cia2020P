<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$KitMaterialDidatico = new KitMaterialDidatico();
?>
<div id="cadastro_KitMaterialDidatico" class="">
	<fieldset>
		<legend>
			Kit Material Didatico
		</legend>
		<div class="menu_interno">
			<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO . "configuracoes/kitmaterialdidatico/formulario.php"; ?>', '<?php echo CAMINHO_MODULO . "configuracoes/kitmaterialdidatico/index.php"; ?>', '#cadastro_KitMaterialDidatico');" />
		</div>
		<div class="lista">
			<table id="tb_lista_KitMaterialDidatico" class="registros">
				<thead>
					<tr>
						<th>idKitMaterialDidatico</th><th>Kit Material</th><th>Material Didático</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$caminhoAbrir = CAMINHO_MODULO . "configuracoes/kitmaterialdidatico/formulario.php";
					$caminhoAtualizar = CAMINHO_MODULO . "configuracoes/kitmaterialdidatico/index.php";
					$ondeAtualiza = "#centro";
					$where = " WHERE K.excluido = 0";
					$idPai = "";
					$caminhoModulo = CAMINHO_MODULO . "configuracoes/kitmaterialdidatico/";

					echo $KitMaterialDidatico -> selectKitMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>idKitMaterialDidatico</th><th>kit Material</th><th>Material Didático</th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</fieldset>
	<script>
		tabelaDataTable('tb_lista_KitMaterialDidatico', 'config');
	</script>
</div>