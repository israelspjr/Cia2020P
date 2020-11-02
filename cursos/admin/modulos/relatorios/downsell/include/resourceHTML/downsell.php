<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

require_once "../acao/filtros.php";?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."downsell/include/acao/downsell.php"?>')"> Exportar relatório</button>
</div>

<?php

echo $RelatorioNovo->relatorioDownSell($where, "", false, $campos, $camposNome);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
