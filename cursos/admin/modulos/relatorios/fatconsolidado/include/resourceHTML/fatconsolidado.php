<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";

$caminhoAtualizar = CAMINHO_RELAT . "fatconsolidado/include/resourceHTML/fatconsolidado.php";
$ondeAtualizar = "tr"; 



//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];


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

?>
<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."fatconsolidado/include/acao/fatconsolidado.php"?>')"> Exportar relatório</button> Período: <?php echo Uteis::retornaNomeMes($mes)."/".$ano; ?>
</div>


<?php
echo $Relatorio->relatorioFatConsolidado($where, $caminhoAtualizar, $ondeAtualizar);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
