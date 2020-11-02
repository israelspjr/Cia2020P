<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PermissaoModulo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$PermissaoModulo = new PermissaoModulo();


$arrayRetorno = array();
//print_r($_POST);exit;

$check = $_POST['check'];
	
if($check){
	
	$idFuncionario = $_POST['idFuncionario'];
	
	$PermissaoModulo->deletePermissaoModulo(" OR ( funcionario_idFuncionario = ".$idFuncionario.")");
	
	$PermissaoModulo->setFuncionarioIdFuncionario($idFuncionario);
	
	
	foreach($check as $valor){
		$PermissaoModulo->setModuloIdModulo($valor);
		$PermissaoModulo->addPermissaoModulo();			
	}
	
	$obs = ""; 
	if( $idFuncionario == $_SESSION['idFuncionario_SS'] ) $obs = "<br /><small>Atualize a pagina para que as permissões tenham efeito</small>";
	
	$arrayRetorno['mensagem'] = "Permissões definidas com sucesso.".$obs;	
		
	$arrayRetorno['fecharNivel'] = true;
	
}else{
	$arrayRetorno['mensagem'] = "O funcionário não pode ficar sem permissões.";	
}

//$arrayRetorno['mensagem'] = MSG_CADNEW;

	
echo json_encode($arrayRetorno);

?>