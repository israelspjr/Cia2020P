<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$ValorHoraGrupo = new ValorHoraGrupo();

//$idPlanoAcaoGrupo = $_GET['id'];
?>

<fieldset>
	<legend>
		Valor hora
	</legend>
	<div class="menu_interno">
		<!--<img src="<?php //echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php //echo CAMINHO_REL . "grupo/include/form/valorHoraGrupo.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"; ?>', '<?php //echo CAMINHO_REL."grupo/include/resourceHTML/valorHoraGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_valorHoraGrupo');" />-->
	</div>
	<div class="lista">
		<table id="tb_lista_ValorHoraGrupo3" class="registros">
			<thead>
				<tr>
					<th></th>
					<th>Valor hora</th>
					<th>Carha horária fixa</th>
					<th>Descont/Validade</th>
					<th>Inicio</th>
					<th>Fim</th>
                    <th>Previsão de Reajuste</th>
                    <th>Não Pagar Professor </th>
                    <th>Valor Hora Professor </th>
				</tr>
			</thead>
			<tbody>
				<?php
				$caminhoAbrir = CAMINHO_REL . "grupo/include/form/valorHoraGrupo.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo;
				$caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/valorHoraGrupo.php?id=" . $idPlanoAcaoGrupo;
				$ondeAtualiza = "#div_valorHoraGrupo";
				$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo";

				echo $ValorHoraGrupo -> selectValorHoraGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);
				?>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th>Valor hora</th>
					<th>Carha horária fixa</th>
					<th>Descont/Validade</th>
					<th>Inicio</th>
					<th>Fim</th>
                    <th>Previsão de Reajuste</th>
                    <th>Não Pagar Professor </th>
                     <th>Valor Hora Professor </th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_ValorHoraGrupo3', 'simples');</script>
