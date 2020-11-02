<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$gerentePorEmpresa = new GerenteTem();

//require_once "frequencia.php";

//$caminhoAtualizar = CAMINHO_RELAT . "empresa/index.php";
//$ondeAtualizar = "tr"; 

$IdClientePj = $_POST['clientePj_idClientePj'];

if($IdClientePj != "-"){
if($IdClientePj!= "") $where .= " AND CL.idClientePj = ".$IdClientePj; 
}

//if ($IdClientePj > 0) {
	
//Achar idGrupos;

$statusG = $_POST['statusG'];

if ($statusG != "-") {
if ($statusG == 0) {
	$where .= " AND G.inativo = 0";
} elseif ($statusG == 1) {
	$where .= " AND G.inativo = 1";
} 
}

//$valorIdEmpresas = $gerentePorEmpresa->selectGerenteTemBH($where);
	$sql = "SELECT SQL_CACHE distinct(G.idGrupo), PAG.idPlanoAcaoGrupo, G.nome, G.inativo, PA.idPlanoAcao, N.nivel  
    FROM grupo AS G 
    INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo 
    INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao 
    INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo    
    INNER JOIN grupoClientePj AS GC ON GC.grupo_idGrupo = G.idGrupo 
	left JOIN gerenteTem AS GT ON GT.clientePj_idClientePj = GC.clientePj_idClientePj 
	INNER JOIN clientePj AS CL ON CL.idClientePj = GC.clientePj_idClientePj ".$where."  AND GT.dataExclusao is NULL";
	
//	echo $sql;
	
	$valorIdEmpresas = Uteis::executarQuery($sql);
	
	for ($x=0;$x<count($valorIdEmpresas);$x++) {
		$valorIdGrupos[] = $valorIdEmpresas[$x]['idGrupo'];
		
	}
	
	$idGrupos = $valorIdGrupos;	
	
	
	
//}

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}/*
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}*/

//if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
$data_ini = $ano_ini."-".$mes_ini."-01";
//$data_fim1 = $ano_fim."-".$mes_fim."-01";

$data_fim = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($data_ini))));

//$where .= " AND (".$valorCriterio." between '".$dataInicio ."' AND '".$dataReferenciaFinal."' )";

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
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."empresa/excel.php"?>')"> Exportar relatório</button> Período: <?php echo Uteis::retornaNomeMes($mes_ini) ."/".$ano_ini ?>
</div>


<?php
echo $Relatorio->relatorioFreqEmpresa($idGrupos, false,$data_ini, $data_fim);
?>

<script> 
tabelaDataTable('tb_lista_res1', 'simples');
</script> 
