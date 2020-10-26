<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$EnderecoVirtual = new EnderecoVirtual();
$ClientePf = new ClientePf();

$arrayRetorno = array();
$idEnderecoVirtual = $_REQUEST['id'];	
		
$EnderecoVirtual->setidEnderecoVirtual($idEnderecoVirtual);
$ePrinc = $_POST['princ'];
if($ePrinc!=1){
	$ePrinc = 0;
}

if($_POST['acao'] == 'deletar'){
	
	$EnderecoVirtual->deleteEnderecoVirtual();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$EnderecoVirtual->setContatoAdicionalIdContatoAdicional($_POST['contatoAdicional_IdContatoAdicional']);
	$EnderecoVirtual->setClientePfIdClientePf($_POST['clientePf_idClientePf']);
	$EnderecoVirtual->setFuncionarioIdFuncionario($_POST['funcionario_idFuncionario']);
	$EnderecoVirtual->setProfessorIdProfessor($_POST['professor_idProfessor']);
	$EnderecoVirtual->settipoEnderecoVirtual_idTipoEnderecoVirtual($_POST['idTipo']);
	$EnderecoVirtual->setValor($_POST['valor']);
  	$EnderecoVirtual->setEprinc($ePrinc);
	
	if($idEnderecoVirtual != "" && $idEnderecoVirtual > 0 ){
		$EnderecoVirtual->updateEnderecoVirtual();
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idEnderecoVirtual = $EnderecoVirtual->addEnderecoVirtual();
		
		if (($_POST['clientePf_idClientePf'] != '') && ($_POST['idTipo']) == 1) {
		
		// Adicionando no RdStation
		 $valorClientePF = $ClientePf->selectClientepf('WHERE idClientePf = '.$_POST['clientePf_idClientePf']);
		 $nomeExibicao = $valorClientePF[0]['nomeExibicao'];
?>	
	<script type='text/javascript'>
	function rdStation() {

var nome = <?php echo $nomeExibicao;?> ;
var email = <?php echo $_POST['valor'];?>;
var tel = "00000000";
var site = 'Novo Aluno cadastro feito pelo admin';
//console.log(nome);
//	console.log(email);
//	console.log(tel);
		$.ajax({
  method: "POST",
  url: "https://www.companhiadeidiomas.com.br/integraRD.php",
  data: { nome: nome, email:email, tel:tel, fonte:site }
})
  .done(function( msg ) {
   console.log( "Data Saved: " + msg );
  });
	}
 rsStation();
 </script> 
 <?php	
		}
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
