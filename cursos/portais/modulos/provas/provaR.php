<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

require_once "filtrosR.php";
//echo $where;
?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel', '<?php echo "modulos/provas/provaRAcao.php"?>')"> Exportar relatório</button>
</div>

<?php
//echo $Relatorio->relatorioProva($where, $tipo, $aplicada, $excel);
$status = $_POST['status'];

if ($status == 1) {
	echo $Relatorio->relatorioProvaAplicadas($where, $tipo, $excel, $status, $where2, "", "", $campos, $camposNome);
} elseif ($status == 2) {
	echo $Relatorio->relatorioProvaAgendadas($where, $tipo, $excel, $status, $where2, 1, $campos, $camposNome, 2);
} else {
	echo $Relatorio->relatorioProvaAplicadas($where, $tipo, $excel, $status, $where2, "", "", $campos, $camposNome);
	echo "<p>&nbsp;</p>";
	echo $Relatorio->relatorioProvaAgendadas($where, $tipo, $excel, $status, $where2, 1, $campos, $camposNome, 2);
}
	

?>

<script> 
//tabelaDataTable('tb_lista_res', 'simples');
//tabelaDataTable('tb_lista_res2', 'simples');
</script> 
