<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$status = $_POST["status"];
$grupo_pj = new GrupoClientePj();
$grupo = new Grupo();
$ClientePf = new ClientePf();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$NivelEstudo = new NivelEstudo();
$idGrupo = $_POST['grupo'];	


//$idNivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo);	
//$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);	
//$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$idPlanoAcaoGrupo_atual = $PlanoAcaoGrupo->getPAG_atual($idGrupo);


echo $NivelEstudo->selectNivelEstudoSelect_con("", $idPlanoAcaoGrupo_atual, " WHERE PAG.grupo_idGrupo = $idGrupo group BY N.nivel", $idPlanoAcaoGrupo_atual);
      
