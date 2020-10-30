<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcao.class.php");

$PlanoAcao = new PlanoAcao();

$idPlanoAcao = $_REQUEST['id'];
$dataInicioEstagio = $_REQUEST['dataInicioEstagio'];

if( $dataInicioEstagio ){
	
	$dataPrevisaoTerminoEstagio = $PlanoAcao->calculaDataTermino( $idPlanoAcao, Uteis::gravarData($dataInicioEstagio) );
	
	$arrayRetorno['campoAtualizar'][] = "#dataPrevisaoTerminoEstagio";
	$arrayRetorno['valor'][] = Uteis::exibirData($dataPrevisaoTerminoEstagio);
	
}else{
	
	$arrayRetorno['mensagem'] = "Preencha a data de inicio de estágio";
	
}

echo json_encode($arrayRetorno);

?>