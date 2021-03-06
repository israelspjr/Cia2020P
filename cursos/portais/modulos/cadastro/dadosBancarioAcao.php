<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DadosBancarios = new DadosBancarios();
$Configuracoes = new Configuracoes();
$Professor = new Professor();

$config = $Configuracoes->selectConfig();

$idProfessor = $_SESSION['idProfessor_SS'];
$banco=  $_POST['banco'];	
$agencia=  $_POST['agencia'];	
$tipo=  $_POST['tipo'];	
$numero=  $_POST['numero'];	
$idDadosBancarios=  $_POST['idDadosBancarios'];	
$favorecido = $_POST['favorecido'];	
$cpf = $_POST['cpf'];	
$pix = $_POST['pix'];

$nome = $Professor->getNome($idProfessor);

$DadosBancarios->setProfessorIdProfessor($idProfessor);
$DadosBancarios->setBanco($banco);
$DadosBancarios->setAgencia($agencia);
$DadosBancarios->setTipo($tipo);
$DadosBancarios->setNumero($numero);
$DadosBancarios->setFavorecido($favorecido);
$DadosBancarios->setCpf($cpf);
$DadosBancarios->setPIX($pix);

if($idDadosBancarios != '' && is_numeric($idDadosBancarios)){
	$DadosBancarios->updateDadosBancarios();
	$arrayRetorno['mensagem'] = MSG_CADNEW;
}else{
	$DadosBancarios->addDadosBancarios();
	$arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";
}

		$msg .= "<div>Conteúdo: <p>Banco:".$banco."</p><p>Agencia: ".$agencia."</p><p>Tipo:".$tipo."</p><p>Número:".$numero."</p><p>Favorecido:".$favorecido."</p><p>CPF:".$cpf."</p></div>";
		
		$assunto = "Atenção professor(a) $nome inseriu / Atualizou os dados bancários - Portal do professor";
		
					 $paraQuem = array("nome" => $config[0]['emailGeral'], "email" => $config[0]['emailGeral'] );
                     $rs = Uteis::enviarEmail($assunto, $msg, $paraQuem);
 

echo json_encode($arrayRetorno);
?>