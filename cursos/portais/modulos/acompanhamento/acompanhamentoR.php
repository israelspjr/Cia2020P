<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");


$Relatorio = new Relatorio();

require_once "filtrosR.php";?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo "modulos/desempenho/include/acao/acompanhamento.php"?>')"> Exportar relatório</button>
</div>

<?php
echo $Relatorio->relatorioAcompanhamento($where, "", "",$mes_ini, $ano_ini, $mes_fim, $ano_fim,1, $unicoAluno,$trazerfrequencia);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
