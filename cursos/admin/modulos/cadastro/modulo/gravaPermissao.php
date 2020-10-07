<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$idModulo = $_REQUEST['id'];	
	
//	$Modulo = new Modulo();	
	$PermissaoModulo = new PermissaoModulo();	

$rsFuncionario = $_REQUEST['idFuncionario'];
if ($rsFuncionario != '') {
	$valor = $PermissaoModulo->deletePermissaoModulo(" OR modulo_idModulo = ".$idModulo);
foreach ($rsFuncionario as $valor) {
	
	$PermissaoModulo->setFuncionarioIdFuncionario($valor);
	$PermissaoModulo->setModuloIdModulo($idModulo);
	$PermissaoModulo->addPermissaoModulo();
	
	}
}

		$arrayRetorno['mensagem'] = MSG_CADNEW;
			
		$arrayRetorno['fecharNivel'] = true;		
	
		
	echo json_encode($arrayRetorno);
?>