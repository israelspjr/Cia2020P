<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";

$caminhoAtualizar = CAMINHO_RELAT . "consolidado/include/resourceHTML/consolidado.php";
$ondeAtualizar = "tr"; 


$id = $_POST['idDemonstrativoCobranca'];

	$ordem = $_REQUEST['ordem'];
    $ano = $_REQUEST['ano'];


//$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];


if (isset($_REQUEST["tr"])) {

	
	$arrayRetorno = array();  
	$idDemonstrativoCobranca = $_REQUEST["idDemonstrativoCobranca"];
	$ordem = $_REQUEST["ordem"];   
   //	Uteis::pr($_REQUEST);	
	$saida = $Relatorio -> relatorioConsolidado("where idDemonstrativoCobranca =".$idDemonstrativoCobranca, $caminhoAtualizar, $ondeAtualizar,true);
    $arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_Consolidado";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);    
	exit ;
}

?>
<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."consolidado/include/acao/consolidado.php"?>')"> Exportar relatório</button>
</div>
<!--
<table id="tb_lista_Consolidado" class="registros">

  <thead>
    <tr>
      <th>Grupo</th>
      <th>Empresa</th>
      <th>Parte Total Empresa R$ / NFe</th>
      <th>Parte Total Aluno R$ / NFe</th>           
      <th>Vencimento</th>
      <th>Total</th> 
    </tr>
  </thead>
  <tbody>-->

<?php
echo $Relatorio->relatorioConsolidado($where, $caminhoAtualizar, $ondeAtualizar, "", false, $campos, $camposNome);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
