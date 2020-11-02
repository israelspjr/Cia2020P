<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";

$aulas = $_REQUEST['aulas'];
$impostos = $_REQUEST['impostos'];


$rs = $Relatorio->relatorioPagamentoTxt($where, "", $impostos, $idProfessor, $mes, $ano,  $idTipoBaixaPagamento, $aulas, 1 );

?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."pagamento/include/acao/pagamento.php"?>')"> Exportar relatório</button>
&nbsp;&nbsp;
	<a download="Exportar_fin<?php echo $mes."_".$ano?>.txt" href="data:text/plain,<?php echo $rs?>"> <button class="button red"> Exportar Folha</button></a>
&nbsp;&nbsp;
	<a download="Exportar_banco<?php echo $mes."_".$ano?>.txt" href="data:text/plain,<?php echo $rs?>"><button class="button blue" > Exportar Financeiro</button>
</a></div>



<?php

echo $Relatorio->relatorioPagamento($where, "", $impostos, $idProfessor, $mes, $ano,  $idTipoBaixaPagamento, $aulas, $mesF, $anoF, $credDeb);

?>


<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
