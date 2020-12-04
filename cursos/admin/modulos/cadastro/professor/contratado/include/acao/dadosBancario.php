<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DadosBancarios.class.php");

$DadosBancarios = new DadosBancarios();

$idProfessor = $_POST['professor_idProfessor'];	
$banco=  $_POST['banco'];	
$agencia=  $_POST['agencia'];	
$tipo=  $_POST['tipo'];	
$numero=  $_POST['numero'];	
$idDadosBancarios=  $_POST['idDadosBancarios'];	
$favorecido = $_POST['favorecido'];
$cobrarDoc = $_POST['cobrarDoc'];
$valorR = $_POST['valorR'];
$dataInicio = $_POST['dataInicio'];
$dataFim = $_POST['dataFim'];
$retiraCheque = $_POST['retiraCheque'];
$obs = $_POST['obs'];
$cpf = $_POST['cpf'];
$pix = $_POST['pix'];


$DadosBancarios->setProfessorIdProfessor($idProfessor);
$DadosBancarios->setBanco($banco);
$DadosBancarios->setAgencia($agencia);
$DadosBancarios->setTipo($tipo);
$DadosBancarios->setNumero($numero);
$DadosBancarios->setFavorecido($favorecido);
$DadosBancarios->setObs($obs);
$DadosBancarios->setCpf($cpf);
$DadosBancarios->setPIX($pix);

if ($retiraCheque == 'on') {
	$retiraCheque = 1;
} else {
	$retiraCheque = 0;
}
		

$DadosBancarios->setRetiraCheque($retiraCheque);

if ($cobrarDoc == 'on') {

$DadosBancarios->setCobrarDoc(1);
$DadosBancarios->setValor($valorR);
$DadosBancarios->setDataInicio($dataInicio);
$DadosBancarios->setDataFim($dataFim);

}



if($idDadosBancarios != '' && is_numeric($idDadosBancarios)){
	$DadosBancarios->updateDadosBancarios();
	$arrayRetorno['mensagem'] = "Dados atualizados com sucesso";
}else{
	$DadosBancarios->addDadosBancarios();
	$arrayRetorno['mensagem'] = "Dados cadastrados com sucesso";
}

echo json_encode($arrayRetorno);
?>