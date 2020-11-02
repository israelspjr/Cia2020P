<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();
$gerentePorEmpresa = new GerenteTem();

$IdClientePj = $_POST['clientePj_idClientePj'];

//if($IdClientePj != "-"){
//if($IdClientePj!= "") $where .= " AND CL.idClientePj = ".$IdClientePj; 
//}

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}


$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}

//if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
$data_ini = $ano_ini."-".$mes_ini."-01";
$data_fim = $ano_fim."-".$mes_fim."-01";

//$data_fim = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($data_ini))));

$idProfessor = $_REQUEST['professor_idProfessor'];
$tipo = $_REQUEST['tipo'];
$statusG = $_REQUEST['statusG'];



?>
<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."aulasPagas/excel.php"?>')"> Exportar relatório</button> Período: <?php echo Uteis::retornaNomeMes($mes_ini) ."/".$ano_ini ?>
</div>


<?php
echo $RelatorioNovo->relatorioAulasPagas($idProfessor, false,$data_ini, $data_fim,$IdClientePj, $tipo, $statusG );
?>

<script> 
tabelaDataTable('tb_lista_res2', 'simples');
</script> 
