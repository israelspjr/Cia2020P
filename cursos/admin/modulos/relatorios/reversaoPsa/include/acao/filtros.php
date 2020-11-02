<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$IntengranteGrupo = new IntegranteGrupo();

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$where = " WHERE 1"; 

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") $where .= " AND GT.gerente_idGerente in (".$IdGerente.")"; 
}
	
$idGrupo = $_REQUEST['grupo_idGrupo'];
if ($idGrupo != "-") {
if ($idGrupo) $where .= " AND PAG.grupo_idGrupo IN (".$idGrupo.")";	
}

$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];
if ($clientePj_idClientePj != "-") {
if($clientePj_idClientePj) $where .= " AND GCP.clientePj_idClientePj IN (".$clientePj_idClientePj.")";	
}

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
if($idIntegranteGrupo) {
$where .= " AND PIG.integranteGrupo_idIntegranteGrupo =".$idIntegranteGrupo;
}

$clientePf_idClientePf = $_REQUEST['idClientePf'];
if ($clientePf_idClientePf != "-") {
if($clientePf_idClientePf) $where .= " AND IG.clientePf_idClientePf IN (".$clientePf_idClientePf.")";	
}

$desistir = $_POST['desistente'];
if ($desistir == 1) {
$where .= " AND PIG.desistirPsa = 1";	
} else {
$where .= " AND PIG.desistirPsa = 0";		
}


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

$dataIni = $data_ini->format('Y-m-d');
$dataFim = $data_fim->format('Y-m-d');

?>
