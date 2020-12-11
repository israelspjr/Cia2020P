<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Proposta = new Proposta();
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Proposta excluídas
		</legend>

		<div class="lista">
			<table id="tb_lista_Proposta_hist" class="registros">
				<thead>
					<tr>
						<th></th>
						<th>Id</th>
						<th>Idioma</th>
						<th>PJ</th>
					</tr>
				</thead>
				<tbody>
					<?php
					echo $Proposta -> selectPropostaTr_hist();
					?>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th>Id</th>
						<th>Idioma</th>
						<th>PJ</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</fieldset>
</div>
<script>tabelaDataTable('tb_lista_Proposta_hist', 'ordenaColuna');</script>
