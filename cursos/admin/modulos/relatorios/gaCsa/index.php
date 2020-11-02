<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();


$where = "WHERE 1 ";

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

if( $mes_fim && $ano_fim ){
$mesIni = $ano_ini."-".$mes_ini."-01";
$mesFim = $ano_fim."-".$mes_fim."-30";

$where .= " AND (DAF.dataAula between '".$mesIni."' AND '".$mesFim."')";
}

$idProfessor = $_REQUEST['idProfessor'];

if ($idProfessor != '') {

        $sql = "SELECT G.idGrupo, G.nome FROM professor AS P
		 INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
		 LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
		 LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
		 INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
		 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
		 WHERE ((AGP.dataFim >= '" . $ano_fim . "-" . $mes_fim  . "-01' AND AGP.dataFim <= '" . $mesFim . "') or AGP.dataFim is null OR AGP.dataFim >= '" . $mesFim . "' ) AND idProfessor=" . $idProfessor . " order by P.idProfessor";
//		 echo $sql;
		 $result =  $RelatorioNovo->executeQuery($sql);
		 $idGrupo = "";
		 foreach ($result as $valor) {
			 $idGrupo .= $valor['idGrupo'].",";
		 }
		 $idGrupo .= 0;

	$where .= " AND PAG.grupo_idGrupo IN (".$idGrupo.")";	
	
} else {
		
$idGrupo = $_REQUEST['grupo_idGrupo'];

if($idGrupo != "-") {
	$where .= " AND PAG.grupo_idGrupo IN (".$idGrupo.")";	
	}
}



$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
   $where .= " AND GER.gerente_idGerente in(".$idGerentes.")"; 
}

if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") 
        $where .= " AND GCP.clientePj_idClientePj = ".$_POST['clientePj_idClientePj'];	

$status =  $_POST['statusG'];
if($status != "-"){
if( $status != '' ) $where .= " AND G.inativo = ".$status;
}		

$idOcorrenciaFF = implode(",", $_REQUEST['idOcorrenciaFF']);
if ($idOcorrenciaFF != '-') {
	if ($idOcorrenciaFF != '') {
//		$ids = implode(",",$idOcorrenciaFF);
$where .= " AND DAF.ocorrenciaFF_idOcorrenciaFF in ( ".$idOcorrenciaFF.")";		
	}
}

$where .= " AND DAF.ocorrenciaFF_idOcorrenciaFF IS NOT NULL
			GROUP BY nome, ocorrenciaFF_idOcorrenciaFF";
			
//echo "//".$where;
?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."gaCsa/informacoes.php?"?>')"> Exportar relatório</button>
</div>

<?php
echo $RelatorioNovo->relatorioGaCsa($where, "", "",$mesIni, $mesFim);
?>

<script> 
tabelaDataTable('tb_lista_res');
</script> 
