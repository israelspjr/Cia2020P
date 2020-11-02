<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$RelatorioNovo = new RelatorioNovo();
require_once "filtros.php";

?>

<div class="linha-inteira">
<div class="esquerda">    
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."aulas/aulasE.php"?>')"> Exportar relatório</button>
</div>
<div class="direita">
 <!--   <button class="button gray" onclick="GerarGrafico()">Gerar Gráfico</button>-->
</div>
</div>
<div id="relatorio_psa">

<?php echo $RelatorioNovo->relatorioAulasAssistidas($where, "", $campos, $camposNome, $dataReferencia1a,$dataReferencia2a ) ?>

</div>
<script>
tabelaDataTable('tb_lista_res', 'simples');
</script>