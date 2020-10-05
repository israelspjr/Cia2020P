<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

require_once "filtrosProf.php";?>

<style>
/*.dataTables_wrapper {
	height:30px;	
}
*/

</style>
<?php

echo $Relatorio->relatorioFrequencia($where, $tipo, false, $FME, $frequencia);
?>

<script> 
//tabelaDataTable('tb_lista_res', 'simples');
</script> 
