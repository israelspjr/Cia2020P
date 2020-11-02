<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtrosC.php";

//$caminhoAtualizar = CAMINHO_RELAT . "fatconsolidado/include/resourceHTML/fatconsolidado.php";
//$ondeAtualizar = "tr"; 



//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

/*
if (isset($_REQUEST["tr"])) {

	
$id = $_POST['idDemonstrativoCobranca'];

	$ordem = $_REQUEST['ordem'];
    $ano = $_REQUEST['ano'];

	$arrayRetorno = array();  
	$idDemonstrativoCobranca = $_REQUEST["idDemonstrativoCobranca"];
	$ordem = $_REQUEST["ordem"];   
   //	Uteis::pr($_REQUEST);	
	$saida = $Relatorio -> relatorioFatConsolidado("where idDemonstrativoCobranca =".$idDemonstrativoCobranca, $caminhoAtualizar, $ondeAtualizar,true);
    $arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_Consolidado";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);    
	exit ;
}
*/
?>
<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."fatconsolidado/include/acao/fatconsolidadoComparativo.php"?>')"> Exportar relatório</button> Período: <?php echo Uteis::retornaNomeMes($mes)."/".$ano . " X ".Uteis::retornaNomeMes($mes1)."/".$ano1;  ?>
</div>
<div class="linha-inteira">
<!--
<table id="tb_lista_Consolidado" class="registros">

  <thead>
    <tr>
      <th>Grupo</th>
      <th>Valor Cobrado</th>
      <th>Total Horas Cobradas</th>
      <th>Custo Professor</th>           
      <th>Pagamento Professor</th>
      <th>Horas Realizadas</th>
      <th>Horas Repostas</th> 
    </tr>
  </thead>
  <tbody>
-->
<?php
echo $Relatorio->relatorioFatConsolidado($where, $caminhoAtualizar, $ondeAtualizar,"","",0);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
<p>&nbsp;</p>
</div>
<div class="linha-inteira">
<?php  echo Uteis::retornaNomeMes($mes1)."/".$ano1; ?>
<!--<table id="tb_lista_ConsolidadoComparativo" class="registros">

  <thead>
    <tr>
      <th>Grupo</th>
      <th>Valor Cobrado</th>
      <th>Total Horas Cobradas</th>
      <th>Custo Professor</th>           
      <th>Pagamento Professor</th>
      <th>Horas Realizadas</th>
      <th>Horas Repostas</th> 
    </tr>
  </thead>
  <tbody>
-->

<?php
echo $Relatorio->relatorioFatConsolidado($where1, $caminhoAtualizar, $ondeAtualizar,"","",1);
?>

<script> 
tabelaDataTable('tb_lista_res1', 'simples');
</script> 
<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."fatconsolidado/include/acao/fatconsolidadoComparativo2.php"?>')"> Exportar relatório</button> Período: <?php echo Uteis::retornaNomeMes($mes)."/".$ano . " X ".Uteis::retornaNomeMes($mes1)."/".$ano1;  ?>
</div>
