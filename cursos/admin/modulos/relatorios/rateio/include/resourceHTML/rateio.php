<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

require_once "../acao/filtros.php";?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."rateio/include/acao/rateio.php"?>')"> Exportar relatório</button>
</div>

<?php
echo $RelatorioNovo->relatorioRateio($where, "", "",$mesIni, $mesFim, $campos, $camposNome);
?>

<script> 
tabelaDataTable('tb_lista_res','simples');
</script> 
