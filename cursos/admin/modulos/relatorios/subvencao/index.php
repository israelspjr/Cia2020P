<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

$GerenteTem = new GerenteTem();

$where = "WHERE 1 ";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$idGrupo = $_POST['grupo_idGrupo'];
if($idGrupo > 0) $where .= " AND G.idGrupo IN(".$idGrupo.")";

$filtroTipo = $_POST['tipo']; 
if($filtroTipo != '')  $where .= " AND CDG.tipo IN(".$filtroTipo.")";

$idClientePj = $_POST['clientePj_idClientePj'];
if($idClientePj > 0)  { 

$where .= " AND CPJ.idClientePj IN(".$idClientePj.")"; 

} else {

$idGerente = implode(",",$_POST['idGerente']);

if ($idGerente != "-") {
if($idGerente) {

$IdClientePjs = $GerenteTem->selectGerenteTem(" Where gerente_idGerente in(".$idGerente.") AND dataExclusao is null");

//Uteis::pr($IdClientePjs);	

foreach ($IdClientePjs as $valor) {
	if ($valor['clientePj_idClientePj'] > 0) {
	
$id2[] = $valor['clientePj_idClientePj'];	
	}
	
}
$id2 = implode(",",$id2);
	$where .= " AND CPJ.idClientePj IN(".$id2.")";
	
}
}
}

$ano_ini = $_POST['ano'];
$mes_ini = $_POST['mes'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}

$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}

$dataInicio = $ano_ini."-".$mes_ini."-01";

$dataX = $ano_fim."-".$mes_fim."-01";

$dataFim = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataX))));

$where .= " AND (SCG.datainicio >= '".$dataInicio."')
        AND ((SCG.dataFim <= '".$dataFim."') || (SCG.dataFim is null)) GROUP BY CPF.nome";

//echo $where;
?>
<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."subvencao/subvencaoExcel.php"?>')"> Exportar relatório</button>
</div>
<div class="linha-inteira">
<fieldset>
  <legend>Subvenção de Curso</legend>
  
</fieldset>
<?php


echo $RelatorioNovo->relatorioSubvencao($where, "", $campos, $camposNome);

echo $RelatorioNovo->relatorioSubvencaoMaterial($where, "", $campos, $camposNome, 2);
?>
</div>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
tabelaDataTable('tb_lista_res2', 'simples');
</script> 
