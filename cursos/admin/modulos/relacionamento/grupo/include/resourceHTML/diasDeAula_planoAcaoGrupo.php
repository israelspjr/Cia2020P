<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AulaPermanenteGrupo.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AulaDataFixa.class.php");

	
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();

$idPlanoAcaoGrupo = $_GET['id'];	
		
$temAulaPermanenteGrupo = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
$temAulaDataFixa = $AulaDataFixa->selectAulaDataFixa(" AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
?>

<div id="div_aulaPermanenteGrupo">
  <?php if( $temAulaPermanenteGrupo || ( !$temAulaPermanenteGrupo && !$temAulaDataFixa)){      
	require_once "aulaPermanenteGrupo.php";
}?>
</div>
<div id="div_aulaDataFixa">
  <?php if( $temAulaDataFixa || ( !$temAulaPermanenteGrupo && !$temAulaDataFixa)){
	require_once "aulaDataFixa.php";
}?>
</div>
