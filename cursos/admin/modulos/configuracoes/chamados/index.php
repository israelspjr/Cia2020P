<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Chamados = new Chamados();


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
$mesIni = $anoIni."-".$mes_ini."-01 00:00:00";
$mesFim = $anoFim."-".$mes_fim."-31 00:00:00";

//}

$status =  $_POST['status'];
if( $status != '' ) {
	
	if ($status == 0) {
	
	$where .= "where T.finalizado IS NULL";
	$where .= " AND (T.dataSolicitacao between '".$mesIni."' and '".$mesFim."')";
	
	} elseif ($status == 1) {
	
	$where .= "where T.finalizado = 1";
	$where .= " AND (T.dataSolucao between '".$mesIni."' and '".$mesFim."')";
	
	} elseif ($status == 2) {
	
	$where .= "where T.descartado = 1";
	$where .= " AND (T.dataSolucao between '".$mesIni."' and '".$mesFim."')";
	} else {
		$where .= "where 1";
		$where .= " AND (T.dataSolucao between '".$mesIni."' and '".$mesFim."')";
	}
}

$idFuncionario = $_REQUEST['idFuncionario'];
if($idFuncionario!='') $where .= " AND T.funcionario_idFuncionario = ".$idFuncionario;

$idSistema = $_REQUEST['sistema'];
if ($idSistema != '-') $where .= " AND sistema = ".$idSistema;
//echo $where;
?>

<!--<div id="cadastro_OcorrenciaFF" class="">
  <fieldset>
    <legend>Chamados do Sistema</legend>-->
    <div class="esquerda">    
	<button class="button gray" onclick="postForm('form_chamados', '<?php echo CAMINHO_MODULO."configuracoes/chamados/excel.php"?>')"> Exportar relatório</button>
</div>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/chamados/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/chamados/index.php";?>', '#lista_res');" /> </div>

          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/chamados/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/chamados/index.php";
		$ondeAtualiza= "#centro";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/chamados/";		
		
		echo $Chamados->selectChamadosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, false);
		?>

<script> 
$(document).ready( function() {
  $('#tb_lista_res').dataTable( {
	 	"aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
		 "oLanguage" : {
		
		"sSearch":       "Buscar:",
	    "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ Registros",
		"sLengthMenu":   "_MENU_ Registros",
		 "sInfoFiltered": "(filtrado de _MAX_ Total de Registros)",
		 "sInfoEmpty":    "Mostrando de 0 até 0 de 0 Registros" ,
		 "oPaginate": {
        "sFirst":    "&lt;&lt;",
        "sPrevious": "&lt;",
        "sNext":     "&gt;",
        "sLast":     "&gt;&gt;"
    }},
        "sPaginationType" : "full_numbers", 
		"bInfo": true,
		"bJQueryUI" : true,
        "aoColumns" : [ null, null, null, null, null, 
                { "sType": "custom-date" },
					 null, null, null, null, null ]
  } );
} );
</script>
<!--</div>-->
