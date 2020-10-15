<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

require_once "filtrosProf.php";?>

<style>
#tb_lista_res1 td {
	font-size:12px;	
}

</style>
<?php

echo $Relatorio->relatorioFrequencia($where, $tipo, false, $FME, $frequencia,"","","","","","","","","","",1);
//$where = "", $tipo, $excel = false, $FME, $frequencia, $tipoR, $d1, $d2, $alunoN,$rh,$freqReal, $portalA, $PDF = false, $d1, $d2, $portalP
?>

<script> 
//tabelaDataTable('tb_lista_res', 'simples');
</script> 
