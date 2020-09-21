<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$Contrato = new Contrato();

$idClientePj = $_SESSION['idClientePj_SS'];
?>

<fieldset>
	<legend>
		Contrato
	</legend>
	
	<div id="div_lista_contrato" class="lista">
		<table id="tb_lista_contrato" class="registros">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Ver contrato</th>					
				</tr>
			</thead>
			<tbody>
				<?php
				echo $Contrato -> selectContratoTr_rh(" WHERE clientePj_idClientePj = " . $idClientePj);
				?>
			</tbody>
		
		</table>
	</div>
</fieldset>
<script>//tabelaDataTable('tb_lista_contrato');</script>

