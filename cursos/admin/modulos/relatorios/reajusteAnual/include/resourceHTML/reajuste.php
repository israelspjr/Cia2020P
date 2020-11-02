<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";?>

<div class="linha-inteira">
    <button class="button gray" onclick="postForm('form_rel_ra', '<?php echo CAMINHO_RELAT."reajusteAnual/include/acao/reajuste.php"?>')"> Exportar relatório</button>
</div>

<?php
echo $Relatorio->relatorioReajuste($where, "", $campos, $camposNome);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 