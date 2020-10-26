<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/VpgPlanoAcao.class.php");

$VpgPlanoAcao = new VpgPlanoAcao();

$idIntegrantePlanoAcao = $_REQUEST['idIntegrantePlanoAcao'];
$tipo = $_REQUEST['tipo'];

$VpgPlanoAcao->setIntegrantePlanoAcaoIdIntegrantePlanoAcao($idIntegrantePlanoAcao);
$VpgPlanoAcao->setTipo($tipo);
	
$VpgPlanoAcao->selectVpgPlanoAcaoLista();

?>