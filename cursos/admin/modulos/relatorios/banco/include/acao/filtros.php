<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$GrupoClientePj = new GrupoClientePj();
$gerentePorEmpresa = new GerenteTem();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Professor = new Professor();

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$dataFim = date("Y-m-t");

$mes_ini = $_REQUEST['mes_ini'];
$mes_fim = $_REQUEST['mes_fim'];

$ano_ini = $_REQUEST['ano_ini'];
$ano_fim = $_REQUEST['ano_fim'];

if ($mes_ini <10) {
	$mes_ini = "0".$mes_ini;
}

$data_ini = date(" ".$ano_ini."-".$mes_ini."-01");

if ($mes_fim <10) {
	$mes_fim = "0".$mes_fim;
}

$data_fim = date(" ".$ano_fim."-".$mes_fim."-01");

 $html = " ";
 $valorx2 = 0;
 $tt=0;
 $saldoHorasSoma = 0;

$idGrupos = array();

$where = " INNER JOIN 
	planoAcaoGrupo AS PAG on PAG.grupo_idGrupo = GPJ.grupo_idGrupo
		INNER JOIN
	grupo AS G on G.idGrupo = PAG.grupo_idGrupo
		INNER JOIN
	gerenteTem AS GT ON GT.clientePj_idClientePj = GPJ.clientePj_idClientePj
  WHERE PAG.inativo = 0 AND (G.naoBancoHoras = 0 or G.naoBancoHoras is null)";

$status =  $_POST['statusG'];
if($status != "-"){
	if( $status != '' ) $where .= " AND G.inativo = ".$status;
}

$IdClientePj = $_POST['clientePj_idClientePj'];
if($IdClientePj != "-"){
	if($IdClientePj!= "") $where .= " AND GPJ.clientePj_idClientePj = ".$IdClientePj; 
}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
	if($IdGerente!= "") $where .= " AND GT.gerente_idGerente in (".$IdGerente.")"; 
}

$statusC = $_POST['statusC'];
	if($statusC != "") {
//		if ($statusC != '-') {
			$HorasS = $statusC; 
//		}
	}; 
//echo $HorasS;

$grupo_idGrupo = $_POST['grupo_idGrupo'];
if($grupo_idGrupo != "-"){
	if($grupo_idGrupo!= "") $where .= " AND G.idGrupo = ".$grupo_idGrupo; 
}

$idProfessor = $_POST['idProfessor'];

//Montar Acumulado

$dataFimMesAnterior = date("Y-m-t", strtotime("-1 months", strtotime($data_ini)));
//echo $dataFimMesAnterior."<br>";
$dataInicioSistema = "2015-02-01";

$where .= " GROUP BY GPJ.grupo_idGrupo";

$valorGrupos = $GrupoClientePj->selectGrupoClientePj($where);
//Uteis::pr($valorGrupos);

//echo $where;
?>
