<?php
ini_set('max_execution_time', 300);
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$BancoHoras = new BancoHoras();

$idPlanoAcaoGrupo = $_REQUEST['grupo'];

$valor = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);

$idGrupo = $valor[0]['grupo_idGrupo'];

  $BancoHoras->bancoHorasTabela($idGrupo, $idPlanoAcaoGrupo, 1);

