<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
$idvpg = $_REQUEST['idvpg'];
$vpg = new VpgPlanoAcao();
$valorVpgPlanoAcao = $vpg -> selectVpgPlanoAcao(" WHERE idVpgPlanoAcao = " . $idvpg);
$retorno = array(
	'idVpgPlanoAcao'=>$valorVpgPlanoAcao[0]['idVpgPlanoAcao'],
	'integrantePlanoAcao_idIntegrantePlanoAcao'=>$valorVpgPlanoAcao[0]['integrantePlanoAcao_idIntegrantePlanoAcao'],
	'valor'=>$valorVpgPlanoAcao[0]['valor'],
	'tipo'=>$valorVpgPlanoAcao[0]['tipo']
);
echo json_encode($retorno);