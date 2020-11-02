<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PsaIntegranteGrupo = new PsaIntegranteGrupo();

$idPsaIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];

//echo $idIntegranteGrupo;

if ($_POST['acao'] = "desistirPsa") {

$PsaIntegranteGrupo->setIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
$PsaIntegranteGrupo->updateFieldPsaIntegranteGrupo("desistirPsa",1);

echo "Cadastro Efetuado";	
	
}

?>