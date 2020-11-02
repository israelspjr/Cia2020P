<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IntegranteGrupo = new IntegranteGrupo();
$BuscaAvulsa = new BuscaAvulsa();

if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	$idClientePf = $_REQUEST["idClientePf"];    
	$ordem = $_REQUEST["ordem"];	
	$saida = $ClientePf->selectClientepfTr(" AND idClientePf = $idClientePf", true);
	$arrayRetorno["updateTr"] = $saida;  
	$arrayRetorno["tabela"] = "#tb_lista_clientepf";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}
//FILTROS
$where = "";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
/*
$nome = $_POST['nome'];
if( $nome != '' ):
   $where .= " AND CPF.nome like '%".$nome."%'";
endif;    
*/

$IdClientePj = $_POST['clientePj_idClientePj'];
if ($IdClientePj != '') {
	if ($IdClientePj != '-') {
		$where .= " AND clientePj_idClientePj = ".$IdClientePj;	
	}
}

$anoIni = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}
$anoFim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}

//if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
$dataInicio = $anoIni."-".$mes_ini."-01";
$dataFim = $anoFim."-".$mes_fim."-01";

$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataFim))));

$where .= " AND ( dataApartir between '".$dataInicio ."' AND '".$dataReferenciaFinal."' )";

//$where .= " ORDER BY dataRetorno ";
//	}
//echo $where;
?>
<!--<fieldset>
<legend>
Histórico de participação em grupos
</legend>
</fieldset>-->
<div class="linha-inteira">
<button class="button gray" onclick="postForm('form_filtra_Grupos', '<?php echo CAMINHO_RELAT."buscaAvulsa/include/acao/retorno.php"?>')">Exportar relatório</button>
</div>
 <!--<div id="lista_clientepf" class="lista">-->

      <?php echo $BuscaAvulsa->selectRelatorioBuscaAvulsaTr($where,false, $vBusca,$campos, $camposNome, false, $dataInicio, $dataReferenciaFinal);?>

<!--</div>-->
<script>
tabelaDataTable('tb_lista_res');
eventDestacar(1);
</script> 
