<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$arrayRetorno = array();
$idPlanoAcaoGrupo = $_REQUEST['id'];

$PlanoAcaoGrupo -> setIdPlanoAcaoGrupo($idPlanoAcaoGrupo);

if ($_POST['acao'] == "deletar") {

	/*$BancoHoras -> setIdBancoHoras($idBancoHoras);
	 $BancoHoras -> deleteBancoHoras();
	 $arrayRetorno['mensagem'] = MSG_CADDEL;*/

} else {

	if ($idPlanoAcaoGrupo) {

		$PlanoAcaoGrupo -> updateFieldPlanoAcaoGrupo("dataValidade", $_POST['dataExpira']);
		$arrayRetorno['mensagem'] = MSG_CADATU;
		$arrayRetorno['fecharNivel'] = true;

	} else {

		$arrayRetorno['mensagem'] = "Não foi possível alterar a validade.";

	}

}

echo json_encode($arrayRetorno);
?>