<?php
//error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

require_once "filtros.php";?>

<div class="esquerda">
<p>
       <?php if ($rsFreq != "") { ?>
<p style="font-size:18px; font-weight:700;">  A frequência exigida pela empresa é: <?php echo $rsFreq."%"; 
	   }
?></p>
</p>

	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo "modulos/frequencia/frequenciaAcao.php"?>')"> Exportar relatório</button>
</div>
<?php

echo $Relatorio->relatorioFrequencia($where, $tipo, false, $FME, $frequencia, $tipoR, $d1, $d2, 0,1,$freqReal, 1);
?>

<script> 
//tabelaDataTable('tb_lista_res', 'simples');
</script> 
