<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TipoImpostoProfessor = new TipoImpostoProfessor();
?>

<div id="cadastro_TipoImpostoProfessor" class="">
	<fieldset>
		<legend>
			Imposto para pagamento de professores
		</legend>
		<div class="menu_interno">
			<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO . "configuracoes/tipoimpostoprofessor/formulario.php"; ?>', '<?php echo CAMINHO_MODULO . "configuracoes/tipoimpostoprofessor/index.php"; ?>', '#cadastro_TipoImpostoProfessor');" />
		</div>
		<div class="lista">
			<table id="tb_lista_TipoImpostoProfessor" class="registros">
				<thead>
					<tr>						
						<th>Imposto</th>
						<th>Sigla</th>						
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$caminhoAbrir = CAMINHO_MODULO . "configuracoes/tipoimpostoprofessor/formulario.php";
					$caminhoAtualizar = CAMINHO_MODULO . "configuracoes/tipoimpostoprofessor/index.php";
					$ondeAtualiza = "#centro";
					$where = " WHERE excluido = 0";					
					$caminhoModulo = CAMINHO_MODULO . "configuracoes/tipoimpostoprofessor/";

					echo $TipoImpostoProfessor -> selectTipoImpostoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $caminhoModulo);
					?>
				</tbody>
				<tfoot>
					<tr>						
						<th>Imposto</th>
						<th>Sigla</th>						
						<th>Status</th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</fieldset>
	<script>
		tabelaDataTable('tb_lista_TipoImpostoProfessor');
	</script>
</div>
