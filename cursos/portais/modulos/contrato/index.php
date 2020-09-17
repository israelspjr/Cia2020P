<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Contrato = new Contrato();
	
?>
<fieldset>
	<legend>Documentos</legend>
</fieldset>   

<div id="div_lista_contrato" class="lista">
		<table id="tb_lista_contrato" class="registros">
			<thead>
				<tr>
					<th>Nome</th>
                    <th>Data de cadastro</th>
					<th>Ver documento</th>
 				</tr>
			</thead>
			<tbody>
				<?php
		echo $Contrato -> selectContratoTr(CAMINHO_CAD . "contrato/contrato.php", "modulos/cadastro/clientepf.php?id=" . $_SESSION['idClientePf_SS'], "#div_financeiro", "WHERE clientePf_idClientePf = " . $_SESSION['idClientePf_SS']. " AND naoMostrar = 0","",1);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Nome</th>
                    <th>Data de cadastro</th>
					<th>Ver contrato</th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>//tabelaDataTable('tb_lista_contrato');</script>

