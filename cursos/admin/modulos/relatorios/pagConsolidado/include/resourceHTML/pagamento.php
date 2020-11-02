<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."pagConsolidado/include/acao/pagamento.php"?>')"> Exportar relatório</button>
</div>

<?php
echo $Relatorio->relatorioPagConsolidado($where, "", $idProfessor, $mes, $ano,  $mesF, $anoF, $idTipoBaixaPagamento );
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
