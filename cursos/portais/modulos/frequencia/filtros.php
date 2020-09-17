<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePf = new ClientePf();
$ClientePj = new ClientePj();

$tipo = $_POST['tipoRel'];
$tipoR = $_POST['tipoR'];
$alunoN = $tipoR;

$where = " WHERE G.inativo = 0 AND CPF.inativo = 0 ";

 $where1 =  " WHERE C.idClientePf = ".$_SESSION['idClientePf_SS']." AND (I.dataSaida > CURDATE() OR I.dataSaida IS NULL OR I.dataSaida = '') /*AND P.inativo = 0 */";
 
 	$sql = "SELECT SQL_CACHE DISTINCT(P.idPlanoAcaoGrupo), I.idIntegranteGrupo, P.planoAcao_idPlanoAcao, G.nome, G.idGrupo, NI.nivel
		FROM clientePf AS C
		INNER JOIN integranteGrupo AS I ON I.clientePf_idClientePf = C.idClientePf
		INNER JOIN planoAcaoGrupo AS P ON P.idPlanoAcaoGrupo = I.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN nivelEstudo AS NI ON NI.IdNivelEstudo = P.nivelEstudo_IdNivelEstudo 
		INNER JOIN grupo AS G ON G.idGrupo = P.grupo_idGrupo" . $where1 ." 
		ORDER BY G.nome, NI.nivel";
	//	echo $sql;
		$result = Uteis::executarQuery($sql);
		
		
       $not = array();
      foreach ($result as $res) {
        $not[] = $res['idIntegranteGrupo'];
		$idGrupo = $res['idGrupo']; 
	  }

$idClientePj = $ClientePj->getIdClientePj_porGrupo($idGrupo);
$rs = $ClientePj->selectClientePj( "WHERE idClientePj = ".$idClientePj);
$rsFreq = $rs[0]['frequenciaMinimaExigida'];
	
//$id = $_REQUEST['grupo_idGrupo'];
$not = implode(",",$not); 

	$where .= " AND IG.idIntegranteGrupo IN (".$not.")";	

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if($mes_ini<10):
$d1 = $ano_ini."-0".$mes_ini."-01";
else: 
$d1 = $ano_ini."-".$mes_ini."-01";
endif;    

$data_ini = new DateTime($d1);
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];

if($mes_fim<10):
$d2 = "01-0".$mes_fim."-".$ano_fim;
else:
$d2 = $ano_fim."-".$mes_fim."-01";
endif;

$data_fim = new DateTime($d2);
if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
	$where .= " AND FF.dataReferencia >= '{$data_ini->format('Y-m-d')}' 
	 AND FF.dataReferencia <= '{$data_fim->format('Y-m-d')}' ";
}
$frequencia = "-";

?>
