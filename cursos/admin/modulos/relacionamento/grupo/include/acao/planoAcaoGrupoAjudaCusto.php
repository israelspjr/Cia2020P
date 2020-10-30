<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcaoGrupoAjudaCusto = new PlanoAcaoGrupoAjudaCusto();

$arrayRetorno = array();

$idPlanoAcaoGrupoAjudaCusto = $_REQUEST['id'];

$PlanoAcaoGrupoAjudaCusto -> setIdPlanoAcaoGrupoAjudaCusto($idPlanoAcaoGrupoAjudaCusto);

if ($_POST['acao'] == "deletar") {

	$PlanoAcaoGrupoAjudaCusto -> deletePlanoAcaoGrupoAjudaCusto();
	$arrayRetorno['mensagem'] = MSG_CADDEL;

} else {

	$mesIni = $_POST['mesIni'];
	$anoIni = $_POST['anoIni'];
	$mesFim = $_POST['mesFim'];
	$anoFim = $_POST['anoFim'];

	if ($mesFim && $anoFim && strtotime("$anoFim-$mesFim-01") < strtotime("$anoIni-$mesIni-01")) {

		$arrayRetorno['mensagem'] = "Data de fim não pode ser menor que data de inicio";

	} else {
		
		if( !$mesFim || !$anoFim ){
			$mesFim = NULL;
			$anoFim = NULL;
		}
		
		$PlanoAcaoGrupoAjudaCusto -> setPlanoAcaoGrupoIdPlanoAcaoGrupo($_POST['planoAcaoGrupo_idPlanoAcaoGrupo']);
		$PlanoAcaoGrupoAjudaCusto -> setProfessorIdProfessor($_POST['idProfessor']);
		
		$PlanoAcaoGrupoAjudaCusto -> setMesIni($mesIni);		
		$PlanoAcaoGrupoAjudaCusto -> setAnoIni($anoIni);
		
		$PlanoAcaoGrupoAjudaCusto -> setMesFim($mesFim);
		$PlanoAcaoGrupoAjudaCusto -> setAnoFim($anoFim);
		
		$PlanoAcaoGrupoAjudaCusto -> setValor($_POST['valor']);
		$PlanoAcaoGrupoAjudaCusto -> setPorDia($_POST['porDia']);
		$PlanoAcaoGrupoAjudaCusto -> setDescricao($_POST['descricao']);
		$PlanoAcaoGrupoAjudaCusto -> setCobrarAluno($_POST['cobrarAluno']);

		if ($idPlanoAcaoGrupoAjudaCusto) {
			$PlanoAcaoGrupoAjudaCusto -> updatePlanoAcaoGrupoAjudaCusto();
			$arrayRetorno['mensagem'] = MSG_CADATU;
		} else {
			$idPlanoAcaoGrupoAjudaCusto = $PlanoAcaoGrupoAjudaCusto -> addPlanoAcaoGrupoAjudaCusto();
			$arrayRetorno['mensagem'] = MSG_CADNEW;
		}

		$arrayRetorno['fecharNivel'] = true;

	}

}

echo json_encode($arrayRetorno);
?>