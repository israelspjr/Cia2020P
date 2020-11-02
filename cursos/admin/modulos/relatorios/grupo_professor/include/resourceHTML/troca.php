<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

require_once "../acao/filtros.php";
?>

<div class="linha-inteira">
  <button class="button gray" onclick="postForm('form_rel_troca', '<?php echo CAMINHO_RELAT."grupo_professor/include/acao/troca.php"?>')"> Exportar relatório</button>
</div>

<?php
echo $RelatorioNovo->relatorioTrocaProfessor($where, "",$tipo, $campos, $camposNome);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
