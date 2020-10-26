<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$FolhaPonto = new FolhaPonto();

$id = $_REQUEST['id'];

$FolhaPonto->setIdFolhaPonto($id);
$finalizar = $_REQUEST['finalizar'];


if ($_POST['acao'] == "deletar") {
   
  	
    $FolhaPonto->updateFieldFolhaPonto("funcionario_idFuncionario", 4);

    $arrayRetorno['mensagem'] = "FP inutilizada com sucesso";
    $arrayRetorno['atualizarNivelAtual'] = true;


} elseif ($_REQUEST['acao'] == "gravaObs") {

    $FolhaPonto->updateFieldFolhaPonto("obs", $_POST['obs']);
    $arrayRetorno['mensagem'] = "Observação gravada com sucesso";
    $arrayRetorno['atualizarNivelAtual'] = true;


} elseif ($_REQUEST['acao'] == "saldoInicial") {

    $FolhaPonto->updateFieldFolhaPonto("saldoInicial", Uteis::gravarHoras($_POST['saldoInicial']));
	$FolhaPonto->updateFieldFolhaPonto("tipoSaldoInicial", $_POST['tipoSaldoInicial']);
    $arrayRetorno['mensagem'] = "Saldo Inicial gravado com sucesso";
    $arrayRetorno['atualizarNivelAtual'] = true;


} elseif ($_REQUEST['acao'] == "saldoFinal") {

    $FolhaPonto->updateFieldFolhaPonto("saldoFinal", Uteis::gravarHoras($_POST['saldoFinal']));
	$FolhaPonto->updateFieldFolhaPonto("tipoSaldoFinal", $_POST['tipoSaldoFinal']);
    $arrayRetorno['mensagem'] = "Saldo Final gravado com sucesso";
    $arrayRetorno['atualizarNivelAtual'] = true;


} elseif ($_REQUEST['acao'] == "finalizar") {
	
	
	 $FolhaPonto->updateFieldFolhaPonto("finalizada", $finalizar);
	 $FolhaPonto->updateFieldFolhaPonto("dataFinalizada", date('Y-m-d H:i:s'));
	 	if ($finalizar == 1) {
     		$arrayRetorno['mensagem'] = "Folha de ponto finalizada com sucesso";
		} else {
			$arrayRetorno['mensagem'] = "Folha de ponto desfinalizada com sucesso";
		}
     $arrayRetorno['fecharNivel'] = true;

	
	
}

echo json_encode($arrayRetorno);
?>