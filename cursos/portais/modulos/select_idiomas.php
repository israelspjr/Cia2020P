<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
$status = $_POST["status"];
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$gerenteTem = new GerenteTem();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$clientePj = $_POST["clientePj"];
$gerente = $_POST['gerente'];
$quantidade = $_POST['quantidade'];
$where = " WHERE inativo = 0 ";
if(is_numeric($clientePj)){
  $gp = $grupo_pj->selectGrupoClientePj(" WHERE clientePj_idClientePj = ".$clientePj );
   for($i=0;$i<count($gp);$i++) {
    $idGrupo[$i] = $gp[$i]['grupo_idGrupo'];
  }
    $idGrupos = implode(",", $idGrupo);
 $where .= "AND idGrupo IN(".$idGrupos.")";
 $resp = $grupo->selectGrupo($where);
// Uteis::pr($resp);
for($i=0;$i<count($resp);$i++) {
	$idGrupo = (int)$resp[$i]['idGrupo'];
	$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($idGrupo); 
	$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
	
	if ($idIdioma == 4) {
		$ingles++;	
	} elseif ($idIdioma == 3) {
		$espanhol++;	
	} elseif ($idIdioma == 6) {
		$frances++;
	} elseif ($idIdioma == 5) {
		$portugues++;
	}
 }
	echo $espanhol.",".$ingles.",".$frances.",".$portugues;
}