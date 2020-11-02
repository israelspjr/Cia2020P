<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
$integrante = new IntegranteGrupo();
$GerenteTem = new GerenteTem();

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$ex =  $integrante->ExAluno(" WHERE PA.inativo = 1 OR G.inativo = 1 OR I.dataSaida is not NULL OR I.dataSaida < CURDATE()");
foreach ($ex as $valor) {
       $idsEx[] = $valor['clientePf_idClientePf']; 
   } 
$alunos = $integrante->ExAluno(" WHERE PA.inativo = 0 AND G.inativo = 0 AND (I.dataSaida is NULL OR I.dataSaida >= CURDATE())");
foreach ($alunos as $valor) {
       $idsAlunos[] = $valor['clientePf_idClientePf']; 
   }
//MONTA FILTROS 
$comgrupo = $_POST['comgrupo'];

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") {
	if($IdGerente!= "") $where .= " AND GT.gerente_idGerente in (".$IdGerente.") AND GT.dataExclusao is null"; 
	}
}



/*if($exalunos){
   $result = array_diff($idsEx, $idsAlunos);   
   $idEx = implode(",", $result);
   $where.=" AND CPF.idClientePf in($idEx)";
   $aula = true;  
}
$aluno = $_POST['aluno'];
if($aluno){   
  $idAlunos = implode(",", $idsAlunos);   
  $where.=" AND CPF.idClientePf in($idAlunos)";
  $aula = true;    
}*/
$ativo = $_POST['status'];
if($ativo==0){
    $where .= " AND CPF.inativo = 0";    
}elseif($ativo==1){
   $where .= " AND CPF.inativo = 1";  
}

$IdClientePj = $_POST['clientePj_idClientePj'];
if($IdClientePj != "-"){
if($IdClientePj!= "") $where .= " AND CPF.clientePj_idClientePj = ".$IdClientePj; 
}


$grupo_idGrupo = $_POST['grupo_idGrupo'];
if($grupo_idGrupo != "-"){
if($grupo_idGrupo!= "") $idGrupo = $grupo_idGrupo; 
}

$ididioma = $_POST['idIdioma'];
if($ididioma[0] > 0) {
$idIdioma = $ididioma;
}

$naoReceberEmail = $_POST['naoReceberEmail'];
if($naoReceberEmail != ""){
    $where .= " AND CPF.naoReceberEmail = ".$naoReceberEmail;
}


$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}
$dataInicio = $ano_ini."-".$mes_ini."-01";
$dataFim = $ano_fim."-".$mes_fim."-30";

$tipoCurso = $_REQUEST['tipoCurso'];
if  (($tipoCurso != '-' && $tipoCurso != '')) {
	$where .= " AND PA.tipoCurso = ".$tipoCurso;
	
}


//	$where .= " AND (IG.dataEntrada is null or IG.dataEntrada >= '".$ano_ini."-".$mes_ini."-01') AND (IG.dataSaida is null or IG.dataSaida <='".$ano_ini."-".$mes_ini."-30')";	


