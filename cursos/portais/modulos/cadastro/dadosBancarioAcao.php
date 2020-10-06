<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DadosBancarios = new DadosBancarios();

$idProfessor = $_SESSION['idProfessor_SS'];
$banco=  $_POST['banco'];	
$agencia=  $_POST['agencia'];	
$tipo=  $_POST['tipo'];	
$numero=  $_POST['numero'];	
$idDadosBancarios=  $_POST['idDadosBancarios'];	
$favorecido = $_POST['favorecido'];	
$cpf = $_POST['cpf'];	

$DadosBancarios->setProfessorIdProfessor($idProfessor);
$DadosBancarios->setBanco($banco);
$DadosBancarios->setAgencia($agencia);
$DadosBancarios->setTipo($tipo);
$DadosBancarios->setNumero($numero);
$DadosBancarios->setFavorecido($favorecido);
$DadosBancarios->setCpf($cpf);

if($idDadosBancarios != '' && is_numeric($idDadosBancarios)){
	$DadosBancarios->updateDadosBancarios();
	$arrayRetorno['mensagem'] = MSG_CADNEW;
}else{
	$DadosBancarios->addDadosBancarios();
	$arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";
}

echo json_encode($arrayRetorno);
?>