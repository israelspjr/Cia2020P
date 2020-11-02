<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$Grafico = new Grafico();
require_once "../acao/filtros.php";
if(!strcmp($tipoG, "PSA")){
echo $Grafico->graficoFrequencia($filtro);
}else{
echo $Grafico->graficoPsa($filtro);
}
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
