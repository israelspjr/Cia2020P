<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";

?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."pagAulas/include/acao/pagAulas.php"?>')"> Exportar relatório</button>
&nbsp;&nbsp;




<?php

echo $Relatorio->relatorioPagAulas($where, $mes, $ano, $mes1, $ano1, $idProfessor, "", 3, $compara);

?>


<script> 
tabelaDataTable('tb_lista_res3');
</script> 


<?php 


//if ($compara == 1) {

//echo $Relatorio->relatorioPagAulas($where2, $mes1, $ano1, "", "", $idProfessor, "",4);

//}


?>
</div>

<script> 
//tabelaDataTable('tb_lista_res4');
</script> 