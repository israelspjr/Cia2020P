<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Professor = new Professor();
$ClientePj = new ClientePj();
$GrupoClientePj = new GrupoClientePj();

$tipo = $_POST['tipoRel'];

$where = " WHERE G.inativo = 0 AND CPF.inativo = 0 ";

 $where1 = " WHERE P.idProfessor = " . $_SESSION['idProfessor_SS'] . " AND PAG.inativo = 0 AND G.inativo = 0 ";
 
/*       $not1 = array();
	   $html = "";
      foreach ($Professor->selectGrupoProfTr_query($where1) as $res) {
        $not1[] = $res['idGrupo'];
		
		
	  }
	*/
$id = $_REQUEST['idGrupo'];
$not = implode(",",$not1); 

if ($id == "-") {
	$where .= " AND G.idGrupo IN (".$not.")";	
} else {
	$where .= " AND G.idGrupo =".$id; 
}

$idsClientes = $GrupoClientePj->selectGrupoClientePj(" WHERE grupo_idGrupo in (".$not.") Group By clientePj_idClientePj");
echo $where;
foreach($idsClientes as $valor) { 

//$idClientePj = $ClientePj->getIdClientePj_porGrupo($res['idGrupo']);
		$rs = $ClientePj->selectClientePj( "WHERE idClientePj = ".$valor['clientePj_idClientePj']);
		$Enome = $ClientePj->getNome($valor['clientePj_idClientePj']);
		$rsFreq = $rs[0]['frequenciaMinimaExigida'];
		if ($rsFreq != "")
		$html .= "<p style=\"font-size:14px; font-weight:700;\">  A frequência exigida pela empresa ".$Enome. " é: ".$rsFreq."%</p>";
}
echo $html;


$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if($mes_ini<10):
$d1 = "01-0".$mes_ini."-".$ano_ini;
else: 
$d1 = "01-".$mes_ini."-".$ano_ini;
endif;    

$data_ini = new DateTime($d1);
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];

if($mes_fim<10):
$d2 = "01-0".$mes_fim."-".$ano_fim;
else:
$d2 = "01-".$mes_fim."-".$ano_fim;
endif;

$data_fim = new DateTime($d2);
if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
	$where .= " AND FF.dataReferencia >= '{$data_ini->format('Y-m-d')}' 
	 AND FF.dataReferencia <= '{$data_fim->format('Y-m-d')}' ";
}
$frequencia = "-";

//echo $where;
?>
