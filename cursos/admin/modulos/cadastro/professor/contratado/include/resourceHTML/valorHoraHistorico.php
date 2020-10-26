<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

$idProfessor = $_GET['id'];

?>
<fieldset>
	<legend>
		Valor hora histórico 
	</legend>
	<div id="div_lista_valorHora" class="lista">
    <table id="tb_lista_valorHora" class="registros">
    <thead>
				<tr>
					<th>Grupo</th>
					<th>Dia / Hora</th>
					<th>Data Inicio </th>
					<th>Data Fim</th>
                    <th>Valor</th>
				</tr>
			</thead>
				<?php
			echo $RelatorioNovo -> relatorioValorHoraHistorico($idProfessor, false); 
				?>
            	<tfoot>
				<tr>
					<th>Grupo</th>
					<th>Dia / Hora</th>
					<th>Data Inicio </th>
					<th>Data Fim</th>
                    <th>Valor</th>
				</tr>
			</tfoot>    
                
                
    </table>            
</div>
</fieldset>
<script>tabelaDataTable('tb_lista_valorHora', 'simples');</script>

